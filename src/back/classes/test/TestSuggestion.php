<?php

require('src/back/classes/business/model/Client.php');
class TestSuggestion
{

    public $ingredients = array(
        0=>"tomate",1=>"jambon", 2=>"salade", 3=>"sel", 4=>"poivron", 5=>"cumin", 6=>"patate", 7=>"ail", 8=>"oignon",
        9=>"banane", 10=>"poire", 11=>"oeuf", 12=>"poulet", 13=>"agneau", 14=>"foie gras", 15=>"chocolat"
    );

    public $recipes =  array(
        1=>array("tomate", "ail", "poivron", "cumin"),
        2=>array("chocolat", "banane", "jambon"),
        3=>array("poulet", "sel", "cumin","oignon"),
        4=>array("oeuf", "salade", "jambon", "tomate", "laitue"),
        5=>array("patate", "jambon", "agneau", "poulet"),
        6=>array("lardon", "moutarde", "yaourt", "bouillon", "eau")
    );

    public $ingredients_user = array("salakis","saumon"
        //"jambon", "sel", "cumin", "patate", "banane", "banane", "jambon", "jambon", "jambon","foie gras","poire","chocolat",
        //"chocolat", "oeuf", "oeuf", "oeuf", "oeuf", "agneau", "oignon"
    );


    public Client $client;
    public array $matrix = array();
    public array $row_user = array();

    public function __construct()
    {
        $this->client = new Client(1);
        $this->matrix = $this->testBuildMatrix($this->matrix);
        $this->row_user = $this->testBuildVectorUser($this->ingredients, $this->ingredients_user);

    }

    public function testRecommendation()
    {
        $similarity_recipes = $this->testCosinusSimilarityRecipes($this->matrix, $this->row_user);
        if(count($similarity_recipes) <= 0) return array();
        print_r($this->testGetBestSimilarity($similarity_recipes));
    }

    function testGetBestSimilarity(array $recipes):array
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
        return $this->testSortRecipes($best_similarity);
    }

    function testSortRecipes(array $recipes):array
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

    private function testBuildMatrix($matrix):array
    {
        foreach ($this->recipes as $id => $recipe) {
            $row = array();
            array_push($row, $id);

            foreach ($this->ingredients as $ingredient) {
                if (in_array($ingredient, $recipe))
                {
                    array_push($row, 1);
                } else {
                    array_push($row, 0);
                }
            }
            array_push($matrix, $row);
        }
        return $matrix;
    }

    private function testBuildVectorUser(array $ingredients, array $ingredients_user):array
    {
        $row_user = array();
        $total_ingredients_user = count($ingredients_user);
        $percent_ingredients_user = array();

        foreach ($this->ingredients_user as $ingredient_user) {
            if (!array_key_exists($ingredient_user, $percent_ingredients_user))
            {
                $percent_ingredients_user[$ingredient_user] = 1;
            } else {
                $percent_ingredients_user[$ingredient_user] += 1;
            }
        }

        foreach ($percent_ingredients_user as $key => $percent_ingredient_user)
        {
            $percent_ingredients_user[$key] /= $total_ingredients_user;
        }

        array_push($row_user, $this->client->getId());

        foreach ($ingredients as $ingredient) {
            if (array_key_exists($ingredient, $percent_ingredients_user)) {
                array_push($row_user, $percent_ingredients_user[$ingredient]);
            } else {
                array_push($row_user, 0);
            }
        }

        return $row_user;
    }

    private function testCosinusSimilarityRecipes(array $matrix, array $row_user):array
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
}