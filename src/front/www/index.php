<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <!-- Title -->
    <title>Delicious | Home</title>

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
                    <form action="./recipes.php" method="post">
                        <input type="search" name="search" placeholder="Type any keywords...">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include("./include/header.php");?>

    <!-- ##### Hero Area Start ##### -->
    <section class="hero-area">
        <div class="hero-slides owl-carousel">
            <!-- Single Hero Slide -->
            <div class="single-hero-slide bg-img" style="background-image: url(../img/bg-img/bg1.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="hero-slides-content" data-animation="fadeInUp" data-delay="100ms">
                                <h2 data-animation="fadeInUp" data-delay="300ms">Delicios Homemade Burger</h2>
                                <p data-animation="fadeInUp" data-delay="700ms">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tristique nisl vitae luctus sollicitudin. Fusce consectetur sem eget dui tristique, ac posuere arcu varius.</p>
                                <a href="#" class="btn delicious-btn" data-animation="fadeInUp" data-delay="1000ms">See Recipe</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Hero Slide -->
            <div class="single-hero-slide bg-img" style="background-image: url(../img/bg-img/bg6.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="hero-slides-content" data-animation="fadeInUp" data-delay="100ms">
                                <h2 data-animation="fadeInUp" data-delay="300ms">Delicios Homemade Burger</h2>
                                <p data-animation="fadeInUp" data-delay="700ms">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tristique nisl vitae luctus sollicitudin. Fusce consectetur sem eget dui tristique, ac posuere arcu varius.</p>
                                <a href="#" class="btn delicious-btn" data-animation="fadeInUp" data-delay="1000ms">See Recipe</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Hero Slide -->
            <div class="single-hero-slide bg-img" style="background-image: url(../img/bg-img/bg7.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="hero-slides-content" data-animation="fadeInUp" data-delay="100ms">
                                <h2 data-animation="fadeInUp" data-delay="300ms">Delicios Homemade Burger</h2>
                                <p data-animation="fadeInUp" data-delay="700ms">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tristique nisl vitae luctus sollicitudin. Fusce consectetur sem eget dui tristique, ac posuere arcu varius.</p>
                                <a href="#" class="btn delicious-btn" data-animation="fadeInUp" data-delay="1000ms">See Recipe</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Hero Area End ##### -->

    <!-- ##### Best Recipe Area Start ##### -->
    <section class="best-recipe-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3 style="margin-top: 25px">Recipes you might like</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Best Recipe Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-best-recipe-area mb-30">
                        <img src="../img/bg-img/r1.jpg" alt="">
                        <div class="recipe-content">
                            <a href="recipe-post.php">
                                <h5>Sushi Easy Receipy</h5>
                            </a>
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Best Recipe Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-best-recipe-area mb-30">
                        <img src="../img/bg-img/r2.jpg" alt="">
                        <div class="recipe-content">
                            <a href="recipe-post.php">
                                <h5>Homemade Burger</h5>
                            </a>
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Best Recipe Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-best-recipe-area mb-30">
                        <img src="../img/bg-img/r3.jpg" alt="">
                        <div class="recipe-content">
                            <a href="recipe-post.php">
                                <h5>Vegan Smoothie</h5>
                            </a>
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Best Recipe Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-best-recipe-area mb-30">
                        <img src="../img/bg-img/r4.jpg" alt="">
                        <div class="recipe-content">
                            <a href="recipe-post.php">
                                <h5>Calabasa soup</h5>
                            </a>
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Best Recipe Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-best-recipe-area mb-30">
                        <img src="../img/bg-img/r5.jpg" alt="">
                        <div class="recipe-content">
                            <a href="recipe-post.php">
                                <h5>Homemade Breakfast</h5>
                            </a>
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Best Recipe Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-best-recipe-area mb-30">
                        <img src="../img/bg-img/r6.jpg" alt="">
                        <div class="recipe-content">
                            <a href="recipe-post.php">
                                <h5>Healthy Fruit Desert</h5>
                            </a>
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Best Recipe Area End ##### -->
	
	 <!-- ##### Top Catagory Area Start ##### -->
    <section class="top-category-area section-padding-80-0">
		<div class="row">
			<div class="col-12">
				<div class="section-heading">
					<h3 style="margin-top: -150px">Suggested categories</h3>
                </div>
            </div>
        </div>
		
        <div class="container">
            <div class="row">
                <!-- Top Catagory Area -->
                <div class="col-12 col-lg-6">
                    <div class="single-top-category">
                        <img src="../img/bg-img/bg2.jpg" alt="">
                        <!-- Content -->
                        <div class="top-cta-content">
                            <h3>Strawberry Cake</h3>
                            <h6>Simple &amp; Delicios</h6>
                            <a href="recipe-post.php" class="btn delicious-btn">See Full Recipe</a>
                        </div>
                    </div>
                </div>
                <!-- Top Catagory Area -->
                <div class="col-12 col-lg-6">
                    <div class="single-top-category">
                        <img src="../img/bg-img/bg3.jpg" alt="">
                        <!-- Content -->
                        <div class="top-cta-content">
                            <h3>Chinesse Noodles</h3>
                            <h6>Simple &amp; Delicios</h6>
                            <a href="recipe-post.php" class="btn delicious-btn">See Full Recipe</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Top Catagory Area End ##### -->

    <!-- ##### CTA Area Start ##### -->
    <section class="cta-area bg-img bg-overlay" style="background-image: url(../img/bg-img/bg4.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <!-- Cta Content -->
                    <div class="cta-content text-center">
                        <h2>Meal Planner</h2>
                        <p>Eat This Much creates personalized meal plans based on your food preferences. Reach your diet and nutritional goals with our calorie calculator.
							Create your meal plan right here in seconds.
						</p>
                        <a href="./mealPlanner.php" class="btn delicious-btn">Discover</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### CTA Area End ##### -->

    <!-- ##### Small Recipe Area Start ##### -->
    <section class="small-recipe-area section-padding-80-0">
		<div class="row">
			<div class="col-12">
				<div class="section-heading">
					<h3 style="margin-top: -50px">Recipes of the day</h3>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <!-- Small Recipe Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-small-recipe-area d-flex">
                        <!-- Recipe Thumb -->
                        <div class="recipe-thumb">
                            <img src="../img/bg-img/sr1.jpg" alt="">
                        </div>
                        <!-- Recipe Content -->
                        <div class="recipe-content">
                            <span>January 04, 2018</span>
                            <a href="recipe-post.php">
                                <h5>Homemade italian pasta</h5>
                            </a>
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                            <p>2 Comments</p>
                        </div>
                    </div>
                </div>

                <!-- Small Recipe Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-small-recipe-area d-flex">
                        <!-- Recipe Thumb -->
                        <div class="recipe-thumb">
                            <img src="../img/bg-img/sr2.jpg" alt="">
                        </div>
                        <!-- Recipe Content -->
                        <div class="recipe-content">
                            <span>January 04, 2018</span>
                            <a href="recipe-post.php">
                                <h5>Baked Bread</h5>
                            </a>
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                            <p>2 Comments</p>
                        </div>
                    </div>
                </div>

                <!-- Small Recipe Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-small-recipe-area d-flex">
                        <!-- Recipe Thumb -->
                        <div class="recipe-thumb">
                            <img src="../img/bg-img/sr3.jpg" alt="">
                        </div>
                        <!-- Recipe Content -->
                        <div class="recipe-content">
                            <span>January 04, 2018</span>
                            <a href="recipe-post.php">
                                <h5>Scalops on salt</h5>
                            </a>
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                            <p>2 Comments</p>
                        </div>
                    </div>
                </div>

                <!-- Small Recipe Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-small-recipe-area d-flex">
                        <!-- Recipe Thumb -->
                        <div class="recipe-thumb">
                            <img src="../img/bg-img/sr4.jpg" alt="">
                        </div>
                        <!-- Recipe Content -->
                        <div class="recipe-content">
                            <span>January 04, 2018</span>
                            <a href="recipe-post.php">
                                <h5>Fruits on plate</h5>
                            </a>
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                            <p>2 Comments</p>
                        </div>
                    </div>
                </div>

                <!-- Small Recipe Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-small-recipe-area d-flex">
                        <!-- Recipe Thumb -->
                        <div class="recipe-thumb">
                            <img src="../img/bg-img/sr5.jpg" alt="">
                        </div>
                        <!-- Recipe Content -->
                        <div class="recipe-content">
                            <span>January 04, 2018</span>
                            <a href="recipe-post.php">
                                <h5>Macaroons</h5>
                            </a>
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                            <p>2 Comments</p>
                        </div>
                    </div>
                </div>

                <!-- Small Recipe Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-small-recipe-area d-flex">
                        <!-- Recipe Thumb -->
                        <div class="recipe-thumb">
                            <img src="../img/bg-img/sr6.jpg" alt="">
                        </div>
                        <!-- Recipe Content -->
                        <div class="recipe-content">
                            <span>January 04, 2018</span>
                            <a href="recipe-post.php">
                                <h5>Chocolate tart</h5>
                            </a>
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                            <p>2 Comments</p>
                        </div>
                    </div>
                </div>

                <!-- Small Recipe Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-small-recipe-area d-flex">
                        <!-- Recipe Thumb -->
                        <div class="recipe-thumb">
                            <img src="../img/bg-img/sr7.jpg" alt="">
                        </div>
                        <!-- Recipe Content -->
                        <div class="recipe-content">
                            <span>January 04, 2018</span>
                            <a href="recipe-post.php">
                                <h5>Berry Desert</h5>
                            </a>
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                            <p>2 Comments</p>
                        </div>
                    </div>
                </div>

                <!-- Small Recipe Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-small-recipe-area d-flex">
                        <!-- Recipe Thumb -->
                        <div class="recipe-thumb">
                            <img src="../img/bg-img/sr8.jpg" alt="">
                        </div>
                        <!-- Recipe Content -->
                        <div class="recipe-content">
                            <span>January 04, 2018</span>
                            <a href="recipe-post.php">
                                <h5>Zucchini Grilled on peper</h5>
                            </a>
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                            <p>2 Comments</p>
                        </div>
                    </div>
                </div>

                <!-- Small Recipe Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-small-recipe-area d-flex">
                        <!-- Recipe Thumb -->
                        <div class="recipe-thumb">
                            <img src="../img/bg-img/sr9.jpg" alt="">
                        </div>
                        <!-- Recipe Content -->
                        <div class="recipe-content">
                            <span>January 04, 2018</span>
                            <a href="recipe-post.php">
                                <h5>Chicken Salad</h5>
                            </a>
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                            <p>2 Comments</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Small Recipe Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-12 h-100 d-flex flex-wrap align-items-center justify-content-between">

                    <!-- Footer Logo -->
                    <div class="footer-logo">
                        <a href="index.php"><img src="../img/core-img/logo.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
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
    <script src="../js/active.js"></script>
	
	<?php include('./include/connexion_profil.php'); ?>
</body>
</html>