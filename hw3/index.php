<?php

require_once 'models/Posts.php';

$postsObj = new Posts();

$postsList = $postsObj->getPosts();

require_once 'view/main.php';