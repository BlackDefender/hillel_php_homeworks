<?php

require_once 'models/Posts.php';

$postsList = Posts::getPosts();

require_once 'view/main.php';