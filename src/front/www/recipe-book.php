<?php
    session_start();
    require_once('./require/require_recipe_book.php');
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
    if(isset($_SESSION['client']) and !empty($_SESSION['client'])){
        $client = getClient();
    }else{
        header('location:./connexion.php?error=Veuillez vous connecter pour voir votre carnet de recettes');
    }

    if(isset($_GET['delete']) and !empty($_GET['delete'])){
        $id_recipe = $_GET['delete'];
        try {
            RecipeFacade::deleteRatedRecipeClient($client, $id_recipe);
            header('Location: ./recipe-book.php');
            exit(0);
        }catch (Exception $e){
            var_dump($e);
        }
    }
    $rated_recipes = RecipeFacade::getRatingRecipesClient($client);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- Title -->
    <title>Delicioso! | Carnet de recettes</title>
    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.ico">
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="../css/etm1.css">
    <link rel="stylesheet" href="../css/css_libs1.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_profil.css">
    <link rel="stylesheet" href="../css/style_recipe_book.css">
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

<section class="best-recipe-area section-padding-80 container" style="margin-top:-3em">
    <div class="container">
        <div class="row">
            <div class="generator_header col-12 col-md-15 offset-md-1 col-lg-9" style="margin:0 auto">
                <div class="row">
                    <img style="margin:1em auto" src="../img/adressBookBlack.png" width="50" height="60" alt="">
                </div>
                <div class="row">
                    <h1 style="margin:0 auto;font-size:24px" for="num_meals_selector">Mon carnet de recettes</h1>
                </div>
                <form id="profil-form" action="profil" method="POST">
                    <?php printRatedRecipesClient($rated_recipes); ?>
                    <p style="height: 10px"></p>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- ##### Footer Area Start ##### -->
<?php include('include/footer.php');?>
<!-- ##### Footer Area End ##### -->
<?php include('./include/add_recipe.php'); ?>

<!-- ##### All Javascript Files ##### -->
<!-- jQuery-2.2.4 js -->
<script src="../js/jquery/jquery-2.2.4.min.js"></script>
<!-- Bootstrap js -->
<script src="../js/bootstrap/bootstrap.min.js"></script>
<!-- All Plugins js -->
<script src="../js/plugins/plugins.js"></script>
<!-- Active js -->
<script src="../js/tools/active/active2.js"></script>
<!-- Canvas js -->
<script src="../js/canvas.js"></script>
<!-- Change profil js -->
<script src="../js/changeProfil.js"></script>
<!-- Add button new recipe js -->
<script src="../js/add_button_recipe.js"></script>

<?php include('./include/connexion_profil.php'); ?>

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