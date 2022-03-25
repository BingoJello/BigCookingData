<?php
    session_start();
    require_once('./require/require_registration.php');
?>

<?php
    if (isset($_SESSION['client']) and !empty($_SESSION['client'])){
        $client = getClient();
    }

    if ((isset($_POST['pseudo']) and (!empty($_POST['pseudo'])))
        and (isset($_POST['civility']) and (!empty($_POST['civility'])))
        and (isset($_POST['email']) and (!empty($_POST['email'])))
        and (isset($_POST['password']) and (!empty($_POST['password'])))
        and (isset($_POST['password_confirm']) and (!empty($_POST['password_confirm'])))) {

        if ((isset($_POST['firstname'])) and (isset($_POST['lastname'])) and (isset($_POST['ingredients']))){
            $pseudo = $_POST['pseudo'];
            $civility = $_POST['civility'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
            $last_name = $_POST['lastname'];
            $first_name = $_POST['firstname'];
            $ingredients = $_POST['ingredients'];
            try {
                ClientFacade::registerInscriptionClient($pseudo, $civility, $email, $password, $password_confirm, $last_name, $first_name, $ingredients);
            } catch (Exception $e) {
            }
        }
    }

    $list_ingredients = json_encode(RecipeFacade::getAllIngredients());
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
    <title>Delicioso! | Inscription</title>
    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.ico">
    <!-- Core Stylesheet -->
	<link rel="stylesheet" href="../css/etm1.css">
	<link rel="stylesheet" href="../css/css_libs1.css">
	<link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_registration.css">
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
				<div class="generator_header col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
					<div class="row">
						 <img style="margin:1em auto" src="../img/core-img/logo-account-black.png" width="50" height="60" alt="">
					</div>
					<div class="row">
						<h1 style="margin:0 auto;font-size:24px" for="num_meals_selector">Inscription</h1>
					</div>
					<div class="row">
						<a href="#" data-toggle="modal" data-target="#loginIHM" style="font-size:16px;color:#1E90FF;margin:0 auto">Se connecter</a>
					</div>

                    <?php
                        if((isset($_GET['error'])) AND (!empty($_GET['error']))){
                            $error=$_GET['error'];
                            echo "<div style ='margin-top:1em' class='row alert-warning'>
						            <label style='margin:0 auto'>".$error."</label>
					            </div>";
                        }
                    ?>

                    <form id="registration-form" action="./registration.php" method="POST">
					    <div style="margin-top:2em" class="row form-group">
						    <label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="pseudo">Pseudo*</label>
						    <div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5 text-center">
							    <input type="text" id="pseudo" class="form-control" name="pseudo" maxlength="25" placeholder="Entrez un pseudo" required>
						    </div>
					    </div>
					    <div class="row form-group">
						    <label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="civility-select">Civility*</label>
						    <div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
                                <p id="error-civility" style="color:red;font-size:15px;"></p>
							    <select id="civility-select" name="civility" class="form-control">
                                    <option value="0" selected="selected">Civilité</option>
                                    <option value="Mme">Mme</option>
                                    <option value="Mr">Mr</option>
							    </select>
						    </div>
					    </div>
                        <div class="row form-group">
						    <label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="firstname">Prénom</label>
						    <div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
                                <input type="text" id="firstname" class="form-control" name="firstname" placeholder="Entrez votre prénom" maxlength="25" />
						    </div>
					    </div>
					    <div class="row form-group">
						    <label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="lastname">Nom</label>
						    <div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
                                <input type="text" id="lastname" class="form-control" name="lastname"  placeholder="Entrez votre nom" maxlength="25" />
						    </div>
					    </div>
					    <div class="row form-group">
						    <label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="email">Email*</label>
						    <div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
                                <p id="error-email" style="color:red;font-size:15px;"></p>
                                <input type="text" id="email" class="form-control" name="email" placeholder="Entrez votre email" maxlength="40"
                                   onfocus="enterElement('error-email')" onblur="mailValidation()" required/>
                            </div>
					    </div>
					    <div class="row form-group">
						    <label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="password">Mot de passe*</label>
						    <div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
                                <input type="password" id="password" class="form-control" name="password" pattern=".{8,}" maxlength="30"
                                   placeholder="Entrer un mot de passe" required />
							    <div id="passwordHelp" class="form-text">
								    <label style="font-size:12px">Le mot de passe doit contenir entre 8 et 30 caractères</label>
							    </div>
						    </div>
					    </div>
					    <div class="row form-group">
						    <label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="password-confirm">Confirmation mot de passe*</label>
						    <div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
                                <p id="error-password-confirm" style="color:red;font-size:15px;"></p>
                                <input type="password" id="password-confirm" class="form-control" name="password_confirm" pattern=".{8,}" maxlength="30"
                                   placeholder="Confirmez votre mot de passe"  onfocus="enterElement('error-password-confirm')" onblur="passwordValidation()"  required />
						    </div>
					    </div>
                        <div class="row form-group">
                            <label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="password-confirm">Ingredients préférés</label>
                            <div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
                                <input type="text" id="list_ingredients" class="form-control" name="ingredients"/>
                            </div>
                        </div>
					    <div class="row form-group small_top_spacer">
						    <div class="col-12 col-md-3 offset-md-4 offset-lg-5">
                                <button type="submit"  id="generate-btn" class="btn btn-lg btn-block btn-orange gen_button">SOUMETTRE</button>
						    </div>
					    </div>
                    </form>
                </div>
            </div>
		</div>
	</section>

    <!-- ##### Footer Area Start ##### -->
     <?php include('include/footer.php');?>
     <!-- ##### Footer Area End ##### -->

     <?php include('./include/connexion_profil.php'); ?>

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
     <!-- Registration security js -->
     <script src="../js/registration.js"></script>
     <!-- List Ingredient multiple select js -->
     <script>
        var listIngredientsJson = <?php echo $list_ingredients; ?>;
        var listIngredients = [];

        for(var i = 0; i < listIngredientsJson.length; i++){
            listIngredients.push(listIngredientsJson[i]);
        }

        $("#list_ingredients").mSelectDBox({
            "list": listIngredients,
            "builtInInput": 0,
            "multiple": true,
            "autoComplete": true,
            "name": "b"
        });
     </script>
</body>
</html>