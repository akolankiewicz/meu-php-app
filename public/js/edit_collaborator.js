class CollaboratorEditor {
    constructor() {
        this.currentCollaborator = null;
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.setupMobileMenu();
        this.setupFormValidation();
        this.setupPasswordToggle();
    }

    setupEventListeners() {
        this.loadCollaboratorData().then(r => console.error('Erro'));
        const collaboratorForm = document.getElementById('collaboratorForm');
        if (collaboratorForm) {
            collaboratorForm.addEventListener('submit', (e) => this.handleFormSubmit(e));
        }

        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('blur', () => this.validateField(input));
            input.addEventListener('input', () => this.clearFieldError(input));
        });

        const senhaField = document.getElementById('senha');
        const confirmSenhaField = document.getElementById('confirm_senha');
        
        if (senhaField && confirmSenhaField) {
            confirmSenhaField.addEventListener('blur', () => this.validatePasswordConfirmation());
            senhaField.addEventListener('input', () => this.clearPasswordErrors());
        }
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
        const form = document.getElementById('collaboratorForm');
        if (form) {
            form.noValidate = true;
        }
    }

    setupPasswordToggle() {
        const togglePassword = document.getElementById('togglePassword');
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const senhaField = document.getElementById('senha');
        const confirmSenhaField = document.getElementById('confirm_senha');

        if (togglePassword && senhaField) {
            togglePassword.addEventListener('click', () => {
                this.togglePasswordVisibility(senhaField, togglePassword);
            });
        }

        if (toggleConfirmPassword && confirmSenhaField) {
            toggleConfirmPassword.addEventListener('click', () => {
                this.togglePasswordVisibility(confirmSenhaField, toggleConfirmPassword);
            });
        }
    }

    togglePasswordVisibility(field, button) {
        const icon = button.querySelector('i');
        
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }

    async loadCollaboratorData() {
        const collaboratorId = CollaboratorUtils.getUrlParameter("id");
        if (! collaboratorId) {
            exibirToastErro("ID do colaborador não fornecido na URL.");
            return;
        }

        this.showLoading();
        
        try {
            const response = await fetch(`../actions/action_load_collaborator_data.php?id=${collaboratorId}`);
            const data = await response.json();
            
            if (!response.ok) {
                throw new Error(data.error || "Erro ao carregar dados do colaborador.");
            }
            
            this.populateForm(data);
            exibirToastSuccess("Dados do colaborador carregados com sucesso!");
        } catch (error) {
            exibirToastErro("Dados de exemplo carregados (erro na API: " + error.message + ")");
        } finally {
            this.hideLoading();
        }
    }

    populateForm(collaboratorData) {
        this.currentCollaborator = collaboratorData;

        Object.keys(collaboratorData).forEach(key => {
            const field = document.getElementById(key);
            if (field) {
                field.value = collaboratorData[key] || '';
            }
        });

        this.animateFieldFill();
    }

    animateFieldFill() {
        const fields = document.querySelectorAll('.form-control');
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
                
            case 'email':
                if (!value) {
                    isValid = false;
                    errorMessage = 'E-mail é obrigatório';
                } else if (!this.isValidEmail(value)) {
                    isValid = false;
                    errorMessage = 'E-mail deve ter um formato válido';
                }
                break;
                
            case 'telefone':
                if (value && !this.isValidPhone(value)) {
                    isValid = false;
                    errorMessage = 'Telefone deve ter um formato válido';
                }
                break;
                
            case 'data_nascimento':
                if (value) {
                    const birthDate = new Date(value);
                    const today = new Date();
                    const age = today.getFullYear() - birthDate.getFullYear();
                    
                    if (age < 16 || age > 80) {
                        isValid = false;
                        errorMessage = 'Idade deve estar entre 16 e 80 anos';
                    }
                }
                break;
                
            case 'type_user':
                if (!value) {
                    isValid = false;
                    errorMessage = 'Tipo de usuário é obrigatório';
                }
                break;
                
            case 'senha':
                if (value && value.length < 6) {
                    isValid = false;
                    errorMessage = 'Senha deve ter pelo menos 6 caracteres';
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

    validatePasswordConfirmation() {
        const senhaField = document.getElementById('senha');
        const confirmSenhaField = document.getElementById('confirm_senha');
        
        if (!senhaField || !confirmSenhaField) return true;
        
        const senha = senhaField.value;
        const confirmSenha = confirmSenhaField.value;
        
        if (senha && confirmSenha && senha !== confirmSenha) {
            this.setFieldInvalid(confirmSenhaField, 'As senhas não coincidem');
            return false;
        } else if (confirmSenha) {
            this.setFieldValid(confirmSenhaField);
        }
        
        return true;
    }

    clearPasswordErrors() {
        const senhaField = document.getElementById('senha');
        const confirmSenhaField = document.getElementById('confirm_senha');
        
        if (senhaField) this.clearFieldError(senhaField);
        if (confirmSenhaField) this.clearFieldError(confirmSenhaField);
    }

    isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    isValidPhone(phone) {
        const phoneRegex = /^[\(\)\s\-\+\d]{10,20}$/;
        return phoneRegex.test(phone);
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
        
        field.parentNode.appendChild(errorDiv);
    }

    removeFieldError(field) {
        const existingError = field.parentNode.querySelector('.field-error');
        if (existingError) {
            existingError.remove();
        }
    }

    validateForm() {
        const requiredFields = document.querySelectorAll('.form-control[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!this.validateField(field)) {
                isValid = false;
            }
        });

        if (!this.validatePasswordConfirmation()) {
            isValid = false;
        }
        
        return isValid;
    }

    collectFormData() {
        const formData = new FormData(document.getElementById('collaboratorForm'));
        const data = {};
        
        for (let [key, value] of formData.entries()) {
            if (key === 'type_user') {
                data[key] = value ? parseInt(value) : null;
            } else {
                data[key] = value || null;
            }
        }

        delete data.confirm_senha;

        if (!data.senha) {
            delete data.senha;
        }
        
        return data;
    }

    handleFormSubmit(e) {
        e.preventDefault();
        
        if (!this.validateForm()) {
            exibirToastErro('Por favor, corrija os erros no formulário');
            return;
        }
        
        this.saveCollaborator();
    }

    async saveCollaborator() {
        this.showLoading();
        
        const collaboratorData = this.collectFormData();
        const collaboratorId = CollaboratorUtils.getUrlParameter("id");
        collaboratorData.id = collaboratorId;

        if (! collaboratorId) {
            this.hideLoading();
            exibirToastErro('ID do colaborador não encontrado para salvar.');
            return;
        }

        try {
            const response = await fetch('../actions/action_save_collaborator_changes.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: collaboratorId, ...collaboratorData })
            });
            
            const result = await response.json();
            
            if (!response.ok) {
                throw new Error(result.error || 'Erro ao salvar colaborador');
            }

            if (result.success) {
                exibirToastSuccess(result.success);
            }
        } catch (error) {
            exibirToastErro(error.message);
        } finally {
            this.hideLoading();
        }
    }

    showLoading() {
        const form = document.getElementById('collaboratorForm');
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
        const form = document.getElementById('collaboratorForm');
        if (form) {
            form.classList.remove('loading');
        }

        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(btn => {
            btn.disabled = false;
            btn.style.opacity = '1';
        });
    }

    getCollaboratorById(id) {
        return new Promise((resolve) => {
            setTimeout(() => {
                resolve(sampleCollaboratorData);
            }, 1000);
        });
    }
}

const CollaboratorUtils = {
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
    },

    formatPhone(phone) {
        if (!phone) return '';
        const numbers = phone.replace(/\D/g, '');

        if (numbers.length === 11) {
            return numbers.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        } else if (numbers.length === 10) {
            return numbers.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
        }
        
        return phone;
    },

    getUserTypeName(typeId) {
        const types = {
            1: 'Administrador',
            2: 'Gerente',
            3: 'Analista',
            4: 'Usuário Comum'
        };
        
        return types[typeId] || 'Não definido';
    }
};

document.addEventListener('DOMContentLoaded', () => {
    window.CollaboratorEditor = new CollaboratorEditor();
    window.CollaboratorUtils = CollaboratorUtils;
});

