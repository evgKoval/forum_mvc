<?php include ROOT . '/views/layouts/header.php'; ?>  
    <span class="d-block">Your query</span>
    <h3 class="d-block"><?php echo $query; ?></h3>
    <hr>
    <div class="row">
        <div class="col-12">
            <?php if($posts == []) { ?>
                <h3>There are no posts with this query</h3>
            <?php } ?>
        </div>
        <?php foreach($posts as $post) { ?>
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="/post/<?php if(isset($post['id'])) echo $post['id'] ?>">
                                <?php if(isset($post['post_title'])) echo $post['post_title'] ?>
                            </a>
                        </h5>
                        <?php if(isset($post['name'])) { ?>
                            <span class="badge badge-primary d-inline-block mb-2"><?php echo $post['name'] ?></span>
                        <?php } ?>
                        

                        <small class="d-block mb-1"><?php if(isset($post['created_at'])) echo $post['created_at']; ?></small>
                        <p class="card-text">
                            <?php if(isset($post['post_text'])) echo $post['post_text'] ?>
                        </p>
                        <?php if(!User::isGuest() && Post::isMyPost($post['id'])) { ?>
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