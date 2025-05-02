<?php
    session_start();
    ! $_SESSION['auth'] && header('Location: login-screen.html');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dash | Ascend Stats</title>
    <link rel="icon" href="img/ascend_stats_circle_border.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<header id="navbar-header"></header>

<section class="login-intro">
    <h1 class="principal-title">Bem-vindo <b id="session-user-name"></b>, ao maior site de monitoramento de jogadores em ascensão do Brasil!</h1>
</section>

<main>

</main>

<div class="dashboard">
    <div class="container">
        <div class="container mt-4 dashboard-cards">
            <div class="row g-4" id="dashboard-cards">
            </div>
        </div>
        <div class="row dashboard-charts">
            <div class="col-md-6 bar-chart">
                <div id="bar-chart"></div>
            </div>
            <div class="col-md-6 pizza-chart">
                <div id="pizza-chart"></div>
            </div>
        </div>
    </div>
</div>

<footer id="footer-footer" class="bg-dark text-white py-4 mt-7"></footer>

<script src="js/on_open.js"></script>
<script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script src="js/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tYhFbargfWtaeZUBDzF4A1jzE+4jBGTFe1m5b0jaQmAzm0fj1Qp6F8Q+" crossorigin="anonymous"></script>
<script src="js/navbar.js"></script>
<script src="js/footer.js"></script>
<script src="js/search_player.js"></script>
</body>
</html>