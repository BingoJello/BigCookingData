<?php

class DecisionTreeCluster
{
    public static function getCluster(string $ingredients):int
    {
        try{
            /*Connection to the soap service */
            $soap_client = new SoapClient("http://localhost:8080/ClusterDecisionTree/soap/description");
            $query = array('ingredients'=>'ingredients');
            $cluster = $soap_client->add($query);
            return $cluster->result;
        }
        catch(SoapFault $exception){
            echo $exception->getMessage();
        }

    }
}