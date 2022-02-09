<?php


namespace classes\business\process;

use classes\AutoLoader;
use classes\business\model\Client;
use classes\business\model\Cluster;
use Exception;
use RecipePersistence;
use ClientPersistence;

AutoLoader::register();

class SuggestionBuilder implements RecipesBuilder
{
    private Client $client;
    private array $recipes;

    /**
     * SuggestionBuilder constructor.
     * @throws Exception
     */
    public function __construct(string $mail, string $password)
    {
        $this->recipes = array();
        $this->client = ClientPersistence::getClient($mail, $password);
    }

    /**
     * @throws Exception
     */
    public function buildRecipes(array $session):array
    {
        $best_cluster_historic_user = RecipePersistence::getBestHistoricClusterUser($this->client->getId());
        $best_cluster_rated_user = RecipePersistence::getBestRatedClusterUser($this->client->getId());
        $best_cluster_visualization_user = RecipePersistence::getBestVisualizationClusterUser($this->client->getId(), $session);

        if(is_null($best_cluster_historic_user) and is_null($best_cluster_rated_user) and is_null($best_cluster_visualization_user))
        {
            //TODO
        }

        $best_cluster_user = $this->getBestCluster($best_cluster_historic_user, $best_cluster_rated_user, $best_cluster_visualization_user, $session);
    }

    /**
     * @throws Exception
     */
    private function getBestCluster(Cluster $historic_cluster, Cluster $rated_cluster, Cluster $visualization_cluster, array $session):Cluster
    {
        foreach(['historic' => $historic_cluster, 'rated' => $rated_cluster, 'visualization' => $visualization_cluster] as $key => $cluster)
        {
            if(empty($cluster) or is_null($cluster))
            {
                if(empty($preferences_ingredients_user) or !isset($preferences_ingredients_user))
                {
                    $preferences_ingredients_user = ClientPersistence::getPreferencesIngredients($this->client->getId());
                }
                switch($key)
                {
                    case 'historic':
                        $historic_cluster = DecisionTreeCluster::getCluster($preferences_ingredients_user);
                        break;
                    case 'rated':
                        $rated_cluster = DecisionTreeCluster::getCluster($preferences_ingredients_user);
                        break;
                    default:
                        $visualization_cluster = DecisionTreeCluster::getCluster($preferences_ingredients_user);
                }
            }
        }
        if($historic_cluster->getId() == $rated_cluster->getId() or $historic_cluster->getId() == $visualization_cluster->getId())
        {
            return $historic_cluster;
        }
        if ($rated_cluster->getId() == $visualization_cluster->getId())
        {
            return $rated_cluster;
        }
        else{
            $max_score_cluster = -1;
            $best_cluster = null;
            foreach([$historic_cluster, $rated_cluster, $visualization_cluster] as $cluster)
            {
                $score_cluster = $this->calculateScoreCluster($cluster, $session);
                if($score_cluster > $max_score_cluster)
                {
                    $max_score_cluster = $score_cluster;
                    $best_cluster = $cluster;
                }
            }
            return $best_cluster;
        }
    }


    private function calculateScoreCluster(Cluster $cluster, array $session):float
    {
        $score_cluster = 0;
        foreach (['historic', 'rated', 'visualization'] as $type)
        {
            switch($type) {
                case 'historic':
                    $score_cluster += (float)RecipePersistence::getNbrRecordedRecipes($this->client->getId(), $cluster->getId()) * 0.5;

                case 'rated':
                    $rating_recipes = RecipePersistence::getRatedRecipes($this->client->getId(), $cluster->getId());
                    $score_rated = 0;
                    foreach ($rating_recipes as $rating)
                    {
                        $score_rated += $rating;
                    }
                    $score_cluster += (float)($score_cluster / count($rating_recipes));

                default:
                    $id_recipes_visualization = array();
                    if (count($session['visualization']['id_recipe']) > 0)
                    {
                        foreach ($session['visualization']['id_recipe'] as $id_recipe)
                        {
                            array_push($id_recipes_visualization, $id_recipe);
                        }
                        $score_cluster += (float)RecipePersistence::getNbrVisualizedRecipes($this->client->getId(), $cluster->getId(), $id_recipes_visualization);
                    }
            }
        }
        return $score_cluster;
    }

    public function getRecipes():array
    {
        return $this->recipes;
    }
}