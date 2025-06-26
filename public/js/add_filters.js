function addQuickFilters() {
    const quickFilters = `
    <div class="row mt-2">
        <div class="col-md-3">
            <div class="mb-3">
                <label></label><input type="text" class="form-control form-control-sm" id="filter-name"
                    placeholder="Nome">
            </div>
        </div>
        <div class="col-md-2">
            <div class="mb-3">
                <label></label>
                <select class="form-select form-select-sm" id="filter-position">
                    <option value="POS">Posição</option>
                    <option value="ATA">ATA</option>
                    <option value="MEI">MEI</option>
                    <option value="ZAG">ZAG</option>
                    <option value="GOL">GOL</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="mb-3">
                <label></label><input type="text" class="form-control form-control-sm"
                    id="filter-nationality" placeholder="Nacionalidade">
            </div>
        </div>
        <div class="col-md-2">
            <div class="mb-3">
                <label></label><input type="text" class="form-control form-control-sm"
                    id="filter-club" placeholder="Clube">
            </div>
        </div>
        <div class="col-md-1">
            <div class="mb-3">
                <label></label>
                <select class="form-select form-select-sm" id="filter-order">
                    <option value="order">Ordenar</option>
                    <option value="id">ID</option>
                    <option value="nome">Nome</option>
                    <option value="posicao">Posição</option>
                    <option value="nacionalidade">Nacionalidade</option>
                    <option value="clube">Clube</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="mb-3">
                <label for="i4"></label><input name="btn-filter-players" id="btn-quick-filter-players"
                      type="submit" class="btn-filter form-control form-control-sm"
                            value="Filtrar">
            </div>
        </div>
    </div>
    `;

    const FiltersField = document.getElementById("filters");
    if (FiltersField) {
        FiltersField.innerHTML = quickFilters;
    } else {
        console.error('Elemento com id "filters" não encontrado.');
    }

    const btnFilterPlayer = document.getElementById('btn-quick-filter-players');
    btnFilterPlayer.addEventListener("click", setQuickFilters);
}

function addAdvancedFilters() {
    const advancedFilters = `
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="mb-3">
                <label for="filter-name" style="color: white">Nome do jogador</label>
                <input type="text" class="form-control form-control-sm" id="filter-nome"
                    placeholder="Nome">
            </div>
        </div>
        <div class="col-md-1">
            <div class="mb-3">
                <label for="filter-position" style="color: white">Posição</label>
                <select class="form-select form-select-sm" id="filter-posicao">
                    <option value="">Todas</option>
                    <option value="ATA">ATA</option>
                    <option value="MEI">MEI</option>
                    <option value="ZAG">ZAG</option>
                    <option value="GOL">GOL</option>
                </select>
            </div>
        </div>
        <div class="col-md-1">
            <div class="mb-3">
                <label for="filter-nacionalidade" style="color: white">Nacionalidade</label>
                <input type="text" class="form-control form-control-sm"
                    id="filter-nacionalidade" placeholder="País">
            </div>
        </div>
        <div class="col-md-1">
            <div class="mb-3">
                <label for="filter-peso" style="color: white">Peso</label>
                <input type="number" class="form-control form-control-sm"
                    id="filter-peso" placeholder="000">
            </div>
        </div>
        <div class="col-md-1">
            <div class="mb-3">
                <label for="filter-altura" style="color: white">Altura</label>
                <input type="number" class="form-control form-control-sm"
                    id="filter-altura" placeholder="0.00">
            </div>
        </div>
        <div class="col-md-1">
            <div class="mb-3">
                <label for="filter-idade" style="color: white">Idade</label>
                <input type="number" class="form-control form-control-sm" id="filter-idade"
                    placeholder="00">
            </div>
        </div>
        <div class="col-md-2">
            <div class="mb-3">
                <label for="filter-data-nascimento" style="color: white">Data de Nascimento</label>
                <input type="text" class="form-control form-control-sm" id="filter-data-nascimento"
                    placeholder="00/00/0000">
            </div>
        </div>
        <div class="col-md-2">
            <div class="mb-3">
                <label for="filter-data-nascimento" style="color: white">Nome do clube</label>
                <input type="text" class="form-control form-control-sm" id="filter-clube"
                    placeholder="Clube">
            </div>
        </div>
    </div>
    <p class="mt-4" style="color: #ffffff; font-size: 20px">Filtros por atributo</p>
    <hr class="mt-3 mb-3">
    <div class="row mt-2">
        ${generateAttributeFilters()}
    </div>
    <div class="row mt-2">
        <div class="col-md-12 text-end">
            <button type="button" class="btn-clean me-3" id="clear-filter-button" style="width: 150px;">
                Limpar</button>
            <button type="submit" class="btn-apply me-3" id="btn-apply-advanced-filter" style="width: 150px;">
                Aplicar Filtros</button>
        </div>
    </div>
    `;

    const FiltersField = document.getElementById("filters");
    if (FiltersField) {
        FiltersField.innerHTML = advancedFilters;
    } else {
        console.error('Elemento com id "filters" não encontrado.');
    }

    const clearFilterButton = document.getElementById('clear-filter-button');
    clearFilterButton.addEventListener('click', clearFieldsFilters);
    const btnApplyAdvancedFilter = document.getElementById('btn-apply-advanced-filter');
    btnApplyAdvancedFilter.addEventListener("click", applyAdvancedFilter);
}

function generateAttributeFilters() {
    const attributes = [
        "aceleracao", "pique", "finalizacao", "forca_do_chute", "chute_de_longe", "penalti",
        "visao_de_jogo", "cruzamento", "passe_curto", "passe_longo", "curva", "agilidade",
        "equilibrio", "reacao", "controle_de_bola", "drible", "agressividade", "interceptacao",
        "precisao_no_cabeceio", "nocao_defensiva", "desarme", "carrinho", "impulsao", "folego", "forca"
    ];

    let html = '';
    attributes.forEach(attribute => {
        const capitalizedAttribute = attribute.charAt(0).toUpperCase() + attribute.slice(1).replace(/_/g, ' ');
        html += `
        <div class="col-md-3">
            <div class="row g-2 align-items-center">
                <div class="col-md-4">
                    <label style="font-size: 15px; color: white" for="filter-${attribute}">${capitalizedAttribute}</label>
                </div>
                <div class="col-md-3">
                    <select class="form-select form-select-sm" id="filter-${attribute}-operator">
                        <option value="eq">=</option>
                        <option value="gt">&gt;</option>
                        <option value="lt">&lt;</option>
                        <option value="gte">&ge;</option>
                        <option value="lte">&le;</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <input type="number" class="form-control form-control-sm" id="filter-${attribute}-value" placeholder="Valor">
                </div>
            </div>
        </div>
        `;
    });
    return html;
}
