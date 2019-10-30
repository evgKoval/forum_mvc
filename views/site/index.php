<?php include ROOT . '/views/layouts/header.php'; ?>
    <h1 class="mb-3">All of posts</h1>
    <?php if(!User::isGuest()) { ?>
        <a href="/post/create" class="btn btn-primary">Create a post</a>
    <?php } ?>
    <hr>
    <div class="row">
        <?php foreach($posts as $post) { ?>
            <div class="col-sm-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="/post/<?php if(isset($post['id'])) echo $post['id'] ?>">
                                <?php if(isset($post['post_title'])) echo $post['post_title'] ?>
                            </a>
                        </h5>

                        <small class="d-block mb-1"><?php if(isset($post['created_at'])) echo $post['created_at']; ?></small>
                        <p class="card-text">
                            <?php if(isset($post['post_text'])) echo $post['post_text'] ?>
                        </p>
                        <?php if(isset($_SESSION['user']) && Post::isMyPost($post['id'])) { ?>
                            <a href="/post/edit/<?php if(isset($post['id'])) echo $post['id'] ?>" class="btn btn-outline-warning">Edit</a>
                            <a href="/post/delete/<?php if(isset($post['id'])) echo $post['id'] ?>" class="btn btn-outline-danger">Delete</a>
                        <?php } ?>
                        <hr>
                        <div>
                            <?php if(!User::isGuest()) { ?>
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
                    </div>
                </div>
            </div>
        <?php } ?>
        
    </div>
<?php include ROOT . '/views/layouts/footer.php'; ?>