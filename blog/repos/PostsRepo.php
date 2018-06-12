<?php

class PostsRepo
{

    private static function connection()
    {
        return DB::getConnection();
    }

    public static function getPost($id)
    {
        $id = (int)$id;
        $statement = self::connection()->prepare("SELECT p.id, p.title, p.content, p.pub_date, p.user_id, u.name AS user_name FROM posts AS p LEFT JOIN users AS u ON p.user_id = u.id WHERE p.id = $id");
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, 'Post');
        return $statement->fetch();
    }

    public static function getPosts($posts_per_page = 10, $page = 1)
    {
        $posts_per_page = intval($posts_per_page);
        $from = (intval($page)-1)*$posts_per_page;

        $statement = self::connection()->prepare("SELECT p.id, p.title, p.content, p.pub_date, p.user_id, u.name AS user_name FROM posts AS p LEFT JOIN users AS u ON p.user_id = u.id ORDER BY id DESC LIMIT $from, $posts_per_page ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, 'Post');
    }

    public static function getPostsByUser($user_id, $posts_per_page = 10, $page = 1){
        $user_id = intval($user_id);
        $posts_per_page = intval($posts_per_page);
        $from = (intval($page)-1)*$posts_per_page;

        $statement = self::connection()->prepare("SELECT p.id, p.title, p.content, p.pub_date, p.user_id, u.name AS user_name FROM posts AS p LEFT JOIN users AS u ON p.user_id = u.id WHERE p.user_id = $user_id ORDER BY id DESC LIMIT $from, $posts_per_page ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, 'Post');
    }


    public static function add($user_id, $title, $content)
    {
        $statement = self::connection()->prepare("INSERT INTO posts SET user_id = :user_id, title = :title, content = :content");
        $statement->execute([
            ':user_id' => $user_id,
            ':title' => $title,
            ':content' => $content,
        ]);
    }

    public static function remove($id)
    {
        $statement = self::connection()->prepare('DELETE FROM posts WHERE id=?');
        $statement->execute([$id]);
    }
}