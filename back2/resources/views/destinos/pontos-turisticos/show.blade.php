@extends('layouts.app')
@section('title', isset($ponto) ? $ponto->nome . ' - Bella Avventura' : 'Ponto Turístico - Bella Avventura')
@section('styles')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
  <style>
    :root {
        --primary-color: #5a8f3d;
        --secondary-color: #D8E6D9;
        --text-color: #333;
        --bg-light: #f8f9fa;
    }
    .ponto-detalhes {
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
    .ponto-header {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    @media (min-width: 768px) {
        .ponto-header {
            flex-direction: row;
            align-items: flex-start;
        }
    }
    .ponto-imagem {
        flex: 1;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .ponto-imagem img {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }
    .ponto-info {
        flex: 1;
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .ponto-titulo {
        font-family: 'Inter', sans-serif;
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }
    .ponto-avaliacao {
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
    .ponto-meta {
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
    .ponto-conteudo {
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
    .ponto-descricao {
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
        .ponto-titulo {
            font-size: 1.5rem;
        }
        .ponto-meta {
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
  <div class="ponto-detalhes">
    @if(!isset($ponto))
      <!-- Mensagem de erro caso o ponto turístico não seja encontrado -->
      <div class="error-message">
        <i class="fas fa-exclamation-circle"></i>
        <h2>Ponto turístico não encontrado</h2>
        <p>O ponto turístico que você está tentando acessar não foi encontrado.</p>
        <a href="{{ route('pontos-turisticos.alternative') }}" class="btn btn-secondary">
          <i class="fas fa-arrow-left"></i> Voltar para Pontos Turísticos
        </a>
      </div>
    @else
      <!-- Breadcrumb -->
      <div class="breadcrumb">
        <a href="{{ route('pontos-turisticos.alternative') }}">Pontos Turísticos</a> &gt; {{ $ponto->nome }}
      </div>
      <!-- Cabeçalho do Ponto Turístico -->
      <div class="ponto-header">
        <div class="ponto-imagem">
          <img src="{{ $ponto->imagem }}"
               alt="{{ $ponto->nome }}"
               onerror="this.src='https://via.placeholder.com/600x400/5a8f3d/ffffff?text=Imagem+Indisponível'">
        </div>
        <div class="ponto-info">
          <h1 class="ponto-titulo">{{ $ponto->nome }}</h1>
          <div class="ponto-avaliacao">
            <span class="star">★</span>
            <span>{{ $ponto->avaliacao }} ({{ number_format($ponto->avaliacoes) }} avaliações)</span>
          </div>
          <div class="ponto-meta">
            <div class="meta-item">
              <span class="meta-label">Tipo de Atração</span>
              <span class="meta-value">{{ ucfirst($ponto->tipo) ?? 'Não especificado' }}</span>
            </div>
            <div class="meta-item">
              <span class="meta-label">Preço</span>
              <span class="meta-value preco">{{ $ponto->precoTexto ?? 'Gratuito' }}</span>
            </div>
            <div class="meta-item">
              <span class="meta-label">Horário de Funcionamento</span>
              <span class="meta-value">{{ $ponto->horario ?? '08:00 - 18:00' }}</span>
            </div>
            <div class="meta-item">
              <span class="meta-label">Localização</span>
              <span class="meta-value">{{ $ponto->localizacao ?? 'Localização não especificada' }}</span>
            </div>
          </div>
          @if(($ponto->badge ?? null) || ($ponto->promocao ?? false))
            <div class="ponto-badges">
              @if($ponto->badge)
                <span class="badge">{{ $ponto->badge }}</span>
              @endif
              @if($ponto->promocao)
                <span class="badge badge-promocao">Promoção</span>
              @endif
            </div>
          @endif
        </div>
      </div>
      <!-- Conteúdo do Ponto Turístico -->
      <div class="ponto-conteudo">
        <h2 class="secao-titulo">Sobre</h2>
        <div class="ponto-descricao">
          <p>Descubra a beleza e a história do {{ $ponto->nome }}, localizado em {{ explode(',', $ponto->localizacao)[1] ?? $ponto->localizacao ?? 'sua cidade' }}. Este ponto turístico oferece uma experiência única que combina cultura, natureza e aventura em um ambiente inesquecível.</p>
          <p>Nossos guias especializados estão prontos para proporcionar uma visita memorável, com informações detalhadas sobre a história e as curiosidades do local. Seja para uma viagem em família, uma aventura com amigos ou uma exploração cultural, o {{ $ponto->nome }} é o destino perfeito.</p>
          <p>Com uma avaliação de {{ $ponto->avaliacao }} estrelas, baseada em {{ number_format($ponto->avaliacoes) }} avaliações, nosso compromisso é oferecer uma experiência que encante e surpreenda todos os visitantes.</p>
        </div>
        <h2 class="secao-titulo">Galeria</h2>
        <div class="galeria">
          <div class="galeria-item">
            <img src="{{ $ponto->imagem }}"
                 alt="{{ $ponto->nome }} - Vista"
                 onerror="this.src='https://via.placeholder.com/300x200/5a8f3d/ffffff?text=Imagem+Indisponível'">
          </div>
          <div class="galeria-item">
            <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                 alt="{{ $ponto->nome }} - Detalhe"
                 onerror="this.src='https://via.placeholder.com/300x200/5a8f3d/ffffff?text=Imagem+Indisponível'">
          </div>
          <div class="galeria-item">
            <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                 alt="{{ $ponto->nome }} - Ambiente"
                 onerror="this.src='https://via.placeholder.com/300x200/5a8f3d/ffffff?text=Imagem+Indisponível'">
          </div>
          <div class="galeria-item">
            <img src="https://images.unsplash.com/photo-1590846406792-0adc7f938f1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                 alt="{{ $ponto->nome }} - Atração"
                 onerror="this.src='https://via.placeholder.com/300x200/5a8f3d/ffffff?text=Imagem+Indisponível'">
          </div>
        </div>
        <h2 class="secao-titulo">Localização</h2>
        <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;margin:40px 0 32px 0;">
          <button id="openMap" style="background:#5a8f3d;color:#fff;border:none;border-radius:10px;padding:14px 32px;font-size:18px;box-shadow:0 2px 12px #5a8f3d22;cursor:pointer;margin-bottom:24px;">Ver Mapa</button>
          <div id="mapContainer" style="display:none;width:100%;max-width:700px;margin:0 auto;">
            <div class="mapa-container" id="map">
              @if(!isset($ponto->lat) || !isset($ponto->lng))
                <div class="mapa-error">
                  <i class="fas fa-exclamation-circle"></i>
                  <p>Coordenadas não disponíveis para este ponto turístico.</p>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
      <!-- Ações -->
      <div class="acoes">
        <a href="{{ route('pontos-turisticos.alternative') }}" class="btn btn-secondary">
          <i class="fas fa-arrow-left"></i> Voltar para Pontos Turísticos
        </a>
        <!-- Nenhuma reserva necessária para pontos turísticos -->
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
        @if(isset($ponto) && $ponto->lat && $ponto->lng)
          // Ponto turístico com coordenadas válidas
          const map = L.map('map').setView([{{ $ponto->lat }}, {{ $ponto->lng }}], 15);
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19,
            detectRetina: true
          }).addTo(map);
          L.marker([{{ $ponto->lat }}, {{ $ponto->lng }}])
            .addTo(map)
            .bindPopup('<b>{{ $ponto->nome }}</b><br>{{ $ponto->localizacao }}')
            .openPopup();
          // Forçar redimensionamento do mapa
          setTimeout(() => {
            map.invalidateSize();
          }, 100);
        @elseif(isset($ponto))
          // Ponto turístico sem coordenadas: exibir mensagem de erro no mapa
          document.getElementById('map').innerHTML = `
            <div class="mapa-error">
              <i class="fas fa-exclamation-circle"></i>
              <p>Coordenadas não disponíveis para este ponto turístico.</p>
            </div>
          `;
        @else
          // Ponto turístico não encontrado: ocultar mapa
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

      document.getElementById('openMap').addEventListener('click', function() {
        document.getElementById('mapContainer').style.display = 'block';
        this.style.display = 'none';
      });
    });
  </script>
@endsection
