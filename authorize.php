<?php
    session_start();
    require_once 'inc/connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" 
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
            crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <title>Авторизация</title>
</head>
<body>
    <form class="reg" method="post" action="inc/authorize.php">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Ваш логин:</label>
            <input type="text" class="form-control"aria-describedby="emailHelp" name="login">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Ваш пароль:</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
        <p class="isAutho">
            У вас еще нет аккаунта? | <a href="index.php">регистрация</a>
        </p>
        <?php 
            if($_SESSION['message']){
                echo '<p class="msg">' . $_SESSION['message'] . '</p>';
            }
            unset($_SESSION['message']);
        ?>
    </form>
</body>
</html>