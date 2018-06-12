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
            <a class="btn btn-lin" href="<?= SITE_URL; ?>user/logout">LogOut</a>
            <a href="<?= SITE_URL; ?>post/add">Add post</a>
            <?php if($_SESSION['user']->id == $post->user_id): ?>
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
        ?>
        <a class="ml-3" href="<?= SITE_URL; ?>"><- go back</a>
    </nav>

    <article>
        <h3><?= $post->title; ?></h3>
        <div>
            <?= $post->getDate(); ?>
            <a href="<?= SITE_URL; ?>author/<?= $post->user_id; ?>"><?= $post->user_name; ?></a>
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
                    <div><?= $c->user_name; ?> at <?= $c->getDate(); ?></div>
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
        <form method="post" action="<?= SITE_URL; ?>comment/add">
            <input type="hidden" name="userId" value="<?= $_SESSION['user']->id; ?>">
            <input type="hidden" name="postId" value="<?= $post->id; ?>">
            <textarea name="comment" class="form-control mb-3" rows="5"></textarea>
            <button type="submit" class="btn btn-success">Add comment</button>
        </form>
    <?php
    endif;
    ?>
</main>

</body>
</html>

