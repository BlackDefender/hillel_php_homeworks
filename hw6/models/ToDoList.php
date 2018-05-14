<?php

require_once 'DB.php';

class ToDoList
{
    private $connection;

    public function __construct()
    {
        $this->connection = (new DB())->getConnection();
    }

    public function __destruct()
    {
        $this->connection = null;
    }

    public function get()
    {
        $statement = $this->connection->prepare("SELECT * FROM todo");
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $data = $statement->fetchAll();
        return $data;
    }

    public function add($text)
    {
        $statement = $this->connection->prepare("INSERT INTO todo SET text = :text, done = 0");
        $statement->execute([
            ':text' => $text
        ]);
    }

    public function remove($id)
    {
        $id = (int)$id;
        $sql = "DELETE FROM todo WHERE id=$id";
        $this->connection->exec($sql);
    }

    public function changeState($id, $state)
    {
        $id = (int)$id;
        $sql = "UPDATE todo SET done = $state WHERE id=$id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }
}