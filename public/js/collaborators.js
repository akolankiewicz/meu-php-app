class CollaboratorsList {
    constructor() {
        this.collaborators = [];
        this.filteredCollaborators = [];
        this.currentPage = 1;
        this.itemsPerPage = 25;
        this.sortColumn = 'nome';
        this.sortOrder = 'asc';
        this.filters = {
            search: '',
            type: '',
            state: ''
        };
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.setupMobileMenu();
        this.loadCollaborators();
    }

    setupEventListeners() {
        const searchInput = document.getElementById('searchInput');
        const clearSearch = document.getElementById('clearSearch');
        
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                this.filters.search = e.target.value;
                this.applyFilters();
            });
        }
        
        if (clearSearch) {
            clearSearch.addEventListener('click', () => {
                searchInput.value = '';
                this.filters.search = '';
                this.applyFilters();
            });
        }

        const typeFilter = document.getElementById('typeFilter');
        const stateFilter = document.getElementById('stateFilter');
        
        if (typeFilter) {
            typeFilter.addEventListener('change', (e) => {
                this.filters.type = e.target.value;
                this.applyFilters();
            });
        }
        
        if (stateFilter) {
            stateFilter.addEventListener('change', (e) => {
                this.filters.state = e.target.value;
                this.applyFilters();
            });
        }

        const sortBy = document.getElementById('sortBy');
        const sortOrder = document.getElementById('sortOrder');
        
        if (sortBy) {
            sortBy.addEventListener('change', (e) => {
                this.sortColumn = e.target.value;
                this.applySort();
            });
        }
        
        if (sortOrder) {
            sortOrder.addEventListener('click', () => {
                this.toggleSortOrder();
            });
        }

        const sortableHeaders = document.querySelectorAll('.sortable');
        sortableHeaders.forEach(header => {
            header.addEventListener('click', () => {
                const column = header.dataset.column;
                if (this.sortColumn === column) {
                    this.toggleSortOrder();
                } else {
                    this.sortColumn = column;
                    this.sortOrder = 'asc';
                    this.applySort();
                }
            });
        });

        const prevPage = document.getElementById('prevPage');
        const nextPage = document.getElementById('nextPage');
        const itemsPerPage = document.getElementById('itemsPerPage');
        
        if (prevPage) {
            prevPage.addEventListener('click', () => this.goToPage(this.currentPage - 1));
        }
        
        if (nextPage) {
            nextPage.addEventListener('click', () => this.goToPage(this.currentPage + 1));
        }
        
        if (itemsPerPage) {
            itemsPerPage.addEventListener('change', (e) => {
                this.itemsPerPage = parseInt(e.target.value);
                this.currentPage = 1;
                this.renderTable();
            });
        }

        const addCollaboratorBtn = document.getElementById('addCollaboratorBtn');
        const refreshBtn = document.getElementById('refreshBtn');
        
        if (addCollaboratorBtn) {
            addCollaboratorBtn.addEventListener('click', () => {
                window.location.href = '/register-screen.php';
            });
        }
        
        if (refreshBtn) {
            refreshBtn.addEventListener('click', () => {
                this.loadCollaborators();
            });
        }

        const confirmDelete = document.getElementById('confirmDelete');
        if (confirmDelete) {
            confirmDelete.addEventListener('click', () => {
                this.confirmDeleteCollaborator();
            });
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

    async loadCollaborators() {
        try {
            const response = await fetch('../actions/action_load_collaborators.php');
            const data = await response.json();
            
            if (!response.ok) {
                throw new Error(data.error || 'Erro ao carregar colaboradores');
            }
            
            this.collaborators = data;
            exibirToastSuccess('Colaboradores carregados com sucesso!');
        } catch (error) {
            exibirToastErro('Falha ao carregar dados (erro na API: ' + error.message + ')');
        } finally {
            this.hideLoading();
            this.applyFilters();
            this.updateStats();
        }
    }

    applyFilters() {
        this.filteredCollaborators = this.collaborators.filter(collaborator => {
            if (this.filters.search) {
                const searchTerm = this.filters.search.toLowerCase();
                const searchableText = `${collaborator.nome} ${collaborator.email} ${collaborator.telefone || ''}`.toLowerCase();
                if (!searchableText.includes(searchTerm)) {
                    return false;
                }
            }

            if (this.filters.type && collaborator.type_user.toString() !== this.filters.type) {
                return false;
            }

            return !(this.filters.state && collaborator.estado !== this.filters.state);
        });
        
        this.currentPage = 1;
        this.applySort();
    }

    applySort() {
        this.filteredCollaborators.sort((a, b) => {
            let valueA = a[this.sortColumn];
            let valueB = b[this.sortColumn];

            if (this.sortColumn === 'data_nascimento') {
                valueA = this.calculateAge(valueA);
                valueB = this.calculateAge(valueB);
            } else if (typeof valueA === 'string') {
                valueA = valueA.toLowerCase();
                valueB = valueB.toLowerCase();
            }
            
            if (valueA < valueB) {
                return this.sortOrder === 'asc' ? -1 : 1;
            }
            if (valueA > valueB) {
                return this.sortOrder === 'asc' ? 1 : -1;
            }
            return 0;
        });
        
        this.updateSortUI();
        this.renderTable();
    }

    toggleSortOrder() {
        this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
        this.applySort();
    }

    updateSortUI() {
        const sortOrderBtn = document.getElementById('sortOrder');
        if (sortOrderBtn) {
            const icon = sortOrderBtn.querySelector('i');
            const text = sortOrderBtn.querySelector('span') || sortOrderBtn.childNodes[1];
            
            if (this.sortOrder === 'desc') {
                sortOrderBtn.classList.add('desc');
                icon.className = 'bi bi-sort-alpha-up';
                if (text) text.textContent = 'Z-A';
            } else {
                sortOrderBtn.classList.remove('desc');
                icon.className = 'bi bi-sort-alpha-down';
                if (text) text.textContent = 'A-Z';
            }
        }

        const sortBy = document.getElementById('sortBy');
        if (sortBy) {
            sortBy.value = this.sortColumn;
        }

        const headers = document.querySelectorAll('.sortable');
        headers.forEach(header => {
            const icon = header.querySelector('.sort-icon');
            header.classList.remove('active');
            
            if (header.dataset.column === this.sortColumn) {
                header.classList.add('active');
                if (icon) {
                    icon.className = this.sortOrder === 'asc' ? 'bi bi-chevron-up sort-icon' : 'bi bi-chevron-down sort-icon';
                }
            } else if (icon) {
                icon.className = 'bi bi-chevron-expand sort-icon';
            }
        });
    }

    renderTable() {
        const tbody = document.getElementById('collaboratorsTableBody');
        const resultsCount = document.getElementById('resultsCount');
        const emptyState = document.getElementById('emptyState');
        const table = document.getElementById('collaboratorsTable');
        
        if (!tbody) return;

        const startIndex = (this.currentPage - 1) * this.itemsPerPage;
        const endIndex = startIndex + this.itemsPerPage;
        const pageData = this.filteredCollaborators.slice(startIndex, endIndex);

        if (resultsCount) {
            const total = this.filteredCollaborators.length;
            resultsCount.textContent = `${total} colaborador${total !== 1 ? 'es' : ''} encontrado${total !== 1 ? 's' : ''}`;
        }

        if (this.filteredCollaborators.length === 0) {
            if (emptyState) emptyState.style.display = 'block';
            if (table) table.style.display = 'none';
            this.updatePagination();
            return;
        } else {
            if (emptyState) emptyState.style.display = 'none';
            if (table) table.style.display = 'table';
        }

        tbody.innerHTML = pageData.map(collaborator => `
            <tr>
                <td>${collaborator.id}</td>
                <td>
                    <strong>${this.escapeHtml(collaborator.nome)}</strong>
                </td>
                <td>${this.escapeHtml(collaborator.email)}</td>
                <td>
                    <span class="user-type-badge ${this.getUserTypeClass(collaborator.type_user)}">
                        ${this.getUserTypeName(collaborator.type_user)}
                    </span>
                </td>
                <td>${this.formatPhone(collaborator.telefone)}</td>
                <td>${this.escapeHtml(collaborator.cidade || '-')}</td>
                <td>${this.escapeHtml(collaborator.estado || '-')}</td>
                <td>${this.calculateAgeFromTable(collaborator.data_nascimento) || '-'} anos</td>
                <td class="actions-column">
                    <button class="action-btn edit" onclick="editCollaborator(${collaborator.id})" title="Editar">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="action-btn delete" onclick="deleteCollaborator(${collaborator.id}, '${this.escapeHtml(collaborator.nome)}')" title="Excluir">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
        `).join('');

        this.updatePagination();
    }

    updatePagination() {
        const totalItems = this.filteredCollaborators.length;
        const totalPages = Math.ceil(totalItems / this.itemsPerPage);

        const paginationInfo = document.getElementById('paginationInfo');
        if (paginationInfo) {
            const startItem = totalItems === 0 ? 0 : (this.currentPage - 1) * this.itemsPerPage + 1;
            const endItem = Math.min(this.currentPage * this.itemsPerPage, totalItems);
            paginationInfo.textContent = `Mostrando ${startItem}-${endItem} de ${totalItems} colaboradores`;
        }

        const prevPage = document.getElementById('prevPage');
        const nextPage = document.getElementById('nextPage');
        
        if (prevPage) {
            prevPage.disabled = this.currentPage <= 1;
        }
        
        if (nextPage) {
            nextPage.disabled = this.currentPage >= totalPages;
        }

        this.renderPageNumbers(totalPages);
    }

    renderPageNumbers(totalPages) {
        const pageNumbers = document.getElementById('pageNumbers');
        if (!pageNumbers) return;

        const maxVisiblePages = 5;
        let startPage = Math.max(1, this.currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

        if (endPage - startPage + 1 < maxVisiblePages) {
            startPage = Math.max(1, endPage - maxVisiblePages + 1);
        }

        let html = '';
        
        for (let i = startPage; i <= endPage; i++) {
            html += `
                <button class="page-number ${i === this.currentPage ? 'active' : ''}" 
                        onclick="collaboratorsList.goToPage(${i})">
                    ${i}
                </button>
            `;
        }

        pageNumbers.innerHTML = html;
    }

    goToPage(page) {
        const totalPages = Math.ceil(this.filteredCollaborators.length / this.itemsPerPage);
        
        if (page >= 1 && page <= totalPages) {
            this.currentPage = page;
            this.renderTable();
        }
    }

    updateStats() {
        const totalCollaborators = document.getElementById('totalCollaborators');
        const adminCount = document.getElementById('adminCount');
        const analystCount = document.getElementById('analystCount');

        if (totalCollaborators) {
            totalCollaborators.textContent = this.collaborators.length;
        }

        const stats = this.collaborators.reduce((acc, collaborator) => {
            switch (collaborator.type_user) {
                case 1: acc.admin++; break;
                case 2: acc.analyst++; break;
                default: acc.user++; break;
            }
            return acc;
        }, { admin: 0, analyst: 0, user: 0 });

        if (adminCount) adminCount.textContent = stats.admin;
        if (analystCount) analystCount.textContent = stats.analyst;
    }

    showLoading() {
        const loading = document.getElementById('tableLoading');
        if (loading) {
            loading.style.display = 'flex';
        }
    }

    hideLoading() {
        const loading = document.getElementById('tableLoading');
        if (loading) {
            loading.style.display = 'none';
        }
    }

    escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    formatPhone(phone) {
        if (!phone) return '-';
        const numbers = phone.replace(/\D/g, '');
        
        if (numbers.length === 11) {
            return numbers.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        } else if (numbers.length === 10) {
            return numbers.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
        }
        
        return phone;
    }

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
    }

    calculateAgeFromTable(birthDateString) {
        if (! birthDateString) return null;

        const parts = birthDateString.split('-');
        const birthYear = parseInt(parts[0], 10);
        const birthMonth = parseInt(parts[1], 10) - 1;
        const birthDay = parseInt(parts[2], 10);

        const today = new Date();
        const todayYear = today.getFullYear();
        const todayMonth = today.getMonth();
        const todayDay = today.getDate();

        if (todayYear === birthYear) {
            return 1;
        }

        let age = todayYear - birthYear;

        if (todayMonth < birthMonth || (todayMonth === birthMonth && todayDay < birthDay)) {
            age--;
        }

        return age;
    }

    getUserTypeName(typeId) {
        const types = {
            1: 'Administrador',
            2: 'Analista',
        };
        
        return types[typeId] || 'Não definido';
    }

    getUserTypeClass(typeId) {
        const classes = {
            1: 'user-type-admin',
            2: 'user-type-analyst'
        };
        
        return classes[typeId] || 'user-type-user';
    }

    async confirmDeleteCollaborator() {
        const idToDelete = window.deleteCollaboratorId;
        if (idToDelete) {
            try {
                const response = await fetch('../actions/action_delete_collaborator.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({id: idToDelete})
                });

                const result = await response.json();

                if (result.erro) {
                    exibirToastErro(result.erro);
                    return;
                }

                if (!response.ok) {
                    throw new Error(result.error || 'Erro ao excluir colaborador');
                }

                exibirToastSuccess('Colaborador excluído com sucesso!');
                collaboratorsList.loadCollaborators();

                const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                modal.hide();

            } catch (error) {
                exibirToastErro(error.message);
            }
        }
    }
}

async function editCollaborator(id) {
    const res = await fetch('../actions/action_get_user_data.php');
    const response = await res.json();
    if (response.type_user === 1) {
        window.location.href = `edit_collaborator.php?id=${id}`;
    } else {
        exibirToastErro('Você não tem permissão para realizar está ação!')
    }
}

function deleteCollaborator(id, name) {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    const nameElement = document.getElementById('deleteCollaboratorName');
    
    if (nameElement) {
        nameElement.textContent = name;
    }

    window.deleteCollaboratorId = id;
    modal.show();
}

function clearAllFilters() {
    const searchInput = document.getElementById('searchInput');
    const typeFilter = document.getElementById('typeFilter');
    const stateFilter = document.getElementById('stateFilter');
    
    if (searchInput) searchInput.value = '';
    if (typeFilter) typeFilter.value = '';
    if (stateFilter) stateFilter.value = '';

    if (window.collaboratorsList) {
        window.collaboratorsList.filters = {
            search: '',
            type: '',
            state: ''
        };
        window.collaboratorsList.applyFilters();
    }
}

let collaboratorsList;

document.addEventListener('DOMContentLoaded', () => {
    collaboratorsList = new CollaboratorsList();
    window.collaboratorsList = collaboratorsList;
});

