@extends('layouts.app')

@section('title', 'Bella Avventura - Planeje sua viagem perfeita')

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
            scroll-behavior: smooth;
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

        /* Adiciona estilos para o user header */
        .user-header {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
            font-weight: 600;
            color: var(--primary-color);
            background: rgba(255, 255, 255, 0.2);
            padding: 6px 12px;
            border-radius: 20px;
            transition: var(--transition-smooth);
        }

        .user-header:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .user-header i {
            font-size: 16px;
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
            flex: 1;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg,
                    rgba(45, 80, 22, 0.8) 0%,
                    rgba(90, 143, 61, 0.6) 100%),
                url('https://images.unsplash.com/photo-1506929562872-bb421503ef21?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 90vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: var(--text-light);
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, transparent 0%, rgba(45, 80, 22, 0.3) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 900px;
            padding: 0 20px;
            animation: fadeInUp 1s ease-out;
        }

        .hero h1 {
            font-family: 'GaramondBold', serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            margin-bottom: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .hero p {
            font-size: clamp(1.1rem, 2vw, 1.3rem);
            margin-bottom: 2.5rem;
            font-weight: 400;
            opacity: 0.95;
            line-height: 1.7;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--primary-light) 100%);
            color: var(--text-dark);
            padding: 1rem 2rem;
            border: none;
            border-radius: var(--border-radius-small);
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition-smooth);
            text-decoration: none;
            box-shadow: var(--shadow-medium);
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: var(--shadow-strong);
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-color) 100%);
            color: var(--text-light);
        }

        /* Sections */
        .section {
            padding: 6rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            font-family: 'GaramondBold', serif;
            font-size: clamp(2rem, 4vw, 2.5rem);
            text-align: center;
            margin-bottom: 3rem;
            color: var(--primary-color);
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -1rem;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-color), var(--primary-light));
            border-radius: 2px;
        }

        /* Features */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 4rem;
        }

        .feature-card {
            background: var(--text-light);
            border-radius: var(--border-radius);
            padding: 2.5rem;
            text-align: center;
            border: 2px solid var(--border-color);
            box-shadow: var(--shadow-soft);
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-color), var(--primary-light));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-medium);
            border-color: var(--accent-color);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary-light);
            margin-bottom: 1.5rem;
            display: block;
        }

        .feature-card h3 {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: var(--text-medium);
            font-weight: 400;
            line-height: 1.6;
        }

        /* Bonus System */
        .bonus-system {
            background: var(--text-light);
            margin: 4rem 0;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-soft);
            overflow: hidden;
        }

        .formula-card {
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--primary-light) 100%);
            color: var(--text-dark);
            padding: 2rem;
            text-align: center;
            font-size: 1.3rem;
            font-weight: 700;
            box-shadow: var(--shadow-soft);
            margin: 2rem 0;
            border-radius: var(--border-radius-small);
        }

        .how-it-works {
            padding: 2rem;
        }

        .points-list {
            list-style: none;
            padding: 0;
            margin: 2rem 0;
        }

        .points-list li {
            display: flex;
            align-items: center;
            padding: 1rem;
            margin-bottom: 1rem;
            background: var(--primary-bg);
            border-radius: var(--border-radius-small);
            border-left: 4px solid var(--accent-color);
        }

        .points-list li::before {
            content: '✓';
            color: var(--primary-light);
            font-weight: bold;
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .example-card {
            background: var(--primary-bg);
            padding: 1.5rem;
            border-radius: var(--border-radius-small);
            border: 1px solid var(--border-color);
            margin-top: 2rem;
        }

        .example-card strong {
            color: var(--primary-color);
        }

        /* Footer Styles */
        .footer {
            background-color: var(--accent-color);
            padding: 20px;
            color: #000;
            font-size: 14px;
            text-align: center;
            animation: fadeIn 1s ease;
            margin-top: auto;
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

        .footer-left,
        .footer-center,
        .footer-right {
            flex: 1;
            text-align: center;
            transition: all 0.3s ease;
        }

        .footer-left:hover,
        .footer-right:hover {
            transform: translateY(-3px);
        }

        .footer-left {
            text-align: left;
        }

        .footer-right {
            text-align: right;
        }

        .footer-bottom a {
            text-decoration: underline;
            color: black;
            transition: color 0.3s ease;
        }

        .footer-bottom a:hover {
            color: var(--primary-color);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

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

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        /* Back to Top Button */
        .back-to-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            color: var(--text-light);
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: var(--shadow-medium);
            transition: var(--transition-smooth);
            opacity: 0;
            visibility: hidden;
            transform: scale(0.8);
            z-index: 1000;
        }

        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
            transform: scale(1);
        }

        .back-to-top:hover {
            transform: scale(1.1) translateY(-3px);
            box-shadow: var(--shadow-strong);
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--accent-color) 100%);
        }

        .back-to-top i {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-5px);
            }

            60% {
                transform: translateY(-3px);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .top-header {
                padding: 10px 20px;
            }

            .header-img img {
                height: 100px;
                top: -30px;
            }

            .hero {
                min-height: 80vh;
                background-attachment: scroll;
            }

            .section {
                padding: 4rem 1rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .feature-card {
                padding: 2rem;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }

            .footer-left,
            .footer-center,
            .footer-right {
                text-align: center;
            }

            .back-to-top {
                width: 50px;
                height: 50px;
                bottom: 1rem;
                right: 1rem;
                font-size: 1.2rem;
            }
        }

        @media (max-width: 480px) {
            .btn {
                padding: 0.8rem 1.5rem;
                font-size: 1rem;
            }

            .feature-card {
                padding: 1.5rem;
            }

            .how-it-works {
                padding: 1rem;
            }

            .top-header {
                padding: 10px 15px;
            }

            .hero {
                min-height: 70vh;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero" id="hero">
        <div class="hero-content">
            <h1>Planeje sua viagem perfeita</h1>
            <p>Descubra os melhores restaurantes e pontos turísticos baseados na sua localização, avalie suas experiências e
                ganhe descontos para suas próximas aventuras!</p>
            @auth
                <a href="{{ route('destinos') }}" class="btn">
                    <i class="fas fa-compass"></i>
                    Explorar Destinos
                </a>
            @else
                <a href="{{ route('login') }}" class="btn">
                    <i class="fas fa-compass"></i>
                    Comece agora
                </a>
            @endauth
        </div>
    </section>

    <!-- Features Section -->
    <section class="section" id="features">
        <h2 class="section-title">Como o Bella Avventura funciona</h2>
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-map-marker-alt feature-icon"></i>
                <h3>Descubra locais próximos</h3>
                <p>Nosso sistema mostra automaticamente os melhores restaurantes e pontos turísticos próximos ao seu hotel.
                </p>
            </div>
            <div class="feature-card">
                <i class="fas fa-star feature-icon"></i>
                <h3>Avalie e ganhe pontos</h3>
                <p>Acumule pontos com suas avaliações que podem ser convertidos em descontos exclusivos.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-share-alt feature-icon"></i>
                <h3>Compartilhe experiências</h3>
                <p>Ajude outros viajantes compartilhando suas avaliações e descobertas.</p>
            </div>
        </div>
    </section>

    <!-- Bonus System Section -->
    <section class="section" id="bonus">
        <div class="bonus-system">
            <div class="how-it-works">
                <h2 class="section-title">Sistema de Bonificação</h2>

                <div class="formula-card">
                    <i class="fas fa-calculator" style="margin-right: 0.5rem;"></i>
                    Fórmula: (Avaliações × 5) + (Qualidade × 10) + (Engajamento × 3)
                </div>

                <p style="text-align: center; margin-bottom: 2rem; color: var(--text-medium);">
                    Seus pontos são calculados com base em:
                </p>

                <ul class="points-list">
                    <li><strong>Avaliações:</strong> 5 pontos por cada avaliação completa</li>
                    <li><strong>Qualidade:</strong> 10 pontos por nível (1-5) da sua avaliação</li>
                    <li><strong>Engajamento:</strong> 3 pontos por nível (1-5) de detalhes fornecidos</li>
                </ul>

                <div class="example-card">
                    <p><strong>Exemplo prático:</strong></p>
                    <p>5 avaliações com qualidade 4 e engajamento 3:</p>
                    <p
                        style="font-family: monospace; background: var(--text-light); padding: 1rem; border-radius: 4px; margin-top: 1rem;">
                        (5 × 5) + (4 × 10) + (3 × 3) = 25 + 40 + 9 = <strong style="color: var(--primary-color);">74
                            pontos</strong>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            // Verifica se os elementos existem antes de adicionar listeners
            const menuToggle = document.getElementById('menuToggle');
            const menuBox = document.getElementById('menuBox');
            const backToTopButton = document.getElementById('backToTop');

            // Menu functionality - só executa se os elementos existirem
            if (menuToggle && menuBox) {
                menuToggle.addEventListener('click', function (e) {
                    e.stopPropagation();
                    menuBox.classList.toggle('visible');
                });

                // Close menu when clicking outside
                document.addEventListener('click', function (e) {
                    if (!menuBox.contains(e.target) && e.target !== menuToggle) {
                        menuBox.classList.remove('visible');
                    }
                });
            }

            // Smooth scroll for anchor links
            const anchorLinks = document.querySelectorAll('a[href^="#"]');
            if (anchorLinks.length > 0) {
                anchorLinks.forEach(anchor => {
                    anchor.addEventListener('click', function (e) {
                        if (this.getAttribute('href') !== '#') {
                            e.preventDefault();
                            const target = document.querySelector(this.getAttribute('href'));
                            if (target) {
                                target.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'start'
                                });
                                // Close menu if it exists
                                if (menuBox) menuBox.classList.remove('visible');
                            }
                        }
                    });
                });
            }

            // Back to top button functionality - só executa se o botão existir
            if (backToTopButton) {
                function handleScroll() {
                    const scrollY = window.pageYOffset;
                    backToTopButton.classList.toggle('visible', scrollY > 400);
                }

                window.addEventListener('scroll', handleScroll);

                backToTopButton.addEventListener('click', function () {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });

                // Initial call
                handleScroll();
            }

            // Animate cards on scroll
            const featureCards = document.querySelectorAll('.feature-card');
            if (featureCards.length > 0) {
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };

                const observer = new IntersectionObserver(function (entries) {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('fade-in-up');
                        }
                    });
                }, observerOptions);

                featureCards.forEach(card => {
                    observer.observe(card);
                });
            }

            // Atalho de teclado para depuração (Ctrl+Alt+D)
            document.addEventListener('keydown', function (e) {
                if (e.ctrlKey && e.altKey && e.key === 'd') {
                    const debugDiv = document.querySelector('div[style*="position: fixed; bottom: 20px; right: 20px;"]');
                    if (debugDiv) {
                        debugDiv.style.display = debugDiv.style.display === 'none' ? 'block' : 'none';
                    }
                }
            });
        });
    </script>
@endsection
