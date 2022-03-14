<?php
/**
 * @param $client
 * @param $session
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
function getRecipe($id_recipe){
    return RecipePersistence::getRecipe($id_recipe);
}
?>

<?php
/**
 * @param $id_recipe
 * @return array
 */
function getAssessRecipe($id_recipe){
    return RecipePersistence::getAllAssessedRecipe($id_recipe);
}
?>
