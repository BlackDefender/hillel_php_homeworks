<div id="page-order">
    <h1>Order #<?= $order->id; ?></h1>
    <table class="table table-striped">
        <tr>
            <th>Product</th>
            <th>Variant</th>
            <th>Amount</th>
            <th>Price per item</th>
            <th>Price</th>
        </tr>
        <?php
        foreach ($order->purchases as $purchase){
            ?>
            <tr>
                <td><?= $purchase->product->title; ?></td>
                <td><?= $purchase->variant->title; ?></td>
                <td><?= $purchase->amount; ?></td>
                <td><?= $purchase->price; ?></td>
                <td><?= $purchase->amount*$purchase->price; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <h3>Price total: <?= $order->price; ?></h3>
    <h3>Delivery address: <?= $order->address; ?></h3>
</div>