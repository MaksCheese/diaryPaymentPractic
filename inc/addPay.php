<?php
    session_start();
    require_once 'connect.php';

    $userID = $_SESSION['user']['id'];
    $userLogin = $_SESSION['user']['login'];

    $tableName = 'table' . $userLogin . $userID;

    $sum = $_POST['sum'];
    $target = $_POST['title'];
    $action = $_POST['action'];
    $category = $_POST['category'];

    $today =  date("F j, Y, g:i a");

    // id | имя_пользователя | цель_транзакции | сумма | итоговая_сумма

    mysqli_query($link, "CREATE TABLE IF NOT EXISTS `payment`.`".$tableName."` 
                                                                (`id` INT NOT NULL AUTO_INCREMENT,
                                                                `userLogin` VARCHAR(255) NOT NULL,
                                                                `target` VARCHAR(255) NOT NULL,
                                                                `category` VARCHAR(255) NOT NULL,
                                                                `sumTransaction` INT(30) NOT NULL,
                                                                `sumEnded` INT(30) NOT NULL,
                                                                `date` VARCHAR(50) NULL,
                                                                PRIMARY KEY (`id`)) ENGINE = InnoDB;");

    $arrSum = mysqli_fetch_all(mysqli_query($link, "SELECT sumEnded FROM `$tableName` ORDER BY id DESC LIMIT 1"));
    foreach($arrSum as $sumEnd){}
    $endSum = $sumEnd[0]; 

    mysqli_query($link, "INSERT INTO $tableName SET id = NULL,
                                                        userLogin = '$userLogin',
                                                        target = '$target',
                                                        category = '$category',
                                                        sumTransaction = '$sum',
                                                        sumEnded = sumEnded + sumTransaction,
                                                        date = '$today'
                                                        ");

    if($action === '+'){
        mysqli_query($link, "UPDATE $tableName SET sumEnded = ".$endSum." + ".$sum." ORDER BY id DESC LIMIT 1");
    } else{
        mysqli_query($link, "UPDATE $tableName SET sumEnded = ".$endSum." - ".$sum." ORDER BY id DESC LIMIT 1");
    }
    header('Location: ../myPage.php?id='.$userID);