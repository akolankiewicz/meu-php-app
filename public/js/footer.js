document.addEventListener("DOMContentLoaded", function () {
    const footerHTML = `
<div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="../img/ascent_stats_binacle.png" alt="erro" width="300">  
            </div>
            <div class="col-md-3">
                <h5>Sobre o Dev</h5>
                <p>Arthur Kolankiewicz - Desenvolvedor PHP</p>
                <p>Com foco em back-end, destaco-me pela facilidade de aprendizado 
                e pela dedicação que aplico no meu trabalho no dia a dia.</p>
            </div>
            <div class="col-md-2">
                <h5>Links úteis</h5>
                <ul class="list-unstyled">
                    <li><a href="https://www.instagram.com/akolankiewicz" class="text-white">Instagram</a></li>
                    <li><a href="https://www.linkedin.com/in/arthur-kolankiewicz-85b333302/" class="text-white">Linkedin</a></li>
                    <li><a href="https://github.com/akolankiewicz" class="text-white">GitHub</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Contato</h5>
                <p>Email: arthurkolan@hotmail.com</p>
                <p>Telefone: (49) 98806-2114</p>
            </div>
        </div>
    </div>
    <div class="text-center mt-3">
        <p>&copy; 2025 Arthur Kolankiewicz. Todos os direitos reservados.</p>
    </div>
    `;

    const footerContainer = document.getElementById("footer-footer");
    if (footerContainer) {
        footerContainer.innerHTML = footerHTML;
    } else {
        console.error('Elemento com id "footer-footer" não encontrado.');
    }
});
