<?php include ROOT . '/views/layouts/header.php'; ?>
    <h1 class="mb-4">Choose your preferences</h1>
    <form method="POST">
        <input type="hidden" name="preferences">
        <div class="form-group">
            <label for="category_input">Which categories do you like?</label>
            <select name="category" class="form-control" id="category_input">
                <?php foreach($categories as $category) { ?>
                    <option value="<?php if(isset($category['id'])) echo $category['id']; ?>">
                        <?php if(isset($category['name'])) echo $category['name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="sub_category_input">Which sub categories do you like?</label>
            <select name="subcategory[]" multiple class="form-control" id="sub_category_input">
            </select>
        </div>
        <button type="submit" class="btn btn-primary mb-4 btn-block">Choose</button>
    </form>
    <?php if(isset($errors) && is_array($errors)) { ?>
        <div class="alert alert-danger" role="alert">
            <?php foreach ($errors as $error) { ?>
                <li><?php echo $error; ?></li>
            <?php } ?>
        </div>
    <?php } ?>
    <script>
        <?php include 'js/preferences.js'; ?>
    </script>
<?php include ROOT . '/views/layouts/footer.php'; ?>