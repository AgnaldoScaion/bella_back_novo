<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Bella Avventura</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="https://i.ibb.co/vx2Dzj9v/image.png">
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
                @else
                    Visitante
                @endauth
            </div>
        </div>

        <!-- Logo -->
        <div class="header">
            <div class="header-img">
                <a href="{{ route('home') }}">
                    <img src="https://i.ibb.co/Q7T008b1/image.png" alt="Logo" class="floating" />
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
                    <img src="https://i.ibb.co/j9vGknyy/image.png" alt="Bella Avventura">
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
        document.addEventListener('DOMContentLoaded', function () {
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
                document.body.style.overflow = 'hidden'; // Previne scroll do body
            }

            // Função para fechar o menu
            function closeMenu() {
                menu.classList.remove('visible');
                menu.classList.add('hidden');
                overlay.classList.remove('active');
                menuIcon.classList.remove('active');
                document.body.style.overflow = 'auto'; // Restaura scroll do body
            }

            // Função toggle melhorada
            function toggleMenu() {
                if (menu.classList.contains('visible')) {
                    closeMenu();
                } else {
                    openMenu();
                }
            }

            // Event listener principal - usando seu código base
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

            // Função para fechar o menu ao clicar em um link (opcional)
            menuLinks.forEach(link => {
                // Não fechar no logout pois ele tem um form
                if (!link.querySelector('.logout-btn')) {
                    link.addEventListener('click', function () {
                        // Delay pequeno para ver a animação de hover
                        setTimeout(() => {
                            closeMenu();
                        }, 150);
                    });
                }
            });

            // Expor funções globalmente para uso em outros scripts se necessário
            window.toggleUserMenu = toggleMenu;
            window.openUserMenu = openMenu;
            window.closeUserMenu = closeMenu;

            // Log para debug (remover em produção)
            console.log('Menu de usuário inicializado com sucesso');

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
fire