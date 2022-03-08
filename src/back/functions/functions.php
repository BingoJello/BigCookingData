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
