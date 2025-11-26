<nav class="navbar-logado">
    <div class="navbar-container">
        <!-- Logo/Brand -->
        <div class="navbar-brand">
            <a href="{{ route('home') }}">
                <img src="https://raw.githubusercontent.com/AgnaldoScaion/bella_back_novo/main/back2/images/Bellaaventura.png"
                    alt="BellaAventura Logo" class="brand-icon" style="height:32px;width:auto;">
                <span class="brand-name">BellaAventura</span>
            </a>
        </div>

        <!-- Menu Desktop -->
        <ul class="navbar-menu">
            <li><a href="{{ route('home') }}" class="nav-link">Início</a></li>
            <li><a href="{{ route('destinos') }}" class="nav-link">Destinos</a></li>
            <li><a href="{{ route('reservas.minhas') }}" class="nav-link">Minhas Reservas</a></li>
            <li><a href="{{ route('sobre-nos') }}" class="nav-link">Sobre nós</a></li>
        </ul>

        <!-- User Menu Desktop -->
        <div class="navbar-user">
            <div class="user-dropdown">
                <button class="user-button" id="userMenuBtn">
                    <div class="user-avatar">
                        <span>{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <svg class="dropdown-arrow" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M4 6L8 10L12 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>

                <div class="dropdown-menu" id="userDropdown">
                    <a href="{{ route('profile.show') }}" class="dropdown-item">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        Meu Perfil
                    </a>
                    <a href="{{ route('termos') }}" class="dropdown-item">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                        </svg>
                        Termos
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item logout-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                            <polyline points="16 17 21 12 16 7" />
                            <line x1="21" y1="12" x2="9" y2="12" />
                        </svg>
                        Sair
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <!-- Botão Mobile -->
        <button class="navbar-toggle" id="navbarToggle" aria-label="Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <!-- Menu Mobile -->
    <div class="navbar-mobile" id="navbarMobile">
        <div class="mobile-user-info">
            <div class="user-avatar-mobile">
                <span>{{ substr(Auth::user()->name, 0, 1) }}</span>
            </div>
            <div class="user-details">
                <p class="user-name-mobile">{{ Auth::user()->name }}</p>
                <p class="user-email-mobile">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <ul>
            <li><a href="{{ route('home') }}">Início</a></li>
            <li><a href="{{ route('destinos') }}">Destinos</a></li>
            <li><a href="{{ route('reservas.minhas') }}">Minhas Reservas</a></li>
            <li><a href="{{ route('profile.show') }}">Meu Perfil</a></li>
            <li><a href="{{ route('sobre-nos') }}">Sobre nós</a></li>
            <li><a href="{{ route('termos') }}">Termos</a></li>
            <li class="mobile-divider"></li>
            <li>
                <a href="{{ route('logout') }}" class="mobile-logout"
                    onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                    Sair
                </a>
                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Navbar Principal */
    .navbar-logado {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: linear-gradient(145deg, #ffffff, #f8fffe);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        z-index: 1000;
        font-family: 'Poppins', sans-serif;
        border-bottom: 2px solid rgba(76, 175, 80, 0.1);
    }

    .navbar-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 70px;
        gap: 20px;
    }

    /* Logo/Brand */
    .navbar-brand a {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        color: #2E7D32;
        font-weight: 700;
        font-size: 24px;
        transition: all 0.3s ease;
    }

    .brand-icon {
        font-size: 28px;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-5px);
        }
    }

    .navbar-brand a:hover {
        transform: scale(1.05);
    }

    .brand-name {
        background: linear-gradient(135deg, #2E7D32, #4CAF50);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Menu Desktop */
    .navbar-menu {
        display: flex;
        list-style: none;
        gap: 5px;
        margin: 0;
        padding: 0;
        flex: 1;
        justify-content: center;
    }

    .nav-link {
        text-decoration: none;
        color: #424242;
        font-size: 16px;
        font-weight: 500;
        padding: 10px 20px;
        border-radius: 10px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .nav-link::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #4CAF50, #2E7D32);
        transform: translateX(-50%);
        transition: width 0.3s ease;
    }

    .nav-link:hover {
        color: #2E7D32;
        background: linear-gradient(135deg, #E8F5E9, #F1F8E9);
    }

    .nav-link:hover::before {
        width: 80%;
    }

    /* User Menu */
    .navbar-user {
        position: relative;
    }

    .user-dropdown {
        position: relative;
    }

    .user-button {
        display: flex;
        align-items: center;
        gap: 10px;
        background: linear-gradient(135deg, #E8F5E9, #F1F8E9);
        border: 2px solid rgba(76, 175, 80, 0.2);
        border-radius: 12px;
        padding: 8px 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }

    .user-button:hover {
        background: linear-gradient(135deg, #C8E6C9, #DCEDC8);
        border-color: rgba(76, 175, 80, 0.4);
        box-shadow: 0 4px 12px rgba(76, 175, 80, 0.2);
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4CAF50, #2E7D32);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 16px;
        text-transform: uppercase;
    }

    .user-name {
        color: #2E7D32;
        font-weight: 600;
        font-size: 15px;
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .dropdown-arrow {
        color: #2E7D32;
        transition: transform 0.3s ease;
    }

    .user-button.active .dropdown-arrow {
        transform: rotate(180deg);
    }

    /* Dropdown Menu */
    .dropdown-menu {
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        min-width: 220px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        border: 1px solid rgba(76, 175, 80, 0.2);
        overflow: hidden;
    }

    .dropdown-menu.active {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        color: #424242;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 15px;
        font-weight: 500;
    }

    .dropdown-item svg {
        flex-shrink: 0;
        color: #4CAF50;
    }

    .dropdown-item:hover {
        background: linear-gradient(135deg, #E8F5E9, #F1F8E9);
        color: #2E7D32;
    }

    .dropdown-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, #E0E0E0, transparent);
        margin: 8px 0;
    }

    .logout-item {
        color: #D32F2F !important;
    }

    .logout-item svg {
        color: #D32F2F !important;
    }

    .logout-item:hover {
        background: linear-gradient(135deg, #FFEBEE, #FFCDD2) !important;
    }

    /* Botão Toggle Mobile */
    .navbar-toggle {
        display: none;
        flex-direction: column;
        gap: 5px;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 8px;
        z-index: 1001;
    }

    .navbar-toggle span {
        width: 25px;
        height: 3px;
        background: #2E7D32;
        border-radius: 3px;
        transition: all 0.3s ease;
    }

    .navbar-toggle.active span:nth-child(1) {
        transform: rotate(45deg) translate(8px, 8px);
    }

    .navbar-toggle.active span:nth-child(2) {
        opacity: 0;
    }

    .navbar-toggle.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -7px);
    }

    /* Menu Mobile */
    .navbar-mobile {
        position: fixed;
        top: 70px;
        left: 0;
        right: 0;
        background: linear-gradient(145deg, #ffffff, #f8fffe);
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border-top: 1px solid rgba(76, 175, 80, 0.1);
    }

    .navbar-mobile.active {
        max-height: 600px;
    }

    .mobile-user-info {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 20px;
        background: linear-gradient(135deg, #E8F5E9, #F1F8E9);
        border-bottom: 2px solid rgba(76, 175, 80, 0.2);
    }

    .user-avatar-mobile {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4CAF50, #2E7D32);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 20px;
        text-transform: uppercase;
        flex-shrink: 0;
    }

    .user-details {
        flex: 1;
    }

    .user-name-mobile {
        color: #2E7D32;
        font-weight: 600;
        font-size: 16px;
        margin-bottom: 4px;
    }

    .user-email-mobile {
        color: #666;
        font-size: 13px;
        opacity: 0.8;
    }

    .navbar-mobile ul {
        list-style: none;
        padding: 15px 20px;
    }

    .navbar-mobile li {
        margin: 0;
        opacity: 0;
        transform: translateY(-10px);
        transition: all 0.3s ease;
    }

    .navbar-mobile.active li {
        opacity: 1;
        transform: translateY(0);
    }

    .navbar-mobile.active li:nth-child(1) {
        transition-delay: 0.1s;
    }

    .navbar-mobile.active li:nth-child(2) {
        transition-delay: 0.15s;
    }

    .navbar-mobile.active li:nth-child(3) {
        transition-delay: 0.2s;
    }

    .navbar-mobile.active li:nth-child(4) {
        transition-delay: 0.25s;
    }

    .navbar-mobile.active li:nth-child(5) {
        transition-delay: 0.3s;
    }

    .navbar-mobile.active li:nth-child(6) {
        transition-delay: 0.35s;
    }

    .navbar-mobile.active li:nth-child(7) {
        transition-delay: 0.4s;
    }

    .navbar-mobile.active li:nth-child(8) {
        transition-delay: 0.45s;
    }

    .navbar-mobile a {
        display: block;
        padding: 14px 20px;
        color: #424242;
        text-decoration: none;
        font-weight: 500;
        border-radius: 10px;
        margin-bottom: 5px;
        transition: all 0.3s ease;
    }

    .navbar-mobile a:hover {
        background: linear-gradient(135deg, #E8F5E9, #F1F8E9);
        color: #2E7D32;
        transform: translateX(5px);
    }

    .mobile-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, #E0E0E0, transparent);
        margin: 15px 0;
    }

    .mobile-logout {
        background: linear-gradient(135deg, #FFEBEE, #FFCDD2) !important;
        color: #D32F2F !important;
        text-align: center;
        font-weight: 600;
        border: 2px solid rgba(211, 47, 47, 0.2);
    }

    .mobile-logout:hover {
        background: linear-gradient(135deg, #FFCDD2, #EF9A9A) !important;
        box-shadow: 0 4px 12px rgba(211, 47, 47, 0.3);
    }

    /* Responsividade */
    @media (max-width: 992px) {

        .navbar-menu,
        .navbar-user {
            display: none;
        }

        .navbar-toggle {
            display: flex;
        }
    }

    @media (max-width: 768px) {
        .navbar-container {
            padding: 0 20px;
            height: 60px;
        }

        .navbar-mobile {
            top: 60px;
        }

        .brand-name {
            font-size: 20px;
        }

        .brand-icon {
            font-size: 24px;
        }
    }

    @media (max-width: 480px) {
        .navbar-container {
            padding: 0 15px;
        }

        .brand-name {
            display: none;
        }

        .mobile-user-info {
            padding: 15px;
        }

        .user-avatar-mobile {
            width: 45px;
            height: 45px;
            font-size: 18px;
        }

        .user-name-mobile {
            font-size: 15px;
        }

        .user-email-mobile {
            font-size: 12px;
        }
    }
</style>

<script>
    // Toggle do menu mobile
    const navbarToggle = document.getElementById('navbarToggle');
    const navbarMobile = document.getElementById('navbarMobile');

    if (navbarToggle && navbarMobile) {
        navbarToggle.addEventListener('click', function () {
            this.classList.toggle('active');
            navbarMobile.classList.toggle('active');
        });

        // Fechar menu ao clicar em um link
        const mobileLinks = navbarMobile.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function () {
                navbarToggle.classList.remove('active');
                navbarMobile.classList.remove('active');
            });
        });

        // Fechar menu ao clicar fora
        document.addEventListener('click', function (event) {
            const isClickInside = navbarToggle.contains(event.target) || navbarMobile.contains(event.target);
            if (!isClickInside && navbarMobile.classList.contains('active')) {
                navbarToggle.classList.remove('active');
                navbarMobile.classList.remove('active');
            }
        });
    }

    // Dropdown do usuário (Desktop)

    const userMenuBtn = document.getElementById('userMenuBtn');
    const userDropdown = document.getElementById('userDropdown');

    if (userMenuBtn && userDropdown) {
        userMenuBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            this.classList.toggle('active');
            userDropdown.classList.toggle('active');
        });

        // Fechar dropdown ao clicar fora
        document.addEventListener('click', function (event) {
            if (!userMenuBtn.contains(event.target) && !userDropdown.contains(event.target)) {
                userMenuBtn.classList.remove('active');
                userDropdown.classList.remove('active');
            }
        });
    }
</script>
