
document.addEventListener("DOMContentLoaded", function () {
    renderDashboardCards();
    renderBarChart();
    renderPizzaChart();
});

function renderDashboardCards() {
    const dadosDashboard = [
        { titulo: "Total de jogadores cadastrados", valor: 0, cor: "primary", link: 'players.php'},
        { titulo: "Total de colaboradores", valor: 0, cor: "info", link: 'colaborators.php' },
        { titulo: "Acessos Hoje", valor: 0, cor: "success", link: 'acessos.php' },
    ];

    const container = document.getElementById("dashboard-cards");
    container.innerHTML = '';

    dadosDashboard.forEach(dado => {
        const col = document.createElement("div");
        col.className = "col-md-4";
        col.innerHTML = `
            <a class="dashboard-links" href="${dado.link}">
              <div class="card text-white bg-${dado.cor} p-3 dashboard-card-hover">
                <h5>${dado.titulo}</h5>
                <h2>${dado.valor}</h2>
              </div>
            </a>
        `;
        container.appendChild(col);
    });
}

function renderBarChart() {
    const chart = new CanvasJS.Chart("bar-chart",
        {
            title:{
                text: "Gráfico de Barras",
                fontColor: "white"
            },
            legend: {
                maxWidth: 500,
                itemWidth: 120,
                fontColor: "white"
            },
            backgroundColor: "transparent",
            data: [
                {
                    type: "bar",
                    dataPoints: [
                        { y: 198, label: "Italy", fontColor: "white"},
                        { y: 201, label: "China", fontColor: "white"},
                        { y: 202, label: "France", fontColor: "white"},
                        { y: 236, label: "Great Britain", fontColor: "white"},
                        { y: 395, label: "Soviet Union", fontColor: "white"},
                        { y: 957, label: "USA", fontColor: "white"}
                    ]
                },
                {
                    type: "bar",
                    dataPoints: [
                        { y: 166, label: "Italy", fontColor: "white"},
                        { y: 144, label: "China", fontColor: "white"},
                        { y: 223, label: "France", fontColor: "white"},
                        { y: 272, label: "Great Britain", fontColor: "white"},
                        { y: 319, label: "Soviet Union", fontColor: "white"},
                        { y: 759, label: "USA", fontColor: "white"}
                    ]
                },
                {
                    type: "bar",
                    dataPoints: [
                        { y: 185, label: "Italy", fontColor: "white"},
                        { y: 128, label: "China", fontColor: "white"},
                        { y: 246, label: "France", fontColor: "white"},
                        { y: 272, label: "Great Britain", fontColor: "white"},
                        { y: 296, label: "Soviet Union", fontColor: "white"},
                        { y: 666, label: "USA", fontColor: "white"}
                    ]
                }
            ]
        });

    chart.render();
}

function renderPizzaChart () {
    const chart = new CanvasJS.Chart("pizza-chart",
        {
            title:{
                text: "Gráfico de Pizza",
                fontColor: "white"
            },
            legend: {
                maxWidth: 500,
                itemWidth: 120,
                fontColor: "white"
            },
            backgroundColor: "transparent",
            data: [
                {
                    type: "pie",
                    showInLegend: true,
                    legendText: "{indexLabel}",
                    dataPoints: [
                        { y: 4181563, indexLabel: "Grêmio", fontColor: "white" },
                        { y: 2175498, indexLabel: "Internacional", fontColor: "white" },
                        { y: 3125844, indexLabel: "Juventude", fontColor: "white" }
                    ]
                }
            ]
        });
    chart.render();
}