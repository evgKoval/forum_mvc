<?php include ROOT . '/views/layouts/header.php'; ?>  
    <?php if($query != '') { ?>
        <span class="d-block">Your query</span>
        <h3 class="d-block"><?php echo $query; ?></h3>
        <hr>
    <?php } ?>
    <form action="/filtered" class="row align-items-center mt-2">
        <div class="col-1"><h5>Filters:</h5></div>
        <div class="col-3">
            <div class="form-group mb-0">
                <select name="filter_category" class="form-control" id="filter_category">
                    <option disabled selected>Choose category</option>
                    <?php foreach($subCategories as $subCategory) { ?>
                        <option value="<?php if(isset($subCategory['name'])) echo $subCategory['name']; ?>">
                            <?php if(isset($subCategory['name'])) echo $subCategory['name']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group mb-0">
                <input class="form-control" type="date" name="filter_date" min="2019-01-01" max="2019-12-31">
            </div>
        </div>
        <div class="col-3">
            <button type="submit" class="btn btn-primary btn-block">Search with filters</button>
        </div>
    </form>
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