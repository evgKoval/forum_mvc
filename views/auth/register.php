<?php include ROOT . '/views/layouts/header.php'; ?>
    <h1 class="mb-4">Register</h1>
    <form method="POST">
        <input type="hidden" name="register">
        <div class="form-group">
            <label for="firstname_input">First name</label>
            <input name="firstname" type="text" class="form-control" id="firstname_input" placeholder="Enter your first name..." value="<?php echo isset($firstname) ? $firstname : ''; ?>">
        </div>
        <div class="form-group">
            <label for="lastname_input">Last name</label>
            <input name="lastname" type="text" class="form-control" id="lastname_input" placeholder="Enter your last name..." value="<?php echo isset($lastname) ? $lastname : ''; ?>">
        </div>
        <div class="form-group">
            <label for="email_input">Email</label>
            <input name="email" type="text" class="form-control" id="email_input" placeholder="example@gmail.com" value="<?php echo isset($email) ? $email : ''; ?>">
        </div>
        <div class="form-group">
            <label for="password_input">Password</label>
            <input name="password" type="password" class="form-control" id="password_input" placeholder="Enter your password...">
        </div>
        <div class="form-group">
            <label for="confirm_password_input">Confirm password</label>
            <input name="confirm_password" type="password" class="form-control" id="confirm_password_input" placeholder="Confirm your password...">
        </div>
        <button type="submit" class="btn btn-primary mb-4 btn-block">Register</button>
    </form>
    <?php if (isset($errors) && is_array($errors)) { ?>
        <div class="alert alert-danger" role="alert">
            <?php foreach ($errors as $error) { ?>
                <li><?php echo $error; ?></li>
            <?php } ?>
        </div>
    <?php } ?>
<?php include ROOT . '/views/layouts/footer.php'; ?>