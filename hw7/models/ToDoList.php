<?php

require_once 'DB.php';

class ToDoList
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function get($user_id)
    {
        $statement = $this->connection->prepare("SELECT * FROM todo WHERE user_id = :user_id");
        $statement->execute([
            ':user_id' => $user_id,
        ]);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        return $statement->fetchAll();
    }

    public function add($user_id, $text)
    {
        $statement = $this->connection->prepare("INSERT INTO todo SET user_id = :user_id, text = :text, done = 0");
        $statement->execute([
            ':user_id' => $user_id,
            ':text' => $text,
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