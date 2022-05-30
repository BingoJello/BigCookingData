<?php


class InsertionRecipe
{
    public static function main($recipe_to_add = null, $id_client)
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
        $new_ingredients = array();
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
                $recipe_to_add->getIngredients()[$index_ingredient]->setUrlPic("https://assets.afcdn.com/recipe/20100101/recipe_default_img_placeholder_w1000h1000.jpg");
                array_push($new_ingredients, $recipe_to_add->getIngredients()[$index_ingredient]);
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
                $id_ingredient = RecipePersistence::getIdIngredientByName($ingredients[$index_score]);
                $recipe_to_add->getIngredients()[$index_ingredient]->setName($ingredients[$index_score]);
                $recipe_to_add->getIngredients()[$index_ingredient]->setId($id_ingredient);
                array_push($ingredients_object, $recipe_to_add->getIngredients()[$index_ingredient]);
                array_push($ingredients_recipe, $ingredients[$index_score]);
            }
        }
        $decision_tree = new DecisionTreeCluster($ingredients_recipe);
        $id_cluster = $decision_tree->getCluster();
        $recipe_to_add->setIngredients($ingredients_object);
        $recipes_close_to = RecipePersistence::getIdRecipesByIngredientsCluster($id_cluster, $ingredients_recipe);
        if(false == empty($recipes_close_to)){
            $recipe_to_add->setCloseTo(join(",", $recipes_close_to));
        }
        $recipe_to_add->setCluster($id_cluster);

        return RecipePersistence::insertRecipe($recipe_to_add, $new_ingredients, $id_client);

    }
}