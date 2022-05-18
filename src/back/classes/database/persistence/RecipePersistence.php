<?php

/**
 * Class RecipePersistence
 * @brief Contient l'ensemble des requêtes SQL en rapport avec les recettes
 * @author arthur mimouni
 */
class RecipePersistence
{
    /*******************
     * SELECT Method
     ******************/

    /**
     * @brief Récupère le meilleur cluster des recettes visualisées par l'utilisateur durant sa session
     * @param array $session
     * @return int
     */
    public static function getBestVisualizationClusterUser($session)
    {
        $visualization_cluster = null;
        $id_recipes_visualization = array();
        $visualization = $session['visualization'];

        if(count($visualization) > 0) {
            foreach ($session['visualization'] as $id_recipe) {
                array_push($id_recipes_visualization, $id_recipe);
            }
            $id_recipes_visualization = join(",", $id_recipes_visualization);

            $query = "SELECT recipe.id_recipe, recipe.clusterNumber, COUNT(recipe.clusterNumber) as cpt FROM recipe
                  WHERE recipe.id_recipe IN(".$id_recipes_visualization.");
                  GROUP BY(recipe.clusterNumber)
                  ORDER BY cpt DESC
                  LIMIT 1";

            $result = DatabaseQuery::selectQuery($query);

            foreach($result as $row) {
                $visualization_cluster = $row['clusterNumber'];
            }
        }
        return $visualization_cluster;
    }

    /**
     * @brief Récupère les recettes visualisées d'un cluster par l'utilisateur durant sa session
     * @param int $id_cluster
     * @param array $session
     * @return array|null
     */
    public static function getRecipesVisualizatedByCluster($id_cluster, $session){
        $recipes = array();
        $id_recipes_visualization = join(",", $session['visualization']);

        $query = "SELECT recipe.* FROM recipe
                  WHERE recipe.clusterNumber = ? AND recipe.id_recipe IN(".$id_recipes_visualization.")";
        $params = [$id_cluster];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row) {
            $recipe = new Recipe($row['id_recipe'], $row['name'], $row['url_pic'], $row['categories'],
                $row['directions'], $row['prep_time'], $row['cook_time'], $row['break_time'], $row['difficulty'], $row['budget'],
                $row['serving'], $row['clusterNumber'], $row['coordonnees'], $row['close_to'], mt_rand(3, 4));
            $recipe->setIngredients(self::getIngredientsByRecipes([$row['id_recipe']]));
            array_push($recipes, $recipe);
        }
        if(true === empty($recipes)){
            return null;
        }
        return $recipes;
    }

    /**
     * @brief Récupère les recettes les mieux évaluées par l'utilisateur
     * @param int $id_client
     * @return array
     */
    public static function getBestRatedRecipesUser($id_client){
        $recipes = array();

        $query = "SELECT DISTINCT recipe.* FROM recipe
                  INNER JOIN assess ON assess.id_recipe = recipe.id_recipe
                  INNER JOIN client ON client.id_client = assess.id_client
                  WHERE client.id_client = ? AND assess.rating >=3";
        $params = [$id_client];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row) {
            $recipe = new Recipe($row['id_recipe'], $row['name'], $row['url_pic'], $row['categories'],
                $row['directions'], $row['prep_time'], $row['cook_time'], $row['break_time'], $row['difficulty'], $row['budget'],
                $row['serving'], $row['clusterNumber'], $row['coordonnees'], $row['close_to']);
            $recipe->setIngredients(self::getIngredientsByRecipes([$row['id_recipe']]));
            array_push($recipes, $recipe);
        }
        if(true === empty($recipes)){
            return null;
        }
        return $recipes;
    }

    /**
     * @brief Récupère les recettes évaluées par l'utilisateur
     * @param int $id_client
     * @return array
     */
    public static function getRatedRecipesUser($id_client, $limit=null){
        $recipes = array();

        $query = "SELECT DISTINCT recipe.*, assess.rating FROM recipe
                  INNER JOIN assess ON assess.id_recipe = recipe.id_recipe
                  WHERE assess.id_client = ?
                  ORDER BY(date_assess) DESC";
        if(false == is_null($limit)){
            $query.=" LIMIT ".$limit;
        }

        $params = [$id_client];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row) {
            $recipe = new Recipe($row['id_recipe'], $row['name'], $row['url_pic'], $row['categories'],
                $row['directions'], $row['prep_time'], $row['cook_time'], $row['break_time'], $row['difficulty'], $row['budget'],
                $row['serving'], $row['clusterNumber'], $row['coordonnees'], $row['close_to'], $row['rating']);
            $recipe->setIngredients(self::getIngredientsByRecipes([$row['id_recipe']]));
            array_push($recipes, $recipe);
        }
        if(true === empty($recipes)){
            return null;
        }
        return $recipes;
    }

    /**
     * @brief Récupère les ID des recettes évaluées par le client
     * @param int $id_client
     * @return array
     */
    public static function getIdRecipesByClient($id_client){
        $id_recipes = array();

        $query="SELECT recipe.id_recipe FROM recipe
                INNER JOIN assess ON assess.id_recipe = recipe.id_recipe
                INNER JOIN client ON client.id_client = assess.id_client
                WHERE client.id_client = ?";
        $params = [$id_client];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row) {
            array_push($id_recipes, $row['id_recipe']);
        }
        return $id_recipes;
    }

    /**
     * @brief Récupère les recettes d'un (ou plusieurs) cluster(s)
     * @param array $id_cluster
     * @return array
     */
    public static function getRecipesByCluster($id_cluster)
    {
        $id_clusters = join(",", $id_cluster);
        $recipes_cluster = array();

        $query="SELECT recipe.* FROM recipe
				WHERE recipe.clusterNumber IN(".$id_clusters.")";

        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row) {
            array_push($recipes_cluster, new Recipe($row['id_recipe'], $row['name'], $row['url_pic'], $row['categories'],
                $row['directions'], $row['prep_time'], $row['cook_time'], $row['break_time'], $row['difficulty'], $row['budget'],
                $row['serving'], $row['clusterNumber'], $row['coordonnees'], $row['close_to']));
        }

        foreach($recipes_cluster as $recipe){
            $ingredients = array();
            $query="SELECT ingredient.* FROM ingredient
                    INNER JOIN contain_recipe_ingredient AS cri ON cri.id_ingredient = ingredient.id_ingredient
                    INNER JOIN recipe ON recipe.id_recipe = cri.id_recipe
                    WHERE recipe.id_recipe = ?";
            $params = [$recipe->getId()];

            $result = DatabaseQuery::selectQuery($query, $params);

            foreach($result as $row) {
                array_push($ingredients, new Ingredient($row['id_ingredient'], $row['name'], $row['url_pic']));
            }
            $recipe->setIngredients($ingredients);
        }
        return $recipes_cluster;
    }

    /**
     * @brief Récupère les recettes par rapport aux ingrédients (inclus et exclus) et à l'ID du cluster
     * @param int $id_cluster
     * @param array $ingredients
     * @return array|null
     */
    public static function getRecipesByIngredientsCluster($id_cluster, $ingredients, $is_object = false, $session = array()){
        $recipes = array();

        $query = "SELECT DISTINCT recipe.* FROM recipe 
                  INNER JOIN contain_recipe_ingredient AS cri ON cri.id_recipe = recipe.id_recipe 
                  INNER JOIN ingredient ON ingredient.id_ingredient = cri.id_ingredient 
                  WHERE recipe.clusterNumber = ? AND ";
        $cpt = 0;

        foreach($ingredients as $ingredient){
            if(0 == $cpt){
                if(true === $is_object){
                    $query.="ingredient.name LIKE('".addslashes($ingredient->getName())."')";
                }else{
                    $query.="ingredient.name LIKE('".addslashes($ingredient)."')";
                }
            }else {
                if(true === $is_object) {
                    $query .= " OR ingredient.name LIKE('" . addslashes($ingredient->getName()) . "')";
                }else{
                    $query .= " OR ingredient.name LIKE('" . addslashes($ingredient) . "')";
                }
            }
            $cpt++;
        }
        $query.=" GROUP BY recipe.id_recipe";

        $params = [$id_cluster];
        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row) {
            if(false === empty($session)){
                if(false === in_array($row['id_recipe'], $session['visualization'])){
                    $recipe = new Recipe($row['id_recipe'], $row['name'], $row['url_pic'], $row['categories'],
                        $row['directions'], $row['prep_time'], $row['cook_time'], $row['break_time'], $row['difficulty'], $row['budget'],
                        $row['serving'], $row['clusterNumber'], $row['coordonnees'], $row['close_to']);
                    $recipe->setIngredients(self::getIngredientsByRecipes([$row['id_recipe']]));
                    array_push($recipes, $recipe);
                }
            }else{
                $recipe = new Recipe($row['id_recipe'], $row['name'], $row['url_pic'], $row['categories'],
                    $row['directions'], $row['prep_time'], $row['cook_time'], $row['break_time'], $row['difficulty'], $row['budget'],
                    $row['serving'], $row['clusterNumber'], $row['coordonnees'], $row['close_to']);
                $recipe->setIngredients(self::getIngredientsByRecipes([$row['id_recipe']]));
                array_push($recipes, $recipe);
            }
        }

        if(true === empty($recipes)){
            return null;
        }
        return $recipes;
    }

    /**
     * @brief Récupère les recettes par rapport à une recherche à l'aide du moteur de recherche
     * @param string $keyword
     * @return array
     */
    public static function getRecipesBySearching($keywords){
        $recipes = array();
        $query="SELECT recipe.id_recipe, recipe.name, recipe.url_pic FROM recipe WHERE recipe.name LIKE '%".$keywords[0]."%'";
        array_shift($keywords);

        if(true == is_array($keywords)){
            if(0 != count($keywords)) {
                foreach ($keywords as $keyword) {
                    $query .= " AND recipe.name LIKE '%" . $keyword . "%'";
                }
            }
        }

        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row) {
            array_push($recipes, new Recipe($row['id_recipe'], $row['name'], $row['url_pic']));
        }
        return $recipes;
    }

    public static function getRecipesById($recipes_id){
        $recipes = array();
        $recipes_id = join(",", $recipes_id);

        $query = "SELECT recipe.* FROM recipe
                  WHERE recipe.id_recipe IN(".$recipes_id.")";

        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row) {
            $recipe = new Recipe($row['id_recipe'], $row['name'], $row['url_pic'], $row['categories'],
                $row['directions'], $row['prep_time'], $row['cook_time'], $row['break_time'], $row['difficulty'], $row['budget'],
                $row['serving'], $row['clusterNumber'], $row['coordonnees'], $row['close_to']);
            $recipe->setIngredients(self::getIngredientsByRecipes([$row['id_recipe']]));
            array_push($recipes, $recipe);
        }
        if(true === empty($recipes)){
            return null;
        }
        return $recipes;
    }

    /**
     * @brief Récupère l'ensemble des recettes
     * @return array
     */
    public static function getRecipes()
    {
        $recipes = array();
        $query="SELECT * FROM recipe";

        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row) {
            array_push($recipes, new Recipe($row['id_recipe'], $row['name'], $row['url_pic'], $row['categories'],
                $row['directions'], $row['prep_time'], $row['cook_time'], $row['break_time'], $row['difficulty'], $row['budget'],
                $row['serving'], $row['clusterNumber'], $row['coordonnees'], $row['close_to']));
        }
        return $recipes;
    }

    /**
     * @brief Récupère les noms des ingrédients
     * @param array $words
     */
    public static function getIngredientNameByWord($words){
        if(true === empty($words)){
            return null;
        }
        $list_words = array();
        $list_ingredient_name = array();

        foreach($words as $word){
            $name_ingredient = "";
            foreach($word as $part_word){
                $name_ingredient.="%".$part_word;
            }
            $name_ingredient.="%";
            array_push($list_words, $name_ingredient);
        }
        $query = "SELECT ingredient.name FROM ingredient WHERE ingredient.name LIKE('".$list_words[0]."')";

        array_shift($list_words);

        if(true == is_array($list_words)){
            if(0 != count($list_words)) {
                foreach ($list_words as $name_ingredient) {
                    $query .= " OR ingredient.name LIKE('".$name_ingredient."')";
                }
            }
        }
        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row) {
            array_push($list_ingredient_name,  addslashes($row['name']));
        }

        return $list_ingredient_name;
    }

    /**
     * @brief Récupère les ID des ingrédients
     * @param array $words
     */
    public static function getIdIngredientByWord($words){
        if(true === empty($words)){
            return null;
        }
        $list_words = array();
        $list_ingredient_name = array();

        foreach($words as $word){
            $name_ingredient = "";
            foreach($word as $part_word){
                $name_ingredient.="%".$part_word;
            }
            $name_ingredient.="%";
            array_push($list_words, $name_ingredient);
        }
        $query = "SELECT ingredient.id_ingredient FROM ingredient WHERE ingredient.name LIKE('".$list_words[0]."')";

        array_shift($list_words);

        if(true == is_array($list_words)){
            if(0 != count($list_words)) {
                foreach ($list_words as $name_ingredient) {
                    $query .= " OR ingredient.name LIKE('".$name_ingredient."')";
                }
            }
        }
        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row) {
            array_push($list_ingredient_name,  addslashes($row['id_ingredient']));
        }

        return $list_ingredient_name;
    }

    /**
     * @brief Récupère les ingrédients des recettes évaluées par l'utilisateur
     * @param int $id_client
     * @return array
     */
    public static function getIngredientsOfRatedRecipesByClient($id_client)
    {
        $ingredients = array();

        $query="SELECT ingredient.id_ingredient, ingredient.name, ingredient.url_pic FROM ingredient
                INNER JOIN contain_recipe_ingredient ON contain_recipe_ingredient.id_ingredient = ingredient.id_ingredient
                INNER JOIN recipe ON recipe.id_recipe = contain_recipe_ingredient.id_recipe
                INNER JOIN assess ON assess.id_recipe = recipe.id_recipe
                INNER JOIN client ON client.id_client = assess.id_client
                WHERE client.id_client = ?";
        $params = [$id_client];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row) {
            if(false === in_array($row['name'], REMOVED_INGREDIENTS)) {
                array_push($ingredients, new Ingredient($row['id_ingredient'], $row['name'], $row['url_pic']));
            }
        }
        return $ingredients;
    }

    /**
     * @brief Récupère les ingrédients des recettes demandées
     * @param array $id_recipes
     * @return array
     */
    public static function getIngredientsByRecipes($id_recipes)
    {
        $ingredients = array();
        $id_recipes = join(",", $id_recipes);

        $query="SELECT ingredient.id_ingredient, ingredient.name, ingredient.url_pic, cri.quantity FROM ingredient
                INNER JOIN contain_recipe_ingredient AS cri ON cri.id_ingredient = ingredient.id_ingredient
                INNER JOIN recipe ON recipe.id_recipe = cri.id_recipe
                WHERE recipe.id_recipe IN(".$id_recipes.")";

        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row) {
            array_push($ingredients, new Ingredient($row['id_ingredient'], $row['name'], $row['url_pic'], $row['quantity']));
        }
        return $ingredients;
    }

    /**
     * @brief Récupère l'ensemble des évaluations de la recette
     * @param int $id_recipe
     * @return array
     */
    public static function getAllRatedOfRecipe($id_recipe)
    {
        $assessed_recipe = array();

        $query="SELECT client.pseudo, assess.rating, assess.commentary, assess.date_assess FROM assess 
                INNER JOIN recipe ON recipe.id_recipe = assess.id_recipe
                INNER JOIN client ON client.id_client = assess.id_client
                WHERE recipe.id_recipe = ?";
        $params=[$id_recipe];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row) {
            array_push($assessed_recipe, new Assess($row['pseudo'], $row['rating'], $row['commentary'], $row['date_assess']));
        }
        return $assessed_recipe;
    }

    /**
     * @brief Récupère des recettes aléatoires
     * @param int $limit
     * @return array
     */
    public static function getRandomRecipes($limit)
    {
        $recipes = array('recipe' => array());
        $query="SELECT * FROM recipe ORDER BY RAND ( ) LIMIT ".$limit;

        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row) {
            array_push($recipes['recipe'], new Recipe($row['id_recipe'], $row['name'], $row['url_pic'],$row['categories'],
                $row['directions'], $row['prep_time'], $row['cook_time'], $row['break_time'], $row['difficulty'], $row['budget'],
                $row['serving'], $row['clusterNumber'], $row['coordonnees']));

        }

        return $recipes;
    }

    /**
     * @brief Récupère la note globale d'une recette
     * @param int $id_recipe
     * @return array|null
     */
    public static function getGlobalRatingRecipe($id_recipe){
        $query = "SELECT AVG(rating) AS score,COUNT(rating) AS nbr_reviews FROM assess WHERE id_recipe = ?";
        $params = [$id_recipe];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row) {
            return array('score' => $row['score'], 'nbr_reviews' => $row['nbr_reviews']);
        }
        return null;
    }

    /**
     * @brief Récupère l'ensemble des ingrédients distincts
     * @return array
     */
    public static function getAllIngredients(){
        $ingredients = array();
        $query = "SELECT DISTINCT ingredient.name FROM ingredient";

        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row) {
            array_push($ingredients, $row['name']);
        }

        return $ingredients;
    }
    /**
     * @brief Récupère la recette
     * @param int $id_recipe
     * @return Recipe
     */
    public static function getRecipe($id_recipe){
        $query="SELECT * FROM recipe WHERE recipe.id_recipe = ?";
        $params = [$id_recipe];

        $result = DatabaseQuery::selectQuery($query, $params);
        foreach($result as $row) {
            $recipe = new Recipe($row['id_recipe'], $row['name'], $row['url_pic'],$row['categories'],
                $row['directions'], $row['prep_time'], $row['cook_time'], $row['break_time'], $row['difficulty'], $row['budget'],
                $row['serving'], $row['clusterNumber'], $row['coordonnees'], $row['close_to']);
        }
        $recipe->setIngredients(self::getIngredientsByRecipes([$row['id_recipe']]));

        return $recipe;
    }

    /**
     * @brief Récupère le nombre total de recette
     * @return int|mixed
     */
    public static function getNbrRecipes(){
        $query="SELECT COUNT(*) as nbr_recipe FROM recipe";

        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row) {
            return $row['nbr_recipe'];
        }
        return 0;
    }

    /**
     * @brief Récupère le nombre total d'ingrédients
     * @return int|mixed
     */
    public static function getNbrIngredients(){
        $query="SELECT COUNT(*) as nbr_ingredient FROM ingredient";

        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row) {
            return $row['nbr_ingredient'];
        }
        return 0;
    }

    /**
     * @brief Récupère les recettes proches des recettes demandées
     * @param array $id_recipes
     * @return array|null
     */
    public static function getProximityRecipes($id_recipes){
        $recipes = array();
        $id_recipes_proximity = array();
        $id_recipes_string = "";
        $cpt_id_recipes = 0;

        foreach($id_recipes as $id){
            if($cpt_id_recipes == count($id_recipes) - 1){
                $id_recipes_string.=$id;
            }else{
                $id_recipes_string.=$id.",";
            }
            $cpt_id_recipes++;
        }

        $query = "SELECT DISTINCT recipe.* FROM recipe
                  WHERE recipe.id_recipe IN(".$id_recipes_string.")";

        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row) {
            $proximity_recipes = explode(',', $row['close_to']);
            foreach($proximity_recipes as $id_recipe){
                if(false === in_array($id_recipe, $id_recipes_proximity) and false == in_array($id_recipe, $id_recipes)){
                    array_push($id_recipes_proximity, $id_recipe);
                    $recipe = self::getRecipe($id_recipe);
                    array_push($recipes, $recipe);
                }
            }
        }

        if(true === empty($recipes)){
            return null;
        }

        return $recipes;
    }

    /**
     * @param int $random_limit
     * @param array $not_in_ingredients
     * @return array
     */
    public static function getRandomIngredients($random_limit, $not_in_ingredients){
        $ingredients = array();

        $query = "SELECT ingredient.id_ingredient FROM ingredient 
                  WHERE ingredient.id_ingredient";
        if(0 == empty($not_in_ingredients)){
            $not_in_ingredients = join(",", $not_in_ingredients);
            $query.=" NOT IN(".$not_in_ingredients.")";
        }
        $query.=" ORDER BY RAND() LIMIT ".$random_limit;
        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row) {
            array_push($ingredients, $row['id_ingredient']);
        }
        return $ingredients;
    }

    /**
     * @brief Récupère les clients qui ont évalué au moins une recette de celles évalués par l'utilisateur ciblé
     * @param int $id_client
     * @param array $id_recipes
     * @return array
     */
    public static function getClientsOfRatingsSimilarRecipes($id_client, $id_recipes){
        $recipes_users = array('id_users' => array(), 'users' => array(), 'id_recipes' => array());

        $id_recipes = join(",", $id_recipes);

        $query = " SELECT assess.id_recipe, assess.id_client, assess.rating FROM assess
                   WHERE assess.id_recipe IN(".$id_recipes.") AND assess.id_client != ?
                   ORDER BY assess.id_client";

        $params = [$id_client];
        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row) {
            if (false === in_array($row['id_recipe'], $recipes_users['id_recipes'])) {
                array_push($recipes_users['id_recipes'], $row['id_recipe']);
            }

            if (false === in_array($row['id_client'], $recipes_users['id_users'])) {
                $client = new Client($row['id_client']);
                array_push($recipes_users['id_users'], $client->getId());
                array_push($recipes_users['users'], $client);
            }
            $key_client = array_search($row['id_client'], $recipes_users['id_users']);
            $client = $recipes_users['users'][$key_client];

            $client->addRatedRecipes(new Rating($row['id_recipe'], $row['rating']));

            $recipes_users['users'][$key_client] = $client;
        }
        return $recipes_users;
    }

    /**
     * @param $id_client
     * @param $id_recipes
     * @return array|array[]
     */
    public static function getRatedRecipesSimilarUser($id_client, $id_client_similar_user){
        $recipes_users = array('id_users' => array(), 'users' => array(), 'id_recipes' => array());

        $id_client_similar_user = join(",", $id_client_similar_user);

        $query = " SELECT assess.id_recipe, assess.id_client, assess.rating FROM assess
                   WHERE assess.i IN(".$id_client_similar_user.") AND assess.id_client != ?
                   ORDER BY assess.id_client";

        $params = [$id_client];
        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row) {
            if (false === in_array($row['id_recipe'], $recipes_users['id_recipes'])) {
                array_push($recipes_users['id_recipes'], $row['id_recipe']);
            }

            if (false === in_array($row['id_client'], $recipes_users['id_users'])) {
                $client = new Client($row['id_client']);
                array_push($recipes_users['id_users'], $client->getId());
                array_push($recipes_users['users'], $client);
            }
            $key_client = array_search($row['id_client'], $recipes_users['id_users']);
            $client = $recipes_users['users'][$key_client];

            $client->addRatedRecipes(new Rating($row['id_recipe'], $row['rating']));

            $recipes_users['users'][$key_client] = $client;
        }
        return $recipes_users;
    }

    /*******************
     * UPDATE Methods
     ******************/

    /**
     * @brief Met à jour les recettes proches d'une recette
     * @param int $id_recipe
     * @param array $recipes_close_to
     */
    public static function updateProximityRecipe($id_recipe, $recipes_close_to){
        $recipes_close_to = join(",", $recipes_close_to);
        $query = "UPDATE recipe
                  SET close_to = '".$recipes_close_to."'
                  WHERE recipe.id_recipe = ".$id_recipe;
        DatabaseQuery::updateQuery($query);
    }
}