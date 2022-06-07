<?php


class AddDescription
{
    public static function main(){
        $query = "SELECT recipe.id_recipe, recipe.directions FROM recipe";
        $result = self::query($query);
        foreach($result as $row){
            $query = 'UPDATE recipe SET directions = "'.$row['directions'].'"
                      WHERE id_recipe = '.$row['id_recipe'];
            echo $query;
            exit(0);
            DatabaseQuery::updateQuery($query);
        }
    }

    public static function query($query, $params=array())
    {
        $stmt = self::getInstance()->prepare($query);
        try {
            $stmt->execute($params);
        } catch(PDOException $error) {
            echo $error->getMessage();
        }
        return $stmt;
    }

    public static function getInstance()
    {
        $instance = null;
        if(empty(self::$instance) OR is_null(self::$instance)) {
            $db_info = array(
                "db_host" => "localhost",
                "db_port" => "80",
                "db_user" => "root",
                "db_pass" => "A123456*",
                "db_name" => "bigcookingdata",
                "db_charset" => "UTF-8");
            try {
                $instance = new PDO("mysql:host=".$db_info['db_host'].';dbname='.$db_info['db_name'].';charset=utf8', $db_info['db_user'], $db_info['db_pass']);
                $instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                $instance->query('SET NAMES utf8');
                $instance->query('SET CHARACTER SET utf8');

            } catch(PDOException $error) {
                echo $error->getMessage();
            }
        }
        return $instance;
    }
}