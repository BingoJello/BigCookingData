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
                        <a class="nav-brand" href="index"><img src="../img/core-img/logo-title.png" width="180" height="180" alt=""></a>

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
                                    <li ><a href="index">Accueil</a></li>
                                    <li><a href="recettes">Recettes</a></li>
                                    <!--<li><a href="./mealPlanner.php">Meal Planner</a></li>-->
                                    <?php
                                    if(isset($_SESSION['client']) and !empty($_SESSION['client'])){
                                        echo "<li><a href='#' data-toggle='modal' data-target='#addRecipe'>Ajouter une recette</a></li>";
                                    }else{
                                        echo "<li><a href='#' data-toggle='modal' data-target='#loginIHM'>Ajouter une recette</a></li>";
                                    }
                                    ?>
                                    <li><a href="#">Profil</a>
                                        <ul class="dropdown">
                                            <?php
                                            if(isset($_SESSION['client']) and !empty($_SESSION['client'])){
                                                echo "<li class='active'><a href='profil'>Mon compte</a></li>";
                                            }else{
                                                echo "<li><a href='#' data-toggle='modal' data-target='#loginIHM'>Mon profil</a></li>";
                                            }
                                            if(isset($_SESSION['client']) and !empty($_SESSION['client'])){
                                                echo "<li><a href='carnet-de-recettes'>Mon carnet</a></li>";
                                            }else{
                                                echo "<li><a href='#' data-toggle='modal' data-target='#loginIHM'>Mon carnet</a></li>";
                                            }
                                            if(isset($_SESSION['client']) and !empty($_SESSION['client'])){
                                                echo "<li><a href='./deconnexion.php'>Déconnexion</a></li>";
                                            }else{
                                                echo "<li><a href='#' data-toggle='modal' data-target='#loginIHM'>Connexion</a></li>";
                                            }
                                            ?>
                                        </ul>
                                    </li>
                                    <li><a href="qui-sommes-nous">Qui sommes-nous</a></li>
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