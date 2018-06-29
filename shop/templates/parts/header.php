<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <base href="<?= SITE_URL; ?>">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10"><h1 class="text-center pb-4 pt-3"><a class="text-dark" href="<?= SITE_URL; ?>">Зе Байкъ Шоп</a></h1></div>
        <div class="col-1"><a href="cart/">Cart (<?= $cart->totalProducts; ?>)</a></div>
    </div>
