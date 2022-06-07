<?php


class GenerationClient
{
    public static function generateClients($nbrClient){
        ini_set('max_execution_time', 0);
        $cpt = 0;
        while ($cpt < $nbrClient){
            $new_id_client = ClientPersistence::getLastIdClient() + 1;
            $random_pseudo = "";
            $random_mail = "";
            $random_password = "";

            for ($i = 0; $i < random_int(6, 30); $i++) {
                $random_pseudo .= CHARACTERS[rand(0, strlen(CHARACTERS) - 1)];
            }
            for ($i = 0; $i < random_int(5, 10); $i++) {
                $random_mail .= CHARACTERS[rand(0, strlen(CHARACTERS) - 1)];
            }
            $random_mail.="@gmail.com";
            for ($i = 0; $i < random_int(8, 60); $i++) {
                $random_password .= CHARACTERS[rand(0, strlen(CHARACTERS) - 1)];
            }

            ClientPersistence::insertClient($new_id_client, "", "", "Mr", $random_pseudo, $random_mail, $random_password);

            $nbr_rated_recipes = 0;
            $id_rated_recipes = array();

            $ingredient_liked = RecipePersistence::getRandomIngredients(NBR_INGREDIENTS_LIKED, []);
            $ingredient_unliked = RecipePersistence::getRandomIngredients(NBR_INGREDIENTS_UNLIKED, $ingredient_liked);

            while($nbr_rated_recipes < NBR_RECIPES_TO_RATE){
                $score = 0;
                $recipe = RecipePersistence::getRandomRecipes(1);
                while(in_array($recipe['recipe'][0]->getId(), $id_rated_recipes)){
                    $recipe = RecipePersistence::getRandomRecipes(1);
                }

                $ingredients_recipe = RecipePersistence::getIngredientsByRecipes([$recipe['recipe'][0]->getId()]);
                $score_recipe = array("quarter" => count($ingredients_recipe) / 4,
                                      "half" => count($ingredients_recipe) / 2,
                                      "three_quarters" => count($ingredients_recipe) * (3/4));
                foreach($ingredients_recipe as $ingredient){
                    if(in_array($ingredient->getId(), $ingredient_liked)){
                        $score += 1;
                    }elseif(in_array($ingredient->getId(), $ingredient_unliked)){
                        $score -= 1;
                    }
                }
                switch(true){
                    case $score < 0 and $score >= -$score_recipe['quarter']:
                        $score = 2;
                        break;
                    case $score <= -$score_recipe['half'] and $score > -$score_recipe['three_quarters']:
                        $score = 1;
                        break;
                    case $score <= -$score_recipe['three_quarters']:
                        $score = 0.5;
                        break;
                    case $score == 0:
                        $score = 2.5;
                        break;
                    case $score > 0 and $score < $score_recipe['quarter']:
                        $score = 3;
                        break;
                    case $score >= $score_recipe['quarter'] and $score < $score_recipe['half']:
                        $score = 3.5;
                        break;
                    case $score >= $score_recipe['half'] and $score < $score_recipe['three_quarters']:
                        $score = 4;
                        break;
                    default:
                        $score = 5;
                        break;
                }
                ClientPersistence::insertCommentaryAndRating($recipe['recipe'][0]->getId(), $new_id_client, $score,
                    date("d/m/Y"), '');

                $nbr_rated_recipes++;
                array_push($id_rated_recipes, $recipe['recipe'][0]->getId());
            }
            $cpt++;
        }
    }
}