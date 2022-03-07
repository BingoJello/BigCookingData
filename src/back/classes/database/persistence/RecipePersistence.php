<?php

class RecipePersistence
{

    //select methods

    /**
     * @brief Récupère le meilleur cluster des recettes enregistrés en favoris
     * @param int $id_client
     * @return int
     */
    public static function getBestHistoricClusterUser($id_client)
    {
        $favorites_history_cluster = null;

        $query="SELECT recipe.id_cluster, COUNT(recipe.id_recipe) AS score FROM recipe
				INNER JOIN record ON record.id_recipe = recipe.id_recipe
				WHERE id_client = ?
				GROUP BY(recipe.id_cluster) 
				HAVING COUNT(recipe.id_recipe) > 0 
				ORDER BY score DESC
				LIMIT 1";
        $params = [$id_client];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row)
            $favorites_history_cluster = $row['id_cluster'];

        return $favorites_history_cluster;
    }

    /**
     * @brief Récupère le meilleur cluster des recettes évaluéés par l'utilisateur
     * @param int $id_client
     * @return int
     */
    public static function getBestRatedClusterUser($id_client)
    {
        $favorites_rated_cluster = null;

        $query="SELECT recipe.id_cluster, AVG(assess.rating) AS rate FROM assess
				INNER JOIN recipe ON recipe.id_recipe = assess.id_recipe
				WHERE assess.id_client = ?
				GROUP BY (recipe.id_cluster)
                ORDER BY AVG(assess.rating) DESC LIMIT 1";
        $params = [$id_client];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row)
            $favorites_rated_cluster = $row['id_cluster'];

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

        if(count($visualization['id_recipe']) > 0) {
            foreach ($session['visualization']['id_recipe'] as $id_recipe) {
                array_push($id_recipes_visualization, $id_recipe);
            }

            $query = "SELECT recipe.id_recipe, recipe.id_cluster, COUNT(recipe.id_cluster) as cpt FROM recipe
                  WHERE recipe.id_recipe IN (?)
                  GROUP BY(recipe.id_cluster)
                  ORDER BY cpt DESC
                  LIMIT 1";
            $params = [implode(",", $id_recipes_visualization)];

            $result = DatabaseQuery::selectQuery($query, $params);

            foreach($result as $row)
                $visualization_cluster = $row['id_cluster'];
        }
        return $visualization_cluster;
    }

    /**
     * @param array $id_cluster
     * @return array
     */
    public static function getRecipesByCluster($id_cluster)
    {
        $recipes_cluster = array();
        $query="SELECT recipe.* as FROM recipe
				WHERE recipe.id_cluster IN(?)";
        $params = [implode(",", $id_cluster)];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row) {
            array_push($rated_recipes, new Recipe($row['id'], $row['url_pic'], $row['summary'], $row['directions'],
                $row['prep_time'], $row['cook_time'], $row['yield'], $row['serving'], $row['ingredients'],
                new Cluster($row['cluster']), $row['categories']));
        }
        return $recipes_cluster;
    }

    /**
     * @param array $id_clusters
     * @return array
     */
    public static function getIngredientsByCluster($id_clusters)
    {
        $ingredients = array();
        $id_clusters = join(",", $id_clusters);

        $query="SELECT * FROM ingredient
                INNER JOIN contain_recipe_ingredient ON contain_recipe_ingredient.id_ingredient = ingredient.id_ingredient
                INNER JOIN recipe ON recipe.id_recipe = contain_recipe_ingredient.id_recipe
                WHERE recipe.id_cluster IN(".$id_clusters.")";

        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row)
            array_push($ingredients, new Ingredient($row['id'], $row['name']));

        return $ingredients;
    }

    /**
     * @param int $id_client
     * @return array
     */
    public static function getIngredientsByClient($id_client)
    {
        $ingredients = array();
        $query="SELECT * FROM ingredient
                INNER JOIN contain_recipe_ingredient ON contain_recipe_ingredient.id_ingredient = ingredient.id_ingredient
                INNER JOIN recipe ON recipe.id_recipe = contain_recipe_ingredient.id_recipe
                INNER JOIN assess ON assess.id_recipe = recipe.id_recipe
                INNER JOIN record ON record.id_recipe = recipe.id_recipe
                INNER JOIN client ON client.id_client = assess.id_client OR client.id_client = record.id_client
                WHERE client.id_client = ?";
        $params = [$id_client];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row)
            array_push($ingredients, new Ingredient($row['id'], $row['name']));

        return $ingredients;
    }

    /**
     * @param array $id_recipes
     * @return array
     */
    public static function getIngredientsByRecipes($id_recipes)
    {
        $ingredients = array();
        $id_recipes = join(",", $id_recipes);
        $query="SELECT * FROM ingredient
                INNER JOIN contain_recipe_ingredient ON contain_recipe_ingredient.id_ingredient = ingredient.id_ingredient
                INNER JOIN recipe ON recipe.id_recipe = contain_recipe_ingredient.id_recipe
                WHERE recipe.id_recipe IN(".$id_recipes.")";

        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row)
            array_push($ingredients, new Ingredient($row['id'], $row['name']));

        return $ingredients;
    }

    /**
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
                WHERE recipe.id_cluster = ? AND name.ingredient IN(".$ingredients_include.") AND name.ingredient NOT IN(".$ingredients_exclude.")";
        $params = [$id_cluster];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row)
            array_push($recipes, new Recipe($row['id'], $row['name']));

        return $ingredients;
    }

    /**
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
     * @return array
     */
    public static function getRecipes()
    {
        $recipes = array();
        $query="SELECT * FROM recipe";

        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row) {
            array_push($recipes, new Recipe($row['id_recipe'], $row['name'], $row['categories'], $row['url_pic'],
                $row['directions'], $row['prep_time'], $row['cook_time'], $row['break_time'], $row['difficulty'],
                $row['budget'], $row['serving'], $row['coordonnees']
            ));
        }
        return $recipes;
    }
}