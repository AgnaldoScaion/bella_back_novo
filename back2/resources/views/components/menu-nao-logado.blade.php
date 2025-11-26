<nav class="navbar-nao-logado">
    <div class="navbar-container">
        <!-- Logo/Brand -->
        <div class="navbar-brand">
            <a href="{{ route('home') }}">
                <span class="brand-icon"></span>
                <span class="brand-name">BellaAventura</span>
            </a>
        </div>

        <!-- Menu Desktop -->
        <ul class="navbar-menu">
            <li><a href="{{ route('home') }}" class="nav-link">Início</a></li>
            <li><a href="{{ route('sobre-nos') }}" class="nav-link">Sobre nós</a></li>
            <li><a href="{{ route('termos') }}" class="nav-link">Termos</a></li>
        </ul>

        <!-- Botões de Ação -->
        <div class="navbar-actions">
            <a href="{{ route('login') }}" class="btn-login">Login</a>
            <a href="{{ route('register') }}" class="btn-register">Cadastrar</a>
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
        <ul>
            <li><a href="{{ route('home') }}">Início</a></li>
            <li><a href="{{ route('sobre-nos') }}">Sobre nós</a></li>
            <li><a href="{{ route('termos') }}">Termos</a></li>
            <li class="mobile-divider"></li>
            <li><a href="{{ route('login') }}" class="mobile-login">Login</a></li>
            <li><a href="{{ route('register') }}" class="mobile-register">Cadastrar</a></li>
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
    .navbar-nao-logado {
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
        0%, 100% {
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

    /* Botões de Ação */
    .navbar-actions {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .btn-login,
    .btn-register {
        text-decoration: none;
        padding: 10px 24px;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
        font-family: 'Inter', sans-serif;
    }

    .btn-login {
        color: #2E7D32;
        background: transparent;
        border: 2px solid #4CAF50;
    }

    .btn-login:hover {
        background: #E8F5E9;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(76, 175, 80, 0.2);
    }

    .btn-register {
        color: white;
        background: linear-gradient(135deg, #4CAF50, #2E7D32);
        border: 2px solid transparent;
        box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
    }

    .btn-register:hover {
        background: linear-gradient(135deg, #2E7D32, #1B5E20);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
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
        max-height: 500px;
    }

    .navbar-mobile ul {
        list-style: none;
        padding: 20px;
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

    .navbar-mobile.active li:nth-child(1) { transition-delay: 0.1s; }
    .navbar-mobile.active li:nth-child(2) { transition-delay: 0.15s; }
    .navbar-mobile.active li:nth-child(3) { transition-delay: 0.2s; }
    .navbar-mobile.active li:nth-child(4) { transition-delay: 0.25s; }
    .navbar-mobile.active li:nth-child(5) { transition-delay: 0.3s; }
    .navbar-mobile.active li:nth-child(6) { transition-delay: 0.35s; }

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

    .mobile-login {
        color: #2E7D32 !important;
        border: 2px solid #4CAF50;
        text-align: center;
        font-weight: 600;
    }

    .mobile-register {
        background: linear-gradient(135deg, #4CAF50, #2E7D32) !important;
        color: white !important;
        text-align: center;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
    }

    .mobile-register:hover {
        background: linear-gradient(135deg, #2E7D32, #1B5E20) !important;
    }

    /* Responsividade */
    @media (max-width: 992px) {
        .navbar-menu,
        .navbar-actions {
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
    }
</style>

<script>
    // Toggle do menu mobile
    const navbarToggle = document.getElementById('navbarToggle');
    const navbarMobile = document.getElementById('navbarMobile');

    if (navbarToggle && navbarMobile) {
        navbarToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            navbarMobile.classList.toggle('active');
        });

        // Fechar menu ao clicar em um link
        const mobileLinks = navbarMobile.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                navbarToggle.classList.remove('active');
                navbarMobile.classList.remove('active');
            });
        });

        // Fechar menu ao clicar fora
        document.addEventListener('click', function(event) {
            const isClickInside = navbarToggle.contains(event.target) || navbarMobile.contains(event.target);
            if (!isClickInside && navbarMobile.classList.contains('active')) {
                navbarToggle.classList.remove('active');
                navbarMobile.classList.remove('active');
            }
        });
    }
</script>
