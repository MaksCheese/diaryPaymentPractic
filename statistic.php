<?php
    session_start();
    require_once 'inc/connect.php';

    $userID = $_GET['id'];
    $userLogin = $_SESSION['user']['login'];
    $tableName = 'tableoleg1' ;

    $arrTargets = mysqli_fetch_all(mysqli_query($link, "SELECT target FROM tableoleg1 "));
    $arrForGraph = [];
    foreach($arrTargets as $target){
        $arrForGraph[] = $target[0];
    }
    $arrForGraphSum = [];
    $arrSumEnd = mysqli_fetch_all(mysqli_query($link, "SELECT sumEnded FROM tableoleg1 "));
    foreach($arrSumEnd as $sumEnd){
        $arrForGraphSum[] = $sumEnd[0];
    }

    $categoryArr = [];
    $sumAuto = mysqli_fetch_all(mysqli_query($link, "SELECT SUM(sumTransaction) FROM tableoleg1 WHERE category = 'Автомобиль'"));
    foreach($sumAuto as $sumAuto2){
        $categoryArr[] = $sumAuto2[0];
    }
    $sumClothes = mysqli_fetch_all(mysqli_query($link, "SELECT SUM(sumTransaction) FROM tableoleg1 WHERE category = 'Одежда'"));
    foreach($sumClothes as $sumClothes2){
        $categoryArr[] = $sumClothes2[0];
    }
    $sumFood = mysqli_fetch_all(mysqli_query($link, "SELECT SUM(sumTransaction) FROM tableoleg1 WHERE category = 'Питание'"));
    foreach($sumFood as $sumFood2){
        $categoryArr[] = $sumFood2[0];
    }
    $sumGift = mysqli_fetch_all(mysqli_query($link, "SELECT SUM(sumTransaction) FROM tableoleg1 WHERE category = 'Подарки'"));
    foreach($sumGift as $sumGift2){
        $categoryArr[] = $sumGift2[0];
    }
    $sumServ = mysqli_fetch_all(mysqli_query($link, "SELECT SUM(sumTransaction) FROM tableoleg1 WHERE category = 'Услуги'"));
    foreach($sumServ as $sumServ2){
        $categoryArr[] = $sumServ2[0];
    }
    $sumIncome = mysqli_fetch_all(mysqli_query($link, "SELECT SUM(sumTransaction) FROM tableoleg1 WHERE category = 'Доходы'"));
    foreach($sumIncome as $sumIncome2){
        $categoryArr[] = $sumIncome2[0];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Моя страница</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" 
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
            crossorigin="anonymous">
    <link rel="stylesheet" href="css/statistic.css">
    <link rel="stylesheet" href="css/nav.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php include 'templates/nav.php';?>
    <div class="content" style="padding-tp: 500px">
        <div style="width: 1000px; height:600px; margin-top: 100px"><canvas id="myChart"></canvas></div>
        <h3>Транзакции по категориям:</h3>
        <div style="width: 700px; height:700px"><canvas id="myChart2"></canvas></div>
    </div>
    <script>
        const data = {
            labels: <?php echo json_encode($arrForGraph);?>,
            datasets: [
                {
                    label: 'Ваши транзакции',
                    data: <?php echo json_encode($arrForGraphSum);?>,
                    fill: false,
                    borderColor: 'rgb(153, 50, 204)',
                    tension: 0.5
                }
            ]
        };
        const config = {
            type: 'line',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>

    <script>
        var ctx = document.getElementById('myChart2');
        var doughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Авто', 'Одежда', 'Питание', 'Подарки', 'Услуги', 'Доходы'],
                datasets: [{
                    label: 'Расходы',
                    data: <?php echo json_encode($categoryArr);?>,
                    backgroundColor: [
                        'rgba(255, 20, 147, 0.3)',
                        'rgba(25, 25, 112, 0.3)',
                        'rgba(255, 69, 0, 0.3)',
                        'rgba(255, 0, 0, 0.3)',
                        'rgba(154, 205, 50, 0.3)',
                        'rgba(139, 0, 139, 0.3)',
                        'rgba(255, 255, 0, 0.3)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        });
    </script>
</body>
</html>