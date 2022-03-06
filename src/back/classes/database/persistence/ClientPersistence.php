<?php

class ClientPersistence
{
    //Select method

    /**
     * @throws Exception
     */
    public static function getClient(string $mail, string $password)
    {
        $query = "SELECT * FROM client WHERE client.mail = ? AND client.password = ?";
        $params = [$mail, $password];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row) {
            $client = new Client($row['id_client'], $row['firstname'], $row['lastname'], $row['civility'], $row['pseudo'], $row['mail'], $row['password']);
            $client->setPreferencesIngredients(ClientPersistence::getPreferencesIngredientsClient($row['id_client']));
            return $client;
        }
        return null;
    }

    /**
     * @throws Exception
     */
    public static function getPreferencesIngredientsClient(int $id_client): array
    {
        $preferences_ingredients_user = array();

        $query = "SELECT ingredient.* FROM ingredient 
                  INNER JOIN have_preferences_ingredient as hpi ON hpi.id_ingredient = ingredient.id_ingredient
                  INNER JOIN client ON client.id_client = hpi.id_client
                  WHERE client.id_client = ?";
        $params = [$id_client];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row)
            array_push($preferences_ingredients_user, new Ingredient($row['id_ingredient'], $row['name'], $row['url_pic']));
        return $preferences_ingredients_user;
    }

    public static function getLastIdClient():int
    {
        $query="SELECT id_client FROM client ORDER BY id_client DESC LIMIT 1";
        $result = DatabaseQuery::selectQuery($query, []);

        foreach($result as $row)
            return $row['id_client'];

        return 0;
    }

    public static function findClientExist($email = false, $password = false, $pseudo = false):bool
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
            if (0 < $row['client_exist'])
                return true;
            return false;
        }
    }

    //insert methods

    public static function insertClient($id_client, $firstname, $lastname, $civility, $pseudo, $mail, $password)
    {
        $query = "INSERT INTO client(id_client,firstname,lastname,civility,pseudo,mail,password) VALUES (?,?,?,?,?,?,?)";
        $params=[$id_client, $firstname, $lastname, $civility, $pseudo, $mail, $password];

        return DatabaseQuery::insertQuery($query, $params);
    }

    public static function insertIngredientsPreferences($id_client, $ingredients)
    {
        foreach($ingredients as $ingredient) {
            $query = "INSERT INTO have_preferences_ingredient(id_client,$ingredient) VALUES (?,?)";
            $params=[$id_client, $ingredient];
            DatabaseQuery::insertQuery($query, $params);
        }
    }

    //delete methods
    public static function deleteIngredientPreferencesClient(int $id_client, array $ingredients)
    {
        $ingredients = join(",", $ingredients);
        $query = "DELETE FROM have_preferences_ingredient 
                  WHERE have_preferences_ingredient.id_client=? AND have_preferences_ingredient.id_ingredient IN(".$ingredients.")";
        $params = [$id_client];

        DatabaseQuery::insertQuery($query, $params);
    }

    //update methods
    public static function updateIngredientsPreferencesClient(int $id_client, array $ingredients)
    {
        $old_ingredients_client = ClientPersistence::getPreferencesIngredientsClient($id_client);
        $old_ingredients_name_client = array();
        $new_ingredients = array();
        $delete_ingredients = array();

        foreach ($old_ingredients_client as $ingredient)
            array_push($old_ingredients_name_client, $ingredient->getName());

        foreach($ingredients as $ingredient) {
            if (!in_array($ingredient, $old_ingredients_name_client))
                array_push($new_ingredients, $ingredient);
        }

        foreach($old_ingredients_name_client as $old_ingredient) {
            if (!in_array($old_ingredient, $ingredients))
                array_push($delete_ingredients, $old_ingredient);
        }

        if(!empty($delete_ingredients)){
            $delete_ingredients = RecipePersistence::getIdIngredientByName($delete_ingredients);
            ClientPersistence::deleteIngredientPreferencesClient($id_client, $delete_ingredients);
        }

        if(!empty($new_ingredients)) {
            $new_ingredients = RecipePersistence::getIdIngredientByName($new_ingredients);

            foreach($new_ingredients as $id_ingredient){
                $query = "INSERT INTO have_preferences_ingredient(id_client,id_ingredient) VALUES (?,?)";
                $params = [$id_client, $id_ingredient];
                DatabaseQuery::insertQuery($query, $params);
            }
        }
    }

    public static function updatePasswordClient(int $id_client, string $password):void{
        $query ="UPDATE client SET password = ? WHERE id_client = ?";
        $params=[$password, $id_client];

        DatabaseQuery::updateQuery($query, $params);
    }
}