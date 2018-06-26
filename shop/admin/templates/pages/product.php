<?php
function _drawVariant($variantId, $title, $price, $amount)
{
    ?>
    <div class="row mt-2">
        <input type="hidden" name="variants[variant_id][]" value="<?= $variantId; ?>">
        <div class="col-3">
            <input type="text" class="form-control" name="variants[title][]" placeholder="Title" value="<?= $title; ?>">
        </div>
        <div class="col-3">
            <input type="text" class="form-control" name="variants[price][]" placeholder="Price" value="<?= $price; ?>">
        </div>
        <div class="col-3">
            <input type="text" class="form-control" name="variants[amount][]" placeholder="Amount" value="<?= $amount; ?>">
        </div>
    </div>
    <?php
}

?>
<div id="page-product">
    <form action="" method="post" enctype="multipart/form-data" class="pt-4">
        <div class="form-group">
            <input type="text" name="title" placeholder="Product title" class="form-control" value="<?= isset($product) ? $product->title : ''; ?>">
        </div>
        <div class="form-group">
            <textarea name="description" class="form-control" placeholder="Product description"><?= isset($product) ? $product->description : ''; ?></textarea>
        </div>


        <?php
        $productIllustration = null;
        if(isset($product)){
            $productIllustration = $product->getIllustrationAdmin();
        }
        ?>
        <div class="main-illustration"
             id="main-illustration" <?= !empty($productIllustration) ? 'style="background-image:url('.$productIllustration.');"' : ''; ?>></div>
        <input type="file" name="main-illustration"  accept="image/jpeg,image/png,image/gif" id="main-illustration-input" class="main-illustration-input">

        <h2 class="mt-4 mb-2">Product variants:</h2>

        <div id="product-variants-list">
            <div class="row mt-2">
                <div class="col-3"><h5>Title</h5></div>
                <div class="col-3"><h5>Price</h5></div>
                <div class="col-3"><h5>Amount</h5></div>
            </div>
            <?php
            if(isset($product)){
                foreach ($product->variants as $v){
                    _drawVariant($v->id, $v->title, $v->price, $v->amount);
                }
            }
            ?>
        </div>
        <div class="row mt-2 mb-4">
            <div class="col">
                <button type="button" id="add-variant-btn" class="btn btn-primary">Add variant</button>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Save product</button>
    </form>
</div>
<script type="template" id="product-variant-template">
    <?php _drawVariant('', '', '', '') ?>
</script>
