<?php

class CommentController
{
    public static function addComment($data)
    {
        if(!empty($data)){
            CommentsRepo::add($data['postId'], $data['userId'], $data['comment']);
            header('location: '.Config::getSiteUrl().'post/'.intval($data['postId']));
        }else{
            header('location: '.Config::getSiteUrl());
        }
    }

    public static function removeComment($data)
    {
        if(!empty($data)){
            $comment = CommentsRepo::getComment($_POST['commentId']);
            if($comment->user_id == $_SESSION['user']->id){
                CommentsRepo::remove($data['commentId']);
            }
            header('location: '.Config::getSiteUrl().'post/'.$_POST['postId']);
        }else{
            header('location: '.Config::getSiteUrl());
        }
    }
}