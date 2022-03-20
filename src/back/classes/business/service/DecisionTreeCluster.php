<?php

/**
 * Class DecisionTreeCluster
 * @author arthur mimouni
 */
class DecisionTreeCluster
{
    public static function getCluster($ingredients, $is_array = false)
    {
        if(true === $is_array){
            $ingredients_string = "";
            $count = count($ingredients);
            $i = 0;
            foreach ($ingredients as $ingredient){
                if($i == $count - 1){
                    $ingredients_string.=$ingredient->getName();
                }else{
                    $ingredients_string.=$ingredient->getName().";";
                }
            }
            $ingredients = $ingredients_string;
        }
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