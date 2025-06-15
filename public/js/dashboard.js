// Dashboard JavaScript - Versão Modernizada
// Compatível com o novo design glassmorphism

document.addEventListener("DOMContentLoaded", async function () {
    try {
        // Aguarda um pouco para garantir que o CanvasJS foi carregado
        await new Promise(resolve => setTimeout(resolve, 100));

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
        console.error('Erro ao carregar dashboard:', error);
        // Fallback para dados de exemplo se houver erro
        renderDashboardCardsExample();
        renderBarChartExample();
        renderPizzaChartExample();
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

    dadosDashboard.forEach((dado, index) => {
        const col = document.createElement("div");
        col.className = "col-md-4";
        col.style.animationDelay = `${(index + 1) * 0.1}s`;
        col.innerHTML = `
          <div id="${dado.id}" class="card text-white bg-${dado.cor} p-3 dashboard-card-hover">
            <h5>${dado.titulo}</h5>
            <h2>${dado.valor}</h2>
          </div>
        `;
        container.appendChild(col);
    });

    // Adiciona event listeners após criar os cards
    const cardTotalPlayers = document.getElementById('t-p');
    if (cardTotalPlayers) {
        cardTotalPlayers.addEventListener('click', openFiltersForAllPlayers);
    }
}

function renderDashboardCardsExample() {
    // Dados de exemplo para fallback
    const dadosExemplo = {
        totalJogadores: 11,
        totalColaboradores: 123,
        totalPlanosDeTreino: 15
    };
    renderDashboardCards(dadosExemplo);
}

function renderBarChart(data) {
    const dataPoints = [];
    for (const nacionalidade in data) {
        if (data.hasOwnProperty(nacionalidade)) {
            const quantidade = data[nacionalidade];
            dataPoints.push({
                label: nacionalidade,
                y: quantidade,
                color: getBarColor(nacionalidade)
            });
        }
    }

    const chart = new CanvasJS.Chart("bar-chart", {
        animationEnabled: true,
        theme: "dark2",
        title: {
            text: "Total de nacionalidades",
            fontColor: "#ffffff",
            fontSize: 18,
            fontWeight: "600"
        },
        axisX: {
            labelFontColor: "#ffffff",
            titleFontColor: "#ffffff",
            gridColor: "rgba(255,255,255,0.1)",
            tickColor: "rgba(255,255,255,0.2)"
        },
        axisY: {
            labelFontColor: "#ffffff",
            title: "Total de jogadores",
            titleFontColor: "#ffffff",
            gridColor: "rgba(255,255,255,0.1)",
            tickColor: "rgba(255,255,255,0.2)"
        },
        legend: {
            fontColor: "#ffffff"
        },
        backgroundColor: "transparent",
        data: [
            {
                type: "column",
                dataPoints: dataPoints,
                indexLabelFontColor: "#ffffff"
            }
        ]
    });
    chart.render();
}

function renderBarChartExample() {
    // Dados de exemplo para fallback
    const dadosExemplo = {
        "Brasil": 6,
        "Portugal": 1,
        "Espanha": 1,
        "Argentina": 3
    };
    renderBarChart(dadosExemplo);
}

function renderPizzaChart(data) {
    const chart = new CanvasJS.Chart("pizza-chart", {
        animationEnabled: true,
        theme: "dark2",
        title: {
            text: "Total de jogadores por posição",
            fontColor: "#ffffff",
            fontSize: 18,
            fontWeight: "600"
        },
        legend: {
            maxWidth: 500,
            itemWidth: 120,
            fontColor: "#ffffff"
        },
        backgroundColor: "transparent",
        data: [
            {
                type: "pie",
                showInLegend: true,
                legendText: "{indexLabel}",
                indexLabelFontColor: "#ffffff",
                dataPoints: [
                    {
                        y: data.totalATA,
                        indexLabel: "Atacantes",
                        color: "#667eea",
                        click: openFiltersForAtacantes
                    },
                    {
                        y: data.totalMEI,
                        indexLabel: "Meias",
                        color: "#f093fb",
                        click: openFiltersForMeias
                    },
                    {
                        y: data.totalZAG,
                        indexLabel: "Zagueiros",
                        color: "#4facfe",
                        click: openFiltersForZagueiros
                    },
                    {
                        y: data.totalGOL,
                        indexLabel: "Goleiros",
                        color: "#43e97b",
                        click: openFiltersForGoleiros
                    }
                ]
            }
        ]
    });
    chart.render();
}

function renderPizzaChartExample() {
    // Dados de exemplo para fallback
    const dadosExemplo = {
        totalATA: 3,
        totalMEI: 2,
        totalZAG: 4,
        totalGOL: 2
    };
    renderPizzaChart(dadosExemplo);
}

// Função para gerar cores para o gráfico de barras
function getBarColor(nacionalidade) {
    const colors = {
        "Brasil": "#11998e",
        "Portugal": "#667eea",
        "Espanha": "#f093fb",
        "Argentina": "#4facfe",
        "Chile": "#fe4f69",
        "Uruguai": "#4f52fe",
    };
    return colors[nacionalidade] || "#764ba2";
}

async function openFiltersForAllPlayers() {
    const open = confirm('Deseja abrir a aba jogadores para visualizar todos os jogadores registrados?');
    if (open) {
        try {
            const response = await fetch('../actions/action_search_player.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `search=`
            });

            const parseData = await response.json();
            localStorage.setItem('data_players', JSON.stringify({
                dataPlayers: parseData,
                mustAddPlayersToTheTable: true
            }));
            window.location.href = "../players.php";
        } catch (error) {
            console.error('Erro ao buscar jogadores:', error);
        }
    }
}

async function openFiltersForAtacantes() {
    const open = confirm('Deseja abrir a aba jogadores para visualizar todos os atacantes registrados?');
    if (open) {
        try {
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
        } catch (error) {
            console.error('Erro ao buscar atacantes:', error);
        }
    }
}

async function openFiltersForMeias() {
    const open = confirm('Deseja abrir a aba jogadores para visualizar todos os meias registrados?');
    if (open) {
        try {
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
        } catch (error) {
            console.error('Erro ao buscar meias:', error);
        }
    }
}

async function openFiltersForZagueiros() {
    const open = confirm('Deseja abrir a aba jogadores para visualizar todos os zagueiros registrados?');
    if (open) {
        try {
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
        } catch (error) {
            console.error('Erro ao buscar zagueiros:', error);
        }
    }
}

async function openFiltersForGoleiros() {
    const open = confirm('Deseja abrir a aba jogadores para visualizar todos os goleiros registrados?');
    if (open) {
        try {
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
        } catch (error) {
            console.error('Erro ao buscar goleiros:', error);
        }
    }
}
