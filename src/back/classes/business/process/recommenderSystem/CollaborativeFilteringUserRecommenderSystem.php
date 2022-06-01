<?php
/**
 * Class CollaborativeFilteringUserRecommenderSystem
 * @brief Effectue le processus de création des recommandations de recettes
 * @author arthur mimouni
 */
class CollaborativeFilteringUserRecommenderSystem implements RecommenderSystem
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
     * CollaborativeFilteringUserRecommenderSystem constructor.
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

        if(true === is_null($rated_recipes_client)) {
            $ingredients_preferences = ClientPersistence::getPreferencesIngredientsClient($this->client->getId());

            if (true === is_null($ingredients_preferences)) {
                $this->recipes = $recipes_to_suggest;
                return;
            } else {
                $decision_tree = new DecisionTreeCluster($ingredients_preferences, true);
                $best_cluster_preferences = $decision_tree->getCluster();
                $preferences_recipes_client = RecipePersistence::getRecipesByIngredientsCluster($best_cluster_preferences,
                    $ingredients_preferences, true, $session);

                if (true === is_null($preferences_recipes_client)) {
                    $this->recipes = $recipes_to_suggest;
                    return;
                } else {
                    $recipes_to_suggest['recipe'] = $preferences_recipes_client;
                    $this->recipes = $recipes_to_suggest;
                    return;
                }
            }
        }
        $this->recipes['recipe'] = $this->buildCollaborativeFiltering($rated_recipes_client);
    }


    private function buildCollaborativeFiltering($rated_recipes_client)
    {
        $similar_users = $this->getSimilarUsers($rated_recipes_client);
        $id_recipes = array();

        foreach($this->client->getRatedRecipes() as $rating){
            if (false === in_array($rating->getIdRecipe(), $id_recipes)) {
                array_push($id_recipes, $rating->getIdRecipe());
            }
        }
        foreach($similar_users['id_recipes'] as $id_recipe){
            if (false === in_array($id_recipe, $id_recipes)) {
                array_push($id_recipes, $id_recipe);
            }
        }

        $matrix = array();
        $vector_user = $this->buildVectorClient($id_recipes);
        array_push($matrix, $vector_user);

        $matrix = $this->buildVectorsUsers($matrix, $similar_users, $id_recipes);

        $mean_centered_matrix = $this->createMeanCenteredMatrix($matrix);

        $vector_user = array_shift($mean_centered_matrix);

        $result = $this->getBestSimilarUsers($mean_centered_matrix, $matrix, $vector_user);

        $similar_user_vector = $result['similar_user_vector'];
        $score_similarity_user = $result['score_similarity_user'];

        unset($result);

        $recipes = $this->getRecipesToSend($mean_centered_matrix, $vector_user, $similar_user_vector, $score_similarity_user, $id_recipes);
        return RecipePersistence::getSortRecipesById($recipes['id_recipe']);

    }

    private function getSimilarUsers($rated_recipes_client){
        $recipes = array("id_recipes" => array(), "ratings" => array());

        if (false === is_null($rated_recipes_client)) {
            foreach ($rated_recipes_client as $recipe) {
                if (false === in_array($recipe->getId(), $recipes['id_recipes'])) {
                    array_push($recipes['id_recipes'], $recipe->getId());
                    array_push($recipes['ratings'], new Rating($recipe->getId(), $recipe->getScore()));
                }
            }
        }
        $this->client->setRatedRecipes($recipes['ratings']);
        if(count($rated_recipes_client) > 20){
            $max = NBR_SIMILAR_RECIPES;
        }else{
            $max = NBR_SIMILAR_RECIPES_SMALL;
        }
        foreach($rated_recipes_client as $recipe){
            $cpt = 0;
            foreach(explode(",", $recipe->getCloseTo()) as $id_close_recipe){
                if($cpt == $max){
                    break;
                }
                if (false === in_array($id_close_recipe, $recipes['id_recipes'])) {
                    array_push($recipes['id_recipes'], $id_close_recipe);
                    array_push($recipes['ratings'], new Rating($recipe->getId()));
                }
                $cpt++;
            }
        }
        return RecipePersistence::getClientsOfRatingsSimilarRecipes($this->client->getId(), $recipes['id_recipes']);
    }

    private function buildVectorClient($id_recipes){
        $nbr_rates = 0;
        $sum_score = 0;
        $vector_user = array();
        array_push($vector_user, $this->client->getId());

        foreach($id_recipes as $id_recipe){
            $score_rate = $this->client->hasRatedRecipe($id_recipe);
            array_push($vector_user, $score_rate);
            $nbr_rates++;
            $sum_score+=$score_rate;
        }
        array_push($vector_user, round($sum_score / $nbr_rates, 2));

        return $vector_user;
    }

    private function buildVectorsUsers($matrix, $similar_users, $id_recipes){
        foreach($similar_users['users'] as $similar_users){
            $vector = array();
            $nbr_rates = 0;
            $sum_score = 0;
            array_push($vector, $similar_users->getId());
            foreach($id_recipes as $id_recipe){
                $score = $similar_users->hasRatedRecipe($id_recipe);
                array_push($vector, $score);
                if(false == is_null($score)){
                    $nbr_rates++;
                    $sum_score+=$score;
                }
            }
            array_push($vector, round($sum_score / $nbr_rates, 2));
            array_push($matrix, $vector);
        }

        return $matrix;
    }

    private function createMeanCenteredMatrix($matrix){
        $last_index_vector = array_key_last($matrix[0]);
        $index_matrix = 0;

        foreach($matrix as $vector){
            $vector_tmp = $vector;
            $index_vector = -1;
            $mean_vector = end($vector);

            foreach($vector as $score){
                $index_vector++;
                if($index_vector == 0 or $index_vector == $last_index_vector){
                    continue;
                }
                if(false == is_null($vector_tmp[$index_vector])){
                    $vector_tmp[$index_vector] = $score - $mean_vector;
                }
            }
            $matrix[$index_matrix] = $vector_tmp;
            $index_matrix++;
        }
        return $matrix;
    }

    private function getBestSimilarUsers($mean_centered_matrix, $matrix, $vector_user){
        $cache_users = array("id_client" => array(), "score" => array());

        $score_similarity_user= array();
        $similar_user_vector = array();
        $mean_cos_similarity = 0;
        $last_index_vector = array_key_last($mean_centered_matrix[0]);
        $i = -1;
        foreach($mean_centered_matrix as $vector){
            $i++;
            $index_vector = -1;
            $numerator = 0;
            $denominator = 0;
            $denominator_user = 0;
            foreach($vector as $score){
                $index_vector++;
                if($index_vector == 0){
                    array_push($cache_users['id_client'], $score);
                    continue;
                }
                if($index_vector == $last_index_vector){
                    break;
                }
                if(false === is_null($score) and false === is_null($vector_user[$index_vector])){
                    $numerator += $score * $vector_user[$index_vector];
                    $denominator += pow($score, 2);
                    $denominator_user += pow($vector_user[$index_vector], 2);
                }
            }
            if($denominator != 0 and $denominator_user != 0){
                $denominator = sqrt($denominator);
                $denominator_user = sqrt($denominator_user);
                $cos_similarity = $numerator / ($denominator_user * $denominator);
            }else{
                $cos_similarity = null;
            }
            array_push($cache_users['score'], $cos_similarity);
            $mean_cos_similarity += $cos_similarity;
        }
        $mean_cos_similarity = $mean_cos_similarity / count($cache_users['score']);
        $index = 0;
        foreach ($cache_users['score'] as $score){
            if($score >= $mean_cos_similarity){
                $index==
                array_push($similar_user_vector, $matrix[$index]);
                array_push($score_similarity_user, $score);
            }
            $index++;
        }
        return array('similar_user_vector' => $similar_user_vector, 'score_similarity_user' => $score_similarity_user);
    }

    private function getRecipesToSend($matrix, $vector_user, $similar_user_vector, $score_similarity_user, $id_recipes){
        $recipes_to_send = array('id_recipe' => array(), 'score' => array());
        $last_index_vector = array_key_last($matrix[0]);
        $index_recipes_to_send = -1;
        $index_user = -1;
        $mean_predictions_score = 0;

        foreach($vector_user as $score){
            $index_user++;
            $index_score_similarity_user = -1;
            $nominator = 0;
            $denominator = 0;
            if($index_user == 0 or $index_user == $last_index_vector){
                continue;
            }
            $index_recipes_to_send++;
            if(false == is_null($score)){
                continue;
            }
            foreach($similar_user_vector as $vector){
                $index_score_similarity_user++;
                if(false == is_null($vector[$index_user])){
                    $nominator+=$vector[$index_user] * $score_similarity_user[$index_score_similarity_user];
                    $denominator+=$score_similarity_user[$index_score_similarity_user];
                }
            }
            if($denominator != 0){
                $prediction_score = $nominator / $denominator;
            }else{
                $prediction_score = 0;
            }
           // $mean_predictions_score+=$prediction_score;
            array_push($recipes_to_send['id_recipe'], $id_recipes[$index_recipes_to_send]);
            array_push($recipes_to_send['score'], $prediction_score);
        }
        //$mean_predictions_score = $mean_predictions_score / count($recipes_to_send['score']);

        $index = 0;
        $recipes_to_send_tmp = array('id_recipe' => array(), 'score' => array());

        foreach($recipes_to_send['score'] as $score){
            if($score >= MIN_SCORE){
                array_push($recipes_to_send_tmp['id_recipe'], $recipes_to_send['id_recipe'][$index]);
                array_push($recipes_to_send_tmp['score'], $recipes_to_send['score'][$index]);
            }
            $index++;
        }

        array_multisort($recipes_to_send_tmp['score'], SORT_DESC, $recipes_to_send_tmp['id_recipe']);
        return $recipes_to_send_tmp;
    }

    /**
     * @return array
     */
    public function getRecipes()
    {
        return $this->recipes;
    }
}