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
include('./src/back/functions/utils.php');
include('./src/back/utils/constants.php');
require_once ('./src/back/classes/business/process/helper/GenerationClient.php');

    $test = new CollaborativeFilteringUserRecommenderSystem("Y1vR1oQ@gmail.com", "g1cYL4GxutJ1F");
   $_SESSION['visualization'] = array();
    $test->buildRecipes($_SESSION);
    exit(0);
    header('Location: ./src/front/www/accueil');
    exit();
?>