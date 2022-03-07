<?php
function print_recipes(){
    $recipes = RecipePersistence::getRecipes();
    $html='';
    foreach($recipes as $recipe){
        $url = $recipe->getUrlPic();
        $html.= "<div class='col-12 col-sm-6 col-lg-4'>
                    <div class='single-best-recipe-area mb-30'>
                        <img src='$url' alt=''>
                        <div class='recipe-content'>
                            <a href='recipe-post.php'>
                                <h5>".$recipe->getName()."</h5>
                            </a>
                            <div class='ratings'>
                                <i class='fa fa-star' aria-hidden='true'></i>
                                <i class='fa fa-star' aria-hidden='true'></i>
                                <i class='fa fa-star'' aria-hidden='true'></i>
                                <i class='fa fa-star' aria-hidden='true''></i>
                                <i class='fa fa-star-o' aria-hidden='true'></i>
                            </div>
                        </div>
                    </div>
                </div>";
    }
    echo $html;
}
?>

<?php
    function printPreferencesIngredients(Client $client){
        $preferences_ingredients_array = $client->getPreferencesIngredients();
        $preferences_ingredients_string = "";
        foreach($preferences_ingredients_array as $ingredient){
            $preferences_ingredients_string.=$ingredient->getName();
            $preferences_ingredients_string.=";";
        }
        echo $preferences_ingredients_string;
    }
?>
