<?php include ROOT . '/views/layouts/header.php'; ?>
    <a href="/">← Back</a>
    <h1 class="mb-4">Create a post</h1>
    <form method="POST">
        <input type="hidden" name="post_create">
        <div class="form-group">
            <label for="title_input">Title</label>
            <input name="post_title" type="text" class="form-control" id="title_input">
        </div>
        <div class="form-group">
            <label for="text_input">Full text</label>
            <textarea name="post_text" class="form-control" id="text_input" rows="6"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-4 btn-block">Create</button>
    </form>
    <?php if (isset($errors) && is_array($errors)) { ?>
        <div class="alert alert-danger" role="alert">
            <?php foreach ($errors as $error) { ?>
                <li><?php echo $error; ?></li>
            <?php } ?>
        </div>
    <?php } ?>
<?php include ROOT . '/views/layouts/footer.php'; ?>