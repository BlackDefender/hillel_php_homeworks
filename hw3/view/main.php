<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Stolen News</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>
<body>

<header class="container pt-2 mb-5">
    <h1 class="display-3 text-center">StolenNews Inc.</h1>
    <div class="text-secondary text-center">Тыряем новости где попало</div>
</header>

<main class="container">
    <?php
    foreach ($postsList as $item):
        ?>
        <article class="mb-5 shadow-sm p-3">
            <h2><?= $item->title; ?></h2>
            <div class="text-muted mt-2 mb-3"><?= date('d.m.Y', strtotime($item->pubDate)); ?></div>
            <div class="content">
                <?= $item->description; ?>
            </div>
        </article>
    <?php
    endforeach;
    ?>
</main>

<footer class="container text-center pb-3">
    &copy; 2018 StolenNews Incorporated. All rights reserved.
</footer>

</body>
</html>
