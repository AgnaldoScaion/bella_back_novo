<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós - Bella Avventura</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="https://i.ibb.co/vx2Dzjv/image.png">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @font-face {
            font-family: 'GaramondBold';
            src: local('Garamond'), serif;
            font-weight: bold;
        }

        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            display: flex;
            flex-direction: column;
            background-color: #f3f7f3;
        }

        .wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            background-color: #A7D096;
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
        }

        .header {
            background-color: #A7D096;
            position: relative;
            height: 86px;
        }

        .header-img img {
            height: 126px;
        }

        .header-img {
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
        }

        @keyframes float {
            0% { transform: translate(-50%, 0px); }
            50% { transform: translate(-50%, -5px); }
            100% { transform: translate(-50%, 0px); }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        .container {
            max-width: 1200px;
            margin: 4rem auto 2rem;
            padding: 0 2rem;
        }

        .about-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .about-header h1 {
            font-family: 'GaramondBold', serif;
            color: #5a8f3d;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .about-content {
            background-color: white;
            padding: 2rem;
            border-radius: 12px;
            border: 3px solid #D8E6D9;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .about-section {
            margin-bottom: 2rem;
        }

        .about-section h2 {
            color: #5a8f3d;
            font-family: 'GaramondBold', serif;
            font-size: 1.8rem;
            border-bottom: 2px solid #D8E6D9;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .about-section p {
            color: #555;
            line-height: 1.8;
            font-size: 1.1rem;
        }

        .values-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .value-card {
            background: white;
            padding: 2rem;
            border-radius: 0.75rem;
            text-align: center;
            border: 2px solid #E9F5E4;
            transition: all 0.3s ease;
        }

        .value-card:hover {
            border-color: #A7D096;
            box-shadow: 0 8px 24px rgba(167, 208, 150, 0.15);
        }

        .footer {
            background-color: #A7D096;
            padding: 20px;
            color: #000;
            font-size: 14px;
            text-align: center;
            flex-shrink: 0;
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
        }

        .footer-bottom a:hover {
            color: #5a8f3d;
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
        }

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
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Header -->
        <div class="top-header">
            <div class="menu-icon">☰</div>
            <div class="user-header">
                <span>👤</span> {{ auth()->check() ? auth()->user()->nome_completo : 'Visitante' }}
            </div>
        </div>

        <div class="header">
            <div class="header-img">
                <a href="{{ route('home') }}">
                    <img src="https://i.ibb.co/Q7T008b/image.png" alt="Logo" class="floating" />
                </a>
            </div>
        </div>

        <!-- Menu -->
        @if(auth()->check())
            @include('components.menu-logado')
        @else
            @include('components.menu-nao-logado')
        @endif

        <!-- Notificação -->
        <div id="notification" class="notification @if(session('success')) success @elseif($errors->any()) error @endif">
            @if(session('success'))
                {{ session('success') }}
            @elseif($errors->any())
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            @endif
        </div>

        <!-- Conteúdo -->
        <main class="container">
            <section class="about-header">
                <h1>Sobre Nós</h1>
            </section>

            <div class="about-content">
                <section class="about-section">
                    <h2>Nossa Missão</h2>
                    <p>Na Bella Avventura, transformamos sonhos em experiências memoráveis. Desde 2020, conectamos
                        viajantes aos destinos mais incríveis do mundo, oferecendo roteiros personalizados e serviços de
                        alta qualidade.</p>
                </section>

                <section class="about-section">
                    <h2>Nossa Equipe</h2>
                    <p>Contamos com especialistas em viagens de mais de 15 países, todos apaixonados por explorar novas
                        culturas e compartilhar conhecimento local autêntico.</p>
                </section>

                <section class="values-section">
                    <article class="value-card">
                        <h3>Experiência</h3>
                        <p>Mais de 50 mil viagens realizadas com excelência</p>
                    </article>

                    <article class="value-card">
                        <h3>Segurança</h3>
                        <p>Parceria com os melhores fornecedores do mercado</p>
                    </article>

                    <article class="value-card">
                        <h3>Inovação</h3>
                        <p>Tecnologia exclusiva de planejamento de viagens</p>
                    </article>
                </section>

                <section class="about-section">
                    <h2>Compromisso Sustentável</h2>
                    <p>Implementamos programas de turismo responsável em todos os destinos, garantindo que 5% de cada
                        reserva seja reinvestido em comunidades locais.</p>
                </section>
            </div>
        </main>

        <!-- Rodapé -->
        <footer class="footer">
            <div class="footer-top">
                <a href="https://www.bellaavventura.com.br/">
                    <img src="https://i.ibb.co/j9vGkny/image.png" alt="Logo">
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
            // Toggle menu
            const menuIcon = document.querySelector('.menu-icon');
            const menuNaoLogado = document.getElementById('menu-nao-logado');
            const menuLogado = document.getElementById('menu-logado');
            const menu = menuNaoLogado || menuLogado;

            if (menu && menuIcon) {
                menuIcon.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                    menu.classList.toggle('visible');
                });
            }

            // Exibir notificação
            const notification = document.getElementById('notification');
            if (notification.textContent.trim()) {
                notification.classList.add('show');
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 3000);
            }
        });
    </script>
</body>
</html>
