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
}