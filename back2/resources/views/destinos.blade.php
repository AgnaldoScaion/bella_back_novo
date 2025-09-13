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
            --shadow-strong: 0 15px 40px rgba(45, 80, 22, 0.18);
            --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            --border-radius: 16px;
            --border-radius-small: 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

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

        .wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Original Header Styles (Unchanged except for user-header) */
        .header {
            background-color: var(--accent-color);
            position: relative;
            height: 86px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .header-img img {
            height: 126px;
            transition: transform 0.5s ease;
        }

        .header-img {
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
        }

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            background-color: var(--accent-color);
            position: relative;
        }

        .menu-icon {
            font-size: 24px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .menu-icon:hover {
            transform: scale(1.1);
        }

        .user-header {
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition-smooth);
        }

        .user-header a {
            color: var(--text-dark);
            text-decoration: none;
            transition: var(--transition-smooth);
        }

        .user-header a:hover {
            color: var(--primary-light);
        }

        /* Menu Styles */
        .menu-box {
            position: fixed;
            top: 60px;
            left: 20px;
            background-color: white;
            border-radius: var(--border-radius-small);
            padding: 20px;
            width: 260px;
            box-shadow: var(--shadow-soft);
            z-index: 1000;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .menu-lateral {
            background-color: var(--primary-light);
            width: 24px;
            border-radius: var(--border-radius-small);
        }

        .menu-conteudo {
            flex: 1;
            font-family: 'Inter', sans-serif;
        }

        .menu-conteudo h2 {
            font-size: 1.25rem;
            color: var(--primary-color);
            margin: 0 0 10px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 8px;
        }

        .menu-conteudo ul {
            list-style: none;
            padding: 0;
            margin-top: 10px;
        }

        .menu-conteudo li {
            margin: 10px 0;
        }

        .menu-conteudo a {
            text-decoration: none;
            color: var(--text-dark);
            font-size: 0.95rem;
            transition: var(--transition-smooth);
        }

        .menu-conteudo a:hover {
            color: var(--primary-light);
        }

        .hidden {
            visibility: hidden;
            opacity: 0;
            pointer-events: none;
        }

        .visible {
            visibility: visible;
            opacity: 1;
            pointer-events: auto;
        }

        /* Main Content */
        .main-content {
            padding: 2.5rem 1rem;
            max-width: 1280px;
            margin: 0 auto;
            flex: 1;
        }

        .page-title {
            font-family: 'GaramondBold', serif;
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-size: 2.8rem;
            letter-spacing: 0.5px;
        }

        .page-subtitle {
            text-align: center;
            font-family: 'Inter', sans-serif;
            font-weight: 400;
            font-size: 1.1rem;
            line-height: 1.6;
            color: var(--text-medium);
            max-width: 700px;
            margin: 0 auto 2.5rem;
        }

        .destinos-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.8rem;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .destino-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            border: 2px solid var(--border-color);
            box-shadow: var(--shadow-soft);
            transition: var(--transition-smooth);
            display: flex;
            flex-direction: column;
            animation: fadeInUp 0.8s ease forwards;
        }

        .destino-card.show {
            opacity: 1;
            transform: translateY(0);
        }

        .destino-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-medium);
        }

        .destino-img {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .destino-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .destino-card:hover .destino-img img {
            transform: scale(1.08);
        }

        .destino-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.7));
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: var(--transition-smooth);
        }

        .destino-card:hover .destino-overlay {
            opacity: 1;
        }

        .destino-overlay-btn {
            background: var(--primary-light);
            color: var(--text-light);
            border: none;
            padding: 10px 20px;
            border-radius: var(--border-radius-small);
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: var(--transition-smooth);
        }

        .destino-overlay-btn:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
        }

        .destino-content {
            padding: 1.8rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .destino-title {
            font-family: 'Inter', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.8rem;
        }

        .destino-desc {
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            color: var(--text-medium);
            margin-bottom: 1.2rem;
            flex: 1;
            line-height: 1.5;
        }

        .destino-stats {
            display: flex;
            justify-content: space-between;
            border-top: 1px solid var(--border-color);
            padding-top: 1rem;
        }

        .destino-stat {
            text-align: center;
            flex: 1;
        }

        .stat-value {
            font-size: 1.2rem;
            color: var(--primary-light);
            font-weight: 600;
        }

        .stat-label {
            font-size: 0.85rem;
            color: var(--text-medium);
            font-weight: 400;
        }

        .destino-action {
            margin-top: auto;
            text-align: center;
        }

        .btn-destino {
            background: var(--accent-color);
            color: var(--text-dark);
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: var(--border-radius-small);
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            text-decoration: none;
            transition: var(--transition-smooth);
            display: inline-block;
            width: 100%;
        }

        .btn-destino:hover {
            background: #8bc176;
            transform: translateY(-2px);
        }

        .btn-destino:focus {
            box-shadow: 0 0 0 3px rgba(90, 143, 61, 0.2);
            outline: none;
        }

        .instrucoes {
            margin-top: 3rem;
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--shadow-soft);
            border: 2px solid var(--border-color);
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
            animation: fadeIn 1s ease;
        }

        .instrucoes h3 {
            color: var(--primary-color);
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            font-family: 'Inter', sans-serif;
        }

        .instrucoes-lista {
            list-style-type: none;
            padding: 0;
            counter-reset: instrucao;
        }

        .instrucoes-item {
            margin-bottom: 1.5rem;
            padding-left: 3rem;
            position: relative;
            counter-increment: instrucao;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            color: var(--text-medium);
        }

        .instrucoes-item::before {
            content: counter(instrucao);
            position: absolute;
            left: 0;
            top: 2px;
            background: var(--primary-light);
            color: var(--text-light);
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .instrucoes-item strong {
            font-weight: 600;
        }

        /* Original Footer Styles (Unchanged) */
        .footer {
            background-color: var(--accent-color);
            padding: 20px;
            color: #000;
            font-size: 14px;
            text-align: center;
            animation: fadeIn 1s ease;
        }

        .footer-top {
            margin-bottom: 15px;
        }

        .footer-top img {
            width: 15%;
            height: auto;
            transition: transform 0.5s ease;
        }

        .footer-top:hover img {
            transform: rotate(5deg) scale(1.05);
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .footer-left, .footer-center, .footer-right {
            flex: 1;
            text-align: center;
            transition: all 0.3s ease;
        }

        .footer-left:hover, .footer-right:hover {
            transform: translateY(-3px);
        }

        .footer-left { text-align: left; }
        .footer-right { text-align: right; }

        .footer-bottom a {
            text-decoration: underline;
            color: black;
            transition: color 0.3s ease;
        }

        .footer-bottom a:hover {
            color: var(--primary-color);
        }

        .notificacao {
            background: var(--primary-light);
            color: var(--text-light);
            padding: 1rem 2rem;
            text-align: center;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            display: none;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            border-radius: var(--border-radius-small);
            box-shadow: var(--shadow-soft);
            min-width: 320px;
        }

        .notificacao.show {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            animation: slideIn 0.5s ease forwards, fadeOut 4s 1s forwards;
        }

        .notificacao::before {
            content: '\f058';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 1.2rem;
        }

        .back-to-top {
            position: fixed;
            right: 20px;
            bottom: 20px;
            background: var(--primary-light);
            color: var(--text-light);
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: var(--shadow-soft);
            transition: var(--transition-smooth);
            opacity: 0;
            visibility: hidden;
            z-index: 999;
        }

        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
            from { transform: translateX(-50%) translateY(-20px); opacity: 0; }
            to { transform: translateX(-50%) translateY(0); opacity: 1; }
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            80% { opacity: 1; }
            100% { opacity: 0; }
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
            100% { transform: translateY(0); }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1.5rem 0.8rem;
            }

            .page-title {
                font-size: 2.2rem;
            }

            .page-subtitle {
                font-size: 1rem;
                margin-bottom: 2rem;
            }

            .destinos-container {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .destino-img {
                height: 200px;
            }

            .instrucoes {
                padding: 1.5rem;
            }
        }

        @media (max-width: 600px) {
            .page-title {
                font-size: 1.8rem;
            }

            .destino-title {
                font-size: 1.2rem;
            }

            .destino-overlay-btn {
                padding: 8px 16px;
                font-size: 0.9rem;
            }

            .btn-destino {
                padding: 0.7rem;
                font-size: 0.9rem;
            }

            .instrucoes-item {
                padding-left: 2.5rem;
            }

            .back-to-top {
                width: 40px;
                height: 40px;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Main Content -->
    <main class="main-content">
        <h1 class="page-title">Escolha seu próximo destino</h1>
        <p class="page-subtitle">Selecione entre nossos hotéis, restaurantes ou pontos turísticos e comece a planejar sua Bella Avventura</p>
        <div class="destinos-container">
            <div class="destino-card">
                <div class="destino-img">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Hotéis">
                    <div class="destino-overlay">
                        <button class="destino-overlay-btn" data-destination="hoteis">Ver Hotéis</button>
                    </div>
                </div>
                <div class="destino-content">
                    <h3 class="destino-title">Hotéis</h3>
                    <p class="destino-desc">Encontre os melhores hotéis para sua estadia. Diferentes categorias, avaliações reais e preços acessíveis para todos os tipos de viajantes.</p>
                    <div class="destino-stats">
                        <div class="destino-stat">
                            <span class="stat-value">200+</span>
                            <span class="stat-label">Hotéis</span>
                        </div>
                        <div class="destino-stat">
                            <span class="stat-value">15.000+</span>
                            <span class="stat-label">Avaliações</span>
                        </div>
                        <div class="destino-stat">
                            <span class="stat-value">30+</span>
                            <span class="stat-label">Cidades</span>
                        </div>
                    </div>
                    <div class="destino-action">
                        <a href="{{ route('hoteis') }}" class="btn-destino">Explorar Hotéis</a>
                    </div>
                </div>
            </div>
            <div class="destino-card">
                <div class="destino-img">
                    <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Restaurantes">
                    <div class="destino-overlay">
                        <button class="destino-overlay-btn" data-destination="restaurantes">Ver Restaurantes</button>
                    </div>
                </div>
                <div class="destino-content">
                    <h3 class="destino-title">Restaurantes</h3>
                    <p class="destino-desc">Descubra a gastronomia local com os melhores restaurantes. Culinária variada, preços para todos os bolsos e experiências inesquecíveis.</p>
                    <div class="destino-stats">
                        <div class="destino-stat">
                            <span class="stat-value">500+</span>
                            <span class="stat-label">Restaurantes</span>
                        </div>
                        <div class="destino-stat">
                            <span class="stat-value">25.000+</span>
                            <span class="stat-label">Avaliações</span>
                        </div>
                        <div class="destino-stat">
                            <span class="stat-value">50+</span>
                            <span class="stat-label">Cozinhas</span>
                        </div>
                    </div>
                    <div class="destino-action">
                        <a href="{{ route('restaurantes.index') }}" class="btn-destino">Explorar Restaurantes</a>
                    </div>
                </div>
            </div>
            <div class="destino-card">
                <div class="destino-img">
                    <img src="https://images.unsplash.com/photo-1534430480872-3498386e7856?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Pontos Turísticos">
                    <div class="destino-overlay">
                        <button class="destino-overlay-btn" data-destination="pontos-turisticos">Ver Pontos Turísticos</button>
                    </div>
                </div>
                <div class="destino-content">
                    <h3 class="destino-title">Pontos Turísticos</h3>
                    <p class="destino-desc">Conheça os pontos turísticos mais populares e os tesouros escondidos. Atrações naturais, históricas e culturais para todos os gostos.</p>
                    <div class="destino-stats">
                        <div class="destino-stat">
                            <span class="stat-value">350+</span>
                            <span class="stat-label">Pontos</span>
                        </div>
                        <div class="destino-stat">
                            <span class="stat-value">18.000+</span>
                            <span class="stat-label">Avaliações</span>
                        </div>
                        <div class="destino-stat">
                            <span class="stat-value">40+</span>
                            <span class="stat-label">Categorias</span>
                        </div>
                    </div>
                    <div class="destino-action">
                        <a href="{{ route('pontos-turisticos') }}" class="btn-destino">Explorar Pontos</a>
                    </div>
                </div>
            </div>
            <div class="back-to-top" id="backToTop">
                <i class="fas fa-arrow-up"></i>
            </div>
        </div>
        <div class="instrucoes">
            <h3>Como utilizar nosso sistema</h3>
            <ol class="instrucoes-lista">
                <li class="instrucoes-item">
                    <strong>Escolha uma categoria:</strong> Selecione entre hotéis, restaurantes ou pontos turísticos com base no seu interesse atual.
                </li>
                <li class="instrucoes-item">
                    <strong>Explore as opções:</strong> Veja as diversas opções disponíveis, filtre por avaliações, preço, localização ou outros critérios relevantes.
                </li>
                <li class="instrucoes-item">
                    <strong>Faça reservas ou planeje visitas:</strong> Para hotéis, faça reservas diretamente. Para restaurantes, verifique disponibilidade ou faça reservas. Para pontos turísticos, planeje sua visita.
                </li>
                <li class="instrucoes-item">
                    <strong>Compartilhe sua experiência:</strong> Após sua visita, avalie e compartilhe sua experiência para ajudar outros viajantes e acumular pontos para descontos futuros.
                </li>
            </ol>
        </div>
    </main>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Exibir notificação se houver mensagem na sessão
    @if (session('msg'))
        showNotification("{{ session('msg') }}", 'success');
    @endif
    // Configurar overlays dos cards
    setupCardOverlays();
    // Configurar menu hamburguer
    setupMenu();
    // Configurar botão "voltar ao topo"
    const backToTopButton = document.getElementById('backToTop');
    const footer = document.getElementById('pageFooter');
    function adjustBackToTopPosition() {
        if (footer) {
            const footerRect = footer.getBoundingClientRect();
            const viewportHeight = window.innerHeight;
            const footerTop = footerRect.top;
            if (footerTop < viewportHeight) {
                const newBottom = (viewportHeight - footerTop) + 10;
                backToTopButton.style.bottom = `${newBottom}px`;
            } else {
                backToTopButton.style.bottom = '20px';
            }
        }
    }
    window.addEventListener('scroll', function () {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.add('visible');
        } else {
            backToTopButton.classList.remove('visible');
        }
        adjustBackToTopPosition();
    });
    backToTopButton.addEventListener('click', function () {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    window.addEventListener('resize', adjustBackToTopPosition);
    adjustBackToTopPosition();
});
function setupMenu() {
    const menuIcon = document.querySelector('.menu-icon');
    const menuBox = document.getElementById('menuBox');
    if (menuIcon && menuBox) {
        menuIcon.addEventListener('click', (e) => {
            e.stopPropagation();
            menuBox.classList.toggle('hidden');
            menuBox.classList.toggle('visible');
        });
        // Fechar menu ao clicar fora
        document.addEventListener('click', function(e) {
            if (!menuBox.contains(e.target) && e.target !== menuIcon) {
                menuBox.classList.add('hidden');
                menuBox.classList.remove('visible');
            }
        });
        // Impedir que cliques no menu fechem ele
        menuBox.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
    // Configurar logout
    const logoutLinks = document.querySelectorAll('a[href="{{ route('logout') }}"]');
    logoutLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const form = document.getElementById('logout-form');
            if (form) {
                form.submit();
            } else {
                console.error('Logout form not found');
            }
        });
    });
}
function setupCardOverlays() {
    const overlayButtons = document.querySelectorAll('.destino-overlay-btn');
    const destinations = {
        'hoteis': '{{ route('hoteis') }}',
        'restaurantes': '{{ route('restaurantes.index') }}',
        'pontos-turisticos': '{{ route('pontos-turisticos') }}'
    };
    overlayButtons.forEach(button => {
        button.addEventListener('click', function() {
            const destination = button.getAttribute('data-destination');
            if (destinations[destination]) {
                window.location.href = destinations[destination];
            }
        });
    });
}
function showNotification(message, type) {
    const notificacao = document.getElementById('notificacao');
    if (notificacao) {
        notificacao.textContent = message;
        notificacao.className = `notificacao ${type} show`;
        setTimeout(() => {
            notificacao.classList.remove('show');
        }, 4000);
    }
}
</script>
@endsection
