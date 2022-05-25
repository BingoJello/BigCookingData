<?php


class Test
{
    public static function addRecipe($recipe_to_add = null)
    {
        $ingredients_recipe = array();
        $process_text_ingredient = new ProcessTextIngredient("chocola noir;chocolat blanc;patates douces", ";", true);
        $process_text_ingredient->build();
        foreach($process_text_ingredient->getWords() as $word_split){
            $word_string = "";
            foreach($word_split as $word){
                $word_string.=$word;
            }
            $ingredients = RecipePersistence::getIngredientNameByWord([$word_split]);
            $best_score = null;
            $index_score = 0;
            $index = 0;
            foreach($ingredients as $ingredient){
                similar_text($word_string,$ingredient, $percent);
                if($percent > $best_score){
                    $best_score = $percent;
                    $index_score = $index;
                }
                $index++;
            }
            array_push($ingredients_recipe, $ingredients[$index_score]);
        }
        $decision_tree = new DecisionTreeCluster($ingredients_recipe);
        $id_cluster = $decision_tree->getCluster();
        var_dump($id_cluster);
        $recipes = RecipePersistence::getRecipesByCluster([$id_cluster]);
        $recipes_close_to = RecipePersistence::getRecipesByIngredientsCluster($id_cluster, $ingredients_recipe);
        var_dump($recipes_close_to);
        exit(0);



        $coord_recipe_to_add = self::normalizeCoord($recipe_to_add->getCoord());
        $list_ingredient = RecipePersistence::getAllIngredients();
        $vector_recipe = array_fill(0, count($list_ingredient), 0);
        $index = 0;
        $recipes_with_distance = array('id_cluster' => array(), 'distance' => array());

        foreach($list_ingredient as $ingredient){
            if(in_array($ingredient, $vector_recipe)){
                $vector_recipe[$index] = 1;
            }
            $index++;
        }
        foreach(RecipePersistence::getDistinctCluster() as $cluster){
            $recipe = RecipePersistence::getRandomRecipesByCluster(1, $cluster);
            $coord_recipe = self::normalizeCoord($recipe->getCoord());

            array_push($recipes_with_distance['id_cluster'], $recipe->getId());

            array_push($recipes_with_distance['distance'],
                (sqrt(
                (pow($coord_recipe_to_add[0] - $coord_recipe[0], 2)) +
                    (pow($coord_recipe_to_add[1] - $coord_recipe[1], 2)) +
                    (pow($coord_recipe_to_add[2] - $coord_recipe[2], 2)))
                )
            );

            $min_distance = 100000;
            $index = 0;
            $index_min =0;
            foreach($recipes_with_distance['distance'] as $distance){
                if($distance <= $min_distance){
                    $min_distance = $distance;
                    $index_min = $index;
                }
                $index_min++;
            }
            $best_cluster = $recipes_with_distance['id_cluster'][$index_min];

            $recipes_cluster = RecipePersistence::getRecipesByCluster([$best_cluster]);
            $recipes_with_distance = array('recipe' => array(), 'distance' => array());

            foreach($recipes_cluster as $recipe_cluster){
                $coord_recipe_cluster = self::normalizeCoord($recipe_cluster->getCoord());
                array_push($recipes_with_distance['distance'], (sqrt(
                    (pow($coord_recipe_to_add[0]-$coord_recipe_cluster[0], 2)) +
                    (pow($coord_recipe_to_add[1]-$coord_recipe_cluster[1], 2)) +
                    (pow($coord_recipe_to_add[2]-$coord_recipe_cluster[2], 2)))
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

            foreach($recipes_with_distance['distance'] as $recipe_with_distance){
                $id_recipe_close = $recipes_with_distance['recipe'][$index];
                if($recipe_with_distance <= $mean_distance){
                    array_push($id_recipes_close, $id_recipe_close);
                }
                $index++;
            }
            RecipePersistence::updateProximityRecipe($recipe_to_add->getId(), $id_recipes_close);
        }
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