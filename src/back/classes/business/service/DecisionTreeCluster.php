<?php

/**
 * Class DecisionTreeCluster
 * @author arthur mimouni
 */
class DecisionTreeCluster
{
    public static function getCluster($ingredients)
    {
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