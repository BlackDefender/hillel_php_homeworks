<div id="page-products" class="pt-3">
    <div class="mb-2">
        <a href="admin/product/" class="btn btn-success">Add product</a>
    </div>
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>Action</th>
        </tr>
        <?php
        foreach ($products as $p) {
            ?>
            <tr>
                <td>
                    <a href="admin/product/?id=<?= $p->id; ?>"><?= $p->title; ?></a>
                </td>
                <td>
                    <form action="admin/product/remove/" method="post" class="remove-product-form">
                        <input type="hidden" name="id" value="<?= $p->id; ?>">
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>