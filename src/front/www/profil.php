<?php
    session_start();
    require_once('./require/require_profil.php');
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
        header('location:./connexion.php?error=Veuillez vous connecter pour voir votre profil');
    }
    if(isset($_POST['ingredients'])) {
        $client = ClientFacade::updatePreferencesIngredients($client, $_POST['ingredients']);
    }
    if((isset($_POST['password']) AND (!empty($_POST['password']))) AND (isset($_POST['password_confirm']) AND (!empty($_POST['password_confirm'])))){
        $client->setPassword($_POST['password']);
        $_SESSION['client'] = serialize($client);
        ClientFacade::updatePasswordClient($client->getId(), $client->getPassword());
    }
    if(isset($_POST['algo']) and !empty($_POST['algo'])){
        $_SESSION['algo'] = $_POST['algo'];
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
    <title>Delicioso! | Profil</title>
    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.ico">
    <!-- Core Stylesheet -->
	<link rel="stylesheet" href="../css/etm1.css">
	<link rel="stylesheet" href="../css/css_libs1.css">
	<link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_profil.css">
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
				<div class="generator_header col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
					<div class="row">
						 <img style="margin:1em auto" src="../img/core-img/logo-account-black.png" width="50" height="60" alt="">
					</div>
					<div class="row">
						<h1 style="margin:0 auto;font-size:24px" for="num_meals_selector">Mon profil</h1>
					</div>

                    <?php
                        if((isset($_GET['error'])) AND (!empty($_GET['error']))){
                            $error=$_GET['error'];
                            echo "<div style ='margin-top:1em' class='row alert-warning'>
						            <label style='margin:0 auto'>".$error."</label>
					            </div>";
                        }
                    ?>

                    <form id="profil-form" action="profil" method="POST">
					    <div style="margin-top:2em" class="row form-group">
						    <label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="pseudo">Pseudo</label>
						    <div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5 text-center">
						    	<input type="text" id="pseudo" class="form-control" value="<?php echo $client->getPseudo();?>" readonly >
						    </div>
					    </div>
					    <div class="row form-group">
						    <label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="civility">Civilité</label>
						    <div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
                                <select id="civility-select" name="civility" class="form-control" disabled readonly>
                                    <?php
                                        if ('1' == $client->getCivility()){
                                            echo "<option value='Mme' selected='selected'>Mme</option>";
                                            echo "<option value='Mr'>Mr</option>";
                                        }else{
                                            echo "<option value='Mme'>Mme</option>";
                                            echo "<option value='Mr' selected='selected'>Mr</option>";
                                        }
                                    ?>
							    </select>
						    </div>
					    </div>
                        <div class="row form-group">
                            <label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="firstname">Prénom</label>
                            <div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
                                <input type="text" id="firstname" class="form-control" name="firstname" value="<?php echo $client->getFirstName();?>" readonly />
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="lastname">Nom</label>
                            <div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
                                <input type="text" id="lastname" class="form-control" name="lastname" value="<?php echo $client->getLastName();?>" readonly />
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="email">Email*</label>
                            <div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
                                <input type="text" id="email" class="form-control" name="email" value="<?php echo $client->getMail();?>" maxlength="40" readonly/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="password">Mot de passe</label>
                            <label class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5" style="padding-top:8px;color:blue" id="modified-password-link" onclick="passwordBlock()">editer</label></td>
                        </div>
                        <div id="change-password-block">
                            <div class="row form-group">
                                <label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="password">Nouveau mot de passe*</label>
                                <div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
                                    <input type="password" id="password" class="form-control" name="password" value="<?php echo $client->getMail();?>"
                                           pattern=".{8,}" maxlength="30" required disabled />
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
                                           onfocus="enterElement('error-password-confirm')" onblur="passwordValidation()"  required disabled />
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="password-confirm">Ingredients préférés</label>
                            <div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
                                <input type="text" class="form-control" class="form-control" name="ingredients"  value="<?php echo $client->getPreferencesIngredientsLabel();?>"/>
                                <div id="ingredientdHelp" class="form-text">
                                    <label style="font-size:12px">Veuillez separez les ingrédients par ";"</label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="password-confirm">Algorithme de Suggestion</label>
                            <div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="content" name="algo" id="flexRadioDefault1"
                                           <?php if(false == isset($_SESSION['algo']) or 'content' == $_SESSION['algo']) { ?> checked <?php } ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Algorithme basé sur le contenu
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="collaborative" name="algo" id="flexRadioDefault2"
                                        <?php if(true == isset($_SESSION['algo']) and 'collaborative' == $_SESSION['algo']) { ?> checked <?php } ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Algorithme de filtrage collaboratif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group small_top_spacer">
                            <div class="col-12 col-md-3 offset-md-4 offset-lg-5">
                                <button class="btn btn-lg btn-block btn-orange gen_button" id="generate-btn" type="submit">SOUMETTRE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

     <?php include('include/footer.php');?>
     <?php include('./include/add_recipe.php'); ?>

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