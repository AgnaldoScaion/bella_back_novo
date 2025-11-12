@extends('layouts.app')

@section('title', 'Bella Avventura - Destinos')

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @font-face {
            font-family: 'GaramondBold';
            src: local('Garamond'), serif;
            font-weight: bold;
        }

        :root {
            --primary-color: #2d5016;
            --primary-light: #5a8f3d;
            --primary-bg: #f3f7f3;
            --accent-color: #A7D096;
            --border-color: #E5F2E5;
            --text-dark: #1a1a1a;
            --text-medium: #4a4a4a;
            --text-light: #ffffff;
            --shadow-soft: 0 2px 15px rgba(45, 80, 22, 0.08);
            --shadow-medium: 0 8px 30px rgba(45, 80, 22, 0.12);
            --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            --border-radius: 16px;
            --border-radius-small: 8px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: var(--primary-bg);
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .wrapper { flex: 1; display: flex; flex-direction: column; }

        /* === HEADER === */
        .header { background-color: var(--accent-color); position: relative; height: 86px; display: flex; justify-content: center; align-items: center; }
        .header-img img { height: 126px; transition: transform 0.5s ease; }
        .header-img { position: absolute; top: -50px; left: 50%; transform: translateX(-50%); z-index: 1; }
        .top-header { display: flex; justify-content: space-between; align-items: center; padding: 10px 30px; background-color: var(--accent-color); }

        .user-header {
            font-family: 'Inter', sans-serif; font-size: 0.95rem; font-weight: 600; color: var(--primary-color);
            display: flex; align-items: center; gap: 8px; transition: var(--transition-smooth);
        }
        .user-header a { color: var(--primary-color); text-decoration: none; }
        .user-header a:hover { color: var(--primary-light); }

        /* === MENU LATERAL === */
        .menu-box { position: fixed; top: 60px; left: 20px; background: white; border-radius: var(--border-radius-small); padding: 20px; width: 260px; box-shadow: var(--shadow-soft); z-index: 1000; transition: opacity 0.3s ease, visibility 0.3s ease; }
        .hidden { visibility: hidden; opacity: 0; pointer-events: none; }
        .visible { visibility: visible; opacity: 1; pointer-events: auto; }

        /* === MAIN CONTENT === */
        .main-content { padding: 2.5rem 1rem; max-width: 1280px; margin: 0 auto; flex: 1; }
        .page-title { font-family: 'GaramondBold', serif; text-align: center; color: var(--primary-light); margin-bottom: 1.5rem; font-size: 2.8rem; }
        .page-subtitle { text-align: center; font-size: 1.1rem; color: var(--text-medium); max-width: 700px; margin: 0 auto 2.5rem; }

        .destinos-container {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.8rem; max-width: 1280px; margin: 0 auto; padding: 0 1rem;
        }

        .destino-card {
            background: white; border-radius: var(--border-radius); overflow: hidden; border: 2px solid var(--border-color);
            box-shadow: var(--shadow-soft); transition: var(--transition-smooth); display: flex; flex-direction: column;
        }
        .destino-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-medium); }

        .destino-img { height: 220px; overflow: hidden; position: relative; }
        .destino-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .destino-card:hover .destino-img img { transform: scale(1.08); }

        .destino-overlay {
            position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.7));
            display: flex; justify-content: center; align-items: center; opacity: 0; transition: var(--transition-smooth);
        }
        .destino-card:hover .destino-overlay { opacity: 1; }

        .destino-overlay-btn {
            background: var(--primary-light); color: white; border: none; padding: 10px 20px; border-radius: var(--border-radius-small);
            font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: var(--transition-smooth);
        }
        .destino-overlay-btn:hover { background: var(--primary-color); transform: translateY(-2px); }

        .destino-content { padding: 1.8rem; flex: 1; display: flex; flex-direction: column; }
        .destino-title { font-size: 1.4rem; font-weight: 700; color: var(--primary-light); margin-bottom: 0.8rem; }
        .destino-desc { font-size: 0.95rem; color: var(--text-medium); margin-bottom: 1.2rem; flex: 1; line-height: 1.5; }

        .destino-stats { display: flex; justify-content: space-between; border-top: 1px solid var(--border-color); padding-top: 1rem; }
        .stat-value { font-size: 1.2rem; color: var(--primary-light); font-weight: 600; }
        .stat-label { font-size: 0.85rem; color: var(--text-medium); }

        .btn-destino {
            background: var(--accent-color); color: var(--text-dark); padding: 0.8rem 1.5rem; border: none;
            border-radius: var(--border-radius-small); font-weight: 600; font-size: 0.95rem; text-decoration: none;
            display: inline-block; width: 100%; transition: var(--transition-smooth);
        }
        .btn-destino:hover { background: #8bc176; transform: translateY(-2px); }

        .instrucoes {
            margin-top: 3rem; background: white; border-radius: var(--border-radius); padding: 2rem;
            box-shadow: var(--shadow-soft); border: 2px solid var(--border-color); max-width: 900px; margin: 3rem auto;
        }
        .instrucoes h3 { color: var(--primary-light); font-size: 1.5rem; text-align: center; margin-bottom: 1.5rem; }
        .instrucoes-lista { list-style: none; padding: 0; counter-reset: instrucao; }
        .instrucoes-item {
            margin-bottom: 1.5rem; padding-left: 3rem; position: relative; counter-increment: instrucao;
            font-size: 0.95rem; color: var(--text-medium);
        }
        .instrucoes-item::before {
            content: counter(instrucao); position: absolute; left: 0; top: 2px; background: var(--primary-light);
            color: white; width: 28px; height: 28px; border-radius: 50%; display: flex; justify-content: center;
            align-items: center; font-weight: 600; font-size: 0.9rem;
        }

        /* === FOOTER === */
        .footer { background-color: var(--accent-color); padding: 20px; color: #000; font-size: 14px; text-align: center; }
        .footer-top img { width: 15%; transition: transform 0.5s ease; }
        .footer-top:hover img { transform: rotate(5deg) scale(1.05); }

        /* === BACK TO TOP === */
        .back-to-top {
            position: fixed; right: 20px; bottom: 20px; background: var(--primary-light); color: white;
            width: 48px; height: 48px; border-radius: 50%; display: flex; justify-content: center; align-items: center;
            cursor: pointer; box-shadow: var(--shadow-soft); transition: var(--transition-smooth); opacity: 0; visibility: hidden; z-index: 999;
        }
        .back-to-top.visible { opacity: 1; visibility: visible; }
        .back-to-top:hover { background: var(--primary-color); transform: translateY(-3px); }

        /* === TUTORIAL NOTIFICATION (APONTA PARA O CHAT) === */
        .tutorial-tooltip {
            position: fixed;
            bottom: 90px;
            right: 20px;
            background: var(--primary-color);
            color: white;
            padding: 12px 18px;
            border-radius: 16px;
            font-size: 0.95rem;
            font-weight: 600;
            max-width: 220px;
            box-shadow: var(--shadow-medium);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.5s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .tutorial-tooltip.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .tutorial-tooltip::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 27px;
            width: 0;
            height: 0;
            border-left: 12px solid transparent;
            border-right: 12px solid transparent;
            border-top: 12px solid var(--primary-color);
        }

        .tutorial-pulse {
            width: 10px;
            height: 10px;
            background: #fff;
            border-radius: 50%;
            animation: pulse 1.8s infinite;
            margin-left: 8px;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(0.9); opacity: 0.8; }
            50% { transform: scale(1.3); opacity: 1; }
        }

        /* === RESPONSIVO === */
        @media (max-width: 768px) {
            .main-content { padding: 1.5rem 0.8rem; }
            .page-title { font-size: 2.2rem; }
            .destinos-container { grid-template-columns: 1fr; }
            .tutorial-tooltip {
                bottom: 85px;
                right: 15px;
                font-size: 0.85rem;
                padding: 10px 14px;
                max-width: 180px;
            }
        }
    </style>
@endsection

@section('content')
    <main class="main-content">
        <h1 class="page-title">Escolha seu próximo destino</h1>
        <p class="page-subtitle">Selecione entre nossos hotéis, restaurantes ou pontos turísticos e comece a planejar sua Bella Avventura</p>

        <div class="destinos-container">
            <!-- Cards mantidos -->
            <div class="destino-card">
                <div class="destino-img">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Hotéis">
                    <div class="destino-overlay"><button class="destino-overlay-btn" data-destination="hoteis">Ver Hotéis</button></div>
                </div>
                <div class="destino-content">
                    <h3 class="destino-title">Hotéis</h3>
                    <p class="destino-desc">Encontre os melhores hotéis para sua estadia. Diferentes categorias, avaliações reais e preços acessíveis.</p>
                    <div class="destino-stats">
                        <div class="destino-stat"><span class="stat-value">200+</span><span class="stat-label">Hotéis</span></div>
                        <div class="destino-stat"><span class="stat-value">15.000+</span><span class="stat-label">Avaliações</span></div>
                        <div class="destino-stat"><span class="stat-value">30+</span><span class="stat-label">Cidades</span></div>
                    </div>
                    <div class="destino-action"><a href="{{ route('hoteis.alternative') }}" class="btn-destino">Explorar Hotéis</a></div>
                </div>
            </div>

            <div class="destino-card">
                <div class="destino-img">
                    <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Restaurantes">
                    <div class="destino-overlay"><button class="destino-overlay-btn" data-destination="restaurantes">Ver Restaurantes</button></div>
                </div>
                <div class="destino-content">
                    <h3 class="destino-title">Restaurantes</h3>
                    <p class="destino-desc">Descubra a gastronomia local com os melhores restaurantes. Culinária variada e experiências inesquecíveis.</p>
                    <div class="destino-stats">
                        <div class="destino-stat"><span class="stat-value">500+</span><span class="stat-label">Restaurantes</span></div>
                        <div class="destino-stat"><span class="stat-value">25.000+</span><span class="stat-label">Avaliações</span></div>
                        <div class="destino-stat"><span class="stat-value">50+</span><span class="stat-label">Cozinhas</span></div>
                    </div>
                    <div class="destino-action"><a href="{{ route('restaurantes.alternative') }}" class="btn-destino">Explorar Restaurantes</a></div>
                </div>
            </div>

            <div class="destino-card">
                <div class="destino-img">
                    <img src="https://images.unsplash.com/photo-1534430480872-3498386e7856?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Pontos Turísticos">
                    <div class="destino-overlay"><button class="destino-overlay-btn" data-destination="pontos-turisticos">Ver Pontos Turísticos</button></div>
                </div>
                <div class="destino-content">
                    <h3 class="destino-title">Pontos Turísticos</h3>
                    <p class="destino-desc">Conheça os pontos turísticos mais populares e os tesouros escondidos. Atrações para todos os gostos.</p>
                    <div class="destino-stats">
                        <div class="destino-stat"><span class="stat-value">350+</span><span class="stat-label">Pontos</span></div>
                        <div class="destino-stat"><span class="stat-value">18.000+</span><span class="stat-label">Avaliações</span></div>
                        <div class="destino-stat"><span class="stat-value">40+</span><span class="stat-label">Categorias</span></div>
                    </div>
                    <div class="destino-action"><a href="{{ route('pontos-turisticos.alternative') }}" class="btn-destino">Explorar Pontos</a></div>
                </div>
            </div>

            <div class="back-to-top" id="backToTop"><i class="fas fa-arrow-up"></i></div>
        </div>

        <div class="instrucoes">
            <h3>Como utilizar nosso sistema</h3>
            <ol class="instrucoes-lista">
                <li class="instrucoes-item"><strong>Escolha uma categoria:</strong> Selecione entre hotéis, restaurantes ou pontos turísticos.</li>
                <li class="instrucoes-item"><strong>Explore as opções:</strong> Filtre por avaliações, preço, localização ou outros critérios.</li>
                <li class="instrucoes-item"><strong>Faça reservas ou planeje visitas:</strong> Reserve hotéis, restaurantes ou planeje visitas.</li>
                <li class="instrucoes-item"><strong>Compartilhe sua experiência:</strong> Avalie e ganhe pontos para descontos futuros.</li>
            </ol>
        </div>
    </main>

    <!-- CHAT + TUTORIAL NOTIFICATION -->
    @if(Auth::check())
        @include('components.chat-feedback')

        <!-- Chat + Tutorial juntos -->
    <div style="position: fixed; bottom: 112px; left: 20px; z-index: 999; display: flex; flex-direction: column; align-items: flex-start; gap: 10px;">
        <div class="tutorial-tooltip" id="tutorialTooltip" style="position: static; opacity: 1; visibility: visible; transform: none; margin-bottom: 8px;">
            <span>Clique aqui para falar com a gente!</span>
            <div class="tutorial-pulse"></div>
        </div>
    </div>
    @endif
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatButton = document.getElementById('chatButton');
            const tutorialTooltip = document.getElementById('tutorialTooltip');
            if (chatButton && tutorialTooltip) {
                chatButton.addEventListener('click', function () {
                    tutorialTooltip.style.display = 'none';
                    sessionStorage.setItem('tutorialChatShown', 'true');
                });
            }
            @if (session('msg'))
                showNotification("{{ session('msg') }}", 'success');
            @endif

            setupCardOverlays();
            setupMenu();

            const backToTopButton = document.getElementById('backToTop');
            window.addEventListener('scroll', () => {
                backToTopButton.classList.toggle('visible', window.pageYOffset > 300);
            });
            backToTopButton.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

            // TUTORIAL: aparece 1x por sessão
            if (!sessionStorage.getItem('tutorialChatShown') && document.getElementById('tutorialTooltip')) {
                setTimeout(() => {
                    const tooltip = document.getElementById('tutorialTooltip');
                    tooltip.classList.add('show');
                    setTimeout(() => {
                        tooltip.classList.remove('show');
                        sessionStorage.setItem('tutorialChatShown', 'true');
                    }, 8000);
                }, 2500);
            }
        });

        function setupCardOverlays() {
            const destinations = {
                'hoteis': '{{ route('hoteis.alternative') }}',
                'restaurantes': '{{ route('restaurantes.alternative') }}',
                'pontos-turisticos': '{{ route('pontos-turisticos.alternative') }}'
            };
            document.querySelectorAll('.destino-overlay-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const dest = btn.getAttribute('data-destination');
                    if (destinations[dest]) window.location.href = destinations[dest];
                });
            });
        }

        function setupMenu() {
            const menuIcon = document.querySelector('.menu-icon');
            const menuBox = document.getElementById('menuBox');
            if (menuIcon && menuBox) {
                menuIcon.addEventListener('click', e => { e.stopPropagation(); menuBox.classList.toggle('visible'); menuBox.classList.toggle('hidden'); });
                document.addEventListener('click', e => { if (!menuBox.contains(e.target) && e.target !== menuIcon) menuBox.classList.replace('visible', 'hidden'); });
                menuBox.addEventListener('click', e => e.stopPropagation());
            }
            document.querySelectorAll('a[href="{{ route('logout') }}"]').forEach(link => {
                link.addEventListener('click', e => { e.preventDefault(); document.getElementById('logout-form')?.submit(); });
            });
        }

        function showNotification(message, type) {
            const el = document.getElementById('notificacao');
            if (el) {
                el.textContent = message;
                el.className = `notificacao ${type} show`;
                setTimeout(() => el.classList.remove('show'), 4000);
            }
        }
    </script>
@endsection
