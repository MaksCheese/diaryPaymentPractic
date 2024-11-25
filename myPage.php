<?php
    session_start();
    require_once 'inc/connect.php';

    $userID = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Моя страница</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" 
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
            crossorigin="anonymous">
    <link rel="stylesheet" href="css/myPage.css">
    <link rel="stylesheet" href="css/nav.css">
    <title>Моя страница</title>
</head>
<body>
    <?php include 'templates/nav.php';?>
    <div class="content">
        <div class="form">
            <form class="add" action="inc/addPay.php" method="post">
                <label class="label" for="">Введите сумму транзакции</label>
                <input name="sum" class="form-control input"type="text"></input>
                <label class="label" for="">Введите цель транзакции</label>
                <input name="title" class="form-control input"type="text"></input>
                <label class="label" for="">Категория</label>
                <select class= "select" name="category" id="">
                    <option value="Автомобиль">Автомобиль</option>
                    <option value="Здоровье">Здоровье</option>
                    <option value="Одежда">Одежда</option>
                    <option value="Питание">Питание</option>
                    <option value="Подарки">Подарки</option>
                    <option value="Услуги">Услуги</option>
                    <option value="Доходы">Доходы</option>
                </select>
                <select class="select" name="action" id="">
                    <option value="+">Прибавить</option>
                    <option value="+">Прибавить</option>
                    <option value="-">Вычесть</option>
                </select>
                <div class="button"><button type="submit" class="btn btn-primary">Добавить</button></div>
            </form>
        </div>
    </div>
</body>
</html>