<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Зе Байкъ Шоп</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <base href="<?= SITE_URL; ?>">
</head>
<body>

<div class="container">
    <div class="row align-items-center">
        <div class="col-4 d-flex align-items-center">
            <?php
            if($user){
                ?>
                Hello, <?= $user->name; ?>
                <form action="user/logout/" method="post" class="ml-2">
                    <input type="submit" class="btn btn-warning" value="Logout">
                </form>
                <?php
                if($user->isAdmin()){
                    ?>
                    <a href="admin/" class="btn btn-link">To Admin panel</a>
                    <?php
                }
            }else{
                ?>
                <a href="user/login/">Login</a>
                <span class="mr-1 ml-1">or</span>
                <a href="user/register/">Register</a>
                <?php
            }
            ?>
        </div>
        <div class="col-4"><h1 class="text-center pb-4 pt-3"><a class="text-dark" href="<?= SITE_URL; ?>">Зе Байкъ Шоп</a></h1></div>
        <div class="col-4 d-flex justify-content-end"><a href="cart/">Cart (<span id="cart-total-products"><?= $cart->totalProducts; ?></span>)</a></div>
    </div>
    <?php foreach ($messages as $message): ?>
        <div class="alert alert-<?= $message->type; ?>" role="alert">
            <?= $message->text; ?>
        </div>
    <?php endforeach; ?>