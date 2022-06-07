<?php

class ReformatQuantity
{
    public static function reformat(){

        $query = "SELECT * from contain_recipe_ingredient";

        $result = DatabaseQuery::selectQuery($query);

        foreach($result as $row){
            $string = $row['quantity'];
            if(empty($string)){
                continue;
            }

            $quantity = preg_split("/[a-zA-Z]+/",$string)[0];
            var_dump(preg_split("/[0-9]+/",$string)[1]);
            $unity = preg_split("/[0-9]+/",$string)[1];

            $query = 'UPDATE contain_recipe_ingredient SET quantity = '.$quantity.', unity = "'.$unity.'"
             WHERE id_recipe = '.$row['id_recipe'].' and id_ingredient = '.$row['id_ingredient'];
            echo $query;

            DatabaseQuery::updateQuery($query);
        }
    }
}