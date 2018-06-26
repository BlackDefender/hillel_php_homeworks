<?php
var_dump($cart);
if(isset($products)){
//    echo '<pre>';
//    var_dump($products);
//    echo '</pre>';
    echo '<div class="row">';
    foreach ($products as $p){
        ?>
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="<?= $p->getIllustration(); ?>" alt="Product illustration">
                <div class="card-body">
                    <h5 class="card-title"><?= $p->title; ?></h5>
                    <p class="card-text"><?= $p->getExcerpt(50); ?></p>
<!--                    <a href="#" class="btn btn-primary">See more</a>-->
                    <?php
                    if(!empty($p->variants)):
                    ?>
                    <form action="cart/add/" method="post">
                        <input type="hidden" name="variantId" value="<?= $p->variants[0]->id; ?>">
                        <button type="submit" class="btn btn-success">Add to cart</button>
                    </form>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
    echo '</div>';
}
?>