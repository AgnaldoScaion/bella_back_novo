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

        /* Overlay para menu */
        .menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Header Superior -->
        <div class="top-header">
            <div class="menu-icon">☰</div>
            <div class="user-header">
                <span>👤</span>
                @auth
                    {{ Auth::user()->nome_perfil ?? Auth::user()->nome_completo ?? Auth::user()->email }}
                    @php
                        $reservasPendentes = \App\Models\Reserva::where('user_id', Auth::id())
                            ->where('status', 'pendente')
                            ->count();
                    @endphp
                    @if($reservasPendentes > 0)
                        <a href="{{ route('reservas.minhas') }}" style="margin-left: 10px; text-decoration: none;">
                            <span style="background: #ff6b6b; color: white; padding: 2px 8px; border-radius: 12px; font-size: 0.75rem; font-weight: bold;">
                                {{ $reservasPendentes }} {{ $reservasPendentes == 1 ? 'reserva pendente' : 'reservas pendentes' }}
                            </span>
                        </a>
                    @endif
                @else
                    Visitante
                @endauth
            </div>
        </div>

        <!-- Logo -->
        <div class="header">
            <div class="header-img">
                <a href="{{ route('home') }}">
                    <img src="https://i.ibb.co/Q7T008b1/image.png" alt="Logo" class="floating"
                         onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjRTBFMEUwIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzZDNzU3RCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPkJlbGxhIEF2dmVudHVyYTwvdGV4dD48L3N2Zz4='"/>
                </a>
            </div>
        </div>

        <!-- Menu -->
        @if(Auth::check())
            @include('components.menu-logado')
        @else
            @include('components.menu-nao-logado')
        @endif

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
