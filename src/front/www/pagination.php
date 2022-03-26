<?php
    require_once ('./require/require_pagination.php');

    $limit = LIMIT_PAGINATION;

    if (isset($_POST["page"])) {
        $page  = $_POST["page"];
    } else {
    $page=1;
    }

    $start_from = ($page-1) * $limit;

    if (isset($_POST["recipes"])) {
        $recipes = html_entity_decode($_POST["recipes"]);
        $recipes = json_decode($recipes);
    }

    $k = $limit+$start_from;
    $have_one_recipe = false;

    for($i=$start_from;$i<$k;$i++){
        if(true === $have_one_recipe AND false === isset($recipes[$i])){
            break;
        }
        if(false === isset($recipes[$i]) AND false === $have_one_recipe){?>
            <div class="row" style="margin:0 auto">
                <h4 style="margin-top: 25px;text-align:center"">Nous n’avons pas trouvé de résultats pour votre recherche</h4>
            </div>
            <?php
            break;
        }
        $have_one_recipe = true;
        ?>
        <div class='col-12 col-sm-6 col-lg-4'>
            <div class='single-best-recipe-area mb-30'>
                <img src=<?php echo $recipes[$i]->url_pic;?> style="min-width:350px;max-width:350px;min-height:300px;max-height:300px" alt=''>
                <div class='recipe-content'>
                    <a href='recette-<?php echo $recipes[$i]->id_recipe;?>'
                        <h5><?php echo $recipes[$i]->name;?></h5>
                    </a>
                    <?php
                        $global_rating = RecipeFacade::getGlobalRating($recipes[$i]->id_recipe);
                        printGlobalRatingIndex($global_rating);
                    ?>
                </div>
            </div>
        </div>
    <?php }?>