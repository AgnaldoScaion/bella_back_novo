<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Bella Avventura</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="https://i.ibb.co/vx2Dzj9v/image.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')

    <!-- Estilos globais para layout e notificações -->
    <style>
        /* Navbar principal */
        .main-navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            box-shadow: 0 2px 8px rgba(90,143,61,0.07);
            padding: 0 32px;
            height: 64px;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .navbar-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2d5016;
            letter-spacing: 1px;
        }
        .navbar-center a, .navbar-right a {
            margin: 0 10px;
            color: #2d5016;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.2s;
        }
        .navbar-center a:hover, .navbar-right a:hover {
            color: #5a8f3d;
        }
        .navbar-center {
            display: flex;
            align-items: center;
        }
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .user-dropdown {
            position: relative;
            cursor: pointer;
        }
        .user-name {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
            color: #2d5016;
        }
        .user-name i {
            font-size: 1.2em;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 120%;
            background: #fff;
            box-shadow: 0 2px 8px rgba(90,143,61,0.13);
            border-radius: 10px;
            min-width: 160px;
            padding: 10px 0;
            z-index: 200;
        }
        .dropdown-menu a {
            display: block;
            padding: 10px 20px;
            color: #2d5016;
            text-decoration: none;
            font-weight: 500;
        }
        .dropdown-menu a:hover {
            background: #e8f5e9;
        }
        .user-dropdown.open .dropdown-menu {
            display: block;
        }
        .badge-pendentes {
            background: #ff6b6b;
            color: #fff;
            border-radius: 12px;
            padding: 2px 10px;
            font-size: 0.85rem;
            font-weight: bold;
            margin-left: 8px;
        }
        /* Mobile/desktop visibility */
        .mobile-only { display: none !important; }
        .desktop-only { display: flex !important; }
        @media (max-width: 900px) {
            .main-navbar { padding: 0 10px; }
        }
        @media (max-width: 768px) {
            .main-navbar { height: 56px; }
            .navbar-title { display: none; }
            .navbar-center, .navbar-right .desktop-only { display: none !important; }
            .mobile-only { display: inline-flex !important; }
        }
        @media (max-width: 480px) {
            .main-navbar { height: 48px; }
        }
        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1 0 auto;
        }

        .footer {
            flex-shrink: 0;
            width: 100%;
        }

        /* Notificação */
        .notification {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px 25px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease, top 0.3s ease;
            max-width: 90%;
            text-align: center;
        }

        .notification.show {
            top: 30px;
            opacity: 1;
        }

        .notification.success {
            background-color: #4CAF50;
        }

        .notification.error {
            background-color: #F44336;
        }

        /* Animação do logo */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-5px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        /* ===== ESTILOS PARA CARREGAMENTO DE IMAGENS ===== */
        .image-loading {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
        }

        .image-error {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 14px;
            border: 1px dashed #dee2e6;
            min-height: 100px;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Estilo para imagens com carregamento otimizado */
        img.lazy-load {
            opacity: 0;
            transition: opacity 0.3s;
        }

        img.lazy-load.loaded {
            opacity: 1;
        }

        /* Estilo para imagens de background com lazy loading */
        .lazy-bg {
            background-size: cover;
            background-position: center;
        }

    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="wrapper">
        <!-- Navbar Desktop/Mobile -->
        <nav class="main-navbar">
            <div class="navbar-left">
                <a href="{{ route('home') }}" class="navbar-logo">
                    <img src="https://i.ibb.co/Q7T008b1/image.png" alt="Logo" class="floating" style="height:38px;vertical-align:middle;">
                    <span class="navbar-title">Bella Avventura</span>
                </a>
            </div>
            <div class="navbar-center desktop-only">
                <a href="{{ route('destinos') }}">Destinos</a>
                @auth
                    <a href="{{ route('reservas.minhas') }}">Minhas Reservas</a>
                @endauth
                <a href="{{ route('sobre-nos') }}">Sobre nós</a>
            </div>
            <div class="navbar-right">
                <!-- Dropdown do usuário no desktop -->
                @auth
                    <span class="user-name" onclick="openUserMenu()">
                        <i class="fas fa-user-circle"></i>
                        {{ Auth::user()->nome_perfil ?? Auth::user()->nome_completo ?? Auth::user()->email ?? 'Usuário' }}
                        <i class="fas fa-bars"></i>
                    </span>
                @else
                    <a href="{{ route('login') }}" class="desktop-only">Entrar</a>
                @endauth
                        <!-- Menu hamburguer lateral do usuário -->
                        @auth
                        <div id="userMenuOverlay" class="user-menu-overlay" onclick="closeUserMenu()"></div>
                        <aside id="userMenu" class="user-menu">
                            <div class="user-menu-header">
                                <i class="fas fa-user-circle"></i>
                                <span>{{ Auth::user()->nome_perfil ?? Auth::user()->nome_completo ?? Auth::user()->email ?? 'Usuário' }}</span>
                            </div>
                            <nav class="user-menu-links">
                                <a href="{{ route('profile.show') }}"><i class="fas fa-user"></i> Meu Perfil</a>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Sair</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                            </nav>
                        </aside>
                        @endauth
                    <style>
                        .user-name {
                            display: flex;
                            align-items: center;
                            gap: 8px;
                            font-weight: 600;
                            color: #2d5016;
                            background: #fff;
                            border-radius: 12px;
                            padding: 8px 16px;
                            box-shadow: 0 2px 8px rgba(90,143,61,0.07);
                            cursor: pointer;
                            transition: background 0.2s;
                        }
                        .user-name:hover {
                            background: #e8f5e9;
                        }
                        .user-menu-overlay {
                            display: none;
                            position: fixed;
                            top: 0; left: 0; right: 0; bottom: 0;
                            background: rgba(0,0,0,0.3);
                            z-index: 1200;
                        }
                        .user-menu {
                            display: none;
                            position: fixed;
                            top: 0; right: 0;
                            width: 270px;
                            height: 100vh;
                            background: #fff;
                            box-shadow: -2px 0 16px rgba(45,80,22,0.10);
                            z-index: 1300;
                            transform: translateX(100%);
                            transition: transform 0.3s cubic-bezier(.4,0,.2,1);
                            padding: 0;
                            display: flex;
                            flex-direction: column;
                        }
                        .user-menu.open {
                            display: flex;
                            transform: translateX(0);
                        }
                        .user-menu-header {
                            display: flex;
                            align-items: center;
                            gap: 12px;
                            padding: 32px 24px 18px 24px;
                            font-size: 1.1rem;
                            font-weight: 700;
                            color: #2d5016;
                            border-bottom: 1px solid #e5f2e5;
                        }
                        .user-menu-header i {
                            font-size: 2.2rem;
                        }
                        .user-menu-links {
                            display: flex;
                            flex-direction: column;
                            padding: 24px;
                            gap: 18px;
                        }
                        .user-menu-links a {
                            color: #2d5016;
                            text-decoration: none;
                            font-size: 1.08rem;
                            font-weight: 500;
                            display: flex;
                            align-items: center;
                            gap: 10px;
                            padding: 10px 0;
                            border-radius: 8px;
                            transition: background 0.2s;
                        }
                        .user-menu-links a:hover {
                            background: #e8f5e9;
                        }
                        @media (max-width: 600px) {
                            .user-menu { width: 90vw; min-width: 180px; }
                        }
                    </style>
                <!-- Menu hamburguer só no mobile -->
                <span class="menu-icon mobile-only" onclick="toggleMenu()">☰</span>
            </div>
        </nav>


        <!-- Notificação Global -->
        <div id="notification"
            class="notification {{ session('success') ? 'success' : ($errors->any() ? 'error' : '') }} {{ session('success') || $errors->any() ? 'show' : '' }}">
            @if(session('success'))
                {{ session('success') }}
            @elseif($errors->any())
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            @endif
        </div>

        <!-- Conteúdo -->
        <main class="main-content">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-top">
                <a href="https://www.bellaavventura.com.br/">
                    <img src="https://i.ibb.co/j9vGknyy/image.png" alt="Bella Avventura"
                         onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjUwIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9IiNFMEUwRTAiLz48dGV4dCB4PSI1MCUiIHk9IjUwJSIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjEyIiBmaWxsPSIjNkM3NTdEIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBkeT0iLjNlbSI+QmVsbGEgQXZ2ZW50dXJhPC90ZXh0Pjwvc3ZnPg=='"/>
                </a>
            </div>
            <div class="footer-bottom">
                <div class="footer-left">
                    <a href="mailto:bella.avventura@gmail.com">📧 bella.avventura@gmail.com</a>
                </div>
                <div class="footer-center">© 2025 Bella Avventura</div>
                <div class="footer-right">
                    <a href="{{ route('termos') }}">Termos e condições</a>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Menu hamburguer lateral do usuário
        function openUserMenu() {
            document.getElementById('userMenu').classList.add('open');
            document.getElementById('userMenuOverlay').style.display = 'block';
        }
        function closeUserMenu() {
            document.getElementById('userMenu').classList.remove('open');
            document.getElementById('userMenuOverlay').style.display = 'none';
        }
        // Sistema avançado de carregamento de imagens com retry
        function initImageLoadingSystem() {
            // Configuração
            const MAX_RETRY_ATTEMPTS = 3;
            const RETRY_DELAY = 5000; // 5 segundos
            const COLD_STORAGE_DELAY = 30000; // 30 segundos para storage frio

            let observer;

            // Inicializar IntersectionObserver se disponível
            if ('IntersectionObserver' in window) {
                observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            loadImageWithRetry(img);
                            observer.unobserve(img);
                        }
                    });
                }, {
                    rootMargin: '200px 0px',
                    threshold: 0.01
                });
            }

            // Função principal para carregar imagens com sistema de retry
            function loadImageWithRetry(imgElement, retryCount = 0) {
                const src = imgElement.getAttribute('data-src') || imgElement.src;
                if (!src) return;

                // Mostra placeholder de carregamento
                imgElement.classList.add('image-loading');
                imgElement.classList.remove('image-error', 'loaded');

                const img = new Image();

                img.onload = function() {
                    // Sucesso no carregamento
                    if (imgElement.hasAttribute('data-src')) {
                        imgElement.src = src;
                        imgElement.removeAttribute('data-src');
                    }
                    imgElement.classList.remove('image-loading');
                    imgElement.classList.add('loaded');

                    // Força o cache do navegador
                    preloadImage(src);
                };

                img.onerror = function() {
                    imgElement.classList.remove('image-loading');

                    if (retryCount < MAX_RETRY_ATTEMPTS) {
                        // Tenta novamente após um delay
                        const delay = retryCount === 0 ? COLD_STORAGE_DELAY : RETRY_DELAY;

                        setTimeout(() => {
                            console.log(`Tentativa ${retryCount + 1} para imagem: ${src}`);
                            loadImageWithRetry(imgElement, retryCount + 1);
                        }, delay);
                    } else {
                        // Todas as tentativas falharam
                        imgElement.classList.add('image-error');
                        console.warn(`Falha ao carregar imagem após ${MAX_RETRY_ATTEMPTS} tentativas: ${src}`);
                    }
                };

                // Inicia o carregamento com parâmetro único para evitar cache em retries
                if (retryCount > 0) {
                    img.src = `${src}${src.includes('?') ? '&' : '?'}_t=${Date.now()}`;
                } else {
                    img.src = src;
                }
            }

            // Pré-carrega imagens para o cache do navegador
            function preloadImage(url) {
                const link = document.createElement('link');
                link.rel = 'preload';
                link.as = 'image';
                link.href = url;
                document.head.appendChild(link);

                // Remove após um tempo para limpeza
                setTimeout(() => {
                    if (link.parentNode) {
                        document.head.removeChild(link);
                    }
                }, 1000);
            }

            // Inicializa o lazy loading para todas as imagens
            function initImageLoading() {
                const images = document.querySelectorAll('img[data-src], img:not([data-src])');

                images.forEach(img => {
                    // Se já tem src, carrega normalmente
                    if (img.src && !img.hasAttribute('data-src')) {
                        loadImageWithRetry(img);
                    }
                    // Se tem data-src, usa lazy loading
                    else if (img.hasAttribute('data-src')) {
                        if (observer) {
                            observer.observe(img);
                        } else {
                            // Fallback para browsers sem IntersectionObserver
                            loadImageWithRetry(img);
                        }
                    }
                });
            }

            // Inicializa quando o DOM estiver pronto
            initImageLoading();

            // Sistema de retry para imagens que falharam
            setInterval(() => {
                document.querySelectorAll('img.image-error').forEach(img => {
                    const src = img.getAttribute('data-src') || img.src;
                    console.log(`Retentando imagem que falhou anteriormente: ${src}`);
                    loadImageWithRetry(img);
                });
            }, 60000); // Tenta a cada 60 segundos
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Inicializar sistema de carregamento de imagens
            initImageLoadingSystem();

            // Toggle menu - usando suas variáveis existentes
            const menuIcon = document.querySelector('.menu-icon');
            const menu = document.querySelector('.menu-box');

            // Verificar se os elementos existem antes de prosseguir
            if (!menu || !menuIcon) {
                console.warn('Menu ou ícone do menu não encontrado');
                return;
            }

            // Criar overlay se não existir
            let overlay = document.querySelector('.menu-overlay');
            if (!overlay) {
                overlay = document.createElement('div');
                overlay.className = 'menu-overlay';
                document.body.appendChild(overlay);
            }

            // Função para abrir o menu
            function openMenu() {
                menu.classList.remove('hidden');
                menu.classList.add('visible');
                overlay.classList.add('active');
                menuIcon.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            // Função para fechar o menu
            function closeMenu() {
                menu.classList.remove('visible');
                menu.classList.add('hidden');
                overlay.classList.remove('active');
                menuIcon.classList.remove('active');
                document.body.style.overflow = 'auto';
            }

            // Função toggle melhorada
            function toggleMenu() {
                if (menu.classList.contains('visible')) {
                    closeMenu();
                } else {
                    openMenu();
                }
            }

            // Event listener principal
            menuIcon.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                toggleMenu();
            });

            // Fechar menu ao clicar no overlay
            overlay.addEventListener('click', function (e) {
                e.preventDefault();
                closeMenu();
            });

            // Fechar menu ao clicar fora dele
            document.addEventListener('click', function (e) {
                if (!menu.contains(e.target) && !menuIcon.contains(e.target) && menu.classList.contains('visible')) {
                    closeMenu();
                }
            });

            // Fechar menu com a tecla ESC
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && menu.classList.contains('visible')) {
                    closeMenu();
                }
            });

            // Prevenir que cliques dentro do menu fechem o menu
            menu.addEventListener('click', function (e) {
                e.stopPropagation();
            });

            // Adicionar animação suave nos links do menu
            const menuLinks = menu.querySelectorAll('a');
            menuLinks.forEach((link, index) => {
                link.style.animationDelay = `${(index + 1) * 0.05}s`;
            });

            // Função para fechar o menu ao clicar em um link
            menuLinks.forEach(link => {
                if (!link.querySelector('.logout-btn')) {
                    link.addEventListener('click', function () {
                        setTimeout(() => {
                            closeMenu();
                        }, 150);
                    });
                }
            });

            // Expor funções globalmente
            window.toggleUserMenu = toggleMenu;
            window.openUserMenu = openMenu;
            window.closeUserMenu = closeMenu;

            // Exibir notificação por 3 segundos
            const notification = document.getElementById('notification');
            if (notification && notification.textContent.trim()) {
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 3000);
            }
        });
    </script>
    @yield('scripts')
</body>

</html>
