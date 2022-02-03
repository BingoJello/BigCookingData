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
    <title>Delicious - Food Blog | Profil</title>

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
	
	<section class="best-recipe-area section-padding-80 container" style="margin-top:-3em">
        <div class="container">			
			<div class="row">
				<div class="generator_header col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
					<div class="row">
						 <img style="margin:1em auto" src="../img/core-img/logo-account-black.png" width="50" height="60" alt="">
					</div>
					<div class="row">
						<h1 style="margin:0 auto;font-size:24px" for="num_meals_selector">My profil</h1>
					</div>
					<div style ="margin-top:1em" class="row alert-warning">
						<label style="margin:0 auto">Ici on écrit les warning</label>
					</div>
					<div style="margin-top:2em" class="row form-group">
						<label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="pseudo">Pseudo</label>
						<div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5 text-center">
							<input type="text" class="form-control" id="pseudo" disabled value="toto">
						</div>
					</div>
					<div class="row form-group">
						<label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="civility">Civility</label>
						<div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
							<select id="civility"class="form-control">
								<option value="1">Mme </option>
								<option selected value="2">Mr </option>
								<option value="3">Non binaire</option>
								<option value="3">Non humain</option>
								<option value="3">Je sais pas</option>
							</select>
						</div>
					</div>
					<div class="row form-group">
						<label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="first_name">First name</label>
						<div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
							<input type="text" class="form-control" id="first_name" value="Arthur">
						</div>
					</div>	
					<div class="row form-group">
						<label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="last_name">Last name</label>
						<div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
							<input type="text" class="form-control" id="last_name" value="Mimouni">
						</div>
					</div>	
					<div class="row form-group">
						<label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="email">Email adress</label>
						<div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
							<input type="text" class="form-control" id="email" value="a.mimouni@cergy.fr" disabled>
						</div>
					</div>		
					<div class="password-row">
						<div class="row form-group">
							<label class="col-9 col-sm-1 col-md-4 col-lg-5 text-sm-right col-form-label" for="password">Password</label>
							<div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
								<input type="password" class="form-control" id="current-password">
								<div style="padding-top:3px" id="passwordHelp" class="form-text">
									<a href="#" id="edit-password" style="font-size:14x;color:#1E90FF">edit</a>
								</div>
							</div>						
						</div>	
					</div>
					<div class="new-password-row">
						<div class="row form-group">
							<label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="password_confirmation">New Password</label>
							<div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
								<input type="password" class="form-control" id="new-password">
								<div id="passwordHelp" class="form-text">
									<label style="font-size:12px">The password must be between 8 and 50 characters.</label>
								</div>
							</div>						
						</div>
					</div>
					<div class="password-confirmation-row">
						<div class="row form-group">
							<label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="password_confirmation">Password Confirmation*</label>
							<div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
								<input type="password" class="form-control" id="password_confirmation">
								<a href="#" id="cancel-password" style="font-size:14x;color:#dc143c;display:none">cancel</a>
							</div>						
						</div>
					</div>
					<div class="row form-group">
						<label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="diet">Diet</label>
						<div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
							<select class="form-control" id="diet">
								<option value="1">Aucun </option>
								<option value="2">Vegetarian </option>
								<option value="3">Paleolithic</option>
								<option value="3">Veganism</option>
							</select>
						</div>						
					</div>
					<div class="row form-group small_top_spacer">
						<div class="col-12 col-md-3 offset-md-4 offset-lg-5">
							<button class="btn btn-lg btn-block btn-orange gen_button" id="generate-btn" type="submit" onclick="generate()" data-loading-text="Generate">
								Submit
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	
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
	
    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Files ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="../js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Bootstrap js -->
    <script src="../js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="../js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="../js/active2.js"></script>
	<!-- Canvas js -->
	<script src="../js/canvas.js"></script>
	<!-- Profil js -->
	<script src="../js/profil.js"></script>
	
	<?php include('./include/connexion_profil.php'); ?>
</body>
</html>