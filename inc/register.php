<?php
    session_start();
    require_once 'connect.php';

    $login = $_POST['login'];
    $password = $_POST['password'];
    $password_check = $_POST['password_check'];

    mysqli_query($link, "CREATE TABLE IF NOT EXISTS `payment`.`users` ( `id` INT NOT NULL AUTO_INCREMENT,
                                                                            `login` VARCHAR(255) NOT NULL,
                                                                            `password` VARCHAR(255) NOT NULL,
                                                                            PRIMARY KEY (`id`)) ENGINE = InnoDB;");
    
    $checkLogin = mysqli_query($link, "SELECT * FROM users WHERE login = '$login'");

    if(mysqli_num_rows($checkLogin) > 0){
        $_SESSION['message'] = 'Такой логин уже существует';
        header('Location: ../index.php');
    } else{
        if($password === $password_check){
            $password = sha1($password);
            mysqli_query($link, "INSERT INTO `users` (`id`, `login`, `password`)
                                            VALUES(NULL, '$login', '$password')");
            $_SESSION['message'] = 'Регистрация прошла успешно!';
            header('Location: ../authorize.php');
        } else{
            $_SESSION['message'] = 'Пароли не совпадают';
            header('Location: ../index.php');
        }
    }

    
    