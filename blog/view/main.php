<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>
<body>

<main class="container">
    <h1 class="p-5 text-center"><a href="<?= SITE_URL; ?>">BLOG</a></h1>
    <nav class="d-flex align-items-center mb-3">
        <?php
        if(isset($_SESSION['user'])):
        ?>
            <span class="text-monospace mr-3">Hello, <?= $_SESSION['user']->name; ?></span>
            <a class="btn btn-lin" href="<?= SITE_URL; ?>logout.php">LogOut</a>
            <a href="<?= SITE_URL; ?>add-post.php">Add post</a>
        <?php
        else:
        ?>
            <a href="<?= SITE_URL; ?>login.php">Login</a> <div class="ml-2 mr-2">or</div> <a href="<?= SITE_URL; ?>register.php">Register</a>
        <?php
        endif;
        ?>
    </nav>

    <?php

    foreach ($posts as $post):
    ?>
    <article class="mb-4">
        <h3><a href="<?= SITE_URL; ?>post.php?post_id=<?= $post->id; ?>"><?= $post->title; ?></a></h3>
        <div>
            <?= $post->pub_date; ?>
            <a href="<?= SITE_URL; ?>?user_id=<?= $post->user_id; ?>"><?= $post->user_name; ?></a>
        </div>
        <div><?= $post->getExcerpt(); ?></div>
    </article>
    <?php
    endforeach;
    ?>
</main>

</body>
</html>