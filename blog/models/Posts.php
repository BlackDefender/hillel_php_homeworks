<?php

require_once 'DB.php';
require_once 'Post.php';

class Posts
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getPost($id)
    {
        $id = (int)$id;
        $statement = $this->connection->prepare("SELECT p.id, p.title, p.content, p.pub_date, p.user_id, u.name AS user_name FROM posts AS p LEFT JOIN users AS u ON p.user_id = u.id WHERE p.id = $id");
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, 'Post');
        return $statement->fetch();
    }

    public function getPosts($posts_per_page = 10, $page = 1)
    {
        $posts_per_page = intval($posts_per_page);
        $from = (intval($page)-1)*$posts_per_page;

        $statement = $this->connection->prepare("SELECT p.id, p.title, p.content, p.pub_date, p.user_id, u.name AS user_name FROM posts AS p LEFT JOIN users AS u ON p.user_id = u.id ORDER BY id DESC LIMIT $from, $posts_per_page ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, 'Post');
    }

    public function getPostsByUser($user_id, $posts_per_page = 10, $page = 1){
        $user_id = intval($user_id);
        $posts_per_page = intval($posts_per_page);
        $from = (intval($page)-1)*$posts_per_page;

        //$statement = $this->connection->prepare("SELECT * FROM posts WHERE user_id = $user_id");
        $statement = $this->connection->prepare("SELECT p.id, p.title, p.content, p.pub_date, p.user_id, u.name AS user_name FROM posts AS p LEFT JOIN users AS u ON p.user_id = u.id WHERE p.user_id = $user_id ORDER BY id DESC LIMIT $from, $posts_per_page ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, 'Post');
    }


    public function add($user_id, $title, $content)
    {
        $statement = $this->connection->prepare("INSERT INTO posts SET user_id = :user_id, title = :title, content = :content");
        $statement->execute([
            ':user_id' => $user_id,
            ':title' => $title,
            ':content' => $content,
        ]);
    }

    public function remove($id)
    {
        $id = (int)$id;
        $sql = "DELETE FROM posts WHERE id=$id";
        $this->connection->exec($sql);
    }
}