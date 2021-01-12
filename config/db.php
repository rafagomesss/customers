<?php
define('DB_HOST', 'localhost');
define('DB_DRIVER', 'mysql');
define('DB_NAME', 'customers');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_PDO_OPTIONS', 
    [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ]
);