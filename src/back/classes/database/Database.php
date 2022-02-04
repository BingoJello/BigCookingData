<?php

use classes\AutoLoader;
AutoLoader::register();

class Database
{
    /**
     * @var PDO
     */
    private $instance;

    /**
     * Database constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return PDO
     */
    public function getInstance()
    {
        try {
            $this->instance = DatabaseConnection::getInstance();
            DatabaseConnection::setCharsetEncoding();
            /*
            $sqlExample = 'SELECT * FROM users WHERE _id = 1';
            $stm = $db->prepare($sqlExample);

            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_ASSOC);
            */

        } catch (Exception $e) {
            print $e->getMessage();

        }

        return $this->instance;
    }
}