<?php

use classes\AutoLoader;
use classes\business\model\Client;
use classes\business\model\Ingredient;
use classes\business\model\Recipe;
use JetBrains\PhpStorm\ArrayShape;

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
            array_push($preferences_ingredients_user, new Ingredient($row['id_ingredient'], $row['name']));
        }
        return $preferences_ingredients_user;
    }

    #[ArrayShape(['id_client' => "array", 'object_client' => "array"])]
    public static function getClientsWithRatingRecipes(int $id_cluster, array $id_recipes):array
    {
        $clients = array('id_client'=>array(), 'object_client'=>array());

        $query = "SELECT client.id_client, recipe.id_recipe, assess.rating AS rate FROM assess
				INNER JOIN client ON client.id_client = assess.id_client
				INNER JOIN recipe ON recipe.id_recipe = assess.id_recipe
                WHERE recipe.id_cluster = ? and recipe.id_recipe IN (?)
				ORDER BY (client.id_client)";

        $params = [$id_cluster, implode(",", $id_recipes)];

        $result = DatabaseQuery::selectQuery($query, $params);

        while($row = $result->fetch())
        {
            if(!empty($index = array_search($row['id_client'], $clients['id_client'])))
            {
                $client = $clients['object_client'][$index];
                $client->addRatedRecipes(new Recipe(id:$row['id_recipe']), $row['rate']);
            }
            else
            {
                $client = new Client($row['id_client']);
                array_push($clients['id_client'], $row['id_client']);
                array_push($clients['object_client'], $client);
                $client->addRatedRecipes(new Recipe(id:$row['id_recipe']),$row['rate']);
            }
        }
        return $clients;
    }
}