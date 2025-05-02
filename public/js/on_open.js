
document.addEventListener('DOMContentLoaded', function() {
    fetch('../actions/action_get_user_data.php')
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erro na requisição: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('session-user-name').textContent = data.nome;
        })
        .catch(error => {
            console.error('Ocorreu um erro:', error);
            document.getElementById('session-user-name').textContent = 'Ocorreu um erro ao buscar as variáveis do servidor.';
        });
});