<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Forum_MVC</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        <?php include ROOT . '/css/style.css'; ?>
    </style>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
    <header class="mb-3">
        <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-start">
            <div class="d-flex mr-auto align-items-center">
                <a class="navbar-brand" href="/">Blog</a>
                <?php include ROOT . '/views/layouts/search.php'; ?>
            </div>
            <nav>
                <?php if(!isset($_SESSION['user'])) { ?>
                    <div class="btn-group" role="group">
                        <a href="/login" class="btn btn-outline-dark">Login</a>
                        <a href="/register" class="btn btn-outline-dark">Register</a>
                    </div>
                <?php } else { ?>
                    <span class="mr-3"><?php if(isset($_SESSION['user']['email'])) echo $_SESSION['user']['email'] ?></span>
                    <div class="btn-group" role="group">
                        <a href="/preferences" class="btn btn-outline-dark">Preferences</a>
                        <a href="/profile" class="btn btn-outline-dark">Profile</a>
                        <a href="/logout" class="btn btn-outline-dark">Logout</a>
                    </div>
                <?php } ?>
            </nav>
        </nav>
    </header>
    <div class="container">