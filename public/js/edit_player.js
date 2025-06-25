class PlayerEditor {
    constructor() {
        this.currentPlayer = null;
        this.init();
    }

    init() {
        this.setupRangeInputs();
        this.setupEventListeners();
        this.setupMobileMenu();
        this.setupFormValidation();
    }

    setupRangeInputs() {
        const rangeInputs = document.querySelectorAll('.form-range');
        
        rangeInputs.forEach(input => {
            const targetId = input.id;
            const valueDisplay = document.querySelector(`[data-target="${targetId}"]`);
            
            if (valueDisplay) {
                valueDisplay.textContent = input.value;

                input.addEventListener('input', (e) => {
                    valueDisplay.textContent = e.target.value;
                    this.updateRangeColor(input, e.target.value);
                });

                this.updateRangeColor(input, input.value);
            }
        });
    }

    updateRangeColor(input, value) {
        const percentage = (value - input.min) / (input.max - input.min) * 100;
        const color = this.getColorByValue(value);
        
        input.style.background = `linear-gradient(to right, ${color} 0%, ${color} ${percentage}%, rgba(255, 255, 255, 0.2) ${percentage}%, rgba(255, 255, 255, 0.2) 100%)`;
    }

    getColorByValue(value) {
        if (value >= 90) return '#4ade80';
        if (value >= 80) return '#22d3ee';
        if (value >= 70) return '#3b82f6';
        if (value >= 60) return '#8b5cf6';
        if (value >= 50) return '#f59e0b';
        if (value >= 30) return '#f97316';
        return '#ef4444';
    }

    setupEventListeners() {
        const loadPlayerBtn = document.getElementById('loadPlayerBtn');
        if (loadPlayerBtn) {
            loadPlayerBtn.addEventListener('click', () => this.loadPlayerData());
        }

        const playerForm = document.getElementById('playerForm');
        if (playerForm) {
            playerForm.addEventListener('submit', (e) => this.handleFormSubmit(e));
        }

        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('blur', () => this.validateField(input));
            input.addEventListener('input', () => this.clearFieldError(input));
        });
    }

    setupMobileMenu() {
        const mobileToggle = document.getElementById('mobileToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (mobileToggle && mobileMenu) {
            mobileToggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('active');
                mobileToggle.classList.toggle('active');
            });
        }
    }

    setupFormValidation() {
        const form = document.getElementById('playerForm');
        if (form) {
            form.noValidate = true;
        }
    }

    async loadPlayerData(playerId) {
        const playerData = await this.getPlayerData(playerId);

        setTimeout(() => {
            this.populateForm(playerData[""]);
            exibirToastSuccess('Dados do jogador carregados com sucesso!');
        }, 400);
    }

    populateForm(playerData) {
        this.currentPlayer = playerData;

        Object.keys(playerData).forEach(key => {
            const field = document.getElementById(key);
            if (field) {
                field.value = playerData[key] || '';

                if (field.type === 'range') {
                    const valueDisplay = document.querySelector(`[data-target="${key}"]`);
                    if (valueDisplay) {
                        valueDisplay.textContent = playerData[key] || 0;
                        this.updateRangeColor(field, playerData[key] || 0);
                    }
                }
            }
        });
        this.animateFieldFill();
    }

    animateFieldFill() {
        const fields = document.querySelectorAll('.form-control, .form-range');
        fields.forEach((field, index) => {
            setTimeout(() => {
                field.style.transform = 'scale(1.05)';
                field.style.transition = 'transform 0.2s ease';
                
                setTimeout(() => {
                    field.style.transform = 'scale(1)';
                }, 200);
            }, index * 50);
        });
    }

    validateField(field) {
        const value = field.value.trim();
        const fieldName = field.name;
        let isValid = true;
        let errorMessage = '';

        switch (fieldName) {
            case 'nome':
                if (!value) {
                    isValid = false;
                    errorMessage = 'Nome é obrigatório';
                } else if (value.length < 2) {
                    isValid = false;
                    errorMessage = 'Nome deve ter pelo menos 2 caracteres';
                }
                break;
                
            case 'peso':
                if (value && (isNaN(value) || value < 0 || value > 999.99)) {
                    isValid = false;
                    errorMessage = 'Peso deve ser um número válido entre 0 e 999.99';
                }
                break;
                
            case 'altura':
                if (value && (isNaN(value) || value < 0 || value > 9.99)) {
                    isValid = false;
                    errorMessage = 'Altura deve ser um número válido entre 0 e 9.99';
                }
                break;
                
            case 'data_nascimento':
                if (value) {
                    const birthDate = new Date(value);
                    const today = new Date();
                    const age = today.getFullYear() - birthDate.getFullYear();
                    
                    if (age < 15 || age > 50) {
                        isValid = false;
                        errorMessage = 'Idade deve estar entre 15 e 50 anos';
                    }
                }
                break;
                
            case 'imagem':
                if (value && !this.isValidURL(value)) {
                    isValid = false;
                    errorMessage = 'URL da imagem deve ser válida';
                }
                break;
        }

        if (isValid) {
            this.setFieldValid(field);
        } else {
            this.setFieldInvalid(field, errorMessage);
        }

        return isValid;
    }

    isValidURL(string) {
        try {
            new URL(string);
            return true;
        } catch (_) {
            return false;
        }
    }

    setFieldValid(field) {
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');
        this.removeFieldError(field);
    }

    setFieldInvalid(field, message) {
        field.classList.remove('is-valid');
        field.classList.add('is-invalid');
        this.showFieldError(field, message);
    }

    clearFieldError(field) {
        field.classList.remove('is-invalid', 'is-valid');
        this.removeFieldError(field);
    }

    showFieldError(field, message) {
        this.removeFieldError(field);
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'field-error';
        errorDiv.textContent = message;
        errorDiv.style.color = '#ef4444';
        errorDiv.style.fontSize = '0.875rem';
        errorDiv.style.marginTop = '5px';
        
        field.parentNode.appendChild(errorDiv);
    }

    removeFieldError(field) {
        const existingError = field.parentNode.querySelector('.field-error');
        if (existingError) {
            existingError.remove();
        }
    }

    validateForm() {
        const fields = document.querySelectorAll('.form-control[required]');
        let isValid = true;
        
        fields.forEach(field => {
            if (!this.validateField(field)) {
                isValid = false;
            }
        });
        
        return isValid;
    }

    collectFormData() {
        const formData = new FormData(document.getElementById('playerForm'));
        const data = {};
        
        for (let [key, value] of formData.entries()) {
            if (['peso', 'altura'].includes(key)) {
                data[key] = value ? parseFloat(value) : null;
            } else if ([
                'aceleracao', 'pique', 'finalizacao', 'forca_do_chute', 'chute_de_longe',
                'penalti', 'visao_de_jogo', 'cruzamento', 'passe_curto', 'passe_longo',
                'curva', 'agilidade', 'equilibrio', 'reacao', 'controle_de_bola',
                'drible', 'agressividade', 'interceptacao', 'precisao_no_cabeceio',
                'nocao_defensiva', 'desarme', 'carrinho', 'impulsao', 'folego', 'forca'
            ].includes(key)) {
                data[key] = value ? parseInt(value) : null;
            } else {
                data[key] = value || null;
            }
        }
        
        return data;
    }

    handleFormSubmit(e) {
        e.preventDefault();
        
        if (! this.validateForm()) {
            exibirToastErro('Por favor, corrija os erros no formulário', 'error');
            return;
        }
        
        this.savePlayer();
    }

    async savePlayer() {
        this.showLoading();

        const playerData = this.collectFormData();
        const playerId = PlayerUtils.getUrlParameter("id");
        playerData.id = playerId;

        if (! playerId) {
            this.hideLoading();
            exibirToastErro('ID do jogador não encontrado para salvar.');
            return;
        }

        try {
            const response = await fetch('../actions/action_save_player_changes.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: playerId, ...playerData })
            });

            const result = await response.json();

            if (!response.ok) {
                exibirToastErro(result.error || 'Erro ao salvar jogador');
            }

            exibirToastSuccess(result.success);
        } catch (error) {
            exibirToastErro(error.message);
        } finally {
            this.hideLoading();
        }
    }

    showLoading() {
        const form = document.getElementById('playerForm');
        if (form) {
            form.classList.add('loading');
        }

        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(btn => {
            btn.disabled = true;
            btn.style.opacity = '0.6';
        });
    }

    hideLoading() {
        const form = document.getElementById('playerForm');
        if (form) {
            form.classList.remove('loading');
        }

        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(btn => {
            btn.disabled = false;
            btn.style.opacity = '1';
        });
    }

    calculateOverall(playerData) {
        const attributes = [
            'aceleracao', 'pique', 'finalizacao', 'forca_do_chute', 'chute_de_longe',
            'penalti', 'visao_de_jogo', 'cruzamento', 'passe_curto', 'passe_longo',
            'curva', 'agilidade', 'equilibrio', 'reacao', 'controle_de_bola',
            'drible', 'agressividade', 'interceptacao', 'precisao_no_cabeceio',
            'nocao_defensiva', 'desarme', 'carrinho', 'impulsao', 'folego', 'forca'
        ];
        
        const total = attributes.reduce((sum, attr) => {
            return sum + (playerData[attr] || 0);
        }, 0);
        
        return Math.round(total / attributes.length);
    }

    async getPlayerData(playerId) {
        try {
            const response = await fetch(`../actions/action_get_player_stats.php?player_id=${playerId}`);

            if (!response.ok) {
                exibirToastErro(`Erro na requisição: ${response.status}`);
            }

            return await response.json();
        } catch (error) {
            console.error('Ocorreu um erro ao buscar dados do jogador:', error);
            return null;
        }
    }
}

const PlayerUtils = {
    formatDate(dateString) {
        if (!dateString) return '';
        const date = new Date(dateString);
        return date.toLocaleDateString('pt-BR');
    },

    calculateAge(birthDate) {
        if (!birthDate) return null;
        const today = new Date();
        const birth = new Date(birthDate);
        let age = today.getFullYear() - birth.getFullYear();
        const monthDiff = today.getMonth() - birth.getMonth();
        
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
            age--;
        }
        
        return age;
    },

    getUrlParameter(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }
};

document.addEventListener('DOMContentLoaded', () => {
    const playerEditor = new PlayerEditor();

    const playerId = PlayerUtils.getUrlParameter('id');
    if (playerId) {
        setTimeout(() => {
            playerEditor.loadPlayerData(playerId);
        }, 200);
    }

    window.PlayerEditor = playerEditor;
    window.PlayerUtils = PlayerUtils;
});

const style = document.createElement('style');
style.textContent = `
    .form-control.is-valid {
        border-color: #4ade80;
        box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.2);
    }
    
    .form-control.is-invalid {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
    }
    
    .field-error {
        animation: fadeInError 0.3s ease-out;
    }
    
    @keyframes fadeInError {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style);

