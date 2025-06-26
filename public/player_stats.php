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
    <link rel="icon" href="img/ascend_stats_circle_border.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="css/player_stats.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="css/footer.css" rel="stylesheet">
    <link href="css/navbar-styles.css" rel="stylesheet">
</head>
<body>
<header id="navbar-header">
    <nav class="modern-navbar">
        <div class="navbar-container">
            <div class="navbar-logo">
                <div class="logo-container">
                    <img src="img/ascend_stats_circle_border.png" alt="Logo" class="logo-image" id="logoImage">
                    <div class="logo-placeholder" id="logoPlaceholder">
                        <i class="bi bi-hexagon-fill logo-icon"></i>
                    </div>
                </div>
                <span class="brand-name">Ascend Stats</span>
            </div>

            <div class="navbar-menu" id="navbarMenu">
                <ul class="nav-links">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">
                            <i class="bi bi-speedometer2 nav-icon"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="players.php" class="nav-link">
                            <i class="bi bi-people-fill nav-icon"></i>
                            <span>Jogadores</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#colaboradores" class="nav-link">
                            <i class="bi bi-person-badge-fill nav-icon"></i>
                            <span>Colaboradores</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="navbar-actions">
                <form action="actions/action_logout.php">
                    <button class="logout-btn" id="logoutBtn">
                        <i class="bi bi-box-arrow-right logout-icon"></i>
                        <span class="logout-text">Logout</span>
                    </button>
                </form>
            </div>

            <button class="mobile-toggle" id="mobileToggle">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
        </div>

        <div class="mobile-menu" id="mobileMenu">
            <div class="mobile-menu-content">
                <ul class="mobile-nav-links">
                    <li class="mobile-nav-item">
                        <a href="index.php" class="mobile-nav-link">
                            <i class="bi bi-speedometer2 mobile-nav-icon"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="mobile-nav-item">
                        <a href="players.php" class="mobile-nav-link">
                            <i class="bi bi-people-fill mobile-nav-icon"></i>
                            <span>Jogadores</span>
                        </a>
                    </li>
                    <li class="mobile-nav-item">
                        <a href="#colaboradores" class="mobile-nav-link">
                            <i class="bi bi-person-badge-fill mobile-nav-icon"></i>
                            <span>Colaboradores</span>
                        </a>
                    </li>
                </ul>
                <div class="mobile-logout">
                    <form action="actions/action_logout.php">
                        <button class="mobile-logout-btn">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</header>

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
            <div id="player-stats-buttons"></div>
        </div>
        <div class="row mt-1 box-player">
            <div class="col-md-12">
                <div class="text-center">
                    <h1>Atributos</h1>
                    <div id="atributos-container" class="container d-flex justify-content-center flex-column align-items-center"></div>
                </div>
            </div>
        </div>
    </main>

    <footer id="footer-footer" class="bg-dark text-white py-4 mt-7"></footer>

    <script src="js/navbar-script.js"></script>
    <script src="js/on_open.js"></script>
    <script src="js/on_load_player_stats.js"></script>
    <script src="js/utils.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/footer.js"></script>
    <script src="js/search_player.js"></script>
</body>
</html>
