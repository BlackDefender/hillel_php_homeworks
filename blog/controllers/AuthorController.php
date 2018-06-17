<?php

class AuthorController
{
    public static function posts($id)
    {
        $posts = PostsRepo::getPostsByUser($id);
        PageBuilder::build('main', ['posts' => $posts]);
    }

    public static function comments($userId)
    {
        $user = UsersRepo::getById($userId);
        if($user){
            $comments = CommentsRepo::getCommentsByAuthorId($userId);
            PageBuilder::build('author-comments', ['comments' => $comments, 'user' => $user]);
        }else{
            PageBuilder::build('404');
        }
    }
}