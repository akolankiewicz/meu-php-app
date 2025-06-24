
document.addEventListener('DOMContentLoaded', function () {
    fetch('../actions/action_get_user_data.php')
        .then(response => {
            if (!response.ok) {
                exibirToastErro(`Erro na requisição: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (window.location.pathname === '/index.php') {
                document.getElementById('session-user-name').textContent = data.nome;
            }

            if (window.location.pathname === '/player_stats.php') {
                localStorage.setItem('sessionUserData', JSON.stringify(data));
            }
        })
        .catch(error => {
            console.error('Ocorreu um erro:', error);
            document.getElementById('session-user-name').textContent = '';
        });

    if (localStorage.getItem('data_players') && window.location.pathname === '/players.php') {
        const data = JSON.parse(localStorage.getItem('data_players'));
        if (data.mustAddPlayersToTheTable === true) {
            addPlayersToTheTable(data.dataPlayers);
        }
        localStorage.clear();
    }

    if (window.location.pathname === '/players.php') {
        console.log('entra');
        const dataMessage = JSON.parse(localStorage.getItem('mustShowSuccessMessage'));
        if (dataMessage) {
            exibirToastSuccess(dataMessage);
            localStorage.removeItem('mustShowSuccessMessage')
        }
    }
});