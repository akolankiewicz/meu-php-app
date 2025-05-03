document.addEventListener("DOMContentLoaded", function () {
    const quickFiltersHTML = `
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row mt-2"> 
                <div class="col-md-6">
                    <button class="btn btn-secondary btn-sm w-100"><i class="bi bi-funnel-fill me-2"></i>Abrir filtros avançados</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary btn-sm w-100"><i class="bi bi-plus-circle-fill me-2"></i>Cadastrar novo jogador</button>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="i1"></label><input type="text" class="form-control form-control-sm" id="i1" placeholder="Nome">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="position" class="form-label"></label>
                        <select class="form-select form-select-sm" id="position">
                            <option value="POS">Posição</option>
                            <option value="ATA">ATA</option>
                            <option value="MEI">MEI</option>
                            <option value="ZAG">ZAG</option>
                            <option value="GOL">GOL</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="i3"></label><label for="i2"></label><input type="text" class="form-control form-control-sm" id="i2" placeholder="Clube">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="i4"></label><input name="btn-filter-players" id="btn-filter-players"
                              type="submit" class="form-control form-control-sm btn-filter-players"
                                    value="Filtrar">
                    </div>
                </div>
            </div>
        </div>
<!--        <div class="col-md-3 d-flex align-items-center justify-content-end"> <img src="../img/ascend_stats_shirt.png" alt="erro" width="100%">-->
<!--        </div>-->
    </div>
</div>
`;

    const quickFiltersField = document.getElementById("quick-filters");
    if (quickFiltersField) {
        quickFiltersField.innerHTML = quickFiltersHTML;
    } else {
        console.error('Elemento com id "navbar-header" não encontrado.');
    }
});