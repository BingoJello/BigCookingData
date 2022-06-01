<?php

/**
 * Class ClientPersistence
 * @brief Contient l'ensemble des requêtes SQL en rapport avec un client
 * @author arthur mimouni
 */
class ClientPersistence
{
    /*******************
     * SELECT Methods
     ******************/

    /**
     * @brief Récupère un client
     * @param string $mail
     * @param string $password
     * @return Client|null
     * @throws Exception
     */
    public static function getClient($mail, $password)
    {
        $query = "SELECT * FROM client WHERE client.mail = ? AND client.password = ?";
        $params = [$mail, $password];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row) {
            $client = new Client($row['id_client'], $row['firstname'], $row['lastname'], $row['civility'], $row['pseudo'], $row['mail'], $row['password']);
            $client->setPreferencesIngredients(ClientPersistence::getPreferencesIngredientsClient($row['id_client']));
            $client->setPreferencesIngredientsLabel($row['preferences_label']);
            return $client;
        }
        return null;
    }

    /**
     * @brief Récupère les ingrédients de préférences du client
     * @param int $id_client
     * @return array
     */
    public static function getPreferencesIngredientsClient($id_client)
    {
        $preferences_ingredients_user = array();

        $query = "SELECT ingredient.* FROM ingredient 
                  INNER JOIN have_preferences_ingredient as hpi ON hpi.id_ingredient = ingredient.id_ingredient
                  INNER JOIN client ON client.id_client = hpi.id_client
                  WHERE client.id_client = ?";
        $params = [$id_client];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row) {
            array_push($preferences_ingredients_user, new Ingredient($row['id_ingredient'], $row['name'], $row['url_pic']));
        }

        if(true === empty($preferences_ingredients_user)){
            return null;
        }
        return $preferences_ingredients_user;
    }

    /**
     * @brief Récupère le dernier ID de la table client
     * @return int
     */
    public static function getLastIdClient()
    {
        $query="SELECT id_client FROM client ORDER BY id_client DESC LIMIT 1";
        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row) {
            return $row['id_client'];
        }
        return 0;
    }

    /**
     * @brief Vérifie si un client existe
     * @param string $email
     * @param string $password
     * @param string $pseudo
     * @return bool
     */
    public static function findClientExist($email = false, $password = false, $pseudo = false)
    {
        if(false == $password) {
            $query = "SELECT COUNT(id_client) AS client_exist FROM client WHERE mail=?";
            $params = [$email];
        }elseif (false !== $pseudo) {
            $query = "SELECT COUNT(id_client) AS client_exist FROM client WHERE pseudo=?";
            $params = [$pseudo];
        }else{
            $query = "SELECT COUNT(id_client) AS client_exist FROM client WHERE mail=? AND password=?";
            $params = [$email, $password];
        }

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row) {
            if (0 < $row['client_exist']) {
                return true;
            }
            return false;
        }
    }

    /**
     * @brief Vérifie si un client à déjà noté la recette demandée
     * @param int $id_client
     * @param int $id_recipe
     * @return bool
     */
    public static function hasAlreadyRatingRecipe($id_client, $id_recipe){
        $query = "SELECT id_client FROM assess WHERE id_client = ? AND id_recipe = ?";
        $params = [$id_client, $id_recipe];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row) {
            return true;
        }
        return false;
    }

    /**
     * @param int $id_client
     * @return mixed|null
     */
    public static function getBestSimilarClient($id_client){
        $best_similar_client = null;
        $query = "SELECT DISTINCT assess.id_client, COUNT(assess.id_client) as nbr FROM assess 
                  WHERE assess.id_recipe IN (
                      SELECT id_recipe FROM assess WHERE assess.id_client = ?
                  ) AND assess.id_client != ?  
                  GROUP BY(assess.id_client) 
                  ORDER BY(nbr) DESC
                  LIMIT 1";
        $params = [$id_client, $id_client];
        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row) {
            $best_similar_client = $row['id_client'];
        }
        return $best_similar_client;
    }


    /*******************
     * INSERT Methods
     ******************/

    /**
     * @brief Insére un client
     * @param int $id_client
     * @param string $firstname
     * @param string $lastname
     * @param string $civility
     * @param string $pseudo
     * @param string $mail
     * @param string $password
     * @return false|PDOStatement
     */
    public static function insertClient($id_client, $firstname, $lastname, $civility, $pseudo, $mail, $password)
    {
        $query = "INSERT INTO client(id_client,firstname,lastname,civility,pseudo,mail,password) VALUES (?,?,?,?,?,?,?)";
        $params=[$id_client, $firstname, $lastname, $civility, $pseudo, $mail, $password];

        return DatabaseQuery::insertQuery($query, $params);
    }

    /**
     * @brief Insert les ingrédients de préférences d'un client
     * @param int $id_client
     * @param array $ingredients
     */
    public static function insertIngredientsPreferences($id_client, $ingredients)
    {
        foreach($ingredients as $ingredient) {
            $query = "INSERT INTO have_preferences_ingredient(id_client,id_ingredient) VALUES (?,?)";
            $params=[$id_client, $ingredient];

            DatabaseQuery::insertQuery($query, $params);
        }
    }

    /**
     * @brief Insert la note et le commentaire d'une recette
     * @param int $id_recipe
     * @param int $id_client
     * @param float $rating
     * @param string $commentary
     */
    public static function insertCommentaryAndRating($id_recipe, $id_client, $rating, $date, $commentary)
    {
        if('' === $commentary){
            $commentary = null;
        }
        $query = "INSERT INTO assess(id_recipe, id_client, rating, commentary, date_assess) VALUES (?,?,?,?,?)";
        $params=[$id_recipe, $id_client, $rating, $commentary, $date];

        DatabaseQuery::insertQuery($query, $params);
    }

    /*******************
     * DELETE Methods
     ******************/

    /**
     * @brief Supprime des ingrédients de préférences d'un client
     * @param int $id_client
     * @param array $ingredients
     */
    public static function deleteIngredientPreferencesClient($id_client)
    {
        $query = "DELETE FROM have_preferences_ingredient 
                  WHERE have_preferences_ingredient.id_client=?";
        $params = [$id_client];

        DatabaseQuery::updateQuery($query, $params);
    }

    /*******************
     * UPDATE Methods
     ******************/

    /**
     * @brief Mets à jour le label des préférences du client
     * @param int $id_client
     * @param string $preferences_label
     */
    public static function updatePreferencesIngredientsLabelClient($id_client, $preferences_label)
    {
        $query = "UPDATE client 
                  SET preferences_label = ?
                  WHERE id_client = ?";
        $params = [$preferences_label, $id_client];

        DatabaseQuery::updateQuery($query, $params);
    }

    /**
     * @brief Met à jour le mot de passe d'un client
     * @param int $id_client
     * @param string $password
     */
    public static function updatePasswordClient($id_client, $password)
    {
        $query = "UPDATE client SET password = ? WHERE id_client = ?";
        $params = [$password, $id_client];

        DatabaseQuery::updateQuery($query, $params);
    }
}