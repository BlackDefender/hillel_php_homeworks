<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog - <?= $post->title ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>
<body>

<main class="container pb-5">
    <h1 class="p-5 text-center"><a href="<?= SITE_URL ?>">BLOG</a></h1>
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
            <a href="<?= SITE_URL; ?>login.php">Login</a> or <a href="<?= SITE_URL; ?>register.php">Register</a>

        <?php
        endif;
        ?>
        <a class="ml-3" href="<?= SITE_URL; ?>"><- go back</a>
    </nav>

    <article>
        <h3><?= $post->title; ?></h3>
        <div>
            <?= $post->pub_date; ?>
            <a href="<?= SITE_URL; ?>?user_id=<?= $post->user_id; ?>"><?= $post->user_name; ?></a>
        </div>
        <div><?= $post->content; ?></div>
    </article>

    <?php
    if(count($comments)):
        ?>
        <h4 class="mt-4">Comments:</h4>
        <div class=" mb-4">
            <?php
            foreach ($comments as $c):
                ?>
                <div class="mb-3">
                    <div><?= $c->user_name; ?> at <?= $c->pub_date; ?></div>
                    <div><?= $c->text; ?></div>
                </div>
            <?php
            endforeach;
            ?>
        </div>
    <?php
    endif;
    ?>

    <?php
    if(isset($_SESSION['user'])):
    ?>
        <h4 class="mt-4">Leave comment:</h4>
        <form method="post" action="<?= SITE_URL; ?>add-comment.php">
            <input type="hidden" name="user_id" value="<?= $_SESSION['user']->id; ?>">
            <input type="hidden" name="post_id" value="<?= $post->id; ?>">
            <textarea name="comment" class="form-control mb-3" rows="5"></textarea>
            <button type="submit" class="btn btn-success">Add comment</button>
        </form>
    <?php
    endif;
    ?>
</main>

</body>
</html>

