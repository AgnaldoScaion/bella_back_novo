@extends('layouts.app')
@section('title', isset($hotel) ? $hotel->nome . ' - Bella Avventura' : 'Hotel - Bella Avventura')

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <style>
        :root {
            --primary-color: #5a8f3d;
            --secondary-color: #D8E6D9;
            --text-color: #333;
            --bg-light: #f8f9fa;
        }
        .hotel-detalhes {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }
        .breadcrumb {
            margin-bottom: 1.5rem;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            color: #666;
        }
        .breadcrumb a {
            color: var(--primary-color);
            text-decoration: none;
        }
        .breadcrumb a:hover {
            text-decoration: underline;
        }
        .hotel-header {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        @media (min-width: 768px) {
            .hotel-header {
                flex-direction: row;
                align-items: flex-start;
            }
        }
        .hotel-imagem {
            flex: 1;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .hotel-imagem img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
        .hotel-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: var(--primary-color);
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .hotel-promocao {
            background: #ff6b6b;
        }
        .hotel-info {
            flex: 1;
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .hotel-titulo {
            font-family: 'Inter', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        .hotel-avaliacao {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
        }
        .star {
            color: #FFD700;
            margin-right: 4px;
            font-size: 1.2rem;
        }
        .hotel-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .meta-item {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
        .meta-label {
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 0.9rem;
            color: #666;
        }
        .meta-value {
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            color: var(--text-color);
        }
        .preco {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1.1rem;
        }
        .estrelas {
            color: #FFD700;
            font-weight: 600;
        }
        .comodidades {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        .comodidade {
            background: var(--secondary-color);
            color: var(--text-color);
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        .hotel-conteudo {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        .secao-titulo {
            font-family: 'Inter', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--secondary-color);
        }
        .hotel-descricao {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            margin-bottom: 2rem;
        }
        .galeria {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .galeria-item {
            border-radius: 8px;
            overflow: hidden;
            height: 200px;
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
        .mapa-container {
            height: 400px;
            width: 100%;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        .acoes {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }
        .btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-primary {
            background: var(--primary-color);
            color: white;
        }
        .btn-primary:hover {
            background: #4a7d2d;
            transform: translateY(-2px);
        }
        .btn-secondary {
            background: var(--secondary-color);
            color: var(--text-color);
        }
        .btn-secondary:hover {
            background: #c8d6c9;
            transform: translateY(-2px);
        }
        .error-message {
            text-align: center;
            padding: 3rem;
            color: #666;
        }
        .error-message i {
            font-size: 3rem;
            color: #ff6b6b;
            margin-bottom: 1rem;
        }
        .tipo-quarto {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .tipo-quarto-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .tipo-quarto-titulo {
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            color: var(--primary-color);
        }
        .tipo-quarto-preco {
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.2rem;
        }
        @media (max-width: 768px) {
            .hotel-titulo {
                font-size: 1.5rem;
            }
            .hotel-meta {
                grid-template-columns: 1fr;
            }
            .galeria {
                grid-template-columns: 1fr;
            }
            .mapa-container {
                height: 300px;
            }
            .acoes {
                flex-direction: column;
            }
            .tipo-quarto-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="hotel-detalhes">
        @if(!isset($hotel))
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i>
                <h2>Hotel não encontrado</h2>
                <p>O hotel que você está tentando acessar não foi encontrado.</p>
                <a href="{{ route('hoteis.alternative') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar para Hotéis
                </a>
            </div>
        @else
            <div class="breadcrumb">
                <a href="{{ route('hoteis.alternative') }}">Hotéis</a> > {{ $hotel->nome }}
            </div>
            <div class="hotel-header">
                <div class="hotel-imagem">
                    <img src="{{ $hotel->imagem }}" alt="{{ $hotel->nome }}" onerror="this.src='https://via.placeholder.com/600x400/5a8f3d/ffffff?text=Imagem+Indisponível'">
                    @if($hotel->categoria === 'premium')
                        <span class="hotel-badge">Premium</span>
                    @endif
                </div>
                <div class="hotel-info">
                    <h1 class="hotel-titulo">{{ $hotel->nome }}</h1>
                    <div class="hotel-avaliacao">
                        <span class="star">★</span>
                        <span>{{ $hotel->avaliacao }} ({{ $hotel->avaliacoes }} avaliações)</span>
                    </div>
                    <div class="hotel-meta">
                        <div class="meta-item">
                            <span class="meta-label">Localização</span>
                            <span class="meta-value">📍 {{ $hotel->localizacao }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Preço por noite</span>
                            <span class="meta-value preco">{{ $hotel->precoTexto }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Classificação</span>
                            <span class="meta-value estrelas">
                                @for($i = 0; $i < ($hotel->estrelas ?? 4); $i++)
                                    ⭐
                                @endfor
                                ({{ $hotel->estrelas ?? 4 }} estrelas)
                            </span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Categoria</span>
                            <span class="meta-value">
                                @if($hotel->categoria === 'premium')
                                    🏨 Premium
                                @elseif($hotel->categoria === 'medio')
                                    🏨 Médio
                                @else
                                    🏨 Econômico
                                @endif
                            </span>
                        </div>
                    </div>
                    @if(isset($hotel->comodidades) && is_array($hotel->comodidades))
                        <div class="comodidades">
                            @foreach($hotel->comodidades as $comodidade)
                                <span class="comodidade">{{ $comodidade }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="hotel-conteudo">
                <h2 class="secao-titulo">Sobre o Hotel</h2>
                <div class="hotel-descricao">
                    <p>Bem-vindo ao {{ $hotel->nome }}, uma excelente opção de hospedagem localizado em {{ $hotel->localizacao }}. Com uma avaliação de {{ $hotel->avaliacao }} estrelas baseada em {{ $hotel->avaliacoes }} avaliações, nosso hotel oferece o equilíbrio perfeito entre conforto, qualidade e preço.</p>
                    <p>Nossas instalações foram cuidadosamente projetadas para proporcionar uma estadia memorável, contando com {{ implode(', ', $hotel->comodidades ?? ['Wi-Fi gratuito', 'Ar condicionado', 'Café da manhã']) }} para garantir seu máximo conforto.</p>
                    <p>Seja para viagens de negócios ou lazer, o {{ $hotel->nome }} é a escolha ideal para quem busca qualidade e atendimento diferenciado. Nossa equipe está sempre pronta para tornar sua estadia inesquecível.</p>
                </div>
                <h2 class="secao-titulo">Tipos de Quarto</h2>
                <div class="tipo-quarto">
                    <div class="tipo-quarto-header">
                        <h3 class="tipo-quarto-titulo">Quarto Standard</h3>
                        <span class="tipo-quarto-preco">{{ $hotel->precoTexto }}/noite</span>
                    </div>
                    <p>Quarto confortável com cama queen size, TV LCD, ar condicionado e banheiro privativo. Ideal para casais ou viajantes individuais.</p>
                </div>
                <div class="tipo-quarto">
                    <div class="tipo-quarto-header">
                        <h3 class="tipo-quarto-titulo">Quarto Luxo</h3>
                        <span class="tipo-quarto-preco">R$ {{ $hotel->preco + 150 }}/noite</span>
                    </div>
                    <p>Amplo quarto com vista privilegiada, cama king size, varanda, banheira de hidromassagem e amenities premium.</p>
                </div>
                <div class="tipo-quarto">
                    <div class="tipo-quarto-header">
                        <h3 class="tipo-quarto-titulo">Suíte Familiar</h3>
                        <span class="tipo-quarto-preco">R$ {{ $hotel->preco + 250 }}/noite</span>
                    </div>
                    <p>Espaçosa suíte com dois quartos, capacidade para 4 pessoas, cozinha compacta e área de estar. Perfeita para famílias.</p>
                </div>
                <h2 class="secao-titulo">Galeria</h2>
                <div class="galeria">
                    <div class="galeria-item">
                        <img src="{{ $hotel->imagem ?? 'https://via.placeholder.com/300x200/5a8f3d/ffffff?text=Imagem+Indisponível' }}"
                            alt="{{ $hotel->nome }} - Interior"
                            onerror="this.src='https://via.placeholder.com/300x200/5a8f3d/ffffff?text=Imagem+Indisponível'">
                    </div>
                    <div class="galeria-item">
                        <img src="{{ !empty($hotel->prato) ? $hotel->prato : 'https://via.placeholder.com/300x200/5a8f3d/ffffff?text=Imagem+Indisponível' }}"
                            alt="{{ $hotel->nome }} - Prato Principal"
                            onerror="this.src='https://via.placeholder.com/300x200/5a8f3d/ffffff?text=Imagem+Indisponível'">
                    </div>
                    <div class="galeria-item">
                        <img src="{{ !empty($hotel->ambiente) ? $hotel->ambiente : 'https://via.placeholder.com/300x200/5a8f3d/ffffff?text=Imagem+Indisponível' }}"
                            alt="{{ $hotel->nome }} - Ambiente"
                            onerror="this.src='https://via.placeholder.com/300x200/5a8f3d/ffffff?text=Imagem+Indisponível'">
                    </div>
                    <div class="galeria-item">
                        <img src="{{ !empty($hotel->sobremesas) ? $hotel->sobremesas : 'https://via.placeholder.com/300x200/5a8f3d/ffffff?text=Imagem+Indisponível' }}"
                            alt="{{ $hotel->nome }} - Sobremesas"
                            onerror="this.src='https://via.placeholder.com/300x200/5a8f3d/ffffff?text=Imagem+Indisponível'">
                    </div>
                </div>
                <h2 class="secao-titulo">Localização</h2>
                <div class="mapa-container" id="map"></div>
                @if(!isset($hotel->lat) || !isset($hotel->lng) || empty($hotel->lat) || empty($hotel->lng))
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <p>Localização exata não disponível para este hotel.</p>
                    </div>
                @endif
            </div>
            <div class="acoes">
                <a href="{{ route('hoteis.alternative') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar para Hotéis
                </a>
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-calendar-check"></i> Fazer Reserva
                </a>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(isset($hotel) && isset($hotel->lat) && isset($hotel->lng) && !empty($hotel->lat) && !empty($hotel->lng))
                // Inicializar o mapa com coordenadas válidas
                const map = L.map('map').setView([{{ $hotel->lat }}, {{ $hotel->lng }}], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
                L.marker([{{ $hotel->lat }}, {{ $hotel->lng }}])
                    .addTo(map)
                    .bindPopup('<b>{{ $hotel->nome }}</b><br>{{ $hotel->localizacao }}')
                    .openPopup();
                // Recalcular o tamanho do mapa após a renderização
                setTimeout(() => map.invalidateSize(), 100);
            @elseif(isset($hotel))
                // Mapa genérico centrado no Brasil se não houver coordenadas
                const map = L.map('map').setView([-15.7797, -47.9297], 4);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
                L.marker([-15.7797, -47.9297])
                    .addTo(map)
                    .bindPopup('<b>{{ $hotel->nome }}</b><br>Localização aproximada')
                    .openPopup();
                // Recalcular o tamanho do mapa após a renderização
                setTimeout(() => map.invalidateSize(), 100);
            @else
                // Esconder o mapa se não houver hotel
                document.getElementById('map').style.display = 'none';
            @endif
        });
    </script>
@endsection
