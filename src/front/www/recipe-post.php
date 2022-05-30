<?php
    session_start();
    require_once('./require/require_recipe_post.php');
?>

<?php
    if(isset($_POST['add_recipe']) and "true" === $_POST['add_recipe'] and isset($_SESSION['client'])){
        if(true == RecipePersistence::recipeAlreadyAddByClient($_POST['name'],  $client = getClient()->getId())){
            $already_add = true;
            $name_add_recipe = $_POST['name'];
        }else{
            $already_add = false;
            $name_add_recipe = RecipeFacade::addRecipe($_POST, getClient()->getId())->getName();
        }?>
        <script>
            $(document).ready(function(){
                $("#myModal").modal('show');
            });
        </script>
        <?php
    }
    if(isset($_SESSION['client']) and !empty($_SESSION['client'])) {
        $client = getClient();
    }

    if(isset($_GET['recipe']) and !empty($_GET['recipe'])) {
        $recipe = RecipeFacade::getRecipe($_GET['recipe']);
        $similar_recipes = RecipeFacade::getSimilarRecipes($_GET['recipe']);
        if(isset($_SESSION['visualization'])){
            if(false === in_array($recipe->getId(), $_SESSION['visualization'])){
                array_push($_SESSION['visualization'], $recipe->getId());
            }
        }else{
            $_SESSION['visualization'] = array();
            array_push($_SESSION['recipe'], $recipe->getId());
        }
    } elseif (isset($_POST['recipe']) and !empty($_POST['recipe'])){
        $recipe = RecipeFacade::getRecipe($_POST['recipe']);
        $similar_recipes = RecipeFacade::getSimilarRecipes($_POST['recipe']);
    } else{
        header('location:recettes');
    }

    if(isset($_GET['record']) and !empty($_GET['record'])){
        ClientFacade::insertRecord($client->getId(), $recipe->getId());
    }

    if(isset($_POST['rate']) and !empty($_POST['rate']) AND (isset($_POST['date']) and !empty($_POST['date']))) {
        if(!isset($client)){
            header('location:recette');
        }
        $rating = $_POST['rate'];
        $date = $_POST['date'];

        if(isset($_POST['commentary']) and !empty($_POST['commentary'])) {
            $commentary = $_POST['commentary'];
            ClientFacade::insertRatingAndCommentary($recipe->getId(), $client->getId(), $rating, $date, $commentary);
        }else{
            ClientFacade::insertRatingAndCommentary($recipe->getId(), $client->getId(), $rating, $date);
        }
    }

    $assessed_recipe = RecipeFacade::getAssessRecipe($recipe->getId());
    $global_rating = RecipeFacade::getGlobalRating($recipe->getId());
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 2 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- Title -->
    <title>Delicioso! | Recette</title>
    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.ico">
    <!-- Core Stylesheet -->
	<link rel="stylesheet" href="../css/etm1.css">
	<link rel="stylesheet" href="../css/css_libs1.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_recipe.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
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
                    <form action="recettes" method="post">
                        <input type="search" name="search" placeholder="Tapez un mot-clé...">
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
                        <h2>Recette</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <div class="recipe-post-area section-padding-80">
        <!-- Recipe Content Area -->
        <div class="recipe-content-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="recipe-headline my-5">
                            <h2><?php echo $recipe->getName();?></h2>
							<p style="margin-top:-20px"><?php echo $recipe->getCategories();?></p>
                            <div class="recipe-duration">
                                <h6>Préparation: <?php echo $recipe->getPrepTime();?></h6>
                                <h6>Cuisson: <?php echo $recipe->getCookTime();?></h6>
                                <h6>Repos: <?php echo $recipe->getBreakTime();?></h6>
                                <?php
                                    if(false == is_null($global_rating)){
                                        printGlobalRating($global_rating['score'], $global_rating['nbr_reviews']);
                                    }
                                ?>
                            </div>
                            <?php
                            if(isset($_SESSION['client']) and !empty($_SESSION['client'])) {
                                $data_target = "#postCommentaryIHM";
                            }else{
                                $data_target = "#loginIHM";
                            }
                            ?>
                            <a href="#" data-toggle='modal' data-target=<?php echo $data_target;?> class="btn delicious-btn"
                            data-animation="fadeInUp" data-delay="1000ms">Donnez votre avis</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <img src=<?php echo $recipe->getUrlPic();?> width='300' height='185' alt=''>
						<p class="space-p"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-8">
                        <!-- Single Preparation Step -->
                        <div class="single-preparation-step d-flex">
                            <h4>01.</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec varius dui. Suspendisse potenti. Vestibulum ac pellentesque tortor. Aenean congue sed metus in iaculis. Cras a tortor enim. Phasellus posuere vestibulum ipsum, eget lobortis purus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
                        </div>
                        <!-- Single Preparation Step -->
                        <div class="single-preparation-step d-flex">
                            <h4>02.</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec varius dui. Suspendisse potenti. Vestibulum ac pellentesque tortor. Aenean congue sed metus in iaculis. Cras a tortor enim. Phasellus posuere vestibulum ipsum, eget lobortis purus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
                        </div>
                        <!-- Single Preparation Step -->
                        <div class="single-preparation-step d-flex">
                            <h4>03.</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec varius dui. Suspendisse potenti. Vestibulum ac pellentesque tortor. Aenean congue sed metus in iaculis. Cras a tortor enim. Phasellus posuere vestibulum ipsum, eget lobortis purus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
                        </div>
                        <!-- Single Preparation Step -->
                        <div class="single-preparation-step d-flex">
                            <h4>04.</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec varius dui. Suspendisse potenti. Vestibulum ac pellentesque tortor. Aenean congue sed metus in iaculis. Cras a tortor enim. Phasellus posuere vestibulum ipsum, eget lobortis purus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
                        </div>
                    </div>

                    <!-- Ingredients -->
                    <div class="col-12 col-lg-4">
                        <div class="ingredients">
                            <h4>Ingredients</h4>
                            <?php printIngredients($recipe);?>
                        </div>
                    </div>
                </div>
                <h3 style="padding-bottom:20px">Recettes similaires</h3>
                <?php printSimilarRecipes($similar_recipes)?>
                <!--<a href="recipe-post.php?recipe=<?php echo $recipe->getId();?>&amp;record=true"  class="btn delicious-btn">Enregistrez la recette</a>-->
                <?php printAssessRecipe($assessed_recipe);?>
            </div>
        </div>
    </div>

    <!-- ##### Footer Area Start ##### -->
    <?php include('include/footer.php');?>
    <!-- ##### Footer Area End ##### -->
    <?php include('./include/add_recipe.php'); ?>

    <!-- ##### All Javascript Files ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="../js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="../js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="../js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="../js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="../js/tools/active/active.js"></script>
    <!-- Add button new recipe js -->
    <script src="../js/add_button_recipe.js"></script>
	
	<?php include('./include/connexion_profil.php'); ?>
    <?php include('./include/post-commentary.php')?>
    <?php include ('./include/all-commentary.php');?>

    <div id="myModal" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajout d'une recette</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="relocate_home()">&times;</button>
                </div>
                <div class="modal-body">
                    <?php if($already_add == false) {
                        ?><p>La recette <?php echo $name_add_recipe;?> a bien été ajouté</p><?php
                    }else{
                        ?><p>Erreur : La recette <?php echo $name_add_recipe;?> a déja été ajouté par vous</p><?php
                    }?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function relocate_home() {
            window.location = "http://localhost/BigCookingData/src/front/www/index.php";
        }
    </script>
</body>
</html>