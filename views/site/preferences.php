<?php include ROOT . '/views/layouts/header.php'; ?>
    <?php if (isset($_SESSION['flash'])) { ?>
        <div class="alert alert-success" role="alert">
            Your verification is done!
        </div>
    <?php } ?>
    <h1 class="mb-4">Choose your preferences</h1>
    <form method="POST">
        <input type="hidden" name="preferences">
        <div class="form-group">
            <label for="category_input">Which categories do you like?</label>
            <select name="category" class="form-control" id="category_input">
                <?php foreach($categories as $index => $category) { ?>
                    <option value="<?php echo $index + 1; ?>">
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
    <script>
        <?php include 'js/preferences.js'; ?>
    </script>
<?php include ROOT . '/views/layouts/footer.php'; ?>