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
                                <span>(49) 98806-2114</span>
                            </div>
                        </div>
                        
                        <div class="newsletter-section">
                            <h4>Receba novidades</h4>
                            <form class="newsletter-form">
                                <div class="input-group">
                                    <input type="email" placeholder="Seu email" class="email-input">
                                    <button type="submit" class="send-button">
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
                        <a href="#" class="footer-social-icon">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="footer-social-icon">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="#" class="footer-social-icon">
                            <i class="bi bi-github"></i>
                        </a>
                    </div>
                </div>
            </footer>
            `;

    const footerContainer = document.getElementById("footer-footer");
    if (footerContainer) {
        footerContainer.innerHTML = footerHTML;
    } else {
        console.error('Elemento com id "footer-footer" não encontrado.');
    }
});
