<?php
session_start();
! $_SESSION['auth'] && header('Location: login-screen.html');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player | Ascend Stats</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="css/player_stats.css" rel="stylesheet">
</head>
<body>
    <header id="navbar-header"></header>

    <main class="main-container">
        <div class="row mt-2 box-player">
            <div class="col-md-4">
                <div class="img-player">
                    <img id="player-img" class="img-player" src="" alt="Erro ao carregar imagem do jogador"
                        width="320px" height="420px">
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-player"></div>
            </div>
            <div class="col-md-4">
                <div class="radar-chart-container">
                    <canvas id="radarChart">
                    </canvas>
                </div>
            </div>
        </div>
        <div class="row mt-1 box-player">
            <div class="col-12">
                <div class="text-center">
                    <h1>Atributos</h1>
                    <div id="atributos-container" class="container d-flex justify-content-center flex-column align-items-center"></div>
                </div>
            </div>
        </div>
    </main>

    <footer id="footer-footer" class="bg-dark text-white py-4 mt-7"></footer>

    <script src="js/on_load_player_stats.js"></script>
    <script src="js/utils.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tYhFbargfWtaeZUBDzF4A1jzE+4jBGTFe1m5b0jaQmAzm0fj1Qp6F8Q+" crossorigin="anonymous"></script>
    <script src="js/navbar.js"></script>
    <script src="js/footer.js"></script>
    <script src="js/search_player.js"></script>
</body>
</html>
