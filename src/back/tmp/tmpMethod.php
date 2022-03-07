
<?php
/*CLientPersistence

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

    foreach($result as $row)
    {
        if (!empty($index = array_search($row['id_client'], $clients['id_client']))) {
            $client = $clients['object_client'][$index];
            $client->addRatedRecipes(new Recipe(id: $row['id_recipe']), $row['rate']);
        } else {
            $client = new Client($row['id_client']);
            array_push($clients['id_client'], $row['id_client']);
            array_push($clients['object_client'], $client);
            $client->addRatedRecipes(new Recipe(id: $row['id_recipe']), $row['rate']);
        }
    }
    return $clients;
}
/*
?>

