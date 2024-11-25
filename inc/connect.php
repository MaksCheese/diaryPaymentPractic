<?php
    $link = mysqli_connect('localhost', 'root', '', 'payment');
    if(!$link){
        die("Ошибка подключения к БД!");
    }