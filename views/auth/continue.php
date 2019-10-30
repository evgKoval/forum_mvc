<?php include ROOT . '/views/layouts/header.php'; ?>
    <strong>To continue registration</strong>
    <h1 class="mb-4">Choose your preferences</h1>
    <form method="POST">
        <input type="hidden" name="continue">
        <div class="form-group">
            <label for="category_input">Which categories do you like?</label>
            <select name="category[]" multiple class="form-control" id="category_input">
                <?php foreach($categories as $category) { ?>
                    <option value="<?php if(isset($category['name'])) echo $category['name']; ?>">
                        <?php if(isset($category['name'])) echo $category['name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="category_input">Which sub categories do you like?</label>
            <select name="subcategory[]" multiple class="form-control" id="category_input">
                <?php foreach($subCategories as $subCategory) { ?>
                    <option value="<?php if(isset($subCategory['name'])) echo $subCategory['name']; ?>">
                        <?php if(isset($subCategory['name'])) echo $subCategory['name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mb-4 btn-block">Choose</button>
    </form>
<?php include ROOT . '/views/layouts/footer.php'; ?>