document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.modern-navbar');
    const mobileToggle = document.getElementById('mobileToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const logoImage = document.getElementById('logoImage');
    const logoPlaceholder = document.getElementById('logoPlaceholder');

    let isMobileMenuOpen = false;

    function toggleMobileMenu() {
        isMobileMenuOpen = !isMobileMenuOpen;
        mobileToggle.classList.toggle('active', isMobileMenuOpen);
        mobileMenu.classList.toggle('active', isMobileMenuOpen);

        document.body.style.overflow = isMobileMenuOpen ? 'hidden' : '';
    }

    mobileToggle.addEventListener('click', toggleMobileMenu);

    document.addEventListener('click', (e) => {
        if (isMobileMenuOpen && 
            !mobileMenu.contains(e.target) && 
            !mobileToggle.contains(e.target)) {
            toggleMobileMenu();
        }
    });

    let lastScrollTop = 0;
    window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }

        lastScrollTop = scrollTop;
    });

    function setActiveNavigation(activeId) {
        const desktopActiveLink = document.querySelector(`.nav-link[href="#${activeId}"]`);
        const mobileActiveLink = document.querySelector(`.mobile-nav-link[href="#${activeId}"]`);
        
        if (desktopActiveLink) desktopActiveLink.classList.add('active');
        if (mobileActiveLink) mobileActiveLink.classList.add('active');
    }

    function loadCustomLogo(imageSrc) {
        logoImage.src = imageSrc;
        logoImage.style.display = 'block';
        logoPlaceholder.style.display = 'none';

        logoImage.onerror = function() {
            logoImage.style.display = 'none';
            logoPlaceholder.style.display = 'flex';
        };
    }

    window.setNavbarLogo = function(imageSrc) {
        loadCustomLogo(imageSrc);
    };

    window.setBrandName = function(name) {
        const brandName = document.querySelector('.brand-name');
        brandName.textContent = name;
    };

    function animateNavbarElements() {
        const elements = document.querySelectorAll('.nav-item, .navbar-logo, .navbar-actions');
        elements.forEach((element, index) => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(-20px)';
            
            setTimeout(() => {
                element.style.transition = 'all 0.6s ease';
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }

    animateNavbarElements();

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isMobileMenuOpen) {
            toggleMobileMenu();
        }

        if ((e.key === 'Enter' || e.key === ' ') && e.target.classList.contains('nav-link')) {
            e.preventDefault();
            e.target.click();
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 768 && isMobileMenuOpen) {
            toggleMobileMenu();
        }
    });

    const style = document.createElement('style');
    style.textContent = `
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .notification-content {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
        }
        
        .notification-content i {
            font-size: 20px;
        }
    `;
    document.head.appendChild(style);
});

