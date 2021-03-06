<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= Config::getSiteUrl(); ?>admin/assets/css/bundle.css">
    <base href="<?= Config::getSiteUrl(); ?>">
</head>
<body>

<div class="page-container container-fluid">
    <div class="row bg-secondary align-items-center">
        <div class="col-4">
            <a href="<?= SITE_URL; ?>" class="btn btn-link text-white">To Shop</a>
        </div>
        <div class="col-4">
            <h1 class="text-center pb-4 pt-3">
                <a class="text-white" href="<?= SITE_URL; ?>admin/">Зе Байкъ Шоп</a>
            </h1>
        </div>
        <div class="col-4"></div>
    </div>
    <div class="row">
        <aside class="col-2 bg-dark">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="admin/products/">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="admin/users/">Users</a>
                </li>
            </ul>
        </aside>
        <main class="col-10">
            <?php foreach ($messages as $message): ?>
                <div class="alert alert-<?= $message->type; ?>" role="alert">
                    <?= $message->text; ?>
                </div>
            <?php endforeach; ?>