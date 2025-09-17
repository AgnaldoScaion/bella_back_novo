@extends('layouts.app')

@section('title', $ponto['nome'] . ' - Bella Avventura')

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
            --primary-color: #5a8f3d;
            --secondary-color: #D8E6D9;
            --text-color: #333;
            --bg-light: #f8f9fa;
        }

        .main-content {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .btn-voltar {
            display: inline-flex;
            align-items: center;
            padding: 0.8rem 1.5rem;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 2rem;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-voltar:hover {
            background: #4a7d2d;
            transform: translateY(-2px);
        }

        .btn-voltar i {
            margin-right: 0.5rem;
        }

        .ponto-detalhe-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .ponto-detalhe-titulo {
            font-family: 'GaramondBold', serif;
            color: var(--primary-color);
            font-size: 2.5rem;
            margin: 0;
        }

        .ponto-detalhe-localizacao {
            font-size: 1.2rem;
            color: #666;
            margin: 0.5rem 0;
            display: flex;
            align-items: center;
        }

        .ponto-detalhe-avaliacao {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 1rem 0;
        }

        .star {
            color: #FFD700;
        }

        .ponto-detalhe-imagem {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .ponto-detalhe-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .ponto-detalhe-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border: 2px solid var(--secondary-color);
        }

        .ponto-detalhe-card h3 {
            color: var(--primary-color);
            margin-top: 0;
            margin-bottom: 1rem;
            font-family: 'Inter', sans-serif;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.8rem;
            font-family: 'Inter', sans-serif;
        }

        .info-item i {
            margin-right: 0.8rem;
            color: var(--primary-color);
            width: 20px;
        }

        .ponto-descricao {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            border: 2px solid var(--secondary-color);
        }

        .ponto-descricao h3 {
            color: var(--primary-color);
            margin-top: 0;
            font-family: 'Inter', sans-serif;
        }

        .ponto-galeria {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .galeria-item {
            height: 200px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
        }

        .galeria-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .galeria-item:hover img {
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .ponto-detalhe-info {
                grid-template-columns: 1fr;
            }

            .ponto-detalhe-header {
                flex-direction: column;
            }

            .ponto-detalhe-imagem {
                height: 300px;
            }

            .main-content {
                padding: 1rem;
            }
        }
    </style>
@endsection

@section('content')
<div class="ponto-detalhe-container">
    <a href="{{ route('pontos-turisticos.index') }}" class="btn-voltar">
        <i class="fas fa-arrow-left"></i> Voltar para pontos turísticos
    </a>

    <div class="ponto-detalhe-header">
        <div>
            <h1 class="ponto-detalhe-titulo">{{ $ponto->nome }}</h1>
            <div class="ponto-detalhe-localizacao">
                <i class="fas fa-map-marker-alt"></i>
                {{ $ponto->localizacao }}
            </div>
            <div class="ponto-detalhe-avaliacao">
                <span class="star">★</span>
                <strong>{{ $ponto->avaliacao }}</strong>
                <span>({{ number_format($ponto->avaliacoes) }} avaliações)</span>
            </div>
        </div>
        <div class="ponto-preco">
            <strong style="font-size: 1.5rem; color: #5a8f3d;">{{ $ponto->precoTexto }}</strong>
        </div>
    </div>

    <img src="{{ $ponto->imagem }}" alt="{{ $ponto->nome }}" class="ponto-detalhe-imagem" onerror="this.src='https://via.placeholder.com/800x400/5a8f3d/ffffff?text=Imagem+Indisponível'">

    <div class="ponto-detalhe-info">
        <div class="ponto-detalhe-card">
            <h3>Informações</h3>
            <div class="info-item">
                <i class="fas fa-tag"></i>
                <span><strong>Tipo:</strong> {{ ucfirst($ponto->tipo) }}</span>
            </div>
            <div class="info-item">
                <i class="fas fa-money-bill-wave"></i>
                <span><strong>Preço:</strong> {{ $ponto->precoTexto }}</span>
            </div>
            <div class="info-item">
                <i class="fas fa-star"></i>
                <span><strong>Avaliação:</strong> {{ $ponto->avaliacao }} ({{ number_format($ponto->avaliacoes) }} avaliações)</span>
            </div>
            <div class="info-item">
                <i class="fas fa-map-marked-alt"></i>
                <span><strong>Localização:</strong> {{ $ponto->cidade }}</span>
            </div>
        </div>

        <div class="ponto-detalhe-card">
            <h3>Detalhes</h3>
            <div class="info-item">
                <i class="fas fa-clock"></i>
                <span><strong>Horário de funcionamento:</strong> 08:00 - 18:00</span>
            </div>
            <div class="info-item">
                <i class="fas fa-phone"></i>
                <span><strong>Telefone:</strong> (XX) XXXX-XXXX</span>
            </div>
            <div class="info-item">
                <i class="fas fa-globe"></i>
                <span><strong>Site:</strong> www.exemplo.com</span>
            </div>
            <div class="info-item">
                <i class="fas fa-wheelchair"></i>
                <span><strong>Acessibilidade:</strong> Sim</span>
            </div>
        </div>
    </div>

    <div class="ponto-detalhe-card">
        <h3>Sobre este ponto turístico</h3>
        <p>O {{ $ponto->nome }} é um dos destinos mais incríveis do Brasil, oferecendo uma experiência única para todos os visitantes. Localizado em {{ $ponto->localizacao }}, este ponto turístico combina beleza natural, cultura e história em um único lugar.</p>
        <p>Com uma avaliação de {{ $ponto->avaliacao }} estrelas baseada em {{ number_format($ponto->avaliacoes) }} avaliações, este destino é altamente recomendado por turistas e locais. O preço {{ $ponto->precoTexto }} torna-o acessível para todos os tipos de viajantes.</p>
        <p>Venha descobrir por si mesmo por que o {{ $ponto->nome }} é considerado uma joia do turismo brasileiro!</p>
    </div>
</div>
@endsection
