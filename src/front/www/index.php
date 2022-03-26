<?php
    session_start();
    require_once('./require/require_index.php');
?>

<?php
    $random = false;

    if(false === isset($_SESSION['visualization'])){
        $_SESSION['visualization'] = array();
    }
    if(isset($_SESSION['client']) and !empty($_SESSION['client'])) {
        $client = getClient();
        try {
            $recipes = RecipeFacade::getSuggestedRecipes($client, $_SESSION);
            if(true == empty($recipes['recipe'])){
                $random = true;
                $recipes = RecipeFacade::getRandomRecipes();
                $json_recipes = getJsonRecipes($recipes);
                $limit = LIMIT_PAGINATION;
                $total_pages = ceil(count($recipes['recipe']) / $limit);
            }
        } catch (Exception $e) {
            var_dump($e);
        }
        $json_recipes = getJsonRecipes($recipes);
        $limit = LIMIT_PAGINATION;
        $total_pages = ceil(count($recipes['recipe']) / $limit);
    }else{
        $random = true;
        $recipes = RecipeFacade::getRandomRecipes();
        $json_recipes = getJsonRecipes($recipes);
        $limit = LIMIT_PAGINATION;
        $total_pages = ceil(count($recipes['recipe']) / $limit);
    }

    $recipes_slide = getRandomRecipes($recipes['recipe']);
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
    <!-- Titre -->
    <title>Delicioso! | Home</title>
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

    <!-- ##### Hero Area Start ##### -->
    <?php printRecipesSlides($recipes_slide); ?>
    <!-- ##### Hero Area End ##### -->

    <!-- ##### Best Recipe Area Start ##### -->
    <section class="best-recipe-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <?php if (true === $random){ ?>
                            <h3 style="margin-top: 25px">Recettes aléatoires</h3>
                        <?php }else{ ?>
                            <h3 style="margin-top: 25px">Recettes que vous pourriez aimer</h3>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="row" id="target-content">
            </div>

            <div class="container-pagination">
                <div class="pagination p1">
                    <ul>
                        <p id="object-recipes" style="display:none" data-id="<?php echo $recipes['recipe'] ?>"></p>
                        <?php
                            printPagination($total_pages);
                        ?>
                    </ul>
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
					<h3 style="margin-top: -150px">Catégories suggérées</h3>
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
                            <a href="recette" class="btn delicious-btn">See Full Recipe</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Top Category Area End ##### -->

    <!-- ##### CTA Area Start ##### -->
    <section class="cta-area bg-img bg-overlay" style="background-image: url(../img/bg-img/bg4.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <!-- Cta Content -->
                    <div class="cta-content text-center">
                        <h2>Meal Planner</h2>
                        <p>Créez des plans de repas personnalisés en fonction de vos préférences alimentaires. Atteignez votre régime alimentaire et vos objectifs nutritionnels avec notre calculateur de calories.</p>
                        <p>Cette fonctionnalité est toujours en développement</p>
                        <a href="./mealPlanner.php" class="btn delicious-btn">Discover</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### CTA Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <?php include('include/footer.php');?>
    <!-- ##### Footer Area End ##### -->

    <?php include('./include/connexion_profil.php'); ?>

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

    <script>
        $(document).ready(function() {
            let Datas = new FormData();
            Datas.append("page", 1);
            Datas.append("recipes", JSON.stringify(<?php echo $json_recipes; ?>));

            let request = $.ajax({
                type: "POST",
                url: "pagination.php",
                data:Datas,
                cache: false,
                contentType: false,
                processData: false,
            });

            request.done(function (output_success) {
                $("#target-content").html(output_success);
            });
            request.fail(function (http_error) {
                //Code à jouer en cas d'éxécution en erreur du script du PHP
                let server_msg = http_error.responseText;
                let code = http_error.status;
                let code_label = http_error.statusText;
                alert("Erreur "+code+" ("+code_label+") : "  + server_msg);
            });

            $(".page-link").click(function(){
                let Datas = new FormData();
                Datas.append("page", $(this).attr("data-id"));
                Datas.append("recipes", JSON.stringify(<?php echo $json_recipes; ?>));
                let request = $.ajax({
                    url: "pagination.php",
                    type: "POST",
                    data: Datas,
                    cache: false,
                    contentType: false,
                    processData: false,
                });

                request.done(function (output_success) {
                    $("#target-content").html(output_success);
                    $(".pageitem").removeClass("active");
                    $("#"+select_id).addClass("active");
                });
                request.fail(function (http_error) {
                    //Code à jouer en cas d'éxécution en erreur du script du PHP
                    let server_msg = http_error.responseText;
                    let code = http_error.status;
                    let code_label = http_error.statusText;
                    alert("Erreur "+code+" ("+code_label+") : "  + server_msg);
                });
            });
        });
    </script>
</body>
</html>