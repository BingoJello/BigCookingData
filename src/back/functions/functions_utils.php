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