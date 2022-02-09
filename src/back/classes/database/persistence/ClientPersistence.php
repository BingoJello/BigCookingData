<?php

use classes\AutoLoader;
use classes\business\model\Client;
use classes\business\model\Ingredient;

AutoLoader::register();

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
        {
            throw new Exception("Aucun client n'existe pour ce mail et ce mot de passe");
        }

        while($row = $result->fetch())
        {
            return new Client($row['id'], $row['lastName'], $row['civility'], $row['pseudo'], $row['mail'], $row['password']);
        }
    }

    /**
     * @throws Exception
     */
    public static function getPreferencesIngredients(int $id_client): array
    {
        $preferences_ingredients_user = array();

        $query = "SELECT ingredient.id_ingredient, ingredient.name FROM ingredient 
                  INNER JOIN preferences_ingredient_client as pic ON pic.id_ingredient = ingredient.id
                  INNER JOIN client ON client.id = pic.id_client
                  WHERE client.id = ?";
        $params = [$id_client];

        $result = DatabaseQuery::selectQuery($query, $params);

        while($row = $result->fetch())
        {
            $ingredient = new Ingredient($row['id_ingredient'], $row['name']);
            array_push($preferences_ingredients_user, $ingredient);
        }
        return $preferences_ingredients_user;
    }
}