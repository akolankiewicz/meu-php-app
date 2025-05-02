window.addEventListener('load', function () {
    const btnSearchPlayer = document.getElementById('btn-search-player');
    btnSearchPlayer.addEventListener("click", async function (evt) {
        evt.preventDefault();
        try {
            const response = await fetch('../actions/search_player.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'search=' + document.getElementById('text-search-player').value
            });

            if (!response.ok) {
                throw new Error(`Erro na requisição: ${response.status}`);
            }

            const data = await response.text();
        } catch (error) {
            console.error('Ocorreu um erro:', error);
        }
    });
});
