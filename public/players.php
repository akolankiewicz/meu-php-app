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
    <link rel="stylesheet" href="css/players.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" type="text/css" href="css/navbar-styles.css">
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
                            <a href="players.php" class="nav-link active">
                                <i class="bi bi-people-fill nav-icon"></i>
                                <span>Jogadores</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="collaborators.php" class="nav-link">
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
                            <a href="players.php" class="mobile-nav-link active">
                                <i class="bi bi-people-fill mobile-nav-icon"></i>
                                <span>Jogadores</span>
                            </a>
                        </li>
                        <li class="mobile-nav-item">
                            <a href="collaborators.php" class="mobile-nav-link">
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

    <div class="login-intro div-intro">
        <div id="buttons"></div>
        <div id="filters"></div>
        <hr class="mt-3 mb-3">
    </div>

    <div class="m-5">
        <th></th>
        <p style="color: #ffffff; font-size: 20px">Tabela de Jogadores</p>
        <table class="table table-secondary text-white table-bg" style="border: 1px solid dimgrey;">
            <thead>
            <tr>
                <th scope="col" class="player-id">#</th>
                <th scope="col" class="player-name">Nome</th>
                <th scope="col" class="player-position">Posição</th>
                <th scope="col" class="player-weight">Peso</th>
                <th scope="col" class="player-height">Altura</th>
                <th scope="col" class="player-age">Idade</th>
                <th scope="col" class="player-birthdate">Data de nascimento</th>
                <th scope="col" class="player-club">Clube Atual</th>
                <th scope="col" class="player-nacionality">Nacionalidade</th>
                <th scope="col" class="player-details">Ver Mais</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <footer id="footer-footer" class="bg-dark text-white py-4 mt-7"></footer>

    <script src="js/create_player.js"></script>
    <script src="js/add_filters.js"></script>
    <script src="js/utils.js"></script>
    <script src="js/navbar-script.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="js/player_filters.js"></script>
    <script src="js/on_open.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/footer.js"></script>
    <script src="js/search_player.js"></script>
</body>
</html>
