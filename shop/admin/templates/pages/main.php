<div id="page-main pt-4">
    <h3>Products:</h3>
    <p>There are <?= $productsCount->count; ?> products in the shop.</p>

    <h3>Images cache:</h3>
    <p>Images cache is <?= $cacheInfo->size; ?> MB in <?= $cacheInfo->filesCount; ?> files.</p>
    <form action="admin/cache/clear/" method="post">
        <button class="btn btn-secondary" type="submit">Clear cache</button>
    </form>
</div>