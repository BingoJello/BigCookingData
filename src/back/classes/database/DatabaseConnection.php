<?php

class DatabaseConnection
{
    private static PDO $instance;
    private static string $db_host = "localhost";
    private static string $db_port = "80";
    private static string $db_user = "root";
    private static string $dp_pass = "A123456*";
    private static string $db_name = "big_cooking_data";
    private static string $db_charset = "UTF-8";

    protected function __construct() {}

    public static function getInstance():PDO
    {
        if(empty(self::$instance) OR is_null(self::$instance))
        {
            $db_info = array(
                "db_host" => self::$db_host,
                "db_port" => self::$db_port,
                "db_user" => self::$db_user,
                "db_pass" => self::$dp_pass,
                "db_name" => self::$db_name,
                "db_charset" => self::$db_charset);
            try
            {
                self::$instance = new PDO("mysql:host=".$db_info['db_host'].';dbname='.$db_info['db_name'].';charset=utf8', $db_info['db_user'], $db_info['db_pass']);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                self::$instance->query('SET NAMES utf8');
                self::$instance->query('SET CHARACTER SET utf8');

            } catch(PDOException $error) {
                echo $error->getMessage();
            }
        }
        return self::$instance;
    }
}