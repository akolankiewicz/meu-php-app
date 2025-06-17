window.addEventListener('load', function () {
    //filtro pela navbar
    const btnSearchPlayer = document.getElementById('btn-search-player');
    btnSearchPlayer.addEventListener("click", async function (evt) {
        evt.preventDefault();
        try {
            const response = await fetch('../actions/action_search_player.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'search=' + document.getElementById('text-search-player').value
            });

            const parseData = await response.json();
            if (parseData.erro) {
                document.getElementById('text-search-player').value = '';
                exibirToastErro(parseData.erro);
                return;
            }

            if (parseData.length === 1) {
                window.location.href = `../player_stats.php?player_id=${parseData[0].id}`;
                return;
            }

            if (window.location.pathname !== '/players.php') {
                localStorage.setItem('data_players', JSON.stringify({
                    dataPlayers: parseData,
                    mustAddPlayersToTheTable: true
                }));
                window.location.href = "../players.php";
                return;
            }

            addPlayersToTheTable(parseData);
        } catch (error) {
            exibirToastErro(error);
        }
    });
});

//filtro pelos filtros rapidos
async function setQuickFilters(evt) {
    evt.preventDefault();
    const playerName = document.getElementById('filter-name').value;
    const playerPosition = document.getElementById('filter-position').value;
    const playerClub = document.getElementById('filter-club').value;
    try {
        const response = await fetch('../actions/action_search_player.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `nome=${encodeURIComponent(playerName)}&posicao=${encodeURIComponent(playerPosition)}&clube=${encodeURIComponent(playerClub)}`
        });

        const parseData = await response.json();

        if (parseData.erro) {
            document.getElementById('filter-name').value = '';
            document.getElementById('filter-position').value = 'POS';
            document.getElementById('filter-club').value = '';
            exibirToastErro(parseData.erro);
            return;
        }

        addPlayersToTheTable(parseData);
    } catch (error) {
        exibirToastErro(error);
    }
}

//filtros avançados
async function applyAdvancedFilter(evt) {
    evt.preventDefault();
    try {
        const response = await fetch('../actions/action_return_advanced_filters.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: getAdvancedFiltersPostBody()
        });

        const parseData = await response.json();

        if (parseData.erro) {
            clearFieldsFilters(false);
            exibirToastErro(parseData.erro);
            return;
        }

        addPlayersToTheTable(parseData);
    } catch (error) {
        exibirToastErro(error);
    }
}

function getAdvancedFiltersPostBody() {
    const filters = {};

    filters.nome = document.getElementById('filter-nome').value;
    filters.posicao = document.getElementById('filter-posicao').value;
    filters.peso = document.getElementById('filter-peso').value;
    filters.altura = document.getElementById('filter-altura').value;
    filters.idade = document.getElementById('filter-idade').value;
    filters.data_nascimento = document.getElementById('filter-data-nascimento').value;
    filters.clube = document.getElementById('filter-clube').value;
    filters.nacionalidade = document.getElementById('filter-nacionalidade').value;

    const attributes = [
        "aceleracao", "pique", "finalizacao", "forca_do_chute", "chute_de_longe", "penalti",
        "visao_de_jogo", "cruzamento", "passe_curto", "passe_longo", "curva", "agilidade",
        "equilibrio", "reacao", "controle_de_bola", "drible", "agressividade", "interceptacao",
        "precisao_no_cabeceio", "nocao_defensiva", "desarme", "carrinho", "impulsao", "folego", "forca"
    ];

    attributes.forEach(attribute => {
        const operator = document.getElementById(`filter-${attribute}-operator`).value;
        const value = document.getElementById(`filter-${attribute}-value`).value;

        if (value !== '') {
            filters[`filter_${attribute}_operator`] = operator;
            filters[`filter_${attribute}_value`] = value;
        }
    });

    const formData = new URLSearchParams();
    for (const key in filters) {
        formData.append(key, filters[key]);
    }

    return formData.toString();
}

function clearFieldsFilters(showConfirm) {
    let clear;
    if (showConfirm) {
        clear = confirm('Deseja realmente limpar os campos preenchidos? Você perderá o processo atual.');
    } else {
        clear = true;
    }

    if (clear) {
        const filtersContainer = document.getElementById("filters");
        if (filtersContainer) {
            const inputs = filtersContainer.querySelectorAll('input[type="text"], input[type="number"], input[type="file"]');
            const selects = filtersContainer.querySelectorAll('select');

            inputs.forEach(input => {
                input.value = '';
            });

            selects.forEach(select => {
                select.value = '';
            });


        }
    }
}
