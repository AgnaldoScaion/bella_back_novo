@extends('layouts.app')

@section('title', isset($restaurante) ? $restaurante->nome . ' - Bella Avventura' : 'Restaurante - Bella Avventura')

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <style>
        :root {
            --primary-color: #5a8f3d;
            --secondary-color: #D8E6D9;
            --text-color: #333;
            --bg-light: #f8f9fa;
        }

        .restaurante-detalhes {
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

        .restaurante-header {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        @media (min-width: 768px) {
            .restaurante-header {
                flex-direction: row;
                align-items: flex-start;
            }
        }

        .restaurante-imagem {
            flex: 1;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .restaurante-imagem img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .restaurante-info {
            flex: 1;
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .restaurante-titulo {
            font-family: 'Inter', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .restaurante-avaliacao {
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

        .restaurante-meta {
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
        }

        .badge {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-right: 0.5rem;
        }

        .badge-promocao {
            background: #ff6b6b;
        }

        .restaurante-conteudo {
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

        .restaurante-descricao {
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
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .mapa-error {
            text-align: center;
            padding: 2rem;
            color: #666;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
        }

        .mapa-error i {
            font-size: 2rem;
            color: #ff6b6b;
            margin-bottom: 0.5rem;
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

        @media (max-width: 768px) {
            .restaurante-titulo {
                font-size: 1.5rem;
            }

            .restaurante-meta {
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
        }
    </style>
@endsection

@section('content')
    <div class="restaurante-detalhes">
        @if(!isset($restaurante))
            <!-- Mensagem de erro caso o restaurante não seja encontrado -->
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i>
                <h2>Restaurante não encontrado</h2>
                <p>O restaurante que você está tentando acessar não foi encontrado.</p>
                <a href="{{ route('restaurantes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar para Restaurantes
                </a>
            </div>
        @else
            <!-- Breadcrumb -->
            <div class="breadcrumb">
                <a href="{{ route('restaurantes.index') }}">Restaurantes</a> &gt; {{ $restaurante->nome }}
            </div>

            <!-- Cabeçalho do Restaurante -->
            <div class="restaurante-header">
                <div class="restaurante-imagem">
                    <img src="{{ $restaurante->imagem }}" alt="{{ $restaurante->nome }}"
                        onerror="this.src='https://via.placeholder.com/600x400/5a8f3d/ffffff?text=Imagem+Indisponível'">
                </div>
                <div class="restaurante-info">
                    <h1 class="restaurante-titulo">{{ $restaurante->nome }}</h1>
                    <div class="restaurante-avaliacao">
                        <span class="star">★</span>
                        <span>{{ $restaurante->avaliacao }} ({{ rand(100, 500) }} avaliações)</span>
                    </div>
                    <div class="restaurante-meta">
                        <div class="meta-item">
                            <span class="meta-label">Tipo de Cozinha</span>
                            <span class="meta-value">
                                @if(is_array($restaurante->tipos))
                                    {{ implode(', ', $restaurante->tipos) }}
                                @else
                                    {{ $restaurante->tipos ?? 'Não especificado' }}
                                @endif
                            </span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Faixa de Preço</span>
                            <span class="meta-value preco">{{ $restaurante->preco_texto ?? '$$' }} -
                                {{ $restaurante->preco ?? 'Médio' }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Horário de Funcionamento</span>
                            <span class="meta-value">{{ $restaurante->horario ?? 'Horário não especificado' }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Localização</span>
                            <span class="meta-value">{{ $restaurante->endereco ?? 'Endereço não especificado' }}</span>
                        </div>
                    </div>
                    @if(($restaurante->badge ?? null) || ($restaurante->promocao ?? false))
                        <div class="restaurante-badges">
                            @if($restaurante->badge)
                                <span class="badge">{{ $restaurante->badge }}</span>
                            @endif
                            @if($restaurante->promocao)
                                <span class="badge badge-promocao">Promoção</span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Conteúdo do Restaurante -->
            <div class="restaurante-conteudo">
                <h2 class="secao-titulo">Sobre</h2>
                <div class="restaurante-descricao">
                    <p>Descubra a excelência gastronômica no {{ $restaurante->nome }}, localizado no coração de
                        {{ explode(',', $restaurante->endereco)[1] ?? $restaurante->endereco ?? 'sua cidade' }}. Nosso
                        restaurante oferece uma experiência única que combina sabores autênticos com um ambiente acolhedor e
                        sofisticado.</p>
                    <p>Nossa equipe de chefs talentosos utiliza apenas os ingredientes mais frescos e selecionados para criar
                        pratos que encantam todos os sentidos. Seja para um jantar romântico, uma reunião de negócios ou uma
                        celebração especial, o {{ $restaurante->nome }} é o local perfeito para momentos memoráveis.</p>
                    <p>Com uma avaliação de {{ $restaurante->avaliacao }} estrelas, nosso compromisso é proporcionar não apenas
                        uma refeição, mas uma experiência gastronômica completa que ficará gravada em sua memória.</p>
                </div>

                <h2 class="secao-titulo">Galeria</h2>
                <div class="galeria">
                    <div class="galeria-item">
                        <img src="{{ $restaurante->imagem ?? 'https://via.placeholder.com/300x200/5a8f3d/ffffff?text=Imagem+Indisponível' }}"
                            alt="{{ $restaurante->nome }} - Interior"
                            onerror="this.src='https://via.placeholder.com/300x200/5a8f3d/ffffff?text=Imagem+Indisponível'">
                    </div>
                    <div class="galeria-item">
                        <img src="{{ !empty($restaurante->prato) ? $restaurante->prato : 'https://via.placeholder.com/300x200/5a8f3d/ffffff?text=Imagem+Indisponível' }}"
                            alt="{{ $restaurante->nome }} - Prato Principal"
                            onerror="this.src='https://via.placeholder.com/300x200/5a8f3d/ffffff?text=Imagem+Indisponível'">
                    </div>
                    <div class="galeria-item">
                        <img src="{{ !empty($restaurante->ambiente) ? $restaurante->ambiente : 'https://via.placeholder.com/300x200/5a8f3d/ffffff?text=Imagem+Indisponível' }}"
                            alt="{{ $restaurante->nome }} - Ambiente"
                            onerror="this.src='https://via.placeholder.com/300x200/5a8f3d/ffffff?text=Imagem+Indisponível'">
                    </div>
                    <div class="galeria-item">
                        <img src="{{ !empty($restaurante->sobremesas) ? $restaurante->sobremesas : 'https://via.placeholder.com/300x200/5a8f3d/ffffff?text=Imagem+Indisponível' }}"
                            alt="{{ $restaurante->nome }} - Sobremesas"
                            onerror="this.src='https://via.placeholder.com/300x200/5a8f3d/ffffff?text=Imagem+Indisponível'">
                    </div>
                </div>

                <h2 class="secao-titulo">Localização</h2>
                <div class="mapa-container" id="map">
                    @if(!isset($restaurante->lat) || !isset($restaurante->lng))
                        <div class="mapa-error">
                            <i class="fas fa-exclamation-circle"></i>
                            <p>Coordenadas não disponíveis para este restaurante.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Ações -->
            <div class="acoes">
                <a href="{{ route('restaurantes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar para Restaurantes
                </a>
                @auth
                    <a href="{{ route('reservas.create', ['tipo' => 'restaurante', 'id' => $restaurante->id]) }}" class="btn btn-primary">
                        <i class="fas fa-utensils"></i> Reservar Mesa
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary" title="Faça login para reservar">
                        <i class="fas fa-sign-in-alt"></i> Login para Reservar
                    </a>
                @endauth
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Inicialização do mapa
            try {
                @if(isset($restaurante) && $restaurante->lat && $restaurante->lng)
                    // Restaurante com coordenadas válidas
                    const map = L.map('map').setView([{{ $restaurante->lat }}, {{ $restaurante->lng }}], 15);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                        maxZoom: 19,
                        detectRetina: true
                    }).addTo(map);
                    L.marker([{{ $restaurante->lat }}, {{ $restaurante->lng }}])
                        .addTo(map)
                        .bindPopup('<b>{{ $restaurante->nome }}</b><br>{{ $restaurante->endereco }}')
                        .openPopup();
                    // Forçar redimensionamento do mapa
                    setTimeout(() => {
                        map.invalidateSize();
                    }, 100);
                @elseif(isset($restaurante))
                        // Restaurante sem coordenadas: exibir mensagem de erro no mapa
                        document.getElementById('map').innerHTML = `
                        <div class="mapa-error">
                          <i class="fas fa-exclamation-circle"></i>
                          <p>Coordenadas não disponíveis para este restaurante.</p>
                        </div>
                      `;
                @else
                    // Restaurante não encontrado: ocultar mapa
                    document.getElementById('map').style.display = 'none';
                @endif
          } catch (error) {
                console.error('Erro ao inicializar o mapa:', error);
                document.getElementById('map').innerHTML = `
              <div class="mapa-error">
                <i class="fas fa-exclamation-circle"></i>
                <p>Não foi possível carregar o mapa. Verifique sua conexão com a internet.</p>
              </div>
            `;
            }
        });
    </script>
@endsection
