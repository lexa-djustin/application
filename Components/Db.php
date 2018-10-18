<?php

namespace Components;

class Db
{
    /**
     * @var null|PDO
     */
    private static $connection = NULL;

    /**
     * Get PDO connection
     *
     * @return null|\PDO
     */
    public static function getConnection()
    {
        $paramsPath = './config/db_params.php';
        $dbParams = include($paramsPath);

        if (!self::$connection) {
            self::$connection = new \PDO("mysql:host={$dbParams['host']}; dbname={$dbParams['dbName']}",
                $dbParams['user'], $dbParams['password'], [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
        }

        return self::$connection;

    }
}