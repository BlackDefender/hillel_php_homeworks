<?php

class CommentsRepo
{
    private static function connection()
    {
        return DB::getConnection();
    }

    public static function get($post_id)
    {
        $post_id = intval($post_id);
        $statement = self::connection()->prepare("SELECT c.post_id, c.user_id, c.text, c.pub_date, u.name AS user_name FROM comments AS c LEFT JOIN users AS u ON c.user_id = u.id WHERE c.post_id = $post_id ORDER BY c.id ASC");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, 'Comment');
    }

    public static function add($post_id, $user_id, $text)
    {
        $statement = self::connection()->prepare("INSERT INTO comments SET user_id = :user_id, text = :text, post_id = :post_id");
        $statement->execute([
            ':user_id' => $user_id,
            ':text' => $text,
            ':post_id' => $post_id,
        ]);
    }

    public static function remove($id)
    {
        $statement = self::connection()->prepare('DELETE FROM comments WHERE id=?');
        $statement->execute([$id]);
    }

    public static function removeByPostId($postId)
    {
        $statement = self::connection()->prepare('DELETE FROM comments WHERE post_id=?');
        $statement->execute([$postId]);
    }

}