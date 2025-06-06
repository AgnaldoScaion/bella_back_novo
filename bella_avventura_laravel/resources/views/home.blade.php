@extends('layouts.app')

@section('title', 'Bella Avventura - Planeje sua viagem perfeita')

@section('styles')
<style>
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

    .hero {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1506929562872-bb421503ef21?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        height: 60vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: white;
        padding: 0 1rem;
        animation: fadeIn 0.7s ease;
    }

    .hero h1 {
        font-size: 3rem;
        margin-bottom: 1rem;
        animation: slideUp 0.8s ease;
    }

    .hero p {
        font-size: 1.2rem;
        max-width: 800px;
        margin-bottom: 2rem;
        font-weight: 400;
        animation: slideUp 1s ease;
    }

    .btn {
        background-color: #A7D096;
        color: white;
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        font-weight: bold;
        animation: fadeIn 1.5s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn:hover {
        background-color: #5a8f3d;
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .features {
        padding: 4rem 2rem;
        text-align: center;
    }

    .features h2 {
        font-size: 2rem;
        margin-bottom: 3rem;
        animation: fadeIn 1s ease;
    }

    .features-container {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .feature-card {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        width: 300px;
        border: 3px solid #D8E6D9;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        animation: fadeInUp 0.8s ease forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    .feature-card:nth-child(1) {
        animation-delay: 0.4s;
    }

    .feature-card:nth-child(2) {
        animation-delay: 0.6s;
    }

    .feature-card:nth-child(3) {
        animation-delay: 0.8s;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .feature-card h3 {
        color: #5a8f3d;
        margin-bottom: 1rem;
    }

    .feature-card p {
        font-weight: 400;
    }

    .bonus-system {
        padding: 4rem 2rem;
        text-align: center;
        background-color: white;
        margin: 2rem 0;
        border-top: 3px solid #D8E6D9;
        border-bottom: 3px solid #D8E6D9;
        animation: fadeIn 1s ease;
    }

    .bonus-system h2 {
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .formula {
        background-color: #A7D096;
        color: white;
        padding: 1.5rem;
        border-radius: 8px;
        max-width: 600px;
        margin: 2rem auto;
        font-size: 1.2rem;
        font-weight: bold;
        box-shadow: 0 4px 8px rgba(167, 208, 150, 0.3);
        transition: all 0.3s ease;
    }

    .formula:hover {
        transform: scale(1.02);
        box-shadow: 0 6px 12px rgba(167, 208, 150, 0.4);
    }

    .how-it-works {
        max-width: 800px;
        margin: 0 auto;
        text-align: left;
        padding: 1rem;
    }

    .how-it-works ul {
        padding-left: 1.5rem;
    }

    .how-it-works li {
        margin-bottom: 0.5rem;
        font-weight: 400;
    }

    .example {
        background-color: #f3f7f3;
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1rem;
        border: 1px solid #D8E6D9;
        transition: all 0.3s ease;
    }

    .example:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .example p {
        font-weight: 400;
    }

    .back-to-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background-color: #5a8f3d;
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        opacity: 0;
        visibility: hidden;
        z-index: 999;
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

    .back-to-top i {
        font-size: 24px;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-5px); }
        100% { transform: translateY(0px); }
    }

    .floating {
        animation: float 3s ease-in-out infinite;
    }

    @media (max-width: 600px) {
        .hero h1 {
            font-size: 2rem;
        }

        .hero p {
            font-size: 1rem;
        }

        .features-container {
            flex-direction: column;
            align-items: center;
        }

        .feature-card {
            width: 100%;
            max-width: 300px;
        }
    }

    @media (max-width: 768px) {
        .back-to-top {
            bottom: 80px;
        }
    }
</style>
@endsection

@section('content')
<section class="hero">
    <h1>Planeje sua viagem perfeita</h1>
    <p>Descubra os melhores restaurantes e pontos turísticos baseados na sua localização, avalie suas experiências e ganhe descontos para suas próximas aventuras!</p>
    <a href="{{ route('destinos') }}" class="btn">Comece agora</a>
</section>

<section class="features">
    <h2>Como o Bella Avventura funciona</h2>
    <div class="features-container">
        <div class="feature-card">
            <h3>Descubra locais próximos</h3>
            <p>Assim que você se hospeda em um hotel, nosso sistema automaticamente mostra os três melhores restaurantes e pontos turísticos próximos a você.</p>
        </div>
        <div class="feature-card">
            <h3>Avalie e ganhe pontos</h3>
            <p>Avalie os locais que visitou e acumule pontos que podem ser convertidos em descontos para hotéis, viagens e outros serviços turísticos.</p>
        </div>
        <div class="feature-card">
            <h3>Compartilhe experiências</h3>
            <p>Contribua com a comunidade de viajantes compartilhando suas avaliações e ajudando outros usuários a planejarem suas viagens.</p>
        </div>
    </div>
</section>

<section class="bonus-system">
    <h2>Sistema de Bonificação</h2>
    <div class="formula">
        Fórmula: (A × 5) + (Q × 10) + (E × 3)
    </div>

    <div class="how-it-works">
        <p>A fórmula de bonificação é baseada em três fatores:</p>
        <ul>
            <li><strong>A (Avaliações):</strong> Cada avaliação feita gera 5 pontos</li>
            <li><strong>Q (Qualidade):</strong> Avaliações de qualidade de 1 a 5 geram 10 pontos por nível</li>
            <li><strong>E (Engajamento):</strong> O engajamento, classificado de 1 a 5, gera 3 pontos por nível</li>
        </ul>

        <div class="example">
            <p><strong>Exemplo:</strong> Um usuário com 5 avaliações de qualidade 4 e engajamento 3 teria:</p>
            <p>(5 × 5) + (4 × 10) + (3 × 3) = 25 + 40 + 9 = 74 pontos</p>
            <p>Estes pontos podem be convertidos em descontos para futuras viagens.</p>
        </div>
    </div>
</section>

<div class="back-to-top" id="backToTop">
    <i class="fas fa-arrow-up"></i>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const backToTopButton = document.getElementById('backToTop');
        const footer = document.querySelector('.footer');

        function updateBackToTopPosition() {
            const footerRect = footer.getBoundingClientRect();
            const scrollPosition = window.innerHeight + window.pageYOffset;
            const documentHeight = document.body.offsetHeight;

            if (scrollPosition >= documentHeight - footer.offsetHeight - 20) {
                backToTopButton.style.bottom = (window.innerHeight - footerRect.top + 30) + 'px';
            } else {
                backToTopButton.style.bottom = '30px';
            }
        }

        window.addEventListener('scroll', function () {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.add('visible');
            } else {
                backToTopButton.classList.remove('visible');
            }
            updateBackToTopPosition();
        });

        backToTopButton.addEventListener('click', function () {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        window.addEventListener('resize', updateBackToTopPosition);
    });
</script>
@endsection

