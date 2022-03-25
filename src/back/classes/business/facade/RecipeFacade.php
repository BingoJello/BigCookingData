<?php

/**
 * Class RecipeFacade
 * @author arthur mimouni
 */
class RecipeFacade
{
    /**
     * @param Client $client
     * @param array $session
     * @return array
     * @throws Exception
     */
    public static function getSuggestedRecipes($client, $session){
        $contentBasedRecommenderSystem = new ContentBasedRecommenderSystem($client->getMail(), $client->getPassword());
        $contentBasedRecommenderSystem->buildRecipes($session);

        return $contentBasedRecommenderSystem->getRecipes();
    }

    /**
     * @return array|array[]
     */
    public static function getRandomRecipes(){
        return RecipePersistence::getRandomRecipes(NBR_RANDOM_RECIPES);
    }

    /**
     * @param int $id_recipe
     * @return Recipe
     */
    public static function getRecipe($id_recipe){
        return RecipePersistence::getRecipe($id_recipe);
    }

    /**
     * @param int $id_recipe
     * @return array
     */
    public static function getAssessRecipe($id_recipe){
        return RecipePersistence::getAllRatedOfRecipe($id_recipe);
    }

    /**
     * @param int $id_recipe
     * @return array|null
     */
    public static function getGlobalRating($id_recipe){
        return RecipePersistence::getGlobalRatingRecipe($id_recipe);
    }

    /**
     * @return array
     */
    public static function getAllIngredients(){
        return RecipePersistence::getAllIngredients();
    }

    /**
     * @param string $words
     * @return array
     */
    public static function getRecipesSearching($words){
        $process_text_search = new ProcessTextSearch($words);
        $process_text_search->build();
        return RecipePersistence::getRecipesBySearching($process_text_search->getWords());
    }

    /**
     * @param $include_ingredients
     * @param string $exclude_ingredients
     * @return array|null
     */
    public static function getRecipesIncludeExclude($include_ingredients, $exclude_ingredients = ''){
        $id_cluster = DecisionTreeCluster::getCluster($include_ingredients);
        return RecipePersistence::getRecipesByIngredientsAndCluster($id_cluster, $include_ingredients, false, $exclude_ingredients);
    }

    /**
     * @return int|mixed
     */
    public static function getNbrRecipes(){
        return RecipePersistence::getNbrRecipes();
    }
}