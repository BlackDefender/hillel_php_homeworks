<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>
<body>

<main class="container pb-5">
    <h1 class="p-5 text-center"><a href="<?= SITE_URL ?>">BLOG</a></h1>
    <nav class="d-flex align-items-center mb-3">
        <?php
        if(isset($_SESSION['user'])):
            ?>
            <span class="text-monospace mr-3">Hello, <a href="<?= SITE_URL; ?>author/<?= $_SESSION['user']->id; ?>"><?= $_SESSION['user']->name; ?></a></span>
            <a class="btn btn-lin" href="<?= SITE_URL; ?>user/logout">LogOut</a>
            <a href="<?= SITE_URL; ?>post/add">Add post</a>
            <?php if( PAGE == 'post' && $_SESSION['user']->id == $post->user_id): ?>
                <form action="<?= SITE_URL ?>post/remove" method="post">
                    <input type="hidden" name="postId" value="<?= $post->id; ?>">
                    <input type="submit" class="btn btn-link" value="Remove post">
                </form>
            <?php endif; ?>
        <?php
        else:
            ?>
            <a href="<?= SITE_URL; ?>user/login">Login</a> <div class="mr-3 ml-3">or</div> <a href="<?= SITE_URL; ?>user/register">Register</a>
        <?php
        endif;
        if(PAGE !== 'main'):
        ?>
        <a class="ml-3" href="<?= SITE_URL; ?>"><- go back</a>
        <?php endif; ?>
    </nav>