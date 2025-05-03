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

function calculateAge(birthDate) {
    const currentDate = new Date();
    let age = currentDate.getFullYear() - birthDate.getFullYear();
    const monthDiff = currentDate.getMonth() - birthDate.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && currentDate.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

function addPlayersToTheTable(parseData) {
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
        const verMaisCell = row.insertCell();

        idCell.textContent = player.id;
        nomeCell.textContent = player.nome;
        posicaoCell.textContent = player.posicao;
        pesoCell.textContent = player.peso ? `${player.peso} kg` : '-';
        alturaCell.textContent = player.altura ? `${player.altura} m` : '-';

        if (player.data_nascimento) {
            const birthDate = new Date(player.data_nascimento);
            const day = String(birthDate.getDate()).padStart(2, '0');
            const month = String(birthDate.getMonth() + 1).padStart(2, '0');
            const year = birthDate.getFullYear();
            const formattedDate = `${day}/${month}/${year}`;
            idadeCell.textContent = calculateAge(birthDate);
            dataNascimentoCell.textContent = formattedDate;
        } else {
            idadeCell.textContent = '-';
            dataNascimentoCell.textContent = '-';
        }

        clubeAtualCell.textContent = player.clube;

        const verMaisButton = document.createElement('button');
        verMaisButton.classList.add('btn', 'btn-sm', 'btn-outline-primary');
        verMaisButton.textContent = 'Ver Mais';
        verMaisButton.addEventListener('click', () => {
            console.log("Ver mais detalhes do jogador com ID:", player.id);
        });
        verMaisCell.appendChild(verMaisButton);
    });
}