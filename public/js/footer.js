document.addEventListener("DOMContentLoaded", function () {
    const footerHTML = `
            <footer class="modern-footer">
                <div class="footer-container">
                    <div class="footer-card">
                        <div class="card-header">
                            <i class="bi bi-info-circle header-icon"></i>
                            <h3>Sobre o Dev</h3>
                        </div>
                        <div class="profile-section">
                            <div class="profile-avatar">
                                <img src="../img/developer.jpg" alt="Arthur Kolankiewicz" class="dev-photo">
                            </div>
                            <div class="profile-info">
                                <h4>Arthur Kolankiewicz</h4>
                                <p class="profile-title">Desenvolvedor PHP</p>
                            </div>
                        </div>
                        <p class="profile-description">
                            Com foco em back-end, destaco-me pela facilidade de aprendizado e pela dedicação que aplico no meu trabalho no dia a dia.
                        </p>
                    </div>

                    <div class="footer-card">
                        <div class="card-header">
                            <i class="bi bi-link-45deg header-icon"></i>
                            <h3>Links úteis</h3>
                        </div>
                        <div class="social-links">
                            <a href="https://www.instagram.com/akolankiewicz/" class="social-link">
                                <i class="bi bi-instagram social-icon"></i>
                                <span>Instagram</span>
                            </a>
                            <a href="https://www.linkedin.com/in/arthur-kolankiewicz-85b333302/" class="social-link">
                                <i class="bi bi-linkedin social-icon"></i>
                                <span>LinkedIn</span>
                            </a>
                            <a href="https://github.com/akolankiewicz" class="social-link">
                                <i class="bi bi-github social-icon"></i>
                                <span>GitHub</span>
                            </a>
                        </div>
                    </div>

                    <div class="footer-card">
                        <div class="card-header">
                            <i class="bi bi-envelope header-icon"></i>
                            <h3>Contato</h3>
                        </div>
                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="bi bi-envelope-fill contact-icon"></i>
                                <span>arthurkolan@hotmail.com</span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-telephone-fill contact-icon"></i>
                                <span>(49) 98888-8888</span>
                            </div>
                        </div>
                        
                        <div class="newsletter-section">
                            <h4> <i title="Preencha seu email e envie para receber o passo a passo!" 
                            class="bi bi-info-circle header-icon" 
                                style="margin-left: 10px; margin-right: 10px;"></i> Adquira meu ebook! </h4>
                            <form class="newsletter-form">
                                <div class="input-group">
                                    <input type="email" placeholder="Seu email" class="email-input">
                                    <button class="send-button" id="send-button">
                                        <i class="bi bi-send send-icon"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    <div class="footer-bottom-content">
                        <p>&copy; 2025 Arthur Kolankiewicz. Todos os direitos reservados.</p>
                    </div>
                    <div class="footer-social-icons">
                        <a href="https://www.instagram.com/akolankiewicz/" class="footer-social-icon">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/arthur-kolankiewicz-85b333302/" class="footer-social-icon">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="https://github.com/akolankiewicz" class="footer-social-icon">
                            <i class="bi bi-github"></i>
                        </a>
                    </div>
                </div>
            </footer>

            <div class="overlay" id="overlay"></div>

            <div class="gear-icon" id="gearIcon">
                <svg class="gear-svg" viewBox="0 0 24 24">
                    <path d="M12,15.5A3.5,3.5 0 0,1 8.5,12A3.5,3.5 0 0,1 12,8.5A3.5,3.5 0 0,1 15.5,12A3.5,3.5 0 0,1 12,15.5M19.43,12.97C19.47,12.65 19.5,12.33 19.5,12C19.5,11.67 19.47,11.34 19.43,11L21.54,9.37C21.73,9.22 21.78,8.95 21.66,8.73L19.66,5.27C19.54,5.05 19.27,4.96 19.05,5.05L16.56,6.05C16.04,5.66 15.5,5.32 14.87,5.07L14.5,2.42C14.46,2.18 14.25,2 14,2H10C9.75,2 9.54,2.18 9.5,2.42L9.13,5.07C8.5,5.32 7.96,5.66 7.44,6.05L4.95,5.05C4.73,4.96 4.46,5.05 4.34,5.27L2.34,8.73C2.22,8.95 2.27,9.22 2.46,9.37L4.57,11C4.53,11.34 4.5,11.67 4.5,12C4.5,12.33 4.53,12.65 4.57,12.97L2.46,14.63C2.27,14.78 2.22,15.05 2.34,15.27L4.34,18.73C4.46,18.95 4.73,19.03 4.95,18.95L7.44,17.94C7.96,18.34 8.5,18.68 9.13,18.93L9.5,21.58C9.54,21.82 9.75,22 10,22H14C14.25,22 14.46,21.82 14.5,21.58L14.87,18.93C15.5,18.68 16.04,18.34 16.56,17.94L19.05,18.95C19.27,19.03 19.54,18.95 19.66,18.73L21.66,15.27C21.78,15.05 21.73,14.78 21.54,14.63L19.43,12.97Z"/>
                </svg>
            </div>

            <div class="side-menu" id="sideMenu">
                <div class="menu-header">
                    Configurações
                </div>
                
                <div class="menu-options" id="menuOptions">
                    <div class="menu-option" onclick="selectOption('logs')">
                        <svg class="option-icon" viewBox="0 0 24 24">
                            <path d="M12,15.5A3.5,3.5 0 0,1 8.5,12A3.5,3.5 0 0,1 12,8.5A3.5,3.5 0 0,1 15.5,12A3.5,3.5 0 0,1 12,15.5M19.43,12.97C19.47,12.65 19.5,12.33 19.5,12C19.5,11.67 19.47,11.34 19.43,11L21.54,9.37C21.73,9.22 21.78,8.95 21.66,8.73L19.66,5.27C19.54,5.05 19.27,4.96 19.05,5.05L16.56,6.05C16.04,5.66 15.5,5.32 14.87,5.07L14.5,2.42C14.46,2.18 14.25,2 14,2H10C9.75,2 9.54,2.18 9.5,2.42L9.13,5.07C8.5,5.32 7.96,5.66 7.44,6.05L4.95,5.05C4.73,4.96 4.46,5.05 4.34,5.27L2.34,8.73C2.22,8.95 2.27,9.22 2.46,9.37L4.57,11C4.53,11.34 4.5,11.67 4.5,12C4.5,12.33 4.53,12.65 4.57,12.97L2.46,14.63C2.27,14.78 2.22,15.05 2.34,15.27L4.34,18.73C4.46,18.95 4.73,19.03 4.95,18.95L7.44,17.94C7.96,18.34 8.5,18.68 9.13,18.93L9.5,21.58C9.54,21.82 9.75,22 10,22H14C14.25,22 14.46,21.82 14.5,21.58L14.87,18.93C15.5,18.68 16.04,18.34 16.56,17.94L19.05,18.95C19.27,19.03 19.54,18.95 19.66,18.73L21.66,15.27C21.78,15.05 21.73,14.78 21.54,14.63L19.43,12.97Z"/>
                        </svg>
                        <span class="option-text">Logs do sistema</span>
                    </div>
                                   
                    <div class="menu-option" onclick="selectOption('sobre')">
                        <svg class="option-icon" viewBox="0 0 24 24">
                            <path d="M11,18H13V16H11V18M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,6A4,4 0 0,0 8,10H10A2,2 0 0,1 12,8A2,2 0 0,1 14,10C14,12 11,11.75 11,15H13C13,12.75 16,12.5 16,10A4,4 0 0,0 12,6Z"/>
                        </svg>
                        <span class="option-text">Sobre</span>
                    </div>
                    
                    <div class="menu-option" onclick="selectOption('sair')">
                        <svg class="option-icon" viewBox="0 0 24 24">
                            <path d="M16,17V14H9V10H16V7L21,12L16,17M14,2A2,2 0 0,1 16,4V6H14V4H5V20H14V18H16V20A2,2 0 0,1 14,22H5A2,2 0 0,1 3,20V4A2,2 0 0,1 5,2H14Z"/>
                        </svg>
                        <span class="option-text">Sair</span>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="exampleModalLong" tabindex="-1" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-custom">
                    <div class="modal-content modal-content-custom">
                        
                        <div class="modal-header modal-header-custom">
                            <h5 class="modal-title modal-title-custom" id="exampleModalLongTitle">Sobre o sistema</h5>
                            <button type="button" class="btn-close modal-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-body modal-body-custom">
                            <p><strong>Ascend Stats:</strong> por Arthur Kolankiewicz </p>
                            <p><strong>Versão:</strong> 1.0 <i>MASTER</i> </p>
                            <p><strong>Chave:</strong> oficial_version_2025</p>
                            <p><strong>Região:</strong> <span class="highlight-text">América do Sul - Brasil (Sul e Sudeste)</span></p>
                            <p><strong>Última Atualização da Base de Dados:</strong> <span class="highlight-date">20/06/2025</span></p>
                            <p><strong>Status do Servidor:</strong> <span class="highlight-status">Operacional Completo</span></p>
                            <p><strong>Módulos Ativos:</strong> <span class="highlight-category">Cadastro, Busca, Análise Gráfica, Estatísticas de Clube</span></p>
                            <p><strong>Observações:</strong> Sistema em contínuo aprimoramento, com foco na expansão de funcionalidades de comparação e relatórios personalizados para scouts.</p>
                        </div>
                        
                        <div class="modal-footer modal-footer-custom">
                            <button type="button" class="btn btn-secondary modal-close-button" data-bs-dismiss="modal">Fechar</button>
                        </div>
        
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="logModal" tabindex="-1" aria-labelledby="logModal" aria-hidden="true">
                <div class="modal-dialog modal-custom modal-custom-custom-height modal-custom-custom-large modal-xl">
                    <div class="modal-content modal-content-custom">
                        
                        <div class="modal-header modal-header-custom">
                            <h5 class="modal-title modal-title-custom" id="logModal">Logs do sistema</h5>
                            <button type="button" class="btn-close modal-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-body modal-body-custom">
                            <div id="log-content" style="max-height: 430px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                                <p>Carregando logs...</p> 
                            </div>
                        </div>
                        
                        <div class="modal-footer modal-footer-custom">
                            <button type="button" class="btn btn-secondary modal-close-button" data-bs-dismiss="modal">Fechar</button>
                        </div>
        
                    </div>
                </div>
            </div>
            `;

    const footerContainer = document.getElementById("footer-footer");
    if (footerContainer) {
        footerContainer.innerHTML = footerHTML;

        const gearIcon = document.getElementById("gearIcon");
        const sideMenu = document.getElementById("sideMenu");
        const overlay = document.getElementById("overlay");
        const menuOptions = document.getElementById("menuOptions");

        let isMenuOpen = false;

        function openMenu() {
            isMenuOpen = true;
            overlay.classList.add("active");
            sideMenu.classList.add("active");
            menuOptions.classList.add("active");
        }

        function closeMenu() {
            isMenuOpen = false;
            overlay.classList.remove("active");
            sideMenu.classList.remove("active");
            menuOptions.classList.remove("active");
        }

        if (gearIcon) {
            gearIcon.addEventListener("click", (e) => {
                e.stopPropagation();
                if (isMenuOpen) {
                    closeMenu();
                } else {
                    openMenu();
                }
            });
        }

        if (overlay) {
            overlay.addEventListener("click", closeMenu);
        }

        window.selectOption = function (option) {
            switch (option) {
                case 'logs':
                    gearOptionLogs();
                    break;
                case 'sobre':
                    gearOptionSobre();
                    break;
                case 'sair':
                    gearOptionSair();
                    break;
            }
            closeMenu();
        };

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape" && isMenuOpen) {
                closeMenu();
            }
        });

        function gearOptionLogs() {
            const logContentDiv = document.getElementById('log-content');
            logContentDiv.innerHTML = '<p>Carregando logs...</p>';

            fetch('../actions/action_get_logs.php')
                .then(response => {
                    if (!response.ok) {
                        exibirToastErro(`Erro na requisição: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    data.sort((a, b) => b.id - a.id);
                    logContentDiv.innerHTML = '';

                    if (data.length === 0) {
                        logContentDiv.innerHTML = '<p>Nenhum log encontrado.</p>';
                        return;
                    }

                    data.forEach(function (log) {
                        const logEntry = document.createElement('p');
                        logEntry.classList.add('log-entry');
                        logEntry.innerHTML = `
                            <small>ID: ${log.id} | </small>
                            <strong>${log.nome}</strong> ${log.tipo}
                            <small>em ${log.data}</small>
                            ${log.operador ? `<small>(Operador: ${log.operador})</small>` : ''}
                        `;
                        logContentDiv.appendChild(logEntry);
                    });

                    const logModal = new bootstrap.Modal(document.getElementById('logModal'));
                    logModal.show();
                })
                .catch(error => {
                    console.error('Ocorreu um erro:', error);
                    document.getElementById('session-user-name').textContent = '';
                });
        }

        function gearOptionSobre() {
            const myModalElement = document.getElementById('exampleModalLong');
            const myModal = new bootstrap.Modal(myModalElement);
            myModal.show();
        }

        function gearOptionSair() {
            fetch('../actions/action_logout.php');
            window.location.href = '../login-screen.html';
        }
    }

    const sendButton = document.getElementById('send-button');
    if (sendButton) {
        sendButton.addEventListener('click', function (evt) {
        evt.preventDefault();
        alert('Eu ainda não tenho ebook kkkkkkk quem sabe no futuro...');
        });
    }
});
