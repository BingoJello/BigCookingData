<?php
    session_start();
    require_once('../../back/classes/business/model/Client.php');
    require_once('../../back/classes/database/DatabaseQuery.php');
    require_once('../../back/classes/database/DatabaseConnection.php');
    require_once('../../back/classes/database/persistence/RecipePersistence.php');
    require_once('../../back/classes/database/persistence/ClientPersistence.php');
    include('../../back/functions/functions_utils.php');
    include('../../back/functions/functions_recipes.php');
    include('../../back/functions/functions_client.php');
?>
<?php
    $nbr_recipes = getNbrRecipes();
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
    <title>Delicioso! | Qui sommes-nous </title>
    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.ico">
    <!-- Core Stylesheet -->
	<link rel="stylesheet" href="../css/etm1.css">
	<link rel="stylesheet" href="../css/css_libs1.css">
    <link rel="stylesheet" href="../css/style.css">
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
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(../img/bg-img/breadcumb1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Qui sommes-nous</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### About Area Start ##### -->
    <section class="about-area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Qui sommes-nous et que faisons-nous ?</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h6 class="sub-heading pb-5">
                        Notre projet consiste à créer une application web intelligente qui utilise une base de données et propose des suggestions de recettes à un utilisateur selon ses goûts, ses préférences ou encore selon le contenu de son frigo.
					</h6>
						
                    <p class="text-center">Toutes les recettes proposées sur notre application web sont issues de l'extraction d'informations (web scraping) sur le site Marmiton.</p>
                    <p class="text-center">De plus, notre algorithme de recommandation est basé sur un apprentissage supervisé (Decision tree) et non supervisé (KMean Clustering)</p>
                </div>
            </div>

            <div class="row align-items-center mt-70">
                <!-- Single Cool Fact -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-fact">
                        <img src="../img/core-img/hamburger.png" alt="">
                        <h3><span class="counter"><?php echo $nbr_recipes; ?></span></h3>
                        <h6>Recettes</h6>
                    </div>
                </div>

                <!-- Single Cool Fact -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-fact">
                        <img src="../img/core-img/salad.png" alt="">
                        <h3><span class="counter">25</span></h3>
                        <h6>Recettes vegan</h6>
                    </div>
                </div>

                <!-- Single Cool Fact -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-fact">
                        <img src="../img/core-img/rib.png" alt="">
                        <h3><span class="counter">471</span></h3>
                        <h6>Recettes à base de viande</h6>
                    </div>
                </div>

                <!-- Single Cool Fact -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-fact">
                        <img src="../img/core-img/pancake.png" alt="">
                        <h3><span class="counter">326</span></h3>
                        <h6>Desserts</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### About Area End ##### -->

    <!-- ##### Contact Area Start ##### -->
    <div class="contact-area section-padding-0-80" style="margin-top: -100px">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Contactez-nous</h3>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-3">
                    <!-- Single Contact Information -->
                    <div class="single-contact-information mb-30">
                        <h6>Adresse:</h6>
                        <p>Université Cergy-Paris <br>2 Av. Adolphe Chauvin, 95300 Pontoise</p>
                    </div>
                    <!-- Single Contact Information -->
                    <div class="single-contact-information mb-30">
                        <h6>Email:</h6>
                        <p>arthur.mimouni@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Contact Area End ##### -->


    <!-- ##### Footer Area Start ##### -->
    <?php include('include/footer.php');?>
    <!-- ##### Footer Area End ##### -->

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
	
	<?php include('./include/connexion_profil.php'); ?>
</body>
</html>