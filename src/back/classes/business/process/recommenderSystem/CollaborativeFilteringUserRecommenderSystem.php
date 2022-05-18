<?php
/**
 * Class ContentBasedRecommenderSystem
 * @brief Effectue le processus de création des recommandations de recettes
 * @author arthur mimouni
 */
class CollaborativeFilteringUserRecommenderSystem
{
    /**
     * @var Client $client
     */
    private $client;
    /**
     * @var array
     */
    private $recipes;

    /**
     * ContentBasedRecommenderSystem constructor.
     * @param string $mail
     * @param string $password
     * @throws Exception
     */
    public function __construct($mail, $password)
    {
        $this->recipes = array();
        $this->client = ClientPersistence::getClient($mail, $password);
    }

    /**
     * @param array $session
     * @throws Exception
     */
    public function buildRecipes($session)
    {
        $recipes_to_suggest = array('recipe' => array());

        $rated_recipes_client = RecipePersistence::getRatedRecipesUser($this->client->getId(), 30);

        if(true === is_null($rated_recipes_client)){
            $ingredients_preferences = ClientPersistence::getPreferencesIngredientsClient($this->client->getId());

            if(true === is_null($ingredients_preferences)){
                $preferences_recipes_user = null;
                $best_cluster_visualization_user = RecipePersistence::getBestVisualizationClusterUser($session);
                $visualized_recipes_user = RecipePersistence::getRecipesVisualizatedByCluster($best_cluster_visualization_user, $session);

                if(true === is_null($visualized_recipes_user)){
                    $this->recipes = $recipes_to_suggest;
                    return;
                }
            }else{
                $visualized_recipes_user = null;
                $decision_tree = new DecisionTreeCluster($ingredients_preferences, true);
                $best_cluster_preferences = $decision_tree->getCluster();
                $preferences_recipes_user = RecipePersistence::getRecipesByIngredientsCluster($best_cluster_preferences,
                    $ingredients_preferences, true, $session);

                if(true === is_null($preferences_recipes_user)){
                    $best_cluster_visualization_user = RecipePersistence::getBestVisualizationClusterUser($session);
                    $visualized_recipes_user = RecipePersistence::getRecipesVisualizatedByCluster($best_cluster_visualization_user, $session);
                    if(true === is_null($visualized_recipes_user)){
                        return $recipes_to_suggest;
                    }
                }else{
                    $recipes_to_suggest['recipe'] = $preferences_recipes_user;
                    $this->recipes = $recipes_to_suggest;
                    return;
                }
            }
        }else{
            $preferences_recipes_user = null;
            $visualized_recipes_user = null;
        }

        if(true === is_null($preferences_recipes_user) AND true === is_null($rated_recipes_user) AND true === is_null($visualized_recipes_user)){
            return $recipes_to_suggest;
        }

        $similar_recipes = $this->build($rated_recipes_user, $preferences_recipes_user,
            $visualized_recipes_user);
    }

    /**
     * @param array $rated_recipes_user
     * @param array $preferences_recipes_user
     * @param array $visualized_recipes_user
     * @return array
     */
    private function build($rated_recipes_user, $preferences_recipes_user, $visualized_recipes_user)
    {
        $ratings_recipes_user = array("id_recipes" => array(), "ratings" => array());

        if (false === is_null($rated_recipes_user)) {
            foreach ($rated_recipes_user as $recipe) {
                if (false === in_array($recipe->getId(), $ratings_recipes_user['id_recipes'])) {
                    array_push($ratings_recipes_user['id_recipes'], $recipe->getId());
                    array_push($ratings_recipes_user['ratings'], new Rating($recipe->getId(), $recipe->getScore()));
                }
            }
        }
        $this->client->setRatedRecipes($ratings_recipes_user['ratings']);

        foreach($rated_recipes_user as $recipe){
            $cpt = 0;
            foreach(explode(",", $recipe->getCloseTo()) as $id_close_recipe){
                if($cpt == 100){
                    break;
                }
                if (false === in_array($id_close_recipe, $ratings_recipes_user['id_recipes'])) {
                    array_push($ratings_recipes_user['id_recipes'], $id_close_recipe);
                    array_push($ratings_recipes_user['ratings'], new Rating($recipe->getId()));
                }
                $cpt++;
            }
        }


        $similar_clients = RecipePersistence::getClientsOfRatingsSimilarRecipes($this->client->getId(), $ratings_recipes_user['id_recipes']);

        $id_recipes = array();

        foreach($this->client->getRatedRecipes() as $rating){
            if (false === in_array($rating->getIdRecipe(), $id_recipes)) {
                array_push($id_recipes, $rating->getIdRecipe());
            }
        }
        foreach($similar_clients['id_recipes'] as $id_recipe){
            if (false === in_array($id_recipe, $id_recipes)) {
                array_push($id_recipes, $id_recipe);
            }
        }

        $vectors = array();
        $vector_user = array();
        $cpt = 0;
        $sum = 0;
        array_push($vector_user, $this->client->getId());

        foreach($id_recipes as $id_recipe){
            $score = $this->client->hasRatedRecipe($id_recipe);
            array_push($vector_user, $score);
            $cpt++;
            $sum+=$score;
        }
        array_push($vector_user, round($sum / $cpt, 2));
        array_push($vectors, $vector_user);

        foreach($similar_clients['users'] as $user){
            $vector = array();
            $cpt = 0;
            $sum = 0;
            array_push($vector, $user->getId());
            foreach($id_recipes as $id_recipe){
                $score = $user->hasRatedRecipe($id_recipe);
                array_push($vector, $score);
                if(false == is_null($score)){
                    $cpt++;
                    $sum+=$score;
                }
            }
            array_push($vector, round($sum / $cpt, 2));
            array_push($vectors, $vector);
        }

        $rated_vectors = $vectors;

        $index_vectors = 0;
        foreach($vectors as $vector){
            $vector_tmp = $vector;
            $index_vector = -1;
            $mean = end($vector);
            $last_index = array_key_last($vector);

            foreach($vector as $score){
                $index_vector++;
                if($index_vector == 0 or $index_vector == $last_index){
                    continue;
                }
                if(false == is_null($vector_tmp[$index_vector])){
                    $vector_tmp[$index_vector] = $score - $mean;
                }
            }
            $vectors[$index_vectors] = $vector_tmp;
            $index_vectors++;
        }
        $vector_user = array_shift($vectors);

        $similarity = array("id_client" => array(), "score" => array());
        $sum = 0;
        $score_array= array();

        foreach($vectors as $vector){
            $index = -1;
            $numerator = 0;
            $denominator = 0;
            $denominator_user = 0;
            foreach($vector as $score){
                $index++;
                if($index == 0){
                    array_push($similarity['id_client'], $score);
                    continue;
                }
                if($index == $last_index){
                    break;
                }
                if(false == is_null($score) and false == is_null($vector_user[$index])){
                    $numerator+=$score*$vector_user[$index];
                    $denominator += pow($score, 2);
                    $denominator_user += pow($vector_user[$index], 2);
                }
            }
            if($denominator != 0 and $denominator_user != 0){
                $denominator = sqrt($denominator);
                $denominator_user = sqrt($denominator_user);
                $cos = $numerator / ($denominator_user * $denominator);
            }else{
                $cos = null;
            }
            array_push($similarity['score'], $cos);
            $sum += $cos;
        }
        $mean = $sum / count($similarity['score']);
        $index = 0;
        $similar_user_vector = array();
        foreach ($similarity['score'] as $score){
            if($score >= $mean){
                array_push($similar_user_vector, $rated_vectors[$index]);
                array_push($score_array, $score);
            }
            $index++;
        }

        $index_user = -1;
        $final = array('id_recipe' => array(), 'score' => array());
        $index_final = -1;
        $sum = 0;

        foreach($vector_user as $score){
            $index_user++;
            $index_mean = -1;
            $rate_sum = 0;
            $nominator = 0;
            $denominator = 0;
            if($index_user == 0 or $index_user == $last_index){
                continue;
            }
            $index_final++;
            if(false == is_null($score)){
                continue;
            }
            foreach($similar_user_vector as $vector){
                $index_mean++;
                if(false == is_null($vector[$index_user])){
                    $nominator+=$vector[$index_user]*$score_array[$index_mean];
                    $denominator+=$score_array[$index_mean];
                }
            }
            if($denominator != 0){
                $rate_sum = $nominator / $denominator;
            }else{
                $rate_sum = 0;
            }
            $sum+=$rate_sum;
            array_push($final['id_recipe'], $id_recipes[$index_final]);
            array_push($final['score'], $rate_sum);
        }
        $mean = $sum / count($final['score']);

        $index = 0;
        $recipes_to_send = array('id_recipe' => array(), 'score' => array());

        foreach($final['score'] as $score){
            if($score >= $mean){
                array_push($recipes_to_send['id_recipe'], $final['id_recipe'][$index]);
                array_push($recipes_to_send['score'], $final['score'][$index]);
            }
            $index++;
        }
        var_dump($recipes_to_send);
        exit(0);
    }
}