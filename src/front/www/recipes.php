<?php
session_start();
require_once('../../back/classes/business/model/Client.php');
require_once('../../back/classes/business/model/Recipe.php');
require_once('../../back/classes/business/model/Ingredient.php');
require_once('../../back/classes/business/process/recommenderSystem/RecommenderSystem.php');
require_once('../../back/classes/business/process/recommenderSystem/ContentBasedRecommenderSystem.php');
require_once('../../back/classes/business/process/informationRetrieval/Stemmer.php');
require_once('../../back/classes/business/process/informationRetrieval/Stem.php');
require_once('../../back/classes/business/process/informationRetrieval/ProcessText.php');
require_once('../../back/classes/business/process/informationRetrieval/ProcessTextSearch.php');
require_once('../../back/classes/business/process/informationRetrieval/StemmerFactory.php');
require_once('../../back/classes/business/process/informationRetrieval/FrenchStemmer.php');
require_once('../../back/classes/business/process/informationRetrieval/StopWords.php');
require_once('../../back/classes/database/DatabaseQuery.php');
require_once('../../back/classes/database/DatabaseConnection.php');
require_once('../../back/classes/database/persistence/RecipePersistence.php');
require_once('../../back/classes/database/persistence/ClientPersistence.php');
require_once('../../back/classes/business/service/DecisionTreeCluster.php');
include('../../back/functions/functions_utils.php');
include('../../back/functions/functions_recipes.php');
include('../../back/functions/functions_client.php');
include('../../back/utils/constants.php');
?>

<?php
    if (isset($_POST['search']) and !empty($_POST['search'])) {
        $recipes = getRecipesSearching($_POST['search']);
        $json_recipes = getJsonRecipes($recipes, true);
        $limit = LIMIT_PAGINATION;
        $total_pages = ceil(count($recipes) / $limit);

    } elseif (isset($_POST['include_ingredients']) and !empty($_POST['include_ingredients'])){
        $exclude_ingredients = '';
        if(isset($_POST['include_ingredients']) and !empty($_POST['include_ingredients'])){
            $exclude_ingredients = $_POST['exclude_ingredients'];
        }
        $recipes = getRecipesIncludeExclude($_POST['include_ingredients'], $_POST['exclude_ingredients']);
        $json_recipes = getJsonRecipes($recipes, true);
        $limit = LIMIT_PAGINATION;
        $total_pages = ceil(count($recipes) / $limit);
    } else {
        $recipes = getRandomRecipes();
        $json_recipes = getJsonRecipes($recipes);
        $limit = LIMIT_PAGINATION;
        $total_pages = ceil(count($recipes['recipe']) / $limit);
    }
    $list_ingredients = json_encode(getAllIngredients());
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- Title -->
    <title>Delicioso! | Recettes</title>
    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.ico">
    <!-- Core Stylesheet -->
	<link rel="stylesheet" href="../css/etm1.css">
	<link rel="stylesheet" href="../css/css_libs1.css">
    <link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/category-recipes.css">

</head>
<body>
    <!-- Preloader -->
    <div id="preloader">
        <i class="circle-preloader"></i>
        <img src="../img/core-img/salad.png" alt="">
    </div>

    <!-- Search Wrapper -->
    <div class="search-wrapper">
        <!-- Close Btn -->
        <div class="close-btn"><i class="fa fa-times" aria-hidden="true"></i></div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="./recipes.php" method="post">
                        <input type="search" name="search" placeholder="Tapez des mot-clés...">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

   <?php include("./include/header.php");?>

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(../img/bg-img/breadcumb3.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Recettes</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <div class="recipe-post-area section-padding-80">
        <!-- Recipe Post Search -->
        <div class="recipe-post-search mb-80">
            <div class="container">
                <form action="./recipes" method="post">
					<div class="row">
						<div class="col 12 col-lg-3">
                            <input type="text" class="form-control" name="include_ingredients" placeholder="Inclure des ingredients"/>
						</div>
						<div class="col 12 col-lg-3">
                            <input type="text" class="form-control" name="exclude_ingredients" placeholder="Exclure des ingredients"/>
						</div>
                        <div class="col-12 col-lg-3">
                            <input type="search" class="input-search" name="search" placeholder="Recherchez des recettes">
                        </div>
                        <div class="col-12 col-lg-3 text-right">
                            <button type="submit" class="btn delicious-btn">Recherche</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
		
		 <!-- Recipe Categories Search -->
        <div class="recipe-post-category mb-80">
			<div class="container">
				<?php include("./include/category-recipes.php");?>
			</div>
        </div>

        <section class="best-recipe-area">
            <div class="container">
                <div class="row" id="target-content">
                </div>

                <div class="container-pagination">
                    <div class="pagination p1">
                        <ul>
                            <p id="object-recipes" style="display:none" data-id="<?php echo $recipes['recipe'] ?>"></p>
                            <?php
                            printPagination($total_pages);
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- ##### Footer Area Start ##### -->
    <?php include('include/footer.php');?>
    <!-- ##### Footer Area End ##### -->

    <?php include('./include/connexion_profil.php'); ?>

    <!-- ##### All Javascript Files ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="../js/jquery/jquery-2.2.4.min.js"></script>
    <script src="../js/tools/md_select_box/dist/m-select-d-box.js"></script>
    <!-- Popper js -->
    <script src="../js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="../js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="../js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="../js/tools/active/active.js"></script>
    <!-- Category js -->
	<script src="../js/categoryRecipes.js"></script>
    <!-- List Ingredient multiple select js -->
    <script>
        var listIngredientsJson = <?php echo $list_ingredients; ?>;
        var listIngredients = [];

        for(var i = 0; i < listIngredientsJson.length; i++){
            listIngredients.push(listIngredientsJson[i]);
        }
        $("#list_ingredients_include").mSelectDBox({
            "list": listIngredients,
            "builtInInput": 0,
            "multiple": true,
            "autoComplete": true,
            "name": "b"
        });
        $("#list_ingredients_exclude").mSelectDBox({
            "list": listIngredients,
            "builtInInput": 0,
            "multiple": true,
            "autoComplete": true,
            "name": "b"
        });
    </script>

    <script>
        $(document).ready(function() {
            let Datas = new FormData();
            Datas.append("page", 1);
            Datas.append("recipes", JSON.stringify(<?php echo $json_recipes; ?>));
            console.log(Datas);
            let request = $.ajax({
                type: "POST",
                url: "pagination.php",
                data:Datas,
                cache: false,
                contentType: false,
                processData: false,
            });

            request.done(function (output_success) {
                $("#target-content").html(output_success);
            });
            request.fail(function (http_error) {
                //Code à jouer en cas d'éxécution en erreur du script du PHP
                let server_msg = http_error.responseText;
                let code = http_error.status;
                let code_label = http_error.statusText;
                alert("Erreur "+code+" ("+code_label+") : "  + server_msg);
            });

            $(".page-link").click(function(){
                let Datas = new FormData();
                Datas.append("page", $(this).attr("data-id"));
                Datas.append("recipes", JSON.stringify(<?php echo $json_recipes; ?>));
                let request = $.ajax({
                    url: "pagination.php",
                    type: "POST",
                    data: Datas,
                    cache: false,
                    contentType: false,
                    processData: false,
                });

                request.done(function (output_success) {
                    $("#target-content").html(output_success);
                    $(".pageitem").removeClass("active");
                    $("#"+select_id).addClass("active");
                });
                request.fail(function (http_error) {
                    //Code à jouer en cas d'éxécution en erreur du script du PHP
                    let server_msg = http_error.responseText;
                    let code = http_error.status;
                    let code_label = http_error.statusText;
                    alert("Erreur "+code+" ("+code_label+") : "  + server_msg);
                });
            });
        });
    </script>
</body>
</html>