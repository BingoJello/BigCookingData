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
        $best_cluster_preferences = -1;

        if(is_null($best_cluster_historic_user) and is_null($best_cluster_rated_user) and is_null($best_cluster_visualization_user))
        {
            $preferences_ingredients = ClientPersistence::getPreferencesIngredients($this->client->getId());
            $preferences_ingredients = implode(";", $preferences_ingredients);
            $best_cluster_preferences = DecisionTreeCluster::getCluster($preferences_ingredients);
        }

        $best_cluster_user = $this->buildContentBasedRecommender($best_cluster_historic_user, $best_cluster_rated_user,
            $best_cluster_visualization_user, $best_cluster_preferences, $session);
    }

    /**
     * @throws Exception
     */
    private function buildContentBasedRecommender(int $historic_cluster, int $rated_cluster, int $visualization_cluster,
                                    int $preferences_cluster = -1, array $session):int
    {
        $recipes = RecipePersistence::getRecipesCluster($historic_cluster, $rated_recipes, $visualization_cluster);
        $ingredients = RecipePersistence::getIngredientsByCluster(array($historic_cluster, $rated_cluster, $visualization_cluster));
        $matrix = array();
        $ingredients_user = RecipePersistence::getIngredientsByClient($this->client->getId());
        $percent_ingredients_user = array();

        foreach ($recipes as $recipe)
        {
            $row = array();
            array_push($row, $recipe->getId());

            foreach ($ingredients as $ingredient)
            {
                if($recipe->hasIngredient($ingredient))
                {
                    array_push($row, 1);
                }
                else
                {
                    array_push($row, 0);
                }
            }
            array_push($matrix, $row);
        }


        foreach($ingredients_user as $ingredient_user)
        {
            if (!array_key_exists($ingredient_user->getId(), $percent_ingredients_user))
            {
                $percent_ingredients_user[$ingredient_user->getId()] = 1;
            }
            else
            {
                $percent_ingredients_user[$ingredient_user->getId()] += 1;
            }
        }

        $total_ingredients_user = count($ingredients_user);

        foreach ($percent_ingredients_user as $key=>$value)
        {
            $value /= $total_ingredients_user;
            $percent_ingredients_user[$key] = $value;
        }
    }

    public function getRecipes():array
    {
        return $this->recipes;
    }
}