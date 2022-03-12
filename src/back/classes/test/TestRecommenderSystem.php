<?php

class TestRecommenderSystem
{
    /**
     * @var Client $client
     */
    private $client;
    /**
     * @var array
     */
    private $recipes;

    private $session;

    /**
     * ContentBasedRecommenderSystem constructor.
     * @param string $mail
     * @param string $password
     * @throws Exception
     */
    public function __construct($mail, $password)
    {
        $this->recipes = array();
        $this->client = ClientPersistence::getClient($mail, $password);
        $this->session = array(
            'visualization'=> array(89, 90, 64));
    }

    /**
     * @throws Exception
     */
    public function buildRecipes()
    {
        $best_cluster_historic_user = RecipePersistence::getBestHistoricClusterUser($this->client->getId());
        $best_cluster_rated_user = RecipePersistence::getBestRatedClusterUser($this->client->getId());
        $best_cluster_visualization_user = RecipePersistence::getBestVisualizationClusterUser($this->getSession());

        $recipes = RecipePersistence::getRecipesByCluster([$best_cluster_historic_user, $best_cluster_rated_user, $best_cluster_visualization_user]);
        $ingredients_user = RecipePersistence::getIngredientsOfClient($this->client->getId());
        $ingredients = array();

        foreach(RecipePersistence::getIngredientsByRecipes($this->getSession()['visualization']) as $ingredient){
            array_push($ingredients_user, $ingredient);
        }

        foreach($ingredients_user as $ingredient){
            if(false == in_array($ingredient, $ingredients)){
                array_push($ingredients, $ingredient);
            }
        }
        $ingredients_percent = $this->buildPercentIngredient($ingredients_user);
        $row_user = $this->buildVectorUser($ingredients_percent);



        $matrix = $this->buildMatrix($recipes, $ingredients);
        $similarity_recipes = $this->cosinusSimilarityRecipes($matrix, $row_user);
        $similarity_recipes = $this->getBestSimilarity($similarity_recipes);
        var_dump($ingredients_user);
    }


    private function buildPercentIngredient($ingredients_user){
        $percent_ingredients_user = array();

        foreach ($ingredients_user as $ingredient_user) {
            if (!array_key_exists($ingredient_user->getId(), $percent_ingredients_user)) {
                $percent_ingredients_user[$ingredient_user->getId()] = 1;
            } else {
                $percent_ingredients_user[$ingredient_user->getId()] += 1;
            }
        }
        return $percent_ingredients_user;
    }

    private function buildVectorUser($ingredients_user)
    {
        $row_user = array();
        array_push($row_user, $this->client->getId());
        $total_ingredients_user = count($ingredients_user);
        foreach ($ingredients_user as $key => $percent_ingredient_user) {
            array_push($row_user, $ingredients_user[$key] /= $total_ingredients_user);
        }
        return $row_user;
    }

    /**
     * @param array $recipes
     * @param array $ingredients
     * @return array
     */
    private function buildMatrix($recipes, $ingredients_user)
    {
        $matrix = array();
        foreach ($recipes as $recipe) {
            $row = array();
            array_push($row, $recipe->getId());
            foreach ($ingredients_user as $ingredient) {
                if (true == $recipe->hasIngredient($ingredient->getId())) {
                    array_push($row, 1);
                } else {
                    array_push($row, 0);
                }
            }
            array_push($matrix, $row);
        }

        return $matrix;
    }

    /**
     * @param array $matrix
     * @param array $row_user
     * @return array
     */
    private function cosinusSimilarityRecipes($matrix, $row_user)
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
            foreach($row as $ingredient_recipe) {
                if($index_item == 0) {
                    $id_recipe = $ingredient_recipe;
                } else {
                    $product_vector += $row_user[$index_item] * $ingredient_recipe;
                    $recipe_vector += pow($ingredient_recipe, 2);

                    if($bool_user_vector == false)
                        $user_vector +=pow($row_user[$index_item], 2);

                }
                $index_item++;
            }
            $recipe_vector = sqrt($recipe_vector);

            if($bool_user_vector == false)
                $user_vector = sqrt($user_vector);

            $bool_user_vector = true;
            $cross_product_vector = $user_vector * $recipe_vector;

            if($cross_product_vector != 0 and $product_vector !=0) {
                $similarity_recipes[$index_similarity]['id_recipe'] = $id_recipe;
                $similarity_recipes[$index_similarity]['score'] = $product_vector / ($cross_product_vector);
            }
            $index_similarity++;
        }
        return $similarity_recipes;
    }

    /**
     * @param array $recipes
     * @return array
     */
    function sortRecipes($recipes)
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

    /**
     * @param array $recipes
     * @return array
     */
    function getBestSimilarity($recipes)
    {
        $best_similarity = array();

        $mean_similarity = 0;
        foreach($recipes as $k=>$v){
            $mean_similarity += $v['score'];
        }
        $mean_similarity /= count($recipes);

        foreach($recipes as $k=>$v) {
            if($v['score'] >= $mean_similarity)
                array_push($best_similarity, $recipes[$k]);
        }
        return $this->sortRecipes($best_similarity);
    }

    /**
     * @return int[][]
     */
    public function getSession(): array
    {
        return $this->session;
    }
}