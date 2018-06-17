<?php

require_once 'models/Config.php';
require_once 'models/DB.php';
require_once 'models/Post.php';
require_once 'models/Comment.php';

require_once 'repos/PostsRepo.php';
require_once 'repos/CommentsRepo.php';
require_once 'repos/UsersRepo.php';

require_once 'PageBuilder.php';

require_once 'controllers/BlogController.php';
require_once 'controllers/AuthorController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/PostController.php';
require_once 'controllers/CommentController.php';

require_once 'router.php';


session_start();

Router::serve();





