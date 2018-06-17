<div id="page-add-post">
    <h2>Add Post:</h2>
    <form action="<?= SITE_URL; ?>post/add" method="post">
        <input class="form-control mb-3" type="text" name="title" placeholder="Title" required>
        <textarea class="form-control" name="content" cols="30" rows="10" placeholder="Your Post"></textarea>
        <input type="submit" value="Publish" class="btn btn-success mt-3">
    </form>
</div>