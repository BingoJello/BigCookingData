<?php
    header('Location: ./src/front/www/accueil');
    exit();
require_once('./src/back/classes/business/model/Client.php');
require_once('./src/back/classes/business/model/Recipe.php');
require_once('./src/back/classes/business/model/Ingredient.php');
require_once('./src/back/classes/business/process/recommenderSystem/RecommenderSystem.php');
require_once('./src/back/classes/business/process/recommenderSystem/ContentBasedRecommenderSystem.php');
require_once('./src/back/classes/business/process/informationRetrieval/Stemmer.php');
require_once('./src/back/classes/business/process/informationRetrieval/Stem.php');
require_once('./src/back/classes/business/process/informationRetrieval/StemmerFactory.php');
require_once('./src/back/classes/business/process/informationRetrieval/FrenchStemmer.php');
require_once('./src/back/classes/business/process/informationRetrieval/ProcessText.php');
require_once('./src/back/classes/business/process/informationRetrieval/ProcessTextIngredient.php');
require_once('./src/back/classes/business/tools/StopWords.php');
require_once('./src/back/classes/database/DatabaseQuery.php');
require_once('./src/back/classes/database/DatabaseConnection.php');
require_once('./src/back/classes/database/persistence/RecipePersistence.php');
require_once('./src/back/classes/database/persistence/ClientPersistence.php');
require_once('./src/back/classes/business/service/DecisionTreeCluster.php');
require_once('./src/back/classes/business/process/proximityrecipes/UpdateProximityRecipes.php');
include('./src/back/functions/functions_utils.php');
include('./src/back/functions/functions_recipes.php');
include('./src/back/functions/functions_client.php');
include('./src/back/utils/constants.php');

?>