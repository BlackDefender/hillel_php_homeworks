<?php

class DB
{
    private static $instance = null;

    private $connection;

    private function __construct()
    {
        try {
            $this->connection = new PDO('mysql:host='.Config::$db_host.';dbname='.Config::$db_name, Config::$db_user, Config::$db_password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getConnection(){

        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance->connection;
    }
}