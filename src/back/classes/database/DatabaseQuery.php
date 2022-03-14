<?php

/**
 * Class DatabaseQuery
 * @author arthur mimouni
 */
class DatabaseQuery
{
    /**
     * @brief Generic select query in database
     * @param string $query
     * @param array $params
     * @return array
     */
    public static function selectQuery($query, $params=array())
    {
        $stmt = DatabaseConnection::getInstance()->prepare($query);
        try {
            $stmt->execute($params);
        } catch(PDOException $error) {
            echo $error->getMessage();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @brief Generic insert query in database
     * @param string $query
     * @param array $params
     * @return false|PDOStatement
     */
    public static function insertQuery($query, $params=array())
    {
        $stmt = DatabaseConnection::getInstance()->prepare($query);
        try {
            $stmt->execute($params);
        } catch(PDOException $error) {
            echo $error->getMessage();
        }
        return $stmt;
    }

    /**
     * @brief Generic insert query in database
     * @param string $query
     * @param array $params
     * @return false|PDOStatement
     */
    public static function updateQuery($query, $params=array())
    {
        $stmt = DatabaseConnection::getInstance()->prepare($query);
        try {
            $stmt->execute($params);
        } catch(PDOException $error) {
            echo $error->getMessage();
        }
        return $stmt;
    }
}