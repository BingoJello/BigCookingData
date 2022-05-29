<?php

/**
 * Class RecipeFacade
 * @author arthur mimouni
 */
class RecipeFacade
{
    /**
     * @brief Recupère les recettes à suggérer avec l'algorithme basé sur le contenu
     * @param Client $client
     * @param array $session
     * @return array
     * @throws Exception
     */
    public static function getSuggestedRecipesByContent($client, $session){
        $contentBasedRecommenderSystem = new ContentBasedRecommenderSystem($client->getMail(), $client->getPassword());
        $contentBasedRecommenderSystem->buildRecipes($session);

        return $contentBasedRecommenderSystem->getRecipes();
    }

    /**
     * @brief Recupère les recettes à suggérer avec l'algorithme basé sur le filtrage collaboratif
     * @param $client
     * @param $session
     * @return array
     * @throws Exception
     */
    public static function getSuggestedRecipesByCollaborative($client, $session){
        $contentBasedRecommenderSystem = new CollaborativeFilteringUserRecommenderSystem($client->getMail(), $client->getPassword());
        $contentBasedRecommenderSystem->buildRecipes($session);

        return $contentBasedRecommenderSystem->getRecipes();
    }

    /**
     * @brief Récupère des recettes aléatoires
     * @return array|array[]
     */
    public static function getRandomRecipes(){
        return RecipePersistence::getRandomRecipes(NBR_RANDOM_RECIPES);
    }

    /**
     * @brief Récupère la recette
     * @param int $id_recipe
     * @return Recipe
     */
    public static function getRecipe($id_recipe){
        return RecipePersistence::getRecipe($id_recipe);
    }

    /**
     * @brief Récupère la recette d'une évaluation
     * @param int $id_recipe
     * @return array
     */
    public static function getAssessRecipe($id_recipe){
        return RecipePersistence::getAllRatedOfRecipe($id_recipe);
    }

    /**
     * @brief Récupère la note global d'une recette
     * @param int $id_recipe
     * @return array|null
     */
    public static function getGlobalRating($id_recipe){
        return RecipePersistence::getGlobalRatingRecipe($id_recipe);
    }

    /**
     * @brief Récupère l'ensemble des ingrédients
     * @return array
     */
    public static function getAllIngredients(){
        return RecipePersistence::getAllIngredients();
    }

    /**
     * @brief Récupère les recettes basé sur des mots-clefs
     * @param string $words
     * @return array
     */
    public static function getRecipesSearching($words){
        $process_text_search = new ProcessTextSearch($words);
        $process_text_search->build();
        return RecipePersistence::getRecipesBySearching($process_text_search->getWords());
    }

    /**
     * @brief Récupère des recettes basés sur ingrédients inclus/exclus
     * @param $include_ingredients
     * @param string $exclude_ingredients
     * @return array|null
     */
    public static function getRecipesIncludeExclude($include_ingredients, $exclude_ingredients){
        $process_text_ingredient = new ProcessTextIngredient($include_ingredients, ';', true);
        $process_text_ingredient->build();
        $include_ingredients_name = RecipePersistence::getIngredientNameByWord($process_text_ingredient->getWords());

        $decision_tree = new DecisionTreeCluster($include_ingredients_name);
        $id_cluster = $decision_tree->getCluster();

        if(false === empty($exclude_ingredients)){
            $recipes = array();
            $recipes_include = RecipePersistence::getRecipesByIngredientsCluster($id_cluster, $include_ingredients_name);
            $process_text_ingredient = new ProcessTextIngredient($exclude_ingredients, ';', true);
            $process_text_ingredient->build();
            $exclude_ingredients_name = RecipePersistence::getIngredientNameByWord($process_text_ingredient->getWords());

            foreach($recipes_include as $recipe_include){
                $is_exclude = false;
                foreach($exclude_ingredients_name as $exclude_ingredient){
                    foreach($recipe_include->getIngredients() as $ingredient){
                        if($exclude_ingredient == $ingredient->getName()){
                            $is_exclude = true;
                            break;
                        }
                    }
                    if(true == $is_exclude){
                        break;
                    }
                }
                if(false === $is_exclude){
                    array_push($recipes, $recipe_include);
                }
            }
            return $recipes;
        }
        return RecipePersistence::getRecipesByIngredientsCluster($id_cluster, $include_ingredients_name);
    }

    /**
     * @brief Récupère le nombre de recettes
     * @return int|mixed
     */
    public static function getNbrRecipes(){
        return RecipePersistence::getNbrRecipes();
    }

    /**
     * @return int|mixed
     */
    public static function getNbrIngredients(){
        return RecipePersistence::getNbrIngredients();
    }

    public static function getSimilarRecipes($id_recipe){
        return RecipePersistence::getSimilarRecipes($id_recipe, 3);
    }

    public static function addRecipe($params, $id_client){
        $name = $_POST['name'];
        if("" != $_POST['url_pic']){
            $url_pic = $_POST['url_pic'];
        }else{
            $url_pic = "https://assets.afcdn.com/recipe/20100101/recipe_default_img_placeholder_w1000h1000.jpg";
        }

        $categories_string = "";
        if("" != $_POST['categories'][0]) {
            $index = 0;
            foreach ($_POST['categories'] as $category) {
                if ($index >= count($_POST['categories']) - 1) {
                    $categories_string .= $category;
                } else {
                    $categories_string .= $category . ";";
                }
                $index++;
            }
        }

        $prep_time = "";
        if("" != $_POST['prep_time1']){
            $prep_time.=$_POST['prep_time1']."h";
            if("" != $_POST['prep_time2']){
                if(intval($_POST['prep_time2']) < 10){
                    $prep_time.="0".$_POST['prep_time2'];
                }else{
                    $prep_time.=$_POST['prep_time2'];
                }
            }
        }else{
            $prep_time = "-";
        }

        $cook_time = "";
        if("" != $_POST['cook_time1']){
            $cook_time.=$_POST['cook_time1']."h";
            if("" != $_POST['cook_time2']){
                if(intval($_POST['cook_time2']) < 10){
                    $cook_time.="0".$_POST['cook_time2'];
                }else{
                    $cook_time.=$_POST['cook_time2'];
                }
            }
        }else{
            $cook_time = "-";
        }

        $break_time = "";
        if("" != $_POST['break_time1']){
            $break_time.=$_POST['break_time1']."h";
            if("" != $_POST['break_time2']){
                if(intval($_POST['break_time2']) < 10){
                    $break_time.="0".$_POST['break_time2'];
                }else{
                    $break_time.=$_POST['break_time2'];
                }
            }
        }else{
            $break_time = "-";
        }

        $directions = array();
        if("" != $_POST['directions'][0]) {
            foreach ($_POST['directions'] as $direction) {
                array_push($directions, $direction);
            }
        }

        $ingredients = array();
        if("" != $_POST['name_ingredient'][0] and "ingredient" != $_POST['name_ingredient'][0]) {
            $index = 0;
            foreach ($_POST['name_ingredient'] as $name_ingredient) {
                if("ingredient" == $name_ingredient or "" == $name_ingredient){
                    continue;
                }
               $ingredient = new Ingredient(null, $name_ingredient);
               if("" != $_POST['quantity'][$index]){
                   $ingredient->setQuantity($_POST['quantity'][$index]);
               }
                if("" != $_POST['unity'][$index]){
                    $ingredient->setUnity($_POST['unity'][$index]);
                }
                array_push($ingredients, $ingredient);
                $index++;
            }
        }

        $recipe = new Recipe(null, $name, $url_pic,$categories_string, $directions, $prep_time, $cook_time, $break_time);
        $recipe->setIngredients($ingredients);
        return InsertionRecipe::main($recipe, $id_client);
    }
}