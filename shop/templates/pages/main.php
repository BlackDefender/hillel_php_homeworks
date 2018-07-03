<div id="page-main">
<?php
if(isset($products)){
    echo '<div class="row">';
    foreach ($products as $p){
        $p->getIllustration(['w'=>250]);
        ?>
        <div class="col-3 mb-3">
            <div class="card">
                <img class="card-img-top" src="<?= $p->getIllustration(['w'=>250, 'h' => 170]); ?>" alt="Product illustration">
                <div class="card-body">
                    <h5 class="card-title"><?= $p->title; ?></h5>
                    <p class="card-text"><?= $p->getExcerpt(50); ?></p>
                    <?php
                    if(!empty($p->variants)):
                    ?>
                    <div class="btn btn-success button-add-to-cart" data-action="add" data-variant-id="<?= $p->variants[0]->id; ?>">Add to cart</div>
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
</div>
