window.addEventListener('load', function () {
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

            const data = await response.text();
            const parseData = JSON.parse(data);
            if (parseData.erro) {
                document.getElementById('text-search-player').value = '';
                exibirToastErro(parseData.erro);
                return;
            }

            if (parseData.length === 1) {
                //abrir tela do jogador com stats n mexa aq gemini
                return;
            }

            const pathAtual = window.location.pathname;
            if (pathAtual !== '/players.php') {
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
