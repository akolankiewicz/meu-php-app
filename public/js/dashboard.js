document.addEventListener("DOMContentLoaded", async function () {
    try {
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
        await fetchActivities(parseData.activityData);
    } catch (error) {
        console.error(error);
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

    const cardTotalPlayers = document.getElementById('t-p');
    if (cardTotalPlayers) {
        cardTotalPlayers.addEventListener('click', openFiltersForAllPlayers);
    }
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
                        color: "#5b71d7",
                        click: openFiltersForAtacantes
                    },
                    {
                        y: data.totalMEI,
                        indexLabel: "Meias",
                        color: "#8f299b",
                        click: openFiltersForMeias
                    },
                    {
                        y: data.totalZAG,
                        indexLabel: "Zagueiros",
                        color: "#316394",
                        click: openFiltersForZagueiros
                    },
                    {
                        y: data.totalGOL,
                        indexLabel: "Goleiros",
                        color: "#32b45a",
                        click: openFiltersForGoleiros
                    }
                ]
            }
        ]
    });
    chart.render();
}


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

function showEmpty() {
    const activityList = document.getElementById('activity-list');
    activityList.innerHTML = '';
    const emptyDiv = document.createElement('div');
    emptyDiv.className = 'empty-state';
    const iconDiv = document.createElement('div');
    iconDiv.className = 'empty-state-icon';
    iconDiv.textContent = '📋';
    const p = document.createElement('p');
    p.textContent = 'Nenhuma atividade recente encontrada';
    emptyDiv.appendChild(iconDiv);
    emptyDiv.appendChild(p);
    activityList.appendChild(emptyDiv);
}

function formatTimeAgo(date) {
    const now = new Date();
    const diffInMinutes = Math.floor((now - date) / (1000 * 60));

    if (diffInMinutes < 1) return 'Agora mesmo';
    if (diffInMinutes < 60) return `${diffInMinutes}m atrás`;

    const diffInHours = Math.floor(diffInMinutes / 60);
    if (diffInHours < 24) return `${diffInHours}h atrás`;

    const diffInDays = Math.floor(diffInHours / 24);
    return `${diffInDays}d atrás`;
}

function createActivityItem(activity) {
    const item = document.createElement('li');
    item.className = `activity-item ${activity.type}`;

    const timeAgo = formatTimeAgo(new Date(activity.timestamp));

    item.innerHTML = `
        <div class="activity-time">${timeAgo}</div>
        <div class="activity-title">
            <span class="activity-icon ${activity.type}"></span>
            ${activity.title}
        </div>
        <div class="activity-description">${activity.description}</div>
    `;

    return item;
}

function loadActivities(activities) {
    document.getElementById('activity-list').innerHTML = '';

    if (!activities || activities.length === 0) {
        showEmpty();
        return;
    }

    const sortedActivities = activities.sort((a, b) =>
        new Date(b.timestamp) - new Date(a.timestamp)
    );

    sortedActivities.forEach(activity => {
        const item = createActivityItem(activity);
        document.getElementById('activity-list').appendChild(item);
    });
}
async function fetchActivities(data) {
    const recentlyActivities = assembleActivitiesArray(data);
    loadActivities(recentlyActivities);
}

function assembleActivitiesArray(data) {
    return data.map((item) => {
        const [datePart, timePart] = item.data.split(' ');
        const [day, month, year] = datePart.split('-');
        const formattedDate = `${year}-${month}-${day}T${timePart}:00`;
        const originalDate = new Date(formattedDate);
        const adjustedDate = new Date(originalDate.getTime() - 3 * 60 * 60 * 1000);

        let activity = {
            type: '',
            title: '',
            description: '',
            timestamp: adjustedDate
        };

        switch (item.tipo) {
            case 'cadastrado':
                activity.type = 'player-registered';
                activity.title = 'Jogador cadastrado recentemente';
                activity.description = `${item.nome} foi cadastrado na plataforma pelo usuário ID ${item.operador}`;
                break;

            case 'deletado':
                activity.type = 'player-deleted';
                activity.title = 'Jogador excluído recentemente';
                activity.description = `${item.nome} foi removido do sistema pelo usuário ID ${item.operador}`;
                break;

            case 'editado':
                activity.type = 'collaborator-added';
                activity.title = 'Jogador editado recentemente';
                activity.description = `${item.nome} foi editado pelo usuário ID ${item.operador}`;
                break;
        }

        return activity;
    });
}


