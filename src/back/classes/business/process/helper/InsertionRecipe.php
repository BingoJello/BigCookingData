<?php


class InsertionRecipe
{
    public static function main($recipe_to_add = null)
    {
        $ingredients_recipe = array();
        $ingredients_str = "";
        $cpt = 0;
        foreach($recipe_to_add->getIngredients() as $ingredient){
            if($cpt >= count($recipe_to_add->getIngredients()) - 1){
                $ingredients_str.=$ingredient->getName();
            }
            $ingredients_str.=$ingredient->getName().";";
        }
        $process_text_ingredient = new ProcessTextIngredient($ingredients_str, ";", true);
        $process_text_ingredient->build();
        $index_ingredient = -1;
        $ingredients_object = array();
        foreach($process_text_ingredient->getWords() as $word_split){
            $index_ingredient++;
            $word_string = "";
            if(count($word_split) > 0){
                foreach($word_split as $word){
                    $word_string.=$word." ";
                }
            }else{
                $word_string = $word_split[0];
            }
            $ingredients = RecipePersistence::getIngredientNameByWord([$word_split]);
            if(true == empty($ingredients)){
                array_push($ingredients_object, $recipe_to_add->getIngredients()[$index_ingredient]);
                continue;
            }
            $best_score = null;
            $index_score = -1;
            $index = 0;
            foreach($ingredients as $ingredient){
                similar_text($word_string,$ingredient, $percent);
                if($percent > $best_score){
                    $best_score = $percent;
                    $index_score = $index;
                }
                $index++;
            }
            if($index_score != -1){
                $recipe_to_add->getIngredients()[$index_ingredient]->setName($ingredients[$index_score]);
                array_push($ingredients_object, $recipe_to_add->getIngredients()[$index_ingredient]);
                array_push($ingredients_recipe, $ingredients[$index_score]);
            }
        }
        $decision_tree = new DecisionTreeCluster($ingredients_recipe);
        $id_cluster = $decision_tree->getCluster();
        $recipe_to_add->setIngredients($ingredients_object);
        $recipes_close_to = RecipePersistence::getRecipesByIngredientsCluster($id_cluster, $ingredients_recipe);
        $recipe_to_add->setCloseTo(join(",", $recipes_close_to));
        $recipe_to_add->setCluster($id_cluster);
        //RecipePersistence::insertRecipe($recipe_to_add);
    }
}