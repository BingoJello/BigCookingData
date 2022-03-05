<?php

class ClientPersistence
{
    /**
     * @throws Exception
     */
    public static function getClient(string $mail, string $password): Client
    {
        $query = "SELECT id_client FROM client WHERE client.mail = ? AND client.password = ?";
        $params = [$mail, $password];

        $result = DatabaseQuery::selectQuery($query, $params);

        if (empty($result))
            throw new Exception("Aucun client n'existe pour ce mail et ce mot de passe");

        foreach($result as $row)
            return new Client($row['id'], $row['lastName'], $row['civility'], $row['pseudo'], $row['mail'], $row['password']);
    }

    /**
     * @throws Exception
     */
    public static function getPreferencesIngredients(int $id_client, string $select="*"): array
    {
        $preferences_ingredients_user = array();

        $query = "SELECT ingredient.$select FROM ingredient 
                  INNER JOIN have_preferences_ingredient as hpi ON hpi.id_ingredient = ingredient.id
                  INNER JOIN client ON client.id_client = hpi.id_client
                  WHERE client.id_client = ?";
        $params = [$id_client];

        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row)
            array_push($preferences_ingredients_user, $row['name']);

        return $preferences_ingredients_user;
    }

    public static function findClientExist($email = false, $password = false, $pseudo = false)
    {
        if(false == $password)
        {
            $query = "SELECT COUNT(id_client) AS client_exist FROM client WHERE mail=?";
            $params = [$email];
        }elseif (false !== $pseudo)
        {
            $query = "SELECT COUNT(id_client) AS client_exist FROM client WHERE pseudo=?";
            $params = [$pseudo];
        }else{
            $query = "SELECT COUNT(id_client) AS client_exist FROM client WHERE mail=? AND password=?";
            $params = [$email, $password];
        }
        $result = DatabaseQuery::selectQuery($query, $params);

        foreach($result as $row)
            if(0 < $row['client_exist'])
                return true;

            return false;
    }

    public static function getLastIdClient()
    {
        $query="SELECT id_client FROM client ORDER BY id_client DESC LIMIT 1";
        $result = DatabaseQuery::selectQuery($query, []);
        foreach($result as $row)
            return $row['id_client'];

        return 0;
    }

    public static function insertClient($id_client, $firstname, $lastname, $civility, $pseudo, $mail, $password)
    {
        $query = "INSERT INTO client(id_client,firstname,lastname,civility,pseudo,mail,password) VALUES (?,?,?,?,?,?,?)";
        $params=[$id_client, $firstname, $lastname, $civility, $pseudo, $mail, $password];
        return DatabaseQuery::insertQuery($query, $params);
    }

    public static function insertIngredientsPreferences($id_client, $ingredients)
    {
        $ingredients = explode(';', $ingredients);
        foreach($ingredients as $ingredient)
        {
            $query = "INSERT INTO have_preferences_ingredient(id_client,$ingredient) VALUES (?,?)";
            $params=[$id_client, $ingredient];
            DatabaseQuery::insertQuery($query, $params);
        }
    }
}