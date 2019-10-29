<?php include ROOT . '/views/layouts/header.php'; ?>
    <a href="/">← Back</a>
    <hr>
    <small><?php if($post['created_at']) echo $post['created_at']; ?></small>
    <h1 class="mt-2 mb-3"><?php if(isset($post['post_title'])) echo $post['post_title']; ?></h1>
    <p><?php if(isset($post['post_text'])) echo $post['post_text']; ?></p>
    <div>
        <?php if(isset($_SESSION['user'])) { ?>
            <?php if(!Like::isLiked($post['id'])) { ?>
                <a href="/post/like/<?php if(isset($post['id'])) echo $post['id'] ?>">👍</a>
            <?php } else { ?>
                <a href="/post/dislike/<?php if(isset($post['id'])) echo $post['id'] ?>">👎</a>
            <?php } ?>
        <?php } else { ?>
            <span>👍</span>
        <?php } ?>
        <span>(<?php echo Like::getLikesByPost($post['id']) ?>)</span>
    </div>
    <hr>
    <?php if(!empty($comments)) { ?>
    <strong class="d-block mb-3">Comments</strong>
    <ul class="list-group comments">
        <?php foreach($comments as $comment) { ?>
            <li class="list-group-item">
                <small class="d-block">
                    <?php if(isset($comment['first_name'])) echo $comment['first_name']; ?> at <?php if(isset($comment['created_at'])) echo $comment['created_at']; ?>
                </small>
                <?php if(isset($comment['comment'])) echo $comment['comment']; ?>
            </li>
        <?php } ?>
    </ul>
    <?php } else { ?>
        <strong class="d-block mb-3">No comments</strong>
    <?php } ?>
    <?php if(isset($_SESSION['user'])) { ?>
        <form method="POST" class="mt-3">
            <input type="hidden" name="add_comment">
            <div class="form-group">
                <label for="comment_input">Add your comment</label>
                <textarea name="comment" class="form-control" id="comment_input" rows="2"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mb-4">Add</button>
        </form>
        <?php if(isset($errors) && is_array($errors)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php foreach ($errors as $error) { ?>
                    <li><?php echo $error; ?></li>
                <?php } ?>
            </div>
        <?php } ?>
    <?php } else { ?>
        <strong class="d-block mt-3 mb-5"><a href="/login">Login</a> or <a href="/register">register</a> to add comment</strong>
    <?php } ?>
    <script>
        <?php include 'js/comment.js'; ?>
    </script>
<?php include ROOT . '/views/layouts/footer.php'; ?>