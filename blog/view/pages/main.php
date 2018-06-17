<?php
foreach ($posts as $post):
?>
<article class="mb-4">
    <h3><a href="<?= SITE_URL; ?>post/<?= $post->id; ?>"><?= $post->title; ?></a></h3>
    <div>
        <?= $post->getDate(); ?>
        <a href="<?= SITE_URL; ?>author/<?= $post->user_id; ?>"><?= $post->user_name; ?></a> | <a href="<?= SITE_URL; ?>author/<?= $post->user_id; ?>/comments">See author comments</a>
    </div>
    <div><?= $post->getExcerpt(); ?></div>
</article>
<?php
endforeach;
?>