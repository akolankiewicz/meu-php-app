
document.addEventListener("DOMContentLoaded", async function () {
    try {
        const response = await fetch('../actions/action_dashboard.php', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        });

        const parseData = await response.json();
        renderDashboardCards(parseData.cardsData);
        renderBarChart(parseData.barChartData);
        renderPizzaChart(parseData.pizzaChartData);
    } catch (error) {
        exibirToastErro(error);
    }
});

function renderDashboardCards(data) {
    const dadosDashboard = [
        { titulo: "Total de jogadores registrados", valor: data.totalJogadores, cor: "primary", id: 't-p'},
        { titulo: "Total de colaboradores", valor: data.totalColaboradores, cor: "info", id: 't-c'},
        { titulo: "Total de planos de treino", valor: data.totalPlanosDeTreino, cor: "success", id: 't-pt'}
    ];

    const container = document.getElementById("dashboard-cards");
    container.innerHTML = '';

    dadosDashboard.forEach(dado => {
        const col = document.createElement("div");
        col.className = "col-md-4";
        col.innerHTML = `
          <div id="${dado.id}" class="card text-white bg-${dado.cor} p-3 dashboard-card-hover">
            <h5>${dado.titulo}</h5>
            <h2>${dado.valor}</h2>
          </div>
        `;
        container.appendChild(col);
    });

    const cardTotalPlayers = document.getElementById('t-p');
    cardTotalPlayers.addEventListener('click', function () {
        localStorage.setItem('data_players', JSON.stringify({
            mustClickOnSearchToBringAllPlayers: true,
            mustAddPlayersToTheTable: false
        }));
        window.location.pathname = '../players.php';
    })
}

function renderBarChart(data) {
    const dataPoints = [];
    for (const nacionalidade in data) {
        if (data.hasOwnProperty(nacionalidade)) {
            const quantidade = data[nacionalidade];
            dataPoints.push({ label: nacionalidade, y: quantidade });
        }
    }

    const chart = new CanvasJS.Chart("bar-chart", {
        title: {
            text: "Total de nacionalidades",
            fontColor: "white"
        },
        axisX: {
            labelFontColor: "white",
            titleFontColor: "white"
        },
        axisY: {
            labelFontColor: "white",
            title: "Total de jogadores",
            titleFontColor: "white"
        },
        legend: {
            fontColor: "white"
        },
        backgroundColor: "transparent",
        data: [
            {
                type: "column",
                dataPoints: dataPoints
            }
        ]
    });
    chart.render();
}

function renderPizzaChart (data) {
    const chart = new CanvasJS.Chart("pizza-chart",
        {
            title:{
                text: "Total de jogadores por posição",
                fontColor: "white"
            },
            legend: {
                maxWidth: 500,
                itemWidth: 100,
                fontColor: "white"
            },
            backgroundColor: "transparent",
            data: [
                {
                    type: "pie",
                    showInLegend: true,
                    legendText: "{indexLabel}",
                    dataPoints: [
                        { y: data.totalATA, indexLabel: "Atacantes", fontColor: "white", click: openFiltersForAtacantes },
                        { y: data.totalMEI, indexLabel: "Meias", fontColor: "white", click: openFiltersForMeias },
                        { y: data.totalZAG, indexLabel: "Zagueiros", fontColor: "white", click: openFiltersForZagueiros },
                        { y: data.totalGOL, indexLabel: "Goleiros", fontColor: "white", click: openFiltersForGoleiros }
                    ]
                }
            ]
        });
    chart.render();
}

async function openFiltersForAtacantes() {
    const open = confirm('Deseja abrir a aba jogadores para visualizar todos os atacantes registrados?');
    if (open) {
        const response = await fetch('../actions/action_search_player.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `nome=&posicao=ATA&clube=`
        });

        const parseData = await response.json();
        localStorage.setItem('data_players', JSON.stringify({
            dataPlayers: parseData,
            mustAddPlayersToTheTable: true
        }));
        window.location.href = "../players.php";
    }
}

async function openFiltersForMeias() {
    const open = confirm('Deseja abrir a aba jogadores para visualizar todos os meias registrados?');
    if (open) {
        const response = await fetch('../actions/action_search_player.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `nome=&posicao=MEI&clube=`
        });

        const parseData = await response.json();
        localStorage.setItem('data_players', JSON.stringify({
            dataPlayers: parseData,
            mustAddPlayersToTheTable: true
        }));
        window.location.href = "../players.php";
    }
}

async function openFiltersForZagueiros() {
    const open = confirm('Deseja abrir a aba jogadores para visualizar todos os zagueiros registrados?');
    if (open) {
        const response = await fetch('../actions/action_search_player.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `nome=&posicao=ZAG&clube=`
        });

        const parseData = await response.json();
        localStorage.setItem('data_players', JSON.stringify({
            dataPlayers: parseData,
            mustAddPlayersToTheTable: true
        }));
        window.location.href = "../players.php";
    }
}

async function openFiltersForGoleiros() {
    const open = confirm('Deseja abrir a aba jogadores para visualizar todos os goleiros registrados?');
    if (open) {
        const response = await fetch('../actions/action_search_player.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `nome=&posicao=GOL&clube=`
        });

        const parseData = await response.json();
        localStorage.setItem('data_players', JSON.stringify({
            dataPlayers: parseData,
            mustAddPlayersToTheTable: true
        }));
        window.location.href = "../players.php";
    }
}