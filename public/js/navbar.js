document.addEventListener("DOMContentLoaded", function () {
    const navbarHTML = `
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #343a40;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="../img/ascend_stats_circle_border.png" alt="Erro ao carregar imagem" width="60" height="60">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item" style="margin-right: 10px;">
                    <a class="nav-link" href="../index.php" data-page="index">Ascend Stats</a>
                </li>
                <li class="nav-item" style="margin-right: 10px;">
                    <a class="nav-link" href="../players.php" data-page="players">Jogadores</a>
                </li>
                <li class="nav-item" style="margin-right: 10px;">
                    <a class="nav-link" href="colaborators.php" data-page="colaborators">Colaboradores</a>
                </li>
            </ul>
            <form class="d-flex" role="search" style="margin-right: 10px;">
                <input id="text-search-player" class="form-control me-4" type="search" placeholder="Nome do jogador" aria-label="Search">
                <button id="btn-search-player" class="btn btn-outline-light">Buscar</button>
            </form>
            <form class="d-flex" role="search" action="../actions/action_logout.php">
                <button id="btn-exit" class="btn btn-danger">Sair</button>
            </form>
        </div>
    </div>
</nav>
    `;

    const navbarContainer = document.getElementById("navbar-header");
    if (navbarContainer) {
        navbarContainer.innerHTML = navbarHTML;

        const currentPage = window.location.pathname.split('/').pop().split('.')[0];
        const navLinks = navbarContainer.querySelectorAll('.nav-link');

        navLinks.forEach(link => {
            const pageData = link.getAttribute('data-page');
            if (pageData === currentPage) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });

    } else {
        console.error('Elemento com id "navbar-header" não encontrado.');
    }
});