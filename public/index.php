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
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/navbar-styles.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
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
                            <a href="#dashboard" class="nav-link active">
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

                <!-- Menu Mobile Toggle -->
                <button class="mobile-toggle" id="mobileToggle">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
            </div>

            <!-- Menu Mobile -->
            <div class="mobile-menu" id="mobileMenu">
                <div class="mobile-menu-content">
                    <ul class="mobile-nav-links">
                        <li class="mobile-nav-item">
                            <a href="#dashboard" class="mobile-nav-link active">
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
                <div class="col-md-1">
                </div>
                <div class="col-md-5 pizza-chart">
                    <div id="pizza-chart"></div>
                </div>
            </div>
            <div class="row dashboard-charts">
                <div id="recently-activity">
                    <h3>Atividades Recentes</h3>
                    <ul id="activity-list">
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <footer id="footer-footer" class="bg-dark text-white py-4 mt-7"></footer>

    <script src="js/on_open.js"></script>
    <script src="js/navbar-script.js"></script>
    <script src="js/utils.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tYhFbargfWtaeZUBDzF4A1jzE+4jBGTFe1m5b0jaQmAzm0fj1Qp6F8Q+" crossorigin="anonymous"></script>
    <script src="js/footer.js"></script>
    <script src="js/search_player.js"></script>
</body>
</html>