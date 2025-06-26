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
    <link rel="stylesheet" href="css/edit.css">
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

<main class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-header">
                    <h1 class="page-title">
                        <i class="bi bi-person-fill-gear"></i>
                        Editar Jogador
                    </h1>
                    <div class="breadcrumb-nav">
                        <a href="players.php" class="breadcrumb-link">
                            <i class="bi bi-arrow-left"></i>
                            Voltar aos Jogadores
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="edit-card">

                    <form id="playerForm" class="player-form">
                        <input type="hidden" id="playerId" name="id">

                        <div class="form-section">
                            <h4 class="section-title">
                                <i class="bi bi-person-circle"></i>
                                Dados Pessoais
                            </h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nome" class="form-label">Nome Completo *</label>
                                        <input type="text" class="form-control" id="nome" name="nome" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nacionalidade" class="form-label">Nacionalidade</label>
                                        <input type="text" class="form-control" id="nacionalidade" name="nacionalidade">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="peso" class="form-label">Peso (kg)</label>
                                        <input type="number" class="form-control" id="peso" name="peso" step="0.01" min="0" max="999.99">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="altura" class="form-label">Altura (m)</label>
                                        <input type="number" class="form-control" id="altura" name="altura" step="0.01" min="0" max="9.99">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="posicao" class="form-label">Posição</label>
                                        <select class="form-control" id="posicao" name="posicao">
                                            <option value="">Posição</option>
                                            <option value="GOL">Goleiro</option>
                                            <option value="ZAG">Zagueiro</option>
                                            <option value="MEI">Meio-campo</option>
                                            <option value="ATA">Atacante</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="clube" class="form-label">Clube</label>
                                        <input type="text" class="form-control" id="clube" name="clube">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h4 style="text-align: center; color:#606060;">A imagem não é alterável</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h4 class="section-title">
                                <i class="bi bi-lightning-charge"></i>
                                Atributos Físicos
                            </h4>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="aceleracao" class="form-label">Aceleração</label>
                                        <input type="range" class="form-range" id="aceleracao" name="aceleracao" min="0" max="100" value="50">
                                        <div class="range-value" data-target="aceleracao">50</div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pique" class="form-label">Pique</label>
                                        <input type="range" class="form-range" id="pique" name="pique" min="0" max="100" value="50">
                                        <div class="range-value" data-target="pique">50</div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="agilidade" class="form-label">Agilidade</label>
                                        <input type="range" class="form-range" id="agilidade" name="agilidade" min="0" max="100" value="50">
                                        <div class="range-value" data-target="agilidade">50</div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="equilibrio" class="form-label">Equilíbrio</label>
                                        <input type="range" class="form-range" id="equilibrio" name="equilibrio" min="0" max="100" value="50">
                                        <div class="range-value" data-target="equilibrio">50</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="impulsao" class="form-label">Impulsão</label>
                                        <input type="range" class="form-range" id="impulsao" name="impulsao" min="0" max="100" value="50">
                                        <div class="range-value" data-target="impulsao">50</div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="folego" class="form-label">Fôlego</label>
                                        <input type="range" class="form-range" id="folego" name="folego" min="0" max="100" value="50">
                                        <div class="range-value" data-target="folego">50</div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="forca" class="form-label">Força</label>
                                        <input type="range" class="form-range" id="forca" name="forca" min="0" max="100" value="50">
                                        <div class="range-value" data-target="forca">50</div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="reacao" class="form-label">Reação</label>
                                        <input type="range" class="form-range" id="reacao" name="reacao" min="0" max="100" value="50">
                                        <div class="range-value" data-target="reacao">50</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h4 class="section-title">
                                <i class="bi bi-gear"></i>
                                Atributos Técnicos
                            </h4>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="finalizacao" class="form-label">Finalização</label>
                                        <input type="range" class="form-range" id="finalizacao" name="finalizacao" min="0" max="100" value="50">
                                        <div class="range-value" data-target="finalizacao">50</div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="forca_do_chute" class="form-label">Força do Chute</label>
                                        <input type="range" class="form-range" id="forca_do_chute" name="forca_do_chute" min="0" max="100" value="50">
                                        <div class="range-value" data-target="forca_do_chute">50</div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="chute_de_longe" class="form-label">Chute de Longe</label>
                                        <input type="range" class="form-range" id="chute_de_longe" name="chute_de_longe" min="0" max="100" value="50">
                                        <div class="range-value" data-target="chute_de_longe">50</div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="penalti" class="form-label">Pênalti</label>
                                        <input type="range" class="form-range" id="penalti" name="penalti" min="0" max="100" value="50">
                                        <div class="range-value" data-target="penalti">50</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="controle_de_bola" class="form-label">Controle de Bola</label>
                                        <input type="range" class="form-range" id="controle_de_bola" name="controle_de_bola" min="0" max="100" value="50">
                                        <div class="range-value" data-target="controle_de_bola">50</div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="drible" class="form-label">Drible</label>
                                        <input type="range" class="form-range" id="drible" name="drible" min="0" max="100" value="50">
                                        <div class="range-value" data-target="drible">50</div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="curva" class="form-label">Curva</label>
                                        <input type="range" class="form-range" id="curva" name="curva" min="0" max="100" value="50">
                                        <div class="range-value" data-target="curva">50</div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="precisao_no_cabeceio" class="form-label">Precisão no Cabeceio</label>
                                        <input type="range" class="form-range" id="precisao_no_cabeceio" name="precisao_no_cabeceio" min="0" max="100" value="50">
                                        <div class="range-value" data-target="precisao_no_cabeceio">50</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h4 class="section-title">
                                <i class="bi bi-arrow-right-circle"></i>
                                Atributos de Passe
                            </h4>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="visao_de_jogo" class="form-label">Visão de Jogo</label>
                                        <input type="range" class="form-range" id="visao_de_jogo" name="visao_de_jogo" min="0" max="100" value="50">
                                        <div class="range-value" data-target="visao_de_jogo">50</div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cruzamento" class="form-label">Cruzamento</label>
                                        <input type="range" class="form-range" id="cruzamento" name="cruzamento" min="0" max="100" value="50">
                                        <div class="range-value" data-target="cruzamento">50</div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="passe_curto" class="form-label">Passe Curto</label>
                                        <input type="range" class="form-range" id="passe_curto" name="passe_curto" min="0" max="100" value="50">
                                        <div class="range-value" data-target="passe_curto">50</div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="passe_longo" class="form-label">Passe Longo</label>
                                        <input type="range" class="form-range" id="passe_longo" name="passe_longo" min="0" max="100" value="50">
                                        <div class="range-value" data-target="passe_longo">50</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h4 class="section-title">
                                <i class="bi bi-shield-check"></i>
                                Atributos Defensivos
                            </h4>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="agressividade" class="form-label">Agressividade</label>
                                        <input type="range" class="form-range" id="agressividade" name="agressividade" min="0" max="100" value="50">
                                        <div class="range-value" data-target="agressividade">50</div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="interceptacao" class="form-label">Interceptação</label>
                                        <input type="range" class="form-range" id="interceptacao" name="interceptacao" min="0" max="100" value="50">
                                        <div class="range-value" data-target="interceptacao">50</div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nocao_defensiva" class="form-label">Noção Defensiva</label>
                                        <input type="range" class="form-range" id="nocao_defensiva" name="nocao_defensiva" min="0" max="100" value="50">
                                        <div class="range-value" data-target="nocao_defensiva">50</div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="desarme" class="form-label">Desarme</label>
                                        <input type="range" class="form-range" id="desarme" name="desarme" min="0" max="100" value="50">
                                        <div class="range-value" data-target="desarme">50</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="carrinho" class="form-label">Carrinho</label>
                                        <input type="range" class="form-range" id="carrinho" name="carrinho" min="0" max="100" value="50">
                                        <div class="range-value" data-target="carrinho">50</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                                <i class="bi bi-arrow-left"></i>
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle"></i>
                                Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

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
<script src="js/edit_player.js"></script>
</body>
</html>
