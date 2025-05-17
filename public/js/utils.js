function exibirToastErro(mensagem) {
    Toastify({
        text: mensagem,
        duration: 2500,
        close: true,
        gravity: "bottom",
        position: "right",
        backgroundColor: "#dc3545",
        stopOnFocus: true,
    }).showToast();
}

function exibirToastSuccess(mensagem) {
    Toastify({
        text: mensagem,
        duration: 2500,
        close: true,
        gravity: "bottom",
        position: "right",
        backgroundColor: "#23a63d",
        stopOnFocus: true,
    }).showToast();
}

function addPlayersToTheTable(parseData) {
    if (!parseData) {
        exibirToastErro('Não existem jogadores para essa busca!');
        return;
    }

    const tableBody = document.querySelector('.table tbody');
    tableBody.innerHTML = '';
    exibirToastSuccess('Busca realizada com sucesso!');

    parseData.forEach((player, index) => {
        const row = tableBody.insertRow();

        const idCell = row.insertCell();
        const nomeCell = row.insertCell();
        const posicaoCell = row.insertCell();
        const pesoCell = row.insertCell();
        const alturaCell = row.insertCell();
        const idadeCell = row.insertCell();
        const dataNascimentoCell = row.insertCell();
        const clubeAtualCell = row.insertCell();
        const nacionalidadeCell = row.insertCell();
        const verMaisCell = row.insertCell();

        idCell.classList.add('player-id');
        nomeCell.classList.add('player-name');
        posicaoCell.classList.add('player-position');
        pesoCell.classList.add('player-weight');
        alturaCell.classList.add('player-height');
        idadeCell.classList.add('player-age');
        dataNascimentoCell.classList.add('player-birthdate');
        clubeAtualCell.classList.add('player-club');
        nacionalidadeCell.classList.add('player-nacionality');
        verMaisCell.classList.add('player-details');

        idCell.textContent = player.id;
        nomeCell.textContent = player.nome;
        posicaoCell.textContent = player.posicao;
        pesoCell.textContent = player.peso ? `${player.peso} kg` : '-';
        alturaCell.textContent = player.altura ? `${player.altura} m` : '-';

        if (player.data_nascimento) {
            const [ano, mes, dia] = player.data_nascimento.split('-');
            const dataFormatada = `${dia}/${mes}/${ano}`;

            const dataNascimento = new Date(`${ano}-${mes}-${dia}T00:00:00`);
            const hoje = new Date();
            let idade = hoje.getFullYear() - dataNascimento.getFullYear();
            const mesAtual = hoje.getMonth();
            const diaAtual = hoje.getDate();
            if (mesAtual < dataNascimento.getMonth() ||
                (mesAtual === dataNascimento.getMonth() && diaAtual < dataNascimento.getDate())) {
                idade--;
            }

            idadeCell.textContent = String(idade);
            dataNascimentoCell.textContent = dataFormatada;
        } else {
            idadeCell.textContent = '-';
            dataNascimentoCell.textContent = '-';
        }

        clubeAtualCell.textContent = player.clube;
        nacionalidadeCell.textContent = player.nacionalidade || '-';

        const verMaisButton = document.createElement('button');
        verMaisButton.classList.add('btn', 'btn-sm', 'btn-outline-primary');
        verMaisButton.textContent = 'Ver Mais';
        verMaisButton.addEventListener('click', message => {
            window.location.href = `../player_stats.php?player_id=${player.id}`;
        });
        verMaisCell.appendChild(verMaisButton);
    });
}
