


    <article>
        <h3><?= $post->title; ?></h3>
        <div>
            <?= $post->getDate(); ?>
            <a href="<?= SITE_URL; ?>author/<?= $post->user_id; ?>"><?= $post->user_name; ?></a> | <a href="<?= SITE_URL; ?>author/<?= $post->user_id; ?>/comments">See author comments</a>
        </div>
        <div><?= $post->content; ?></div>
    </article>

    <?php
    if(count($comments)):
        ?>
        <h4 class="mt-4">Comments:</h4>
        <div class=" mb-4">
            <?php
            foreach ($comments as $c):
                ?>
                <div class="mb-3">
                    <div class="d-flex align-items-center">
                        <?= $c->user_name; ?> at <?= $c->getDate(); ?>
                        <?php if($c->user_id == $_SESSION['user']->id): ?>
                        <form action="<?= SITE_URL ?>comment/remove" method="post">
                            <input type="hidden" name="commentId" value="<?= $c->id; ?>">
                            <input type="hidden" name="postId" value="<?= $post->id; ?>">
                            <button type="submit" class="btn btn-link">Delete</button>
                        </form>
                        <?php endif; ?>
                    </div>
                    <div><?= $c->text; ?></div>
                </div>
            <?php
            endforeach;
            ?>
        </div>
    <?php
    endif;
    ?>

    <?php
    if(isset($_SESSION['user'])):
    ?>
        <h4 class="mt-4">Leave comment:</h4>
        <form method="post" action="<?= SITE_URL; ?>comment/add">
            <input type="hidden" name="userId" value="<?= $_SESSION['user']->id; ?>">
            <input type="hidden" name="postId" value="<?= $post->id; ?>">
            <textarea name="comment" class="form-control mb-3" rows="5"></textarea>
            <button type="submit" class="btn btn-success">Add comment</button>
        </form>
    <?php
    endif;
    ?>


