<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Forum_MVC</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        <?php include ROOT . '/css/style.css'; ?>
    </style>
</head>
<body>
    <header class="mb-3">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand mr-auto" href="/content">Blog</a>
            <nav>
                <?php if(!isset($_SESSION['firstname'])) { ?>
                    <div class="btn-group" role="group">
                        <a href="login" class="btn btn-outline-dark">Login</a>
                        <a href="register" class="btn btn-outline-dark">Register</a>
                    </div>
                <?php } ?>

                <?php if(isset($_SESSION['firstname'])) { ?>
                    <div class="btn-group" role="group">
                        <a href="profile" class="btn btn-outline-dark">Profile</a>
                        <a href="logout" class="btn btn-outline-dark">Logout</a>
                    </div>
                <?php } ?>
            </nav>
        </nav>
    </header>
    <div class="container">