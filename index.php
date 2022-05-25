<?php
require_once('./src/back/classes/business/model/Client.php');
require_once('./src/back/classes/business/model/Recipe.php');
require_once('./src/back/classes/business/model/Ingredient.php');
require_once('./src/back/classes/business/model/Rating.php');
require_once('./src/back/classes/database/DatabaseQuery.php');
require_once('./src/back/classes/database/DatabaseConnection.php');
require_once('./src/back/classes/business/service/DecisionTreeCluster.php');
require_once('./src/back/classes/database/persistence/RecipePersistence.php');
require_once('./src/back/classes/database/persistence/ClientPersistence.php');
require_once('./src/back/classes/business/process/recommenderSystem/RecommenderSystem.php');
require_once('./src/back/classes/business/process/recommenderSystem/ContentBasedRecommenderSystem.php');
require_once('./src/back/classes/business/process/recommenderSystem/CollaborativeFilteringUserRecommenderSystem.php');
require_once('./src/back/classes/business/facade/RecipeFacade.php');
require_once('./src/back/classes/business/facade/ClientFacade.php');
require_once('./src/back/classes/business/process/helper/UpdateProximityRecipes.php');
require_once('./src/back/classes/business/process/informationRetrieval/Stemmer.php');
require_once('./src/back/classes/business/process/informationRetrieval/Stem.php');
require_once('./src/back/classes/business/process/informationRetrieval/ProcessText.php');
require_once('./src/back/classes/business/process/informationRetrieval/ProcessTextIngredient.php');
require_once('./src/back/classes/business/process/informationRetrieval/StemmerFactory.php');
require_once('./src/back/classes/business/process/informationRetrieval/FrenchStemmer.php');
require_once('./src/back/classes/business/process/informationRetrieval/StopWords.php');
require_once('./src/back/classes/business/service/DecisionTreeCluster.php');
require_once('./src/back/classes/business/process/helper/InsertionRecipe.php');
include('./src/back/functions/utils.php');
include('./src/back/utils/constants.php');
require_once ('./src/back/classes/business/process/helper/GenerationClient.php');
/**
    $test = new CollaborativeFilteringUserRecommenderSystem("Tqprys@gmail.com", "CjUvjg5rVV6VFr856uWO2Tb");
   $_SESSION['visualization'] = array();
    $test->buildRecipes($_SESSION);
    var_dump($test->getRecipes());
 **/
$recipe = new Recipe(3000, "Test");
$ingredients = array();
array_push($ingredients, new Ingredient(3000, "Tomates", "", "23g"));
array_push($ingredients, new Ingredient(3001, "Poulets", "", "23g"));
array_push($ingredients, new Ingredient(3002, "Huile d'cdqsrzv", "", "23g"));
array_push($ingredients, new Ingredient(3003, "Paprika", "", "23g"));
$recipe->setIngredients($ingredients);
InsertionRecipe::main($recipe);
exit(0);
    header('Location: ./src/front/www/accueil');
    exit();
?>