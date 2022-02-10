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

    private function formItemPairs(array $pairs, array $recipes, int $begin, int $end):array
    {
        if($begin >= $end)
            return $pairs;

        while($begin + 1 <= $end)
            array_push($pairs, new PairsItem($recipes[$begin], $recipes[$begin+1]));

        return $this->formItemPairs($pairs, $begin + 1, $end);
    }

    private function calculateSimilarity(PairsItem $pairs, array $clients):float
    {
        $score_item_numerator= 0;
        $score_item_denominator1 = 0;
        $score_item_denominator2 = 0;

        foreach($clients as $client)
        {
            $score_item_numerator += $client->getRatingRecipe($pairs->getItem1()) * $client->getRatingRecipe($pairs->getItem2());
        }

        foreach($clients as $client)
        {
            $score_item_denominator1 += pow($client->getRatingRecipe($pairs->getItem1()), 2);
            $score_item_denominator2 += pow($client->getRatingRecipe($pairs->getItem2()), 2);
        }

        return sqrt($score_item_denominator1) * sqrt($score_item_denominator2);
    }

    private function generateMissingRatings(array $missing_items, array $pairsItems):array
    {
        $ratings = array();
        foreach($missing_items as $item)
        {
            
        }
    }
}