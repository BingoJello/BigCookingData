<?php
require_once('../../back/classes/business/model/Client.php');
require_once('../../back/classes/business/model/Recipe.php');
require_once('../../back/classes/business/model/Ingredient.php');
require_once('../../back/classes/business/model/Rating.php');
require_once('../../back/classes/database/DatabaseQuery.php');
require_once('../../back/classes/database/DatabaseConnection.php');
require_once('../../back/classes/business/service/DecisionTreeCluster.php');
require_once('../../back/classes/database/persistence/RecipePersistence.php');
require_once('../../back/classes/database/persistence/ClientPersistence.php');
require_once('../../back/classes/business/process/recommenderSystem/RecommenderSystem.php');
require_once('../../back/classes/business/process/recommenderSystem/ContentBasedRecommenderSystem.php');
require_once('../../back/classes/business/process/recommenderSystem/CollaborativeFilteringUserRecommenderSystem.php');
require_once('../../back/classes/business/facade/RecipeFacade.php');
require_once('../../back/classes/business/facade/ClientFacade.php');
require_once('../../back/classes/business/process/helper/UpdateProximityRecipes.php');
include('../../back/functions/utils.php');
include('../../back/utils/constants.php');
?>