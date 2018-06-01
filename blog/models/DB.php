<?php


class DB
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbname = "blog";
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection(){
        return $this->connection;
    }
}