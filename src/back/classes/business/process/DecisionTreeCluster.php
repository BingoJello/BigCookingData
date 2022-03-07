<?php

class DecisionTreeCluster
{
    /**
     * @param array $ingredients
     * @return int
     */
    public static function getCluster($ingredients)
    {
        try{
            /*Connection to the soap service */
            $soap_client = new SoapClient("http://localhost:8080/ClusterDecisionTree/soap/description");
            $query = array('ingredients'=>'ingredients');
            $cluster = $soap_client->add($query);
            return $cluster->result;
        } catch(SoapFault $exception){
            echo $exception->getMessage();
        }

    }
}