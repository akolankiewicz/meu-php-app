function openPlayerRegisterFields() {
    const registerPlayerFields = `
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="mb-3">
                <label for="filter-name">Nome do jogador</label>
                <input type="text" class="form-control form-control-sm" id="filter-nome"
                    placeholder="Nome" required>
            </div>
        </div>
        <div class="col-md-1">
            <div class="mb-3">
                <label for="filter-position">Posição</label>
                <select required class="form-select form-select-sm" id="filter-posicao">
                    <option value=""></option>
                    <option value="ATA">ATA</option>
                    <option value="MEI">MEI</option>
                    <option value="ZAG">ZAG</option>
                    <option value="GOL">GOL</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="mb-3">
                <label for="filter-nacionalidade">Nacionalidade</label>
                <input type="text" class="form-control form-control-sm" required
                    id="filter-nacionalidade" placeholder="País">
            </div>
        </div>
        <div class="col-md-1">
            <div class="mb-3">
                <label for="filter-peso">Peso</label>
                <input type="number" class="form-control form-control-sm"
                    id="filter-peso" placeholder="000" required>
            </div>
        </div>
        <div class="col-md-1">
            <div class="mb-3">
                <label for="filter-altura">Altura</label>
                <input type="number" class="form-control form-control-sm"
                    id="filter-altura" placeholder="0.00" required>
            </div>
        </div>
        <div class="col-md-2">
            <div class="mb-3">
                <label for="filter-data-nascimento">Data de Nascimento</label>
                <input type="text" class="form-control form-control-sm" id="filter-data-nascimento"
                    placeholder="00/00/0000" required>
            </div>
        </div>
        <div class="col-md-2">
            <div class="mb-3">
                <label for="filter-data-nascimento">Nome do clube</label>
                <input type="text" class="form-control form-control-sm" id="filter-clube"
                    placeholder="Clube" required>
            </div>
        </div>
    </div>
    <p class="mt-4" style="color: #555555; font-size: 20px">Filtros por atributo</p>
    <hr class="mt-3 mb-3"><br>
    <div class="row mt-2">
        <!-- Rever se pode isso ou melhor colocar alguma tag html com id -->
        ${generateAttributeFields()}
    </div>
    <br>
    <hr class="mt-3 mb-3">
    <div class="row mt-2">
        <div class="col-md-6">
            <label for="img-player" style="color: #555555; font-size: 20px; padding: 10px;">Imagem do Jogador (Opcional)
                </label>
            <input id="filter-img-player" type="file" alt="erro" class="form-control">
        </div>
        <div class="col-md-6 text-end" style="padding: 10px;">
            <button type="button" class="btn btn-secondary btn-sm me-3" id="btn-clear-player-fields" 
                style="width: 150px;">Limpar</button>
            <button type="submit" class="btn btn-primary btn-sm" id="btn-create-player" 
                style="width: 150px;">Cadastrar jogador</button>
        </div>
    </div><br>
    `;

    const FiltersField = document.getElementById("filters");
    if (FiltersField) {
        FiltersField.innerHTML = registerPlayerFields;
    } else {
        console.error('Elemento com id "filters" não encontrado.');
    }

    const buttonClearPlayerFields = document.getElementById('btn-clear-player-fields');
    if (buttonClearPlayerFields) {
        buttonClearPlayerFields.addEventListener('click', clearFieldsFilters);
    }

    const buttonCreatePlayer = document.getElementById('btn-create-player');
    buttonCreatePlayer.addEventListener('click', createPlayer);

    const imagemInput = document.getElementById('filter-img-player');
    imagemInput.addEventListener('change', function() {
        const imagem = this.files[0];

        if (imagem) {
            const allowedFormats = ['image/png', 'image/jpeg', 'image/jpg'];
            if (! allowedFormats.includes(imagem.type)) {
                exibirToastErro("Formato de imagem inválido. Por favor, selecione um arquivo PNG, JPG ou JPEG.");
                this.value = '';
            }
        }
    });
}

function generateAttributeFields() {
    const attributes = [
        "aceleracao", "pique", "finalizacao", "forca_do_chute", "chute_de_longe", "penalti",
        "visao_de_jogo", "cruzamento", "passe_curto", "passe_longo", "curva", "agilidade",
        "equilibrio", "reacao", "controle_de_bola", "drible", "agressividade", "interceptacao",
        "precisao_no_cabeceio", "nocao_defensiva", "desarme", "carrinho", "impulsao", "folego", "forca"
    ];

    let html = '';
    attributes.forEach(attribute => {
        const capitalizedAttribute = attribute.charAt(0).toUpperCase() +
            attribute.slice(1).replace(/_/g, ' ');
        html += `
        <div class="col-md-3">
            <div class="row g-2 align-items-center">
                <div class="col-md-4">
                    <label style="font-size: 15px" for="filter-${attribute}">${capitalizedAttribute}</label>
                </div>
                <div class="col-md-5">
                    <input required type="text" class="form-control form-control-sm" 
                        pattern="\d*" maxlength="2" id="filter-${attribute}-value" placeholder="Valor (1-99)">
                </div>
            </div>
        </div>
        `;
    });
    return html;
}

function createPlayer() {
    const nome = document.getElementById('filter-nome').value;
    const posicao = document.getElementById('filter-posicao').value;
    const nacionalidade = document.getElementById('filter-nacionalidade').value;
    const peso = document.getElementById('filter-peso').value;
    const altura = document.getElementById('filter-altura').value;
    const dataNascimento = document.getElementById('filter-data-nascimento').value;
    const clube = document.getElementById('filter-clube').value;

    const atributos = {};
    const attributes = [
        "aceleracao", "pique", "finalizacao", "forca_do_chute", "chute_de_longe", "penalti",
        "visao_de_jogo", "cruzamento", "passe_curto", "passe_longo", "curva", "agilidade",
        "equilibrio", "reacao", "controle_de_bola", "drible", "agressividade", "interceptacao",
        "precisao_no_cabeceio", "nocao_defensiva", "desarme", "carrinho", "impulsao", "folego", "forca"
    ];
    attributes.forEach(attribute => {
        atributos[attribute] = document.getElementById(`filter-${attribute}-value`).value;
    });
    const imagemInput = document.getElementById('filter-img-player');
    const imagem = imagemInput.files[0];

    const playerData = {
        nome,
        posicao,
        nacionalidade,
        peso,
        altura,
        dataNascimento,
        clube,
        ...atributos //spread operator
    };

    const camposObrigatorios = ['nome', 'posicao', 'nacionalidade', 'peso', 'altura', 'dataNascimento', 'clube'];
    for (const campo of camposObrigatorios) {
        if (! playerData[campo]) {
            exibirToastErro(`O campo ${campo} é obrigatório.`);
            document.getElementById(`filter-${campo}`).focus();
            return;
        }
    }

    for (const atributo of attributes) {
        if (atributos[atributo] === undefined || atributos[atributo] === '') {
            exibirToastErro(`O atributo ${atributo} é obrigatório.`);
            document.getElementById(`filter-${atributo}-value`).focus();
            return;
        }

    }

    const formData = new FormData();
    formData.append('imagem', imagem);
    formData.append('nome', nome);
    formData.append('posicao', posicao);
    formData.append('nacionalidade', nacionalidade);
    formData.append('peso', peso);
    formData.append('altura', altura);
    formData.append('dataNascimento', dataNascimento);
    formData.append('clube', clube);

    for (const key in atributos) {
        formData.append(key, atributos[key]);
    }

    fetch('../actions/action_create_player.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.erro) {
            exibirToastErro(data.erro);
        } else {
            exibirToastSuccess("Jogador ID: "+ data.id + " " + data.nome.nome + " cadastrado com sucesso!");
            clearFieldsFilters(false);
        }
    })
    .catch(error => {
        console.error('Erro ao cadastrar jogador:', error);
        exibirToastErro("Erro ao cadastrar jogador. Verifique a conexão.");
    });
}