<?php


namespace classes\business\process;
use classes\business\model\Cluster;

use classes\AutoLoader;
AutoLoader::register();

class DecisionTreeCluster
{
    public static function getCluster(string $ingredients):Cluster
    {
        try{
            /*Connection to the soap service */
            $soap_client = new SoapClient("http://localhost:8080/ClusterDecisionTree/soap/description");
            $query = array('ingredients'=>'ingredients');
            $cluster = $soap_client->add($query);
            echo $cluster->result;
        }
        catch(SoapFault $exception){
            echo $exception->getMessage();
        }

    }
}