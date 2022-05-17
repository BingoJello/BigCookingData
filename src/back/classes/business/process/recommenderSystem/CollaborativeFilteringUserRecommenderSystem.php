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

        $rated_recipes_user = RecipePersistence::getRatedRecipesUser($this->client->getId(), 30);

        if(true === is_null($rated_recipes_user)){
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

        $builded_recipes = $this->build($rated_recipes_user, $preferences_recipes_user,
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
        if (false === is_null($preferences_recipes_user)) {
            foreach ($preferences_recipes_user as $recipe) {
                if (false === in_array($recipe->getId(), $ratings_recipes_user['id_recipes'])) {
                    array_push($ratings_recipes_user['id_recipes'], $recipe->getId());
                    array_push($ratings_recipes_user['ratings'], new Rating($recipe->getId(), $recipe->getScore()));
                }
            }
        }
        if (false === is_null($visualized_recipes_user)) {
            foreach ($visualized_recipes_user as $recipe) {
                if (false === in_array($recipe->getId(), $ratings_recipes_user['id_recipes'])) {
                    array_push($ratings_recipes_user['id_recipes'], $recipe->getId());
                    array_push($ratings_recipes_user['ratings'], new Rating($recipe->getId(), $recipe->getScore()));
                }
            }
        }

        $this->client->setRatedRecipes($ratings_recipes_user['ratings']);




        $similar_clients = RecipePersistence::getSimilarClientsOfRatingsRecipesClient($this->client->getId());
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
        var_dump($vectors);
        $similarity = array("id_client" => array(), "score" => array());

        foreach($vectors as $vector){
            $index = 0;
            $numerator = 0;
            $denominator = 0;
            foreach($vector as $score){
                if($index == 0){
                    array_push($similarity['id_client'], $score);
                }
                if($index = $last_index){
                    break;
                }
                if(false == is_null($vector[$index])){

                }
            }
        }
    }
}