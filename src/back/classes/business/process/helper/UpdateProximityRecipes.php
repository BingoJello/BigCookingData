<?php

/**
 * Class UpdateProximityRecipes
 * @brief Mets à jour les recettes proches de chaque recette
 * ATTENTION : Ce script ne doit être exécuté seulement lors de l'insertion des données dans la base de données
 * @author arthur mimouni
 */
class UpdateProximityRecipes
{
    public static function buildAllProximity(){
        $recipes = RecipePersistence::getRecipes();

        foreach($recipes as $recipe){
            self::buildProximityRecipe($recipe->getId());
        }
    }

    /**
     * @param array $id_cluster
     */
    public static function buildProximityCluster($id_cluster){
        ini_set('max_execution_time', 0);
        $recipes = RecipePersistence::getRecipesByCluster($id_cluster);

        foreach($recipes as $recipe){
            self::buildProximityRecipe($recipe->getId());
        }
    }

    /**
     * @param int $id_recipe
     */
    private static function buildProximityRecipe($id_recipe){
        $recipes_with_distance = array('recipe' => array(), 'distance' => array());
        $recipe = RecipePersistence::getRecipe($id_recipe);
        $coord_recipe = self::normalizeCoord($recipe->getCoord());
        $recipes_cluster = RecipePersistence::getRecipesByCluster([$recipe->getCluster()]);

        foreach($recipes_cluster as $recipe_cluster){
            $coord_recipe_cluster = self::normalizeCoord($recipe_cluster->getCoord());
            array_push($recipes_with_distance['distance'], (sqrt(
                (pow($coord_recipe[0]-$coord_recipe_cluster[0], 2)) +
                     (pow($coord_recipe[1]-$coord_recipe_cluster[1], 2)) +
                     (pow($coord_recipe[2]-$coord_recipe_cluster[2], 2)))
                )
            );
            array_push($recipes_with_distance['recipe'], $recipe_cluster->getId());
        }

        $nbr_distance = 0;
        $mean_distance =0;

        foreach($recipes_with_distance['distance'] as $distance){
            $nbr_distance++;
            $mean_distance += $distance;
        }
        $mean_distance /= $nbr_distance;

        $id_recipes_close = array();
        $index=0;

        array_multisort($recipes_with_distance['distance'], SORT_ASC, $recipes_with_distance['recipe']);

/*
        usort($id_recipes_close, function ($a, $b){
            if ($a->getDistance() == $b->getDistance()) return 0;
            return ($a->getDistance() < $b->getDistance())?-1:1;
        });
*/
        array_shift($recipes_with_distance['distance']);
        array_shift($recipes_with_distance['recipe']);
        foreach($recipes_with_distance['distance'] as $recipe_with_distance){
            $id_recipe_close = $recipes_with_distance['recipe'][$index];
            if($recipe_with_distance <= $mean_distance){
                array_push($id_recipes_close, $id_recipe_close);
            }
            $index++;
        }

        RecipePersistence::updateProximityRecipe($id_recipe, $id_recipes_close);
    }

    /**
     * @param string $coord
     * @return false|string[]
     */
    private static function normalizeCoord($coord){
        $coord = explode(';', $coord);

        $i =0;
        foreach($coord as $c){
            $coord[$i] = floatval($c);
            $i++;
        }
        return $coord;
    }
}