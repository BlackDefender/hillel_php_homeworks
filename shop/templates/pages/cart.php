<div id="page-cart">

    <table class="table table-striped">
        <tr>
            <th>Title</th>
            <th>Amount</th>
            <th>Price</th>
            <th>Total price</th>
            <th></th>
        </tr>
    <?php
    foreach ($cart->purchases as $p){
        ?>
        <tr>
            <td>
                <?= $p->product->title; ?> (<?= $p->variant->title; ?>)
            </td>
            <td><?= $p->amount; ?></td>
            <td><?= $p->variant->price; ?></td>
            <td><?= $p->variant->price*$p->amount; ?></td>
            <td>
                <form action="cart/remove/" method="post">
                    <input type="hidden" name="variantId" value="<?= $p->variant->id; ?>">
                    <button type="submit" class="btn btn-warning">Remove</button>
                </form>
            </td>
        </tr>
        <?php
    }
    ?>
    </table>

    <h3 class="text-right">Order price: <?= $cart->totalPrice; ?></h3>

    <div class="d-flex justify-content-end mt-4 mb-4">
        <form action="cart/clear/" method="post">
            <button type="submit" class="btn btn-danger">Clear cart</button>
        </form>
    </div>

    <form action="order" method="post">
        <div class="row mb-3">
            <div class="col-4">
                <input class="form-control" type="text" name="name" placeholder="Name">
            </div>
            <div class="col-4">
                <input class="form-control" type="email" name="email" placeholder="Email">
            </div>
            <div class="col-4">
                <input class="form-control" type="tel" name="tel" placeholder="Phone *" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-8">
                <input class="form-control" type="text" name="address" placeholder="Delivery address">
            </div>
            <div class="col-4">
                <select class="form-control" name="payment-method">
                    <option value="" disabled selected>Payment method</option>
                    <option value="cash">Cash</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <textarea name="message" class="form-control" placeholder="Message"></textarea>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Order!</button>
        </div>
    </form>

</div>