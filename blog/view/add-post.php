<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog - Add post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>
<body>

<main class="container">
    <h1 class="p-5 text-center">Add post</h1>
    <nav class="d-flex align-items-center">
        <?php
        if(isset($_SESSION['user'])):
            ?>
            <span class="text-monospace mr-3">Hello, <?= $_SESSION['user']->name; ?></span>
            <a class="btn btn-lin" href="<?= SITE_URL; ?>user/logout">LogOut</a>
        <?php
        endif;
        ?>
        <a class="ml-3" href="<?= SITE_URL; ?>"><- go back</a>
    </nav>

    <form action="<?= SITE_URL; ?>post/add" method="post">
        <input class="form-control" type="text" name="title" placeholder="Title" required>
        <textarea class="form-control mt-3 mb-3" name="content" cols="30" rows="10" placeholder="Your Post" required></textarea>
        <input type="submit" value="Publish" class="btn btn-success">
    </form>
</main>

</body>
</html>