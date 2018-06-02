<?php

require_once 'DB.php';
require_once 'Comment.php';

class Comments
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function get($post_id)
    {
        $post_id = intval($post_id);
        $statement = $this->connection->prepare("SELECT c.post_id, c.user_id, c.text, c.pub_date, u.name AS user_name FROM comments AS c LEFT JOIN users AS u ON c.user_id = u.id WHERE c.post_id = $post_id ORDER BY c.id ASC");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, 'Comment');
    }

    public function add($post_id, $user_id, $text)
    {
        $statement = $this->connection->prepare("INSERT INTO comments SET user_id = :user_id, text = :text, post_id = :post_id");
        $statement->execute([
            ':user_id' => $user_id,
            ':text' => $text,
            ':post_id' => $post_id,
        ]);
    }

}