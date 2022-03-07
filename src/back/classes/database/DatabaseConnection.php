<?php

class DatabaseConnection
{
    /**
     * @var PDO
     */
    private static $instance;
    /**
     * @var string
     */
    private static $db_host = "localhost";
    /**
     * @var string
     */
    private static $db_port = "80";
    /**
     * @var string
     */
    private static $db_user = "root";
    /**
     * @var string
     */
    private static $dp_pass = "A123456*";
    /**
     * @var string
     */
    private static $db_name = "big_cooking_data";
    /**
     * @var string
     */
    private static $db_charset = "UTF-8";

    /**
     * DatabaseConnection constructor.
     */
    protected function __construct() {}

    /**
     * @return PDO
     */
    public static function getInstance()
    {
        if(empty(self::$instance) OR is_null(self::$instance)) {
            $db_info = array(
                "db_host" => self::$db_host,
                "db_port" => self::$db_port,
                "db_user" => self::$db_user,
                "db_pass" => self::$dp_pass,
                "db_name" => self::$db_name,
                "db_charset" => self::$db_charset);
            try {
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