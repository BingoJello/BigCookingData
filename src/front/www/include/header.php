 <!-- ##### Header Area Start ##### -->
    <header class="header-area">
        <!-- Top Header Area -->
        <div class="top-header-area">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-between">
                    <!-- Breaking News -->
                    <div class="col-12 col-sm-6">
                        <div class="breaking-news">
                            <div id="breakingNewsTicker" class="ticker">
                                <ul>
                                    <li><a href="#">Hello !</a></li>
                                    <li><a href="#">Bienvenue sur Delicioso!.</a></li>
                                    <li><a href="#">Bon appétit</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navbar Area -->
        <div class="delicious-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="deliciousNav">

                        <!-- Logo -->
                        <a class="nav-brand" href="index.php"><img src="../img/core-img/logo-title.png" width="180" height="180" alt=""></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- close btn -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li class="active"><a href="./index.php">Home</a></li>
                                    <li><a href="#">Menu</a>
                                        <div class="megamenu">
                                            <ul class="single-mega cn-col-4">
                                                <li class="title">Recettes par catégorie</li>
                                                <li><a href="./recipes.php?category=appetizers">Appetizers and Snacks</a></li>
                                                <li><a href="./recipes.php?category=grilling">BBQ and Grilling</a></li>
                                                <li><a href="./recipes.php?category=bread">Bread Recipes</a></li>
                                                <li><a href="./recipes.php?category=breakfast-brunch">Breakfast and Brunch</a></li>
                                                <li><a href="./recipes.php?category=desserts">Desserts</a></li>
                                                <li><a href="./recipes.php?category=dinner">Dinner Recipes</a></li>
												<li><a href="./recipes.php?category=drinks">Drinks</a></li>
                                            </ul>
                                            <ul class="single-mega cn-col-4">
												<li class="title" style="color:white">Recipes by category</li>
                                                <li><a href="./recipes.php?category=everyday-cooking">Everyday Cooking</a></li>
                                                <li><a href="./recipes.php?category=fruits-vegetables">Fruits, Vegetables and Other Produce</a></li>
                                                <li><a href="./recipes.php?category=holidays">Holidays and Events</a></li>
												<li><a href="./recipes.php?category=ingredients">Ingredients</a></li>
                                                <li><a href="./recipes.php?category=lunch">Lunch Recipes</a></li>
                                                <li><a href="./recipes.php?category=main">Main Dishes</a></li>
                                                <li><a href="./recipes.php?category=meat">Meat and Poultry</a></li>
                                            </ul>
                                            <ul class="single-mega cn-col-4">
												<li class="title" style="color:white">Recipes by category</li>
												<li><a href="./recipes.php?category=pasta">Pasta and Noodles</a></li>
                                                <li><a href="./recipes.php?category=salad">Salad Recipes</a></li>
                                                <li><a href="./recipes.php?category=seafood">Seafood Recipes</a></li>
												<li><a href="./recipes.php?category=side-dishes">Side Dishes</a></li>
                                                <li><a href="./recipes.php?category=soups">Soups, Stews and Chili</a></li>
                                                <li><a href="./recipes.php?category=us">U.S Recipes</a></li>
                                                <li><a href="./recipes.php?category=world">World Cuisine</a></li>
                                            </ul>
                                            <div class="single-mega cn-col-4">
                                                <div class="recipe-slider owl-carousel">
                                                    <a href="#"><img src="../img/bg-img/bg1.jpg" alt=""></a>
                                                    <a href="#"><img src="../img/bg-img/bg6.jpg" alt=""></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a href="./recipes.php">Recettes</a></li>
                                    <li><a href="./mealPlanner.php">Meal Planner</a></li>
                                    <li><a href="./about.php">Qui sommes-nous</a></li>
									<li><a href="#">Profil</a>
										<ul class="dropdown">
                                            <?php
                                                if(isset($_SESSION['client']) and !empty($_SESSION['client'])){
                                                    echo "<li><a href='./profil.php'>Mon compte</a></li>";
                                                }else{
                                                    echo "<li><a href='#' data-toggle='modal' data-target='#loginIHM'>Mon profil</a></li>";
                                                }
                                            ?>
                                            <li><a href="./recipe-book.php">Mon carnet</a></li>
                                            <?php
                                                if(isset($_SESSION['client']) and !empty($_SESSION['client'])){
                                                    echo "<li><a href='./deconnexion.php'>Déconnexion</a></li>";
                                                }else{
                                                    echo "<li><a href='#' data-toggle='modal' data-target='#loginIHM'>Connexion</a></li>";
                                                }
                                            ?>
                                        </ul>
									</li>
                                </ul>

                                <!-- Newsletter Form -->
                                <div class="search-btn">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </div>
                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
<!-- ##### Header Area End ##### -->