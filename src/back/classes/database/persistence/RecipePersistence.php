<?php

/**
 * Class RecipePersistence
 * @author arthur mimouni
 */
class RecipePersistence
{
    /*******************
     * SELECT Method
     ******************/

    /**
     * @brief Récupère le meilleur cluster des recettes enregistrés en favoris
     * @param int $id_client
     * @return int
     */
    public static function getBestHistoricClusterUser($id_client)
    {
        $favorites_history_cluster = null;

        $query="SELECT recipe.clusterNumber, COUNT(recipe.id_recipe) AS score FROM recipe
				INNER JOIN record ON record.id_recipe = recipe.id_recipe
				WHERE id_client = ?
				GROUP BY(recipe.clusterNumber) 
				HAVING COUNT(recipe.id_recipe) > 0 
				ORDER BY score DESC
				LIMIT 1";
        $params = [$id_client];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row)
            $favorites_history_cluster = $row['clusterNumber'];

        return $favorites_history_cluster;
    }

    /**
     * @brief Récupère le meilleur cluster des recettes évaluées par l'utilisateur
     * @param int $id_client
     * @return int
     */
    public static function getBestRatedClusterUser($id_client)
    {
        $favorites_rated_cluster = null;

        $query="SELECT recipe.clusterNumber, AVG(assess.rating) AS rate FROM assess
				INNER JOIN recipe ON recipe.id_recipe = assess.id_recipe
				WHERE assess.id_client = ?
				GROUP BY (recipe.clusterNumber)
                ORDER BY AVG(assess.rating) DESC LIMIT 1";
        $params = [$id_client];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row)
            $favorites_rated_cluster = $row['clusterNumber'];

        return $favorites_rated_cluster;
    }

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
            $params = [];

            $result = DatabaseQuery::selectQuery($query, $params);

            foreach($result as $row)
                $visualization_cluster = $row['clusterNumber'];
        }
        return $visualization_cluster;
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
        $params = [];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row) {
            array_push($recipes_cluster, new Recipe($row['id_recipe'], $row['name'], $row['categories'], $row['url_pic'],
                $row['directions'], $row['prep_time'], $row['cook_time'], $row['break_time'], $row['difficulty'], $row['budget'],
                $row['serving'], $row['clusterNumber'], $row['coordonnees']));
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
     * @brief Récupère l'ensemble des ingrédients d'un (ou plusieurs) cluster(s)
     * @param array $id_clusters
     * @return array
     */
    public static function getIngredientsByCluster($id_clusters)
    {
        $ingredients = array();
        $id_clusters = join(",", $id_clusters);

        $query="SELECT DISTINCT ingredient.id_ingredient, ingredient.name, ingredient.url_pic FROM ingredient
                INNER JOIN contain_recipe_ingredient ON contain_recipe_ingredient.id_ingredient = ingredient.id_ingredient
                INNER JOIN recipe ON recipe.id_recipe = contain_recipe_ingredient.id_recipe
                WHERE recipe.clusterNumber IN(".$id_clusters.")";

        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row)
            array_push($ingredients, new Ingredient($row['id_ingredient'], $row['name'], $row['url_pic']));

        return $ingredients;
    }

    /**
     * @brief Récupère les ingrédients des recettes enregistrés / évalués / visualisés par l'utilisateur
     * @param int $id_client
     * @return array
     */
    public static function getIngredientsOfClient($id_client)
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

        foreach($result as $row)
            array_push($ingredients, new Ingredient($row['id_ingredient'], $row['name'], $row['url_pic']));

        $query="SELECT ingredient.id_ingredient, ingredient.name, ingredient.url_pic FROM ingredient
                INNER JOIN contain_recipe_ingredient ON contain_recipe_ingredient.id_ingredient = ingredient.id_ingredient
                INNER JOIN recipe ON recipe.id_recipe = contain_recipe_ingredient.id_recipe
                INNER JOIN record ON record.id_recipe = recipe.id_recipe
                INNER JOIN client ON client.id_client = record.id_client
                WHERE client.id_client = ?";
        $params = [$id_client];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row)
            array_push($ingredients, new Ingredient($row['id_ingredient'], $row['name'], $row['url_pic']));

        return $ingredients;
    }

    /**
     * @brief Récupère les ingrédients des recettes selectionnés
     * @param array $id_recipes
     * @return array
     */
    public static function getIngredientsByRecipes($id_recipes)
    {
        $ingredients = array();
        $id_recipes = join(",", $id_recipes);

        $query="SELECT ingredient.id_ingredient, ingredient.name, ingredient.url_pic FROM ingredient
                INNER JOIN contain_recipe_ingredient AS cri ON cri.id_ingredient = ingredient.id_ingredient
                INNER JOIN recipe ON recipe.id_recipe = cri.id_recipe
                WHERE recipe.id_recipe IN(".$id_recipes.")";
        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row)
            array_push($ingredients, new Ingredient($row['id_ingredient'], $row['name'], $row['url_pic']));
        return $ingredients;
    }

    /**
     * @brief Récupère les recettes par rapport aux ingrédients (inclus et exclus) et à l'ID du cluster
     * @param int $id_cluster
     * @param array $ingredients_include
     * @param array $ingredients_exclude
     * @return array
     */
    public static function getRecipesByIngredientsAndCluster($id_cluster, $ingredients_include, $ingredients_exclude)
    {
        $ingredients = array();
        $ingredients_include = "'".join("','",$ingredients_include)."'";
        $ingredients_exclude = "'".join("','",$ingredients_exclude)."'";
        $query="SELECT * FROM recipe
                INNER JOIN contain_recipe_ingredient ON contain_recipe_ingredient.id_ingredient = ingredient.id_ingredient
                INNER JOIN recipe ON recipe.id_recipe = contain_recipe_ingredient.id_recipe
                WHERE recipe.clusterNumber = ? AND name.ingredient IN(".$ingredients_include.") AND name.ingredient NOT IN(".$ingredients_exclude.")";
        $params = [$id_cluster];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row)
            array_push($recipes, new Recipe($row['id'], $row['name']));

        return $ingredients;
    }

    /**
     * @brief Récupère l'ID de(s) l'ingrédient(s)
     * @param array $ingredients_name
     * @return array
     */
    public static function getIdIngredientByName($ingredients_name)
    {
        $id_ingredients = array();
        $ingredients_name_join = "'".join("','",$ingredients_name)."'";

        $query="SELECT ingredient.id_ingredient FROM ingredient
                WHERE ingredient.name IN(".$ingredients_name_join.")";

        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row)
            array_push($id_ingredients, $row['id_ingredient']);

        return $id_ingredients;
    }

    /**
     * @brief Récupère l'ensemble des évaluations de la recette
     * @param $id_recipe
     * @return array
     */
    public static function getAllAssessedRecipe($id_recipe)
    {
        $assessed_recipe = array();

        $query="SELECT client.pseudo, assess.rating, assess.commentary, assess.date_assess FROM assess 
                INNER JOIN recipe ON recipe.id_recipe = assess.id_recipe
                INNER JOIN client ON client.id_client = assess.id_client
                WHERE recipe.id_recipe = ?";
        $params=[$id_recipe];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row)
            array_push($assessed_recipe, new Assess($row['pseudo'], $row['rating'], $row['commentary'], $row['date_assess']));

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
            array_push($recipes['recipe'], new Recipe($row['id_recipe'], $row['name'], $row['categories'], $row['url_pic'],
                $row['directions'], $row['prep_time'], $row['cook_time'], $row['break_time'], $row['difficulty'], $row['budget'],
                $row['serving'], $row['clusterNumber'], $row['coordonnees']));
        }

        return $recipes;
    }

    /**
     * @brief Récupère la recette
     * @param $id_recipe
     * @return Recipe
     */
    public static function getRecipe($id_recipe){
        $query="SELECT * FROM recipe WHERE recipe.id_recipe = ?";
        $params = [$id_recipe];
        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row) {
            $recipe = new Recipe($row['id_recipe'], $row['name'], $row['categories'], $row['url_pic'],
                $row['directions'], $row['prep_time'], $row['cook_time'], $row['break_time'], $row['difficulty'], $row['budget'],
                $row['serving'], $row['clusterNumber'], $row['coordonnees']);
        }
        $recipe->setIngredients(self::getIngredientsByRecipes([$id_recipe]));

        return $recipe;
    }

    /**
     * @brief Récupère les recettes
     * @return array
     */
    public static function getRecipes()
    {
        $recipes = array();
        $query="SELECT * FROM recipe";

        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row) {
            array_push($recipes, new Recipe($row['id_recipe'], $row['name'], $row['categories'], $row['url_pic'],
                    $row['directions'], $row['prep_time'], $row['cook_time'], $row['break_time'], $row['difficulty'], $row['budget'],
                    $row['serving'], $row['clusterNumber'], $row['coordonnees']));
        }
        return $recipes;
    }
}