<?php

use classes\AutoLoader;
AutoLoader::register();

class DatabaseQuery
{
    /**
     * @var PDO
     */
    private $instance;

    /**
     * DatabaseQuery constructor.
     */
    public function __construct()
    {
        $this->instance = $this->getInstance();
    }

    /**
     * Select query in database
     * @return array
     */
    public function selectQuery($query){
        $stm = $this->instance->prepare($query);

        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertQuery($query){
        //TODO
    }

    public function deleteQuery($query){
        //TODO
    }

    /**
     * Design pattern singleton
     * @return PDO
     */
    private function getInstance()
    {
        try {
            $this->instance = DatabaseConnection::getInstance();
            DatabaseConnection::setCharsetEncoding();
        } catch (Exception $e) {
            print $e->getMessage();

        }

        return $this->instance;
    }
}