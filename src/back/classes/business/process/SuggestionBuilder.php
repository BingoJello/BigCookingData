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
        $recipes = RecipePersistence::getRecipesCluster($historic_cluster, $rated_cluster, $visualization_cluster);
        $ingredients = RecipePersistence::getIngredientsByCluster(array($historic_cluster, $rated_cluster, $visualization_cluster));
        $ingredients_user = RecipePersistence::getIngredientsByClient($this->client->getId());
        array_push($ingredients_user, RecipePersistence::getIngredientsByRecipes($session['recipes']));

        $matrix = $this->buildMatrix($recipes, $ingredients);
        $row_user = $this->buildVectorUser($ingredients, $ingredients_user);

        $similarity_recipes = $this->cosinusSimilarityRecipes($matrix, $row_user);
    }

    private function buildMatrix(array $recipes, array $ingredients):array
    {
        $matrix = array();

        foreach ($recipes as $recipe) {
            $row = array();
            array_push($row, $recipe->getId());

            foreach ($ingredients as $ingredient) {
                if ($recipe->hasIngredient($ingredient->getId())) {
                    array_push($row, 1);
                } else {
                    array_push($row, 0);
                }
            }
            array_push($matrix, $row);
        }

        return $matrix;
    }

    private function buildVectorUser(array $ingredients, array $ingredients_user):array
    {
        $row_user = array();
        $percent_ingredients_user = array();
        $total_ingredients_user = count($ingredients_user);
        $percent_ingredients_user = array();

        foreach ($ingredients_user as $ingredient_user) {
            if (!array_key_exists($ingredient_user->getId(), $percent_ingredients_user)) {
                $percent_ingredients_user[$ingredient_user->getId()] = 1;
            } else {
                $percent_ingredients_user[$ingredient_user->getId()] += 1;
            }
        }

        foreach ($percent_ingredients_user as $key => $percent_ingredient_user) {
            $percent_ingredients_user[$key] /= $total_ingredients_user;
        }

        array_push($row_user, $this->client->getId());

        foreach ($ingredients as $ingredient) {
            if (array_key_exists($ingredient->getId(), $percent_ingredients_user)) {
                array_push($row_user, $percent_ingredients_user[$ingredient->getId()]);
            } else {
                array_push($row_user, 0);
            }
        }

        return $row_user;
    }

    private function cosinusSimilarityRecipes(array $matrix, array $row_user):array
    {
        $row_user_vector = 0;
        $bool_user_vector = false;
        $similarity_recipes = array();
        $index_similarity = 0;

        foreach($matrix as $row)
        {
            $product_vector = 0;
            $row_recipe_vector = 0;
            $index_item = 0;
            foreach($row as $ingredient_recipe)
            {
                if($index_item == 0)
                {
                    $id_recipe = $ingredient_recipe;
                }
                else
                {
                    $product_vector += $row_user[$index_item] * $ingredient_recipe;
                    $row_recipe_vector += pow($ingredient_recipe, 2);

                    if($bool_user_vector == false)
                    {
                        $row_user_vector +=pow($row_user[$index_item], 2);
                    }
                }
                $index_item++;
            }
            $row_recipe_vector = sqrt($row_recipe_vector);

            if($bool_user_vector == false)
            {
                $row_user_vector = sqrt($row_user_vector);
            }
            $bool_user_vector = true;
            $cross_product_vector = $row_user_vector * $row_recipe_vector;

            if($cross_product_vector != 0)
            {
                $similarity_recipes[$index_similarity]['id_recipe'] = $id_recipe;
                $similarity_recipes[$index_similarity]['score'] = $product_vector / ($cross_product_vector);
            }
            $index_similarity++;
        }
        return $similarity_recipes;
    }

    public function getRecipes():array
    {
        return $this->recipes;
    }
}