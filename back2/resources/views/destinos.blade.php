@extends('layouts.app')

@section('title', 'Bella Avventura - Destinos')

@section('styles')
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

    /* Header Styles */
    .header {
        background-color: var(--accent-color);
        position: relative;
        height: 86px;
    }

    .header-img img {
        height: 126px;
        transition: transform 0.5s ease;
    }

    .header-img {
        position: absolute;
        top: -50px;
        left: 50%;
        transform: translateX(-5%);
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
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 700;
    }

    /* Menu Styles */
    .menu-box {
        position: fixed;
        top: 50px;
        left: 20px;
        background-color: #d6e3d6;
        border-radius: 8px;
        padding: 20px;
        width: 260px;
        display: flex;
        gap: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        font-family: 'Garamond', serif;
        z-index: 1000;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .menu-lateral {
        background-color: #88b68b;
        width: 24px;
        border-radius: 8px;
    }

    .menu-conteudo {
        flex: 1;
    }

    .menu-conteudo h2 {
        font-size: 20px;
        margin: 0;
        border-bottom: 1px solid #999;
        padding-bottom: 10px;
    }

    .menu-conteudo ul {
        list-style: none;
        padding: 0;
        margin-top: 15px;
    }

    .menu-conteudo li {
        margin: 15px 0;
    }

    .menu-conteudo a {
        text-decoration: none;
        color: black;
        transition: color 0.2s;
    }

    .menu-conteudo a:hover {
        color: #3a6545;
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
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
        flex: 1;
    }

    .page-title {
        font-family: 'GaramondBold', serif;
        text-align: center;
        color: var(--primary-color);
        margin-bottom: 2rem;
        font-size: 2.5rem;
        font-weight: 900;
    }

    .page-subtitle {
        text-align: center;
        font-weight: 400;
        margin-bottom: 3rem;
        color: var(--text-dark);
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .destinos-container {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 2rem;
    }

    .destino-card {
        background: white;
        border-radius: var(--border-radius);
        overflow: hidden;
        width: 300px;
        border: 3px solid var(--border-color);
        box-shadow: var(--shadow-soft);
        transition: var(--transition-smooth);
        display: flex;
        flex-direction: column;
        animation: fadeInUp 0.8s ease forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    .destino-card:nth-child(1) { animation-delay: 0.2s; }
    .destino-card:nth-child(2) { animation-delay: 0.4s; }
    .destino-card:nth-child(3) { animation-delay: 0.6s; }

    .destino-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-medium);
    }

    .destino-img {
        height: 180px;
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
        transform: scale(1.1);
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
        transition: opacity 0.3s ease;
    }

    .destino-card:hover .destino-overlay {
        opacity: 1;
    }

    .destino-overlay-btn {
        background-color: var(--primary-light);
        color: var(--text-light);
        border: none;
        padding: 12px 20px;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        transition: var(--transition-smooth);
        transform: translateY(20px);
        opacity: 0;
    }

    .destino-card:hover .destino-overlay-btn {
        transform: translateY(0);
        opacity: 1;
    }

    .destino-content {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .destino-title {
        font-size: 1.5rem;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .destino-desc {
        font-weight: 400;
        margin-bottom: 1.5rem;
        flex: 1;
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

    .destino-stat span {
        display: block;
    }

    .stat-value {
        font-size: 1.2rem;
        color: var(--primary-color);
        font-weight: bold;
    }

    .stat-label {
        font-size: 0.8rem;
        color: #666;
        font-weight: 400;
    }

    .destino-action {
        text-align: center;
        margin-top: 1rem;
    }

    .btn-destino {
        background-color: var(--primary-color);
        color: var(--text-light);
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        cursor: pointer;
        transition: var(--transition-smooth);
        text-decoration: none;
        font-weight: bold;
        display: inline-block;
        width: 80%;
    }

    .btn-destino:hover {
        background-color: #4a7d2d;
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .instrucoes {
        margin-top: 4rem;
        background-color: white;
        border-radius: var(--border-radius);
        padding: 2rem;
        box-shadow: var(--shadow-soft);
        border: 3px solid var(--border-color);
        max-width: 900px;
        margin-left: auto;
        margin-right: auto;
        animation: fadeIn 1s ease;
    }

    .instrucoes h3 {
        color: var(--primary-color);
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        text-align: center;
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
    }

    .instrucoes-item::before {
        content: counter(instrucao);
        position: absolute;
        left: 0;
        top: 0;
        background-color: var(--primary-light);
        color: var(--text-light);
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
    }

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
        background-color: var(--primary-color);
        color: var(--text-light);
        padding: 16px;
        text-align: center;
        font-weight: bold;
        display: none;
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        min-width: 300px;
    }

    .notificacao.show {
        display: block;
        animation: fadeOut 4s forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeOut {
        0% { opacity: 1; }
        80% { opacity: 1; }
        100% { opacity: 0; }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        .destinos-container {
            flex-direction: column;
            align-items: center;
        }

        .destino-card {
            width: 100%;
            max-width: 350px;
        }

        .page-title {
            font-size: 2rem;
        }

        .instrucoes {
            padding: 1.5rem;
        }
    }

    @media (max-width: 600px) {
        .footer-bottom {
            flex-direction: column;
            text-align: center;
        }

        .footer-left, .footer-center, .footer-right {
            text-align: center;
        }

        .header-img img {
            height: 100px;
            top: -30px;
        }

        .instrucoes-item {
            padding-left: 2.5rem;
        }
    }

    .back-to-top {
        position: fixed;
        right: 30px;
        background-color: var(--primary-color);
        color: var(--text-light);
        width: 50px;
        height: 50px;
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
        bottom: 30px;
    }

    .back-to-top.visible {
        opacity: 1;
        visibility: visible;
    }

    .back-to-top:hover {
        background-color: #4a7d2d;
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    }

    @media (max-width: 768px) {
        .back-to-top {
            width: 45px;
            height: 45px;
            right: 20px;
            bottom: 20px;
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
                        <a href="{{ route('restaurante.lista') }}" class="btn-destino">Explorar Restaurantes</a>
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
                backToTopButton.style.bottom = '30px';
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
        'restaurantes': '{{ route('restaurante.lista') }}',
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
