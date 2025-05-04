
document.addEventListener('DOMContentLoaded', function () {
    fetch('../actions/action_get_user_data.php')
        .then(response => {
            if (!response.ok) {
                exibirToastErro(`Erro na requisição: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('session-user-name').textContent = data.nome;
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
});