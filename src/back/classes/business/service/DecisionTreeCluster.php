<?php

/**
 * Class DecisionTreeCluster
 * @brief Récupère le meilleur cluster comportant les ingrédients demandés (Appelle un web service python à l'aide de SOAP)
 * @author arthur mimouni
 */
class DecisionTreeCluster
{
    public static function getCluster($ingredients)
    {
        $ingredient_string = "";
        $index = 0;
        foreach($ingredients as $ingredient){
            if($index == count($ingredients) - 1){
                $ingredient_string.=$ingredient;
            }else{
                $ingredient_string.=$ingredient.";";
            }
            $index++;
        }
        $ingredients = $ingredient_string;

        try{
            /*Connection to the soap service */
            $soap_client = new SoapClient("http://localhost:8080/DecisionTreeService/soap/description");
            $query = array('ingredients-user' => $ingredients);
            $cluster = $soap_client->add($query);

            return $cluster->result;
        } catch(SoapFault $exception){
            echo $exception->getMessage();
        }
    }
}