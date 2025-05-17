document.addEventListener('DOMContentLoaded', function () {
    const params = new URLSearchParams(window.location.search);
    const playerId = params.get('player_id');
    fetch(`../actions/action_get_player_stats.php?player_id=${playerId}`)
        .then(response => {
            if (!response.ok) {
                exibirToastErro(`Erro na requisição: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            showPlayerStats(data);
        })
        .catch(error => {
            console.error('Ocorreu um erro ao buscar o jogador:', error);
            document.getElementById('field_player_name').textContent = 'Ocorreu um erro ao buscar o jogador!';
        });
});

async function showPlayerStats(parseData) {
    const player = parseData[''];
    if (!player) return;

    const imgElement = document.getElementById('player-img');
    if (player.imagem) {
        imgElement.src = `img/${player.imagem}`;
    } else {
        imgElement.src = 'img/default.png';
        exibirToastAlert('O Jogador não possuí imagem cadastrada!')
    }

    document.querySelector('.info-player').innerHTML = `
        <h1>${player.nome}</h1>
        <p>Posição: ${player.posicao}</p>
        <p>Nacionalidade: ${player.nacionalidade}</p>
        <p>Clube: ${player.clube}</p>
        <p>Data de nascimento: ${formatarData(player.data_nascimento)}</p>
        <p>Idade: ${calcularIdade(player.data_nascimento)}</p>
        <p>Altura: ${player.altura}m</p>
        <p>Peso: ${player.peso}kg</p>
    `;

    const ritmo = (player.aceleracao + player.pique) / 2;
    const finalizacao = (player.finalizacao + player.forca_do_chute + player.chute_de_longe +
        player.penalti) / 4;
    const passe = (player.visao_de_jogo + player.cruzamento + player.passe_curto + player.passe_longo +
        player.curva) / 5;
    const drible = (player.agilidade + player.equilibrio + player.reacao + player.controle_de_bola +
        player.drible + player.agressividade) / 5;
    const defesa = (player.interceptacao + player.precisao_no_cabeceio + player.nocao_defensiva +
        player.desarme + player.carrinho) / 5;
    const fisico = (player.impulsao + player.folego + player.forca) / 3;
    radarChart(ritmo,finalizacao,passe,drible,defesa,fisico);

    const atributos = [
        'aceleracao', 'pique', 'finalizacao', 'forca_do_chute', 'chute_de_longe',
        'penalti', 'visao_de_jogo', 'cruzamento', 'passe_curto', 'passe_longo',
        'curva', 'agilidade', 'equilibrio', 'reacao', 'controle_de_bola',
        'drible', 'agressividade', 'interceptacao', 'precisao_no_cabeceio',
        'nocao_defensiva', 'desarme', 'carrinho', 'impulsao', 'folego', 'forca'
    ];

    const container = document.getElementById('atributos-container');
    container.innerHTML = '';

    let row;
    atributos.forEach((attr, index) => {
        if (index % 5 === 0) {
            row = document.createElement('div');
            row.className = 'row justify-content-center mb-3 w-100';
            container.appendChild(row);
        }

        const col = document.createElement('div');
        col.className = 'col-6 col-sm-4 col-md-2 mb-3 d-flex flex-column align-items-start';

        const label = document.createElement('label');
        label.textContent = attr.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
        label.setAttribute('for', attr);
        label.className = 'form-label';

        const input = document.createElement('input');
        input.type = 'number';
        input.id = attr;
        input.name = attr;
        input.className = 'form-control form-control-sm custom-input';
        input.min = 1;
        input.max = 99;
        input.value = player[attr] ?? '';

        input.addEventListener('input', () => {
            if (input.value.length > 2) {
                input.value = input.value.slice(0, 2);
            }
            const num = parseInt(input.value, 10);
            if (num > 99) input.value = 99;
            if (num < 1 && input.value !== '') input.value = 1;
        });

        col.appendChild(label);
        col.appendChild(input);
        row.appendChild(col);
    });
}

function formatarData(data) {
    const [ano, mes, dia] = data.split('-');
    return `${dia}/${mes}/${ano}`;
}

function calcularIdade(dataNascimento) {
    const hoje = new Date();
    const nascimento = new Date(dataNascimento);
    let idade = hoje.getFullYear() - nascimento.getFullYear();
    const m = hoje.getMonth() - nascimento.getMonth();
    if (m < 0 || (m === 0 && hoje.getDate() < nascimento.getDate())) {
        idade--;
    }
    return idade;
}

function radarChart(ritmo, finalizacao, passe, drible, defesa, fisico) {
    const ctx = document.getElementById('radarChart').getContext('2d');
    const radarChart = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: ['Ritmo', 'Finalização', 'Passe', 'Drible', 'Defesa', 'Físico'],
            datasets: [{
                label: 'Atributos',
                data: [ritmo, finalizacao, passe, drible, defesa, fisico],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                r: {
                    angleLines: {
                        display: true
                    },
                    suggestedMin: 0,
                    suggestedMax: 100,
                    ticks: {
                        stepSize: 20,
                        showLabelBackdrop: false,
                        fontColor: '#ffffff'
                    },
                    pointLabels: {
                        fontColor: '#ffffff',
                        fontSize: 14
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.9)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        fontColor: '#ffffff',
                        fontSize: 14
                    }
                }
            }
        }
    });
}
