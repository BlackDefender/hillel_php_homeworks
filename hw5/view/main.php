<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Юзвери</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>
<body>

<main class="container">
    <?php if(isset($_SESSION['user'])): ?>
        <div class="d-flex align-items-center">
            <span class="text-monospace">Hello, <?= $_SESSION['user']->name; ?></span>
            <a class="btn btn-lin" href="logout.php">LogOut</a>
        </div>
    <?php endif; ?>

    <?php
    if(isset($message)):
        ?>
        <div class="alert alert-<?= $message['type']; ?>">
            <?= $message['text']; ?>
        </div>
        <?php
    endif;

    ?>

    <table class="table table-striped users-list">
        <thead>
        <tr>
            <th>Имя</th>
            <th>Email</th>
            <th></th>
        </tr>
        </thead>
    <?php
    foreach ($usersList as $index => $user){
        ?>
        <tr>
            <td><?= $user->name; ?></td>
            <td><?= $user->email; ?></td>
            <td>
                <div class="d-flex">
                    <form action="" method="post">
                        <input type="hidden" name="action" value="remove">
                        <input type="hidden" name="index" value="<?= $index; ?>">
                        <button class="btn btn-danger" type="submit">Удалить</button>
                    </form>
                    <div class="btn btn-info change-user"
                         data-toggle="modal"
                         data-target="#editUserModal"
                         data-index="<?= $index; ?>"
                         data-name="<?= $user->name; ?>"
                         data-email="<?= $user->email; ?>">Изменить</div>
                </div>
            </td>
        </tr>
        <?php
    }
    ?>
    </table>
    <form action="" method="post" id="user-form">
        <h3 class="mb-2">Добавить пользователя</h3>
        <input type="hidden" name="action" value="add">
        <div class="form-group mb-2">
            <input class="form-control" type="text" name="name" required placeholder="Имя">
        </div>
        <div class="form-group mb-2">
            <input class="form-control" type="email" name="email" required placeholder="Email">
        </div>
        <div class="form-group mb-2">
            <input class="form-control" type="password" name="password" required placeholder="Password">
        </div>
        <input class="btn btn-success" type="submit" value="Сохранить">
    </form>
</main>



<!-- Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Редактировать пользователя</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="editUserForm">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="index">
                    <div class="form-group mb-2">
                        <input class="form-control" type="text" name="name" required placeholder="Имя">
                    </div>
                    <div class="form-group mb-2">
                        <input class="form-control" type="email" name="email" required placeholder="Email">
                    </div>
                    <h6 class="mt-4">Пароль (опционально)</h6>
                    <div class="form-group mb-2">
                        <input class="form-control" type="password" name="old_password" placeholder="Старый пароль">
                    </div>
                    <div class="form-group mb-2">
                        <input class="form-control" type="password" name="new_password" placeholder="Новый пароль">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-success" form="editUserForm">Сохранить</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

<script src="assets/js/app.js"></script>
</body>
</html>