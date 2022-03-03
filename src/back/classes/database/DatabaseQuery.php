<?php

class DatabaseQuery
{
    /**
     * @brief Generic select query in database
     */
    public static function selectQuery($query, $params=array())
    {
        $stmt = DatabaseConnection::getInstance()->prepare($query);
        try
        {
            $stmt->execute($params);
        } catch(PDOException $error)
        {
            echo $error->getMessage();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}