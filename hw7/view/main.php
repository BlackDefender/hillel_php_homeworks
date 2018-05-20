<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ToDoList</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>
<body>

<main class="container">
    <h1 class="p-5 text-center">TODO LIST</h1>
    <nav class="d-flex align-items-center">
        <span class="text-monospace mr-3">Hello, <?= $_SESSION['user']->name; ?></span>
        <a class="btn btn-lin" href="<?= Config::getSiteUrl(); ?>logout.php">LogOut</a>
    </nav>
    <table class="table">
        <thead>
        <tr>
            <th>Задание</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($todos as $item){
            ?>
            <tr>
                <td><?= $item['done'] ? '<s>'.$item['text'].'</s>' : $item['text']; ?></td>
                <td>
                    <div class="d-flex">
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?= $item['id']; ?>">
                            <input type="hidden" name="action" value="<?= $item['done'] ? 'setAsNew' : 'setAsDone'; ?>">
                            <button class="btn btn-<?= $item['done'] ? 'warning' : 'success'; ?>"><?= $item['done'] ? 'Не выполнено' : 'Выполнено'; ?></button>
                        </form>
                        <form class="ml-1" action="" method="post">
                            <input type="hidden" name="id" value="<?= $item['id']; ?>">
                            <input type="hidden" name="action" value="remove">
                            <button class="btn btn-danger">Удалить</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

    <form class="mt-5" action="" method="post">
        <h3>Добавить задание</h3>
        <input type="hidden" name="action" value="add">
        <textarea class="form-control mb-2 mt-3" name="text"></textarea>
        <button class="btn btn-success float-right">Добавить</button>
    </form>

</main>

</body>
</html>