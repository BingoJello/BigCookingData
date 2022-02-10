<?php


namespace classes\business\process;

use classes\business\model\Client;
use ClientPersistence;
use PairsItem;

class CollaborativeFiltering
{
    private Client $client;
    private array $recipes;

    public function __construct(Client $client, array $recipes)
    {
        $this->client = $client;
        $this->recipes = $recipes;
    }

    public function buildFiltering():array
    {
        $clients = ClientPersistence::getClientsWithRatingRecipes($this->recipes);

        if(!empty($index = array_search($this->client->getId(), $clients['id_client'])))
        {
            array_splice($clients['id_client'], $index,1);
            array_splice($clients['object_client'], $index,1);
        }

        //$itemPairs = $this->formItemPairs($itemPairs, 0, count($))
    }

    private function findAllUniqueRatingsRecipes($clients):array
    {
        $recipes = array();
    }


    private function formItemPairs(array $pairs, int $begin, int $end):array
    {
        if($begin >= $end)
            return $pairs;

        while($begin + 1 <= $end)
            array_push($pairs, new PairsItem($begin, $begin+1));

        return $this->formItemPairs($pairs, $begin + 1, $end);
    }
}