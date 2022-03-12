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