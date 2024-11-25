<?php
    session_start();
    require_once 'connect.php';

$login = $_POST['login'];
$password = sha1($_POST['password']);

$checkUser = mysqli_query($link, "SELECT * FROM users WHERE login = '$login' AND password = '$password'");

if(mysqli_num_rows($checkUser) > 0){
    $user = mysqli_fetch_assoc($checkUser);
    $_SESSION['user'] = [
        "id" => $user['id'],
        "login" => $user['login'],
    ];
    $userID = $_SESSION['user']['id'];
    header('Location: ../myPage.php?id='.$userID);
}