<?php
?>

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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand mr-auto" href="/content">Blog</a>
            <nav>
                <?php if(!isset($_SESSION['user'])) { ?>
                    <div class="btn-group" role="group">
                        <a href="/login" class="btn btn-outline-dark">Login</a>
                        <a href="/register" class="btn btn-outline-dark">Register</a>
                    </div>
                <?php } else { ?>
                    <span class="mr-3"><?php if(isset($_SESSION['user']['email'])) echo $_SESSION['user']['email'] ?></span>
                    <a href="/logout" class="btn btn-outline-dark">Logout</a>
                <?php } ?>
            </nav>
        </nav>
    </header>
    <div class="container">