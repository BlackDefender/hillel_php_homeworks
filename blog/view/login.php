<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ToDoList</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>
<body>

<main class="container pt-5">
    <div class="row justify-content-center">
        <form action="<?= Config::getSiteUrl(); ?>user/login" method="post"  class="mb-4 col-4">
            <h3 class="mb-2">Login</h3>
            <div class="form-group mb-2">
                <input class="form-control" type="email" name="email" required placeholder="Email">
            </div>
            <div class="form-group mb-2">
                <input class="form-control" type="password" name="password" required placeholder="Password">
            </div>
            <input class="btn btn-success" type="submit" value="Login!">
        </form>
    </div>
    <div class="row justify-content-center">
        <div class="col-4">
            <a href="<?= Config::getSiteUrl(); ?>user/register">Do not have account yet? Register!</a>
        </div>
    </div>
</main>

</body>
</html>