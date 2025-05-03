<?php
session_start();
! $_SESSION['auth'] && header('Location: login-screen.html');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Players | Ascend Stats</title>
    <link rel="icon" href="img/ascend_stats_circle_border.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>
<body>
    <header id="navbar-header"></header>

    <div class="login-intro">
        <h1 class="principal-title">Aba Jogadores - Aqui poderá encontrar e cadastrar seus jogadores</h1>
        <div id="quick-filters"></div>
    </div>

    <div class="m-5">
        <table class="table table-borderless text-white table-bg">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Posição</th>
                <th scope="col">Peso</th>
                <th scope="col">Altura</th>
                <th scope="col">Idade</th>
                <th scope="col">Data de nascimento</th>
                <th scope="col">Clube Atual</th>
                <th scope="col">Ver Mais</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <footer id="footer-footer" class="bg-dark text-white py-4 mt-7"></footer>

    <script src="js/utils.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="js/player_filters.js"></script>
    <script src="js/on_open.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tYhFbargfWtaeZUBDzF4A1jzE+4jBGTFe1m5b0jaQmAzm0fj1Qp6F8Q+" crossorigin="anonymous"></script>
    <script src="js/navbar.js"></script>
    <script src="js/footer.js"></script>
    <script src="js/search_player.js"></script>
</body>
</html>
