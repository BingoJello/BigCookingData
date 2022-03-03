<?php

require('src/back/classes/business/model/Client.php');
require('src/back/classes/business/model/RecipePersistence.php');
require('src/back/classes/business/model/ClientPersistence.php');

class GlobalSuggestionBuilder implements RecipesBuilder
{
    private Client $client;
    private array $recipes;

    /**
     * GlobalSuggestionBuilder constructor.
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
    public function buildRecipes(array $session):void
    {
        $best_cluster_historic_user = RecipePersistence::getBestHistoricClusterUser($this->client->getId());
        $best_cluster_rated_user = RecipePersistence::getBestRatedClusterUser($this->client->getId());
        $best_cluster_visualization_user = RecipePersistence::getBestVisualizationClusterUser($this->client->getId(), $session);
        $best_cluster_preferences = -1;

        if(is_null($best_cluster_historic_user) and is_null($best_cluster_rated_user) and is_null($best_cluster_visualization_user))
        {
            $preferences_ingredients = ClientPersistence::getPreferencesIngredients($this->client->getId(), 'name');
            $preferences_ingredients = implode(";", $preferences_ingredients);
            $best_cluster_preferences = DecisionTreeCluster::getCluster($preferences_ingredients);
        }

        $this->recipes = $this->buildContentBasedRecommender($best_cluster_historic_user, $best_cluster_rated_user,
            $best_cluster_visualization_user, $best_cluster_preferences, $session);
    }

    /**
     * @throws Exception
     */
    private function buildContentBasedRecommender(int $historic_cluster, int $rated_cluster, int $visualization_cluster,
                                    int $preferences_cluster = -1, array $session):array
    {
        $recipes = RecipePersistence::getRecipesByCluster([$historic_cluster, $rated_cluster, $visualization_cluster]);
        $ingredients = RecipePersistence::getIngredientsByCluster(array($historic_cluster, $rated_cluster, $visualization_cluster));
        $ingredients_user = RecipePersistence::getIngredientsByClient($this->client->getId());
        array_push($ingredients_user, RecipePersistence::getIngredientsByRecipes($session['recipes']));

        $matrix = $this->buildMatrix($recipes, $ingredients);
        $row_user = $this->buildVectorUser($ingredients, $ingredients_user);

        $similarity_recipes = cosinusSimilarityRecipes($matrix, $row_user);
        return $this->getBestSimilarity($similarity_recipes);
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
        $user_vector = 0;
        $bool_user_vector = false;
        $similarity_recipes = array();
        $index_similarity = 0;

        foreach($matrix as $row)
        {
            $product_vector = 0;
            $recipe_vector = 0;
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
                    $recipe_vector += pow($ingredient_recipe, 2);

                    if($bool_user_vector == false)
                    {
                        $user_vector +=pow($row_user[$index_item], 2);
                    }
                }
                $index_item++;
            }
            $recipe_vector = sqrt($recipe_vector);

            if($bool_user_vector == false)
            {
                $user_vector = sqrt($user_vector);
            }
            $bool_user_vector = true;
            $cross_product_vector = $user_vector * $recipe_vector;

            if($cross_product_vector != 0 and $product_vector !=0)
            {
                $similarity_recipes[$index_similarity]['id_recipe'] = $id_recipe;
                $similarity_recipes[$index_similarity]['score'] = $product_vector / ($cross_product_vector);
            }
            $index_similarity++;
        }
        return $similarity_recipes;
    }

    function sortRecipes(array $recipes):array
    {
        $sort_recipes = array();

        foreach($recipes as $recipe){
            foreach($recipe as $key=>$value){
                if(!isset($sort_recipes[$key])){
                    $sort_recipes[$key] = array();
                }
                $sort_recipes[$key][] = $value;
            }
        }
        $orderby = "score";

        array_multisort($sort_recipes[$orderby],SORT_DESC,$recipes);

        return $sort_recipes;
    }

    function getBestSimilarity(array $recipes):array
    {
        $best_similarity = array();

        $mean_similarity = 0;
        foreach($recipes as $k=>$v){
            $mean_similarity += $v['score'];
        }
        $mean_similarity /= count($recipes);

        foreach($recipes as $k=>$v)
        {
            if($v['score'] >= $mean_similarity)
            {
                array_push($best_similarity, $recipes[$k]);
            }
        }
        return $this->sortRecipes($best_similarity);
    }
    public function getRecipes():array
    {
        return $this->recipes;
    }
}