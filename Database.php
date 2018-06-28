<?php
require 'config.php';

class Database
{
    private static $_pdo;

    /**
     * Set and get PDO connection
     * @return PDO
     */
    private static function _getPdo(){
        if (!is_null(self::$_pdo)) return self::$_pdo;
        try
        {
            $pdo = new PDO('mysql:dbname='.db.';host='.host, user, pw);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(\Exception $e)
        {
            die('Error : '.$e->getMessage());
        }
        self::$_pdo = $pdo;

        self::$_pdo->exec('SET NAMES \'utf8\'');
        self::$_pdo->query('SET NAMES \'utf8\'');
        self::$_pdo->prepare('SET NAMES \'utf8\'');

        return self::$_pdo;
    }

    /** 
     * Get the id of the last insert
     * @return int
     */
    public static function getLastId()
    {
        return self::_getPdo()->lastInsertId();
    }

    /**
     * Create a query to fetch (retrieve) data from the DB
     * @param $statement string
     * @param array $params
     * @return array
     */
    public static function query($statement, $params = [])
    {
        $q = self::_getPdo()->prepare($statement);
        $q->execute($params);
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Create a query to fetch (retrieve) the first data from the DB
     * @param $statement string
     * @return array
     */
    public static function queryFirst($statement, $params = [])
    {
        $res = self::query($statement, $params);
        if (count($res) > 0) {
            return $res[0];
        } else {
            return null;
        }
    }


    /**
     * Insert, update, delete a data from the DB
     * @param $statement string
     * @param $params array
     * @return int
     */
    public static function exec($statement, $params = []){
        $q = self::_getPdo()->prepare($statement);
        return $q->execute($params);
    }
}
