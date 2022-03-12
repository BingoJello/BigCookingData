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
    <title>Delicious - Food Blog Template | Recipe Post</title>
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
                    <form action="#" method="post">
                        <input type="search" name="search" placeholder="Type any keywords...">
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
                        <h2>Recipe</h2>
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
                            <h2>Vegetarian cheese salad</h2>
							<p style="margin-top:-20px">This is a very lightly sauced pasta with lemon and shrimp. It's refreshing as well as filling.</p>
                            <div class="recipe-duration">
                                <h6>Préparation: 15 min</h6>
                                <h6>Cuisson: 30 min</h6>
                                <h6>Repos: -</h6>
								<div class="recipe-ratings my-4">
									<div class="ratings">
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" style="color:grey" aria-hidden="true"></i>
										<label>3.2/5</label>
									</div>
								</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <img src="../img/test.webp" width="300" height="185" height alt="">
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
                            <div>
                                <label class="ingredient-label">
                                    <img src="https://assets.afcdn.com/recipe/20170607/67459_w320h320c1cx350cy350.webp" height="40" width="40">
                                    4 Tbsp (57 gr) butter
                                </label>
                            </div>

                            <div>
                                <label class="ingredient-label">2 large eggs</label>
                            </div>

                            <div>
                                <label class="ingredient-label">2 yogurt containers granulated sugar</label>
                            </div>

                            <div>
                                <label class="ingredient-label">1 vanilla or plain yogurt, 170g container</label>
                            </div>

                            <div>
                                <label class="ingredient-label">2 yogurt containers unbleached white flour</label>
                            </div>

                            <div>
                                <label class="ingredient-label">1.5 yogurt containers milk</label>
                            </div>

                            <div>
                                <label class="ingredient-label">1/4 tsp cinnamon</label>
                            </div>

                            <div class="custom-control custom-checkbox">
                                <label class="ingredient-label">1 cup fresh blueberries </label>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#" data-toggle='modal' data-target='#postCommentaryIHM' class="btn delicious-btn" data-animation="fadeInUp" data-delay="1000ms">Donnez votre avis</a>
                <div class="commentary-container">
                    <span style="margin-left: 20px">
                        <h2 class="nbr-commentary-front">Commentaires (12)</h2>
                    </span>
                    <div class="list-commentary">
                        <div class="commentary">
                            <div class="name-rating-container">
                                <div class="name-rating">
                                    <div class="pseudo">
                                        <p class="name-pseudo">Name pseudo </p>
                                    </div>
                                    <div class="rating-commentary">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star empty" aria-hidden="true"></i>
                                        <label>3.2/5</label>
                                    </div>
                                </div>
                            </div>
                            <div class="date-commentary">
                                <p class="date-commentary-font">13/08/2018 11:36</p>
                            </div>
                            <div class="commentary-text">
                                <p class="commentary-text-font">Je me suis bien régalé, en ajoutant une escalope de dinde et un oeuf c'était parfait. </p>
                            </div>
                        </div>
                        <hr>
                        <div class="commentary">
                            <div class="name-rating-container">
                                <div class="name-rating">
                                    <div class="pseudo">
                                        <p class="name-pseudo">Name pseudo </p>
                                    </div>
                                    <div class="rating-commentary">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <label>3.2/5</label>
                                    </div>
                                </div>
                            </div>
                            <div class="date-commentary">
                                <p class="date-commentary-font">13/08/2018 11:36</p>
                            </div>
                            <div class="commentary-text">
                                <p class="commentary-text-font">Je me suis bien régalé, en ajoutant une escalope de dinde et un oeuf c'était parfait. </p>
                            </div>
                        </div>
                    </div>
                    <a href="#" data-toggle='modal' data-target='#allCommentaryIHM' class="btn delicious-btn" data-animation="fadeInUp" data-delay="1000ms">Voir plus</a>
                </div>
            </div>
        </div>
    </div>

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
    <?php include('./include/post-commentary.php')?>
    <?php include ('./include/all-commentary.php');?>
</body>