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
                    <form action="#" method="post">
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
                <form action="#" method="post">
					<div class="row">
						<div class="col 12, col-lg-3">
							<input class="input-lg" type="text" value="" data-role="tagsinput" placeholder="ingredients inclus"></input>
						</div>
						<div class="col 12, col-lg-3">
							<input class="input-lg text-success" type="text" value="" data-role="tagsinput" placeholder="ingredients exclus"></input>
						</div>

                        <div class="col-12 col-lg-3">
                            <input class="input-search" type="search" name="search" placeholder="Recherchez des recettes">
                        </div>
                        <div class="col-12 col-lg-3 text-right">
                            <button type="submit" class="btn delicious-btn">Recherche</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
		
		 <!-- Recipe Catgeories Search -->
        <div class="recipe-post-category mb-80">
			<div class="container">
				<?php include("./include/category-recipes.php");?>
			</div>
        </div>

        <!-- Receipe Content Area -->
        <div class="recipe-content-area">
            <div class="container">
				<div class="row">
					<!-- Recipes -->
					<div class="col-12 col-sm-6 col-lg-4">
						<div class="single-best-recipe-area mb-30">
							<img src="../img/bg-img/r1.jpg" width="320" height="285" alt="">
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

					<!-- Recipes -->
					<div class="col-12 col-sm-6 col-lg-4">
						<div class="single-best-recipe-area mb-30">
							<img src="../img/bg-img/r2.jpg" width="320" height="285" alt="">
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

					<!-- Recipes -->
					<div class="col-12 col-sm-6 col-lg-4">
						<div class="single-best-recipe-area mb-30">
							<img src="../img/bg-img/r3.jpg" width="320" height="285" alt="">
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

					<!-- Recipes -->
					<div class="col-12 col-sm-6 col-lg-4">
						<div class="single-best-recipe-area mb-30">
							<img src="../img/bg-img/r4.jpg" width="320" height="285" alt="">
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

					<!-- Recipes -->
					<div class="col-12 col-sm-6 col-lg-4">
						<div class="single-best-recipe-area mb-30">
							<img src="../img/bg-img/r5.jpg" width="320" height="285" alt="">
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

					<!-- Recipes -->
					<div class="col-12 col-sm-6 col-lg-4">
						<div class="single-best-recipe-area mb-30">
							<img src="../img/bg-img/r6.jpg" width="320" height="285" alt="">
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
					
					<!-- Recipes -->
					<div class="col-12 col-sm-6 col-lg-4">
						<div class="single-best-recipe-area mb-30">
							<img src="../img/bg-img/r4.jpg" width="320" height="285" alt="">
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

					<!-- Recipes -->
					<div class="col-12 col-sm-6 col-lg-4">
						<div class="single-best-recipe-area mb-30">
							<img src="../img/bg-img/r5.jpg" width="320" height="285" alt="">
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

					<!-- Recipes -->
					<div class="col-12 col-sm-6 col-lg-4">
						<div class="single-best-recipe-area mb-30">
							<img src="../img/bg-img/r6.jpg" width="320" height="285" alt="">
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
        </div>
	
		<div class="container-pagination">
			<div class="pagination p1">
				<ul>
					<a style="text-decoration: none;font-size: 14px" href="#"><li style="font-size: 14px"><</li></a>
					<a style="text-decoration: none;font-size: 14px" class="" href="#"><li style="font-size: 14px">1</li></a>
					<a style="text-decoration: none;font-size: 14px" href="#"><li style="font-size: 14px">2</li></a>
					<a style="text-decoration: none;font-size: 14px" href="#"><li style="font-size: 14px">3</li></a>
					<a style="text-decoration: none;font-size: 14px" href="#"><li style="font-size: 14px">4</li></a>
					<a style="text-decoration: none;font-size: 14px" href="#"><li style="font-size: 14px">5</li></a>
					<a style="text-decoration: none;font-size: 14px" href="#"><li style="font-size: 14px">6</li></a>
					<a style="text-decoration: none;font-size: 14px" href="#"><li style="font-size: 14px">></li></a>
				</ul>
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
    <script src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <!-- All Plugins js -->
    <script src="../js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="../js/tools/active/active.js"></script>
	<!-- Recipes Category js -->
	<script src="../js/categoryRecipes.js"></script>

	<?php include('./include/connexion_profil.php'); ?>
</body>
</html>