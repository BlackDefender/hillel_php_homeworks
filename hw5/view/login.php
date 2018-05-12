<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Юзвери</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>
<body>

<main class="container">

    <form action="login.php" method="post">
        <h3 class="mb-2">Login</h3>
        <div class="form-group mb-2">
            <input class="form-control" type="email" name="email" required placeholder="Email">
        </div>
        <div class="form-group mb-2">
            <input class="form-control" type="password" name="password" required placeholder="Password">
        </div>
        <input class="btn btn-success" type="submit" value="Login!">
    </form>
</main>

</body>
</html>