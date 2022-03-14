<?php
session_start();
require_once('../../back/classes/business/model/Client.php');
require_once('../../back/classes/business/model/Ingredient.php');
require_once('../../back/classes/database/DatabaseQuery.php');
require_once('../../back/classes/database/DatabaseConnection.php');
require_once('../../back/classes/database/persistence/ClientPersistence.php');
require_once('../../back/classes/database/persistence/RecipePersistence.php');
include('../../back/functions/functions_recipes.php');
include('../../back/functions/functions_utils.php');
?>

<?php
    if(isset($_SESSION['client']) and !empty($_SESSION['client'])){
        $client = unserialize($_SESSION['client']);
    }else{
        header('location:./connexion.php?error=Veuillez vous connecter pour voir votre carnet de recettes');
    }
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
                <form action="./recipes.php" method="post">
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
                <form id="profil-form" action="./profil.php" method="POST">
                    <div class="generator_header col-12 col-md-9 col-lg-9" style="margin:0 auto;margin-top:20px">
                        <div class="row">
                            <div style="float:left">
                                <img src="https://assets.afcdn.com/recipe/20131106/63010_w1024h778c1cx1633cy2449.webp" width="116" height="132" alt="">
                            </div>
                            <div class="recipe-book-div">
                                <div>
                                    <p class = "recipe-book-link">Pasta alla caprese and fjuifnruhvn cnuiergccr crr...</p>
                                    <p style="color:red;margin-top:-10px">Supprimer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="generator_header col-12 col-md-9 col-lg-9" style="margin:0 auto;margin-top:20px">
                        <div class="row">
                            <div style="float:left">
                                <img src="https://assets.afcdn.com/recipe/20131106/63010_w1024h778c1cx1633cy2449.webp" width="116" height="132" alt="">
                            </div>
                            <div class="recipe-book-div">
                                <div>
                                    <p class = "recipe-book-link">Pasta alla caprese and fjuifnruhvn cnuiergccr crr...</p>
                                    <p style="color:red;margin-top:-10px">Supprimer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="generator_header col-12 col-md-9 col-lg-9" style="margin:0 auto;margin-top:20px">
                        <div class="row">
                            <div style="float:left">
                                <img src="https://assets.afcdn.com/recipe/20131106/63010_w1024h778c1cx1633cy2449.webp" width="116" height="132" alt="">
                            </div>
                            <div class="recipe-book-div">
                                <div>
                                    <p class = "recipe-book-link">Pasta alla caprese and fjuifnruhvn cnuiergccr crr...</p>
                                    <p style="color:red;margin-top:-10px">Supprimer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p style="height: 10px"></p>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- ##### Footer Area Start ##### -->
<?php include('include/footer.php');?>
<!-- ##### Footer Area End ##### -->

<!-- ##### All Javascript Files ##### -->
<!-- jQuery-2.2.4 js -->
<script src="../js/jquery/jquery-2.2.4.min.js"></script>
<script src="../js/tools/md_select_box/dist/m-select-d-box.js"></script>
<!-- Bootstrap js -->
<script src="../js/bootstrap/bootstrap.min.js"></script>
<!-- All Plugins js -->
<script src="../js/plugins/plugins.js"></script>
<!-- Active js -->
<script src="../js/tools/active/active2.js"></script>
<!-- Canvas js -->
<script src="../js/canvas.js"></script>
<!-- List Ingredient multiple select js -->
<script src="../js/tools/list_ingredients_select.js"></script>
<!-- Change profil js -->
<script src="../js/changeProfil.js"></script>

<?php include('./include/connexion_profil.php'); ?>
</body>
</html>