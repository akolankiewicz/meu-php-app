<?php
session_start();
! $_SESSION['auth'] && header('Location: login-screen.html');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collaborators | Ascend Stats</title>
    <link rel="icon" href="img/ascend_stats_circle_border.png" type="image/x-icon">
    <link rel="stylesheet" href="css/collaborators.css">
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
                        <a href="collaborators.php" class="nav-link active">
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
                        <a href="collaborators.php" class="mobile-nav-link active">
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
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="page-title">
                        <i class="bi bi-person-badge-fill"></i>
                        Colaboradores
                    </h1>
                    <p class="page-subtitle">Gerencie os colaboradores do sistema</p>
                </div>
                <div class="col-md-6 text-end">
                    <button class="btn btn-primary" id="addCollaboratorBtn">
                        <i class="bi bi-person-plus"></i>
                        Novo Colaborador
                    </button>
                    <button class="btn btn-secondary" id="refreshBtn">
                        <i class="bi bi-arrow-clockwise"></i>
                        Atualizar
                    </button>
                </div>
            </div>
        </div>

        <div class="filters-section">
            <div class="row">
                <div class="col-md-4">
                    <div class="search-container">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" class="form-control search-input" id="searchInput" placeholder="Buscar por nome, email ou telefone...">
                        <button class="clear-search" id="clearSearch">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-control filter-select" id="typeFilter">
                        <option value="">Todos os tipos</option>
                        <option value="1">Administrador</option>
                        <option value="2">Analista</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control filter-select" id="sortBy">
                        <option value="nome">Ordenar por Nome</option>
                        <option value="email">Ordenar por Email</option>
                        <option value="type_user">Ordenar por Tipo</option>
                        <option value="cidade">Ordenar por Cidade</option>
                        <option value="data_nascimento">Ordenar por Idade</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-light toggle-order" id="sortOrder" data-order="asc">
                        <i class="bi bi-sort-alpha-down"></i>
                        A-Z
                    </button>
                </div>
            </div>
        </div>

        <div class="stats-section">
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number" id="totalCollaborators">0</h3>
                            <p class="stat-label">Total de Colaboradores</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon admin">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number" id="adminCount">0</h3>
                            <p class="stat-label">Administradores</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon analyst">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number" id="analystCount">0</h3>
                            <p class="stat-label">Analistas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-section">
            <div class="table-header">
                <h3>
                    <i class="bi bi-table"></i>
                    Lista de Colaboradores
                </h3>
                <div class="table-actions">
                    <span class="results-count" id="resultsCount">0 colaboradores encontrados</span>
                </div>
            </div>

            <div class="table-container">
                <div class="table-loading" id="tableLoading">
                    <div class="loading-spinner"></div>
                    <p>Carregando colaboradores...</p>
                </div>

                <table class="table collaborators-table" id="collaboratorsTable">
                    <thead>
                    <tr>
                        <th class="sortable" data-column="id">
                            <span>ID</span>
                            <i class="bi bi-chevron-expand sort-icon"></i>
                        </th>
                        <th class="sortable" data-column="nome">
                            <span>Nome</span>
                            <i class="bi bi-chevron-expand sort-icon"></i>
                        </th>
                        <th class="sortable" data-column="email">
                            <span>Email</span>
                            <i class="bi bi-chevron-expand sort-icon"></i>
                        </th>
                        <th class="sortable" data-column="type_user">
                            <span>Tipo</span>
                            <i class="bi bi-chevron-expand sort-icon"></i>
                        </th>
                        <th class="sortable" data-column="telefone">
                            <span>Telefone</span>
                            <i class="bi bi-chevron-expand sort-icon"></i>
                        </th>
                        <th class="sortable" data-column="cidade">
                            <span>Cidade</span>
                            <i class="bi bi-chevron-expand sort-icon"></i>
                        </th>
                        <th class="sortable" data-column="estado">
                            <span>Estado</span>
                            <i class="bi bi-chevron-expand sort-icon"></i>
                        </th>
                        <th class="sortable" data-column="data_nascimento">
                            <span>Idade</span>
                            <i class="bi bi-chevron-expand sort-icon"></i>
                        </th>
                        <th class="actions-column">Ações</th>
                    </tr>
                    </thead>
                    <tbody id="collaboratorsTableBody">
                    </tbody>
                </table>

                <div class="empty-state" id="emptyState" style="display: none;">
                    <div class="empty-icon">
                        <i class="bi bi-person-x"></i>
                    </div>
                    <h3>Nenhum colaborador encontrado</h3>
                    <p>Não há colaboradores que correspondam aos filtros aplicados.</p>
                    <button class="btn btn-primary" onclick="clearAllFilters()">
                        <i class="bi bi-funnel"></i>
                        Limpar Filtros
                    </button>
                </div>
            </div>

            <div class="pagination-section">
                <div class="pagination-info">
                    <span id="paginationInfo">Mostrando 0 de 0 colaboradores</span>
                </div>
                <div class="pagination-controls">
                    <button class="btn btn-sm btn-outline-light" id="prevPage" disabled>
                        <i class="bi bi-chevron-left"></i>
                        Anterior
                    </button>
                    <div class="page-numbers" id="pageNumbers">
                    </div>
                    <button class="btn btn-sm btn-outline-light" id="nextPage" disabled>
                        Próxima
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
                <div class="items-per-page">
                    <label>Itens por página:</label>
                    <select class="form-control form-control-sm" id="itemsPerPage">
                        <option value="10">10</option>
                        <option value="25" selected>25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle text-warning"></i>
                    Confirmar Exclusão
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir o colaborador <strong id="deleteCollaboratorName"></strong>?</p>
                <p style="color: black">Esta ação não pode ser desfeita.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">
                    <i class="bi bi-trash"></i>
                    Excluir
                </button>
            </div>
        </div>
    </div>
</div>

<footer id="footer-footer" class="bg-dark text-white py-4 mt-7"></footer>

<script src="js/create_player.js"></script>
<script src="js/add_filters.js"></script>
<script src="js/utils.js"></script>
<script src="js/navbar-script.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="js/collaborators.js"></script>
<script src="js/on_open.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="js/footer.js"></script>
</body>
</html>
