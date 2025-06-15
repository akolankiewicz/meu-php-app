document.addEventListener("DOMContentLoaded", function () {
    const buttons = `
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row mt-2">
                <div class="col-md-6">
                    <button class="btn-purple w-100" id="advanced-filter-button"><i class="bi bi-funnel-fill me-2"></i>
                        Abrir filtros avançados</button>
                </div>
                <div class="col-md-6">
                    <button id="btn-open-player-register" class="btn-blue w-100"><i class="bi bi-plus-circle-fill me-2"></i>
                        Cadastrar novo jogador</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="filters" id="filters"></div>
    </div>
</div>
`;

    const buttonsField = document.getElementById('buttons');
    if (buttonsField) {
        buttonsField.innerHTML = buttons;
        addQuickFilters();
    }

    const filtersField = document.getElementById("filters");
    if (filtersField) {
        const advancedFilterButton = document.getElementById("advanced-filter-button");
        if (advancedFilterButton) {
            advancedFilterButton.addEventListener("click", function() {
                if (advancedFilterButton.textContent.includes("Abrir filtros avançados")) {
                    advancedFilterButton.innerHTML = '<i class="bi bi-lightning-fill me-2"></i>Abrir filtros rápidos';
                    addAdvancedFilters();
                } else {
                    advancedFilterButton.innerHTML = '<i class="bi bi-funnel-fill me-2"></i>Abrir filtros avançados';
                    addQuickFilters();
                }
            });
        } else {
            console.error('Botão com id "advanced-filter-button" não encontrado.');
        }

    } else {
        console.error('Elemento com id "quick-filters" não encontrado.');
    }

    const buttonOpenPlayerRegister = document.getElementById('btn-open-player-register');
    if (buttonOpenPlayerRegister) {
        buttonOpenPlayerRegister.addEventListener('click', openPlayerRegisterFields);
    }
});