<?php
/**
 * @param Client $client
 */
function printPreferencesIngredients($client){
    $preferences_ingredients_array = $client->getPreferencesIngredients();
    $preferences_ingredients_string = "";

    foreach($preferences_ingredients_array as $ingredient){
        $preferences_ingredients_string.=$ingredient->getName();
        $preferences_ingredients_string.=";";
    }
    echo $preferences_ingredients_string;
}
?>

<?php
/**
 * @return mixed
 */
function getClient(){
    return unserialize($_SESSION['client']);
}
?>

<?php
/**
 * @param $recipes
 * @return false|string
 */
function getJsonRecipes($recipes){
    $recipes_array = array();
    $i =0;

    foreach($recipes['recipe'] as $recipe){
        $recipes_array[$i]['id_recipe'] = $recipe->getId();
        $recipes_array[$i]['name'] = $recipe->getName();
        $recipes_array[$i]['url_pic'] = $recipe->getUrlPic();
        $i++;
    }

    return json_encode($recipes_array, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES );
}
?>

<?php
/**
 * @param $total_pages
 */
function printPagination($total_pages){
    if(!empty($total_pages)){
        for($i=1; $i<=$total_pages; $i++){
            if($i == 1){
                ?>
                <li style="text-decoration: none;font-size: 14px;display:inline-block" class="pageitem active" id="<?php echo $i;?>">
                    <a href="JavaScript:Void(0);" class="page-link" data-id="<?php echo $i;?>" ><?php echo $i;?></a>
                </li>
                <?php
            }
            else{
                ?>
                <li style="display:inline-block" class="pageitem" id="<?php echo $i;?>">
                    <a href="JavaScript:Void(0);" class="page-link" data-id="<?php echo $i;?>"><?php echo $i;?></a>
                </li>
                <?php
            }
        }
    }
}
?>

<?php
function printIngredients($recipe){
    foreach($recipe->getIngredients() as $ingredient){?>
        <div>
            <label class="ingredient-label">
                <img src=<?php echo $ingredient->getUrlPic();?> height="40" width="40">
                <?php echo $ingredient->getName();?>
            </label>
        </div>
    <?php }
}
?>

<?php
function printAssessRecipe($assessed_recipe){
    $html = "";
    $cpt_assessed = 0;

    $html.="<div class='commentary-container'>
                <span style='margin-left: 20px'>
                    <h2 class='nbr-commentary-front'>Commentaires (".count($assessed_recipe).")</h2>
                </span>";

    foreach($assessed_recipe as $assess){
        if($cpt_assessed > 3){
            break;
        }

        $html.="<div class='list-commentary'>
                    <div class='commentary'>
                        <div class='name-rating-container'>
                         <div class='name-rating'>
                            <div class='pseudo'>
                                <p class='name-pseudo'>".$assess->getPseudo()."</p>
                            </div>
                         <div class='rating-commentary'>";
        $rating = $assess->getRating();

        for($i=0; $i<5; $i++){
            if($rating > 0){
                $html.="<i class='fa fa-star' style='color:yellowgreen' aria-hidden='true'></i>";
                $rating--;
            }else{
                $html.="<i class='fa fa-star' style='color:grey' aria-hidden='true'></i>";
            }
        }
        $html.="<label> ".$assess->getRating()."/5</label>
             </div>
            </div>
           </div>
         <div class='date-commentary'>
            <p class='date-commentary-font'>".$assess->getDate()."</p>
         </div>
         <div class='commentary-text'>
            <p class='commentary-text-font'>".$assess->getCommentary()."</p>
         </div>
        </div>
        <hr>";

        $cpt_assessed++;
    }

    if($cpt_assessed > 3){
        $html.="<a href='#' data-toggle='modal' data-target='#allCommentaryIHM' class='btn delicious-btn' data-animation='fadeInUp' data-delay='1000ms'>Voir plus</a>";
    }

    $html.="</div>";

    echo $html;
}
?>
