<h2>Comments by <?= $user->name; ?>:</h2>

<?php foreach ($comments as $index => $comment): ?>
    <?php
    if($index > 0){
        echo '<hr class=" mt-4 mb-4">';
    }
    ?>
    <div>
        <?= $comment->text; ?>
        <br>
        <a href="<?= SITE_URL; ?>post/<?= $comment->post_id; ?>">See in post</a>
    </div>
<?php endforeach; ?>