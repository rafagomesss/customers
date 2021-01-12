<?php

declare(strict_types = 1);

namespace Customer\DB;

class Connection extends \PDO
{
    protected static $db;

    private function __construct()
    {
        try {
            self::$db = new \PDO(DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD, DB_PDO_OPTIONS);
        } catch (\PDOException $pdoEx) {
            echo "Error - {$pdoEx->getCode}: " . $pdoEx->getMessage();
        }
    }

    public static function getInstance(): ?\PDO
    {
        if (is_null(self::$db)) {
            new Connection();
        }
    
        return self::$db;
    }
}