<div id="page-users" class="pt-3">
    <a href="admin/user/" class="btn btn-success">Add user</a>

    <table class="table table-striped mt-3">
        <thead>
        <tr>
            <th>User</th>
            <th>Role</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($users as $user){
            ?>
            <tr>
                <td><a href="admin/user/?id=<?= $user->id; ?>"><?= $user->name; ?></a></td>
                <td><?= $user->isAdmin() ? 'Admin' : 'Customer'; ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

</div>