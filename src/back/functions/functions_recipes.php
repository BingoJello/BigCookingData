<?php
/**
 * @param Client $client
 * @param array $session
 * @return array
 * @throws Exception
 */
function getSuggestedRecipes($client, $session){
    $contentBasedRecommenderSystem = new ContentBasedRecommenderSystem($client->getMail(), $client->getPassword());
    $contentBasedRecommenderSystem->buildRecipes($session);

    return $contentBasedRecommenderSystem->getRecipes();
}
?>


<?php
/**
 * @return array|array[]
 */
function getRandomRecipes(){
    return RecipePersistence::getRandomRecipes(NBR_RANDOM_RECIPES);
}
?>

<?php
/**
 * @param int $id_recipe
 * @return Recipe
 */
function getRecipe($id_recipe){
    return RecipePersistence::getRecipe($id_recipe);
}
?>

<?php
/**
 * @param int $id_recipe
 * @return array
 */
function getAssessRecipe($id_recipe){
    return RecipePersistence::getAllAssessedRecipe($id_recipe);
}
?>

<?php
/**
 * @param int $id_recipe
 * @return array|null
 */
function getGlobalRating($id_recipe){
    return RecipePersistence::getGlobalRatingRecipe($id_recipe);
}
?>

<?php
/**
 * @return array
 */
function getAllIngredients(){
    return RecipePersistence::getAllIngredients();
}
?>

<?php
/**
 * @param $words
 * @return array
 */
function getRecipesSearching($words){
    $process_text_search = new ProcessTextSearch($words);
    $process_text_search->build();
    return RecipePersistence::getRecipesBySearching($process_text_search->getWords());
}
?>

<?php
/**
 * @param $include_ingredients
 * @param string $exclude_ingredients
 * @return array
 */
function getRecipesIncludeExclude($include_ingredients, $exclude_ingredients = ''){
    $id_cluster = DecisionTreeCluster::getCluster($include_ingredients);
    return RecipePersistence::getRecipesByIngredientsAndCluster($id_cluster, $include_ingredients, $exclude_ingredients);
}
?>

<?php
/**
 * @return int|mixed
 */
function getNbrRecipes(){
    return RecipePersistence::getNbrRecipes();
}
?>
