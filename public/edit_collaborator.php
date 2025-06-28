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
    <link rel="stylesheet" href="css/navbar-styles.css">
    <link rel="stylesheet" href="css/edit_collaborator.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/footer.css">
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
                        <a href="players.php" class="mobile-nav-link">
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

<main class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-header">
                    <h1 class="page-title">
                        <i class="bi bi-person-fill-gear"></i>
                        Editar Colaborador
                    </h1>
                    <div class="breadcrumb-nav">
                        <a href="collaborators.php" class="breadcrumb-link">
                            <i class="bi bi-arrow-left"></i>
                            Voltar aos Colaboradores
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="edit-card">
                    <form id="collaboratorForm" class="collaborator-form">
                        <input type="hidden" id="collaboratorId" name="id">

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

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">E-mail *</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="telefone" class="form-label">Telefone</label>
                                        <input type="tel" class="form-control" id="telefone" name="telefone" maxlength="20">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="type_user" class="form-label">Tipo de Usuário *</label>
                                        <select class="form-control" id="type_user" name="type_user" required>
                                            <option value="">Selecione...</option>
                                            <?php if ($_SESSION['type_user'] == 1) { ?>
                                                <option value="1">Administrador</option>
                                            <?php } ?>
                                            <option value="2">Analista</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h4 class="section-title">
                                <i class="bi bi-geo-alt"></i>
                                Endereço
                            </h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cidade" class="form-label">Cidade</label>
                                        <input type="text" class="form-control" id="cidade" name="cidade" maxlength="50">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="estado" class="form-label">Estado</label>
                                        <select class="form-control" id="estado" name="estado">
                                            <option value="">Selecione...</option>
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amapá</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Ceará</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Espírito Santo</option>
                                            <option value="GO">Goiás</option>
                                            <option value="MA">Maranhão</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Pará</option>
                                            <option value="PB">Paraíba</option>
                                            <option value="PR">Paraná</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piauí</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rondônia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">São Paulo</option>
                                            <option value="SE">Sergipe</option>
                                            <option value="TO">Tocantins</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="endereco" class="form-label">Endereço</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco" maxlength="50">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h4 class="section-title">
                                <i class="bi bi-shield-lock"></i>
                                Segurança
                            </h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="senha" class="form-label">Nova Senha</label>
                                        <div class="password-input-container">
                                            <input type="password" class="form-control" id="senha" name="senha" maxlength="155">
                                            <button type="button" class="password-toggle" id="togglePassword">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        <small style="color: #777777">* Não altere para manter a senha atual</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirm_senha" class="form-label">Confirmar Nova Senha</label>
                                        <div class="password-input-container">
                                            <input type="password" class="form-control" id="confirm_senha" name="confirm_senha" maxlength="155">
                                            <button type="button" class="password-toggle" id="toggleConfirmPassword">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                                <i class="bi bi-arrow-left"></i>
                                Fechar
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

<script src="js/on_open.js"></script>
<script src="js/navbar-script.js"></script>
<script src="js/utils.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script src="js/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="js/footer.js"></script>
<script src="js/edit_collaborator.js"></script>
</body>
</html>