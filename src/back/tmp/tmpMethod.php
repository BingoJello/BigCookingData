
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

 public static function getNbrVisualizedRecipes(int $id_client, int $id_cluster, array $id_recipes):int
    {
        $nbr_visualized_recipes = 0;

        $query="SELECT COUNT(recipe.id_recipe) as nbr_recipes FROM recipe
				WHERE recipe.id_cluster = ? AND recipe.id_recipe IN (?)";
        $params = [$id_cluster, implode(",", $id_recipes)];

        $result = DatabaseQuery::selectQuery($query, $params);

        while($row = $result->fetch())
            $nbr_visualized_recipes = $row['nbr_recipes'];

        return $nbr_visualized_recipes;
    }

public static function getRatedRecipes($id_client, $id_cluster):array
    {
        $rated_recipes = array();

        $query="SELECT assess.rating FROM assess
				INNER JOIN recipe ON recipe.id_recipe = assess.id_recipe
				WHERE assess.id_client = ? AND recipe.id_cluster = ?";
        $params = [$id_client, $id_cluster];

        $result = DatabaseQuery::selectQuery($query, $params);

        while($row = $result->fetch())
        {
            array_push($rated_recipes, $row['rating']);
        }
        return $rated_recipes;
    }

 public static function getNbrRecordedRecipes(int $id_client, int $id_cluster):int
    {
        $nbr_recorded_recipes = 0;

        $query="SELECT COUNT(recipe.id_recipe) as nbr_recipes FROM recipe
				INNER JOIN record ON record.id_recipe = recipe.id_recipe
				WHERE record.id_client = ? AND recipe.id_cluster = ?";
        $params = [$id_client, $id_cluster];

        $result = DatabaseQuery::selectQuery($query, $params);

        while($row = $result->fetch())
        {
            $nbr_recorded_recipes = $row['nbr_recipes'];
        }
        return $nbr_recorded_recipes;
    }

/*
?>

