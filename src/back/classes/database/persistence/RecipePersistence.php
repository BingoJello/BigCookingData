<?php

use classes\AutoLoader;
use classes\business\model\Cluster;
AutoLoader::register();

class RecipePersistence
{
    /**
     * @brief Récupère le meilleur cluster des recettes enregistrés en favoris
     */
    public static function getBestHistoricClusterUser(int $id_client): Cluster
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

        while($row = $result->fetch())
        {
           // $favorites_history_cluster = new Cluster($row['id_cluster']);
            $favorites_history_cluster = $row['id_cluster'];
        }
        return $favorites_history_cluster;
    }

    /**
     * @brief Récupère le meilleur cluster des recettes évaluéés par l'utilisateur
     * @throws Exception
     */
    public static function getBestRatedClusterUser(int $id_client): Cluster
    {
        $favorites_rated_cluster = null;

        $query="SELECT recipe.id_cluster, AVG(assess.rating) AS rate FROM assess
				INNER JOIN recipe ON recipe.id_recipe = assess.id_recipe
				WHERE assess.id_client = ?
				GROUP BY (recipe.id_cluster)
                ORDER BY AVG(assess.rating) DESC LIMIT 1";
        $params = [$id_client];

        $result = DatabaseQuery::selectQuery($query, $params);

        while($row = $result->fetch())
        {
            //$favorites_rated_cluster = new Cluster($row['id_cluster']);
            $favorites_rated_cluster = $row['id_cluster'];
        }
        return $favorites_rated_cluster;
    }

    /**
     * @brief Récupère le meilleur cluster des recettes visualisées par l'utilisateur durant sa session
     * @throws Exception
     */
    public static function getBestVisualizationClusterUser(int $id_client, array $session): Cluster
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

            while ($row = $result->fetch()) {
                //$visualization_cluster = new Cluster($row['id_cluster']);
                $visualization_cluster = $row['id_cluster'];
            }
        }
        return $visualization_cluster;
    }

    public static function getNbrRecordedRecipes(int $id_client, int $id_cluster):int
    {
        $nbr_recorded_recipes = 0;

        $query="SELECT COUNT(recipe.id_recipe) as nbr_recipes FROM recipe
				INNER JOIN record ON record.id_recipe = recipe.id_recipe
				WHERE record.id_client = ? AND recipe.id_cluster = ?";
        $params = [$id_client, $id_cluster];

        $result = DatabaseQuery::selectQuery($query, $params);

        while($row = $result->fetch())
        {
            $nbr_recorded_recipes = $row['nbr_recipes'];
        }
        return $nbr_recorded_recipes;
    }

    public static function getRatedRecipes($id_client, $id_cluster):array
    {
        $rated_recipes = array();

        $query="SELECT assess.rating FROM assess
				INNER JOIN recipe ON recipe.id_recipe = assess.id_recipe
				WHERE assess.id_client = ? AND recipe.id_cluster = ?";
        $params = [$id_client, $id_cluster];

        $result = DatabaseQuery::selectQuery($query, $params);

        while($row = $result->fetch())
        {
            array_push($rated_recipes, $row['rating']);
        }
        return $rated_recipes;
    }

    public static function getNbrVisualizedRecipes(int $id_client, int $id_cluster, array $id_recipes):int
    {
        $nbr_visualized_recipes = 0;

        $query="SELECT COUNT(recipe.id_recipe) as nbr_recipes FROM recipe
				WHERE recipe.id_cluster = ? AND recipe.id_recipe IN (?)";
        $params = [$id_cluster, implode(",", $id_recipes)];

        $result = DatabaseQuery::selectQuery($query, $params);

        while($row = $result->fetch())
            $nbr_visualized_recipes = $row['nbr_recipes'];

        return $nbr_visualized_recipes;
    }

    public static function getRecipesCluster(int $id_cluster):array
    {
        $recipes_cluster = array();
        $query="SELECT recipe.* as FROM recipe
				WHERE recipe.id_cluster = ?";
        $params = [$id_cluster];

        $result = DatabaseQuery::selectQuery($query, $params);

        while($row = $result->fetch())
            array_push($rated_recipes, new Recipe($row['id'], $row['url_pic'], $row['summary'], $row['directions'],
                $row['prep_time'],$row['cook_time'], $row['yield'], $row['serving'], $row['ingredients'],
                new Cluster($row['cluster']), $row['categories']));

        return $recipes_cluster;
    }
}