<?php

/**
 * Class DecisionTreeCluster
 * @brief Récupère le meilleur cluster comportant les ingrédients demandés (Appelle un web service python à l'aide de SOAP)
 * @author arthur mimouni
 */
class DecisionTreeCluster
{
    /**
     * @var string
     */
    private $ingredients;

    /**
     * DecisionTreeCluster constructor.
     * @param $ingredients
     * @param false $is_object
     */
    public function __construct($ingredients, $is_object = false){
        $this->ingredients = $this->formatIngredient($ingredients, $is_object);
    }

    /**
     * @return mixed
     */
    public function getCluster()
    {
        try{
            /*Connection to the soap service */
            $soap_client = new SoapClient("http://localhost:8080/DecisionTreeService/soap/description");
            $query = array('ingredients-user' => $this->ingredients);
            $cluster = $soap_client->add($query);

            return $cluster->result;
        } catch(SoapFault $exception){
            echo $exception->getMessage();
        }
    }

    /**
     * @param $ingredients
     * @param bool $is_object
     * @return string
     */
    private function formatIngredient($ingredients, $is_object)
    {
        $ingredient_string = "";
        $index = 0;
        foreach($ingredients as $ingredient){
            if($index == count($ingredients) - 1){
                if(true === $is_object){
                    $ingredient_string.=$ingredient->getName();
                }else{
                    $ingredient_string.=$ingredient;
                }

            }else{
                if(true === $is_object){
                    $ingredient_string.=$ingredient->getName().";";
                }else{
                    $ingredient_string.=$ingredient.";";
                }
            }
            $index++;
        }
        return $ingredient_string;
    }

    /**
     * @return string
     */
    public function getIngredients(): string
    {
        return $this->ingredients;
    }

    /**
     * @param string $ingredients
     */
    public function setIngredients(string $ingredients): void
    {
        $this->ingredients = $ingredients;
    }

}