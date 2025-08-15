@extends('layouts.app')

@section('title', 'Restaurantes - Bella Avventura')

@section('styles')
<style>
    @font-face {
        font-family: 'GaramondBold';
        src: local('Garamond'), serif;
        font-weight: bold;
    }

    .filtros-container {
        background-color: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 3px solid #D8E6D9;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.8s ease;
    }

    .filtros-container h3 {
        color: #5a8f3d;
        margin-top: 0;
        margin-bottom: 1rem;
    }

    .filtros-form {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .filtro-grupo {
        flex: 1;
        min-width: 200px;
    }

    .filtro-grupo label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 400;
        color: #333;
    }

    .filtro-grupo select,
    .filtro-grupo input {
        width: 100%;
        padding: 0.8rem;
        border: 1px solid #D8E6D9;
        border-radius: 5px;
        font-family: 'Inter', sans-serif;
    }

    .filtro-botoes {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
        justify-content: center;
        width: 100%;
    }

    .btn-filtrar,
    .btn-limpar {
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-filtrar {
        background-color: #5a8f3d;
        color: white;
    }

    .btn-filtrar:hover {
        background-color: #4a7d2d;
    }

    .btn-limpar {
        background-color: #f0f0f0;
        color: #333;
    }

    .btn-limpar:hover {
        background-color: #e0e0e0;
    }

    .pagination-info {
        text-align: center;
        margin-bottom: 1rem;
        color: #666;
        font-weight: 400;
    }

    .restaurantes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        min-height: 600px;
    }

    .restaurante-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        border: 3px solid #D8E6D9;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        animation: fadeInUp 0.8s ease forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    .restaurante-card.show {
        opacity: 1;
        transform: translateY(0);
    }

    .restaurante-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .restaurante-img {
        height: 180px;
        overflow: hidden;
        position: relative;
    }

    .restaurante-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .restaurante-card:hover .restaurante-img img {
        transform: scale(1.1);
    }

    .restaurante-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #5a8f3d;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.8rem;
        font-weight: bold;
    }

    .restaurante-promocao {
        background-color: #ff6b6b;
    }

    .restaurante-content {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .restaurante-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.5rem;
    }

    .restaurante-title {
        font-size: 1.3rem;
        color: #5a8f3d;
        margin: 0;
    }

    .restaurante-rating {
        display: flex;
        align-items: center;
        font-weight: bold;
    }

    .star {
        color: #FFD700;
        margin-right: 3px;
    }

    .restaurante-tipos {
        margin-bottom: 1rem;
        color: #666;
        font-size: 0.9rem;
        font-weight: 400;
    }

    .restaurante-info {
        margin-bottom: 1rem;
        flex: 1;
    }

    .restaurante-info p {
        margin: 0.5rem 0;
        font-weight: 400;
        display: flex;
        align-items: center;
    }

    .restaurante-info p span {
        margin-right: 0.5rem;
    }

    .preco {
        font-weight: bold;
        color: #5a8f3d;
    }

    .restaurante-footer {
        display: flex;
        justify-content: space-between;
        margin-top: 1rem;
        border-top: 1px solid #D8E6D9;
        padding-top: 1rem;
    }

    .btn-reservar,
    .btn-ver-mais {
        padding: 0.6rem 1rem;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
    }

    .btn-reservar {
        background-color: #5a8f3d;
        color: white;
        flex: 1;
        margin-right: 0.5rem;
    }

    .btn-reservar:hover {
        background-color: #4a7d2d;
    }

    .btn-ver-mais {
        background-color: #f0f0f0;
        color: #333;
        width: 40%;
    }

    .btn-ver-mais:hover {
        background-color: #e0e0e0;
    }

    .paginacao {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 3rem;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .pagina-btn {
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #D8E6D9;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: white;
        font-weight: bold;
    }

    .pagina-btn:hover,
    .pagina-btn.active {
        background-color: #5a8f3d;
        color: white;
    }

    .pagina-btn.disabled {
        cursor: not-allowed;
        opacity: 0.5;
    }

    .pagina-seta {
        font-size: 1.2rem;
    }

    .notificacao {
        background-color: #5a8f3d;
        color: white;
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
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .loading {
        text-align: center;
        padding: 2rem;
        color: #666;
    }

    #map {
        height: 300px;
        width: 80%;
        margin: 1rem auto;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 768px) {
        .restaurantes-grid {
            grid-template-columns: 1fr;
        }

        .filtros-form {
            flex-direction: column;
        }
    }

    @media (max-width: 600px) {
        .restaurante-footer {
            flex-direction: column;
            gap: 0.5rem;
        }

        .btn-ver-mais {
            width: 100%;
        }

        .btn-reservar {
            margin-right: 0;
        }

        .paginacao {
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<div id="notification" class="notification"></div>

<main class="main-content">
    <h1 class="page-title">Restaurantes</h1>
    <p class="page-subtitle">Descubra os melhores sabores locais e internacionais. Filtre por tipo de cozinha, preço e avaliações para encontrar o restaurante perfeito para sua experiência gastronômica.</p>

    <!-- Filtros -->
    <div class="filtros-container">
        <h3>Filtros</h3>
        <form class="filtros-form" id="filtros-form">
            <div class="filtro-grupo">
                <label for="tipo-cozinha">Tipo de Cozinha</label>
                <select id="tipo-cozinha" name="tipo">
                    <option value="">Todas</option>
                    @foreach($tiposCozinha as $tipo)
                        <option value="{{ $tipo }}" {{ request('tipo') == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filtro-grupo">
                <label for="preco">Faixa de Preço</label>
                <select id="preco" name="preco">
                    <option value="">Todos</option>
                    <option value="$" {{ request('preco') == '$' ? 'selected' : '' }}>$ - Econômico</option>
                    <option value="$$" {{ request('preco') == '$$' ? 'selected' : '' }}>$$ - Moderado</option>
                    <option value="$$$" {{ request('preco') == '$$$' ? 'selected' : '' }}>$$$ - Premium</option>
                </select>
            </div>
            <div class="filtro-grupo">
                <label for="avaliacao">Avaliação Mínima</label>
                <select id="avaliacao" name="avaliacao">
                    <option value="">Qualquer</option>
                    <option value="3" {{ request('avaliacao') == '3' ? 'selected' : '' }}>3+ Estrelas</option>
                    <option value="4" {{ request('avaliacao') == '4' ? 'selected' : '' }}>4+ Estrelas</option>
                    <option value="4.5" {{ request('avaliacao') == '4.5' ? 'selected' : '' }}>4.5+ Estrelas</option>
                </select>
            </div>
            <div class="filtro-grupo">
                <label for="localizacao">Cidade</label>
                <select id="localizacao" name="cidade">
                    <option value="">Todas</option>
                    @foreach($cidades as $cidade)
                        <option value="{{ $cidade }}" {{ request('cidade') == $cidade ? 'selected' : '' }}>{{ $cidade }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filtro-botoes">
                <button type="submit" class="btn-filtrar">Aplicar Filtros</button>
                <a href="{{ route('restaurante') }}" class="btn-limpar">Limpar</a>
            </div>
        </form>
    </div>

    <!-- Info da paginação -->
    <div class="pagination-info" id="pagination-info">
        Mostrando {{ $restaurantes->firstItem() }} a {{ $restaurantes->lastItem() }} de {{ $restaurantes->total() }} restaurantes
    </div>

    <!-- Restaurantes Grid -->
    <div class="restaurantes-grid" id="restaurantes-grid">
        @forelse($restaurantes as $restaurante)
            <div class="restaurante-card show">
                <div class="restaurante-img">
                    <img src="{{ asset($restaurante->imagem) }}" alt="{{ $restaurante->nome }}">
                    @if($restaurante->promocao)
                        <div class="restaurante-badge restaurante-promocao">Promoção</div>
                    @elseif($restaurante->badge)
                        <div class="restaurante-badge">{{ $restaurante->badge }}</div>
                    @endif
                </div>
                <div class="restaurante-content">
                    <div class="restaurante-header">
                        <h3 class="restaurante-title">{{ $restaurante->nome }}</h3>
                        <div class="restaurante-rating">
                            <span class="star">★</span>{{ $restaurante->avaliacao }}
                        </div>
                    </div>
                    <div class="restaurante-tipos">{{ implode(' • ', $restaurante->tipos) }}</div>
                    <div class="restaurante-info">
                        <p><span>📍</span> {{ $restaurante->endereco }}</p>
                        <p><span>⏰</span> {{ $restaurante->horario }}</p>
                        <p><span>💰</span> <span class="preco">{{ $restaurante->precoTexto }}</span> {{ $restaurante->preco }}</p>
                    </div>
                    <div class="restaurante-footer">
                        <a href="{{ route('reservas.create', $restaurante->id) }}" class="btn-reservar">Reservar Mesa</a>
                        <a href="{{ route('restaurante', $restaurante->id) }}" class="btn-ver-mais">Ver Detalhes</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="loading">Nenhum restaurante encontrado</div>
        @endforelse
    </div>

    <!-- Paginação -->
    <div class="paginacao">
        @if($restaurantes->onFirstPage())
            <div class="pagina-btn disabled">&laquo;</div>
        @else
            <a href="{{ $restaurantes->previousPageUrl() }}" class="pagina-btn">&laquo;</a>
        @endif

        @foreach(range(1, $restaurantes->lastPage()) as $page)
            @if($page == $restaurantes->currentPage())
                <div class="pagina-btn active">{{ $page }}</div>
            @else
                <a href="{{ $restaurantes->url($page) }}" class="pagina-btn">{{ $page }}</a>
            @endif
        @endforeach

        @if($restaurantes->hasMorePages())
            <a href="{{ $restaurantes->nextPageUrl() }}" class="pagina-btn">&raquo;</a>
        @else
            <div class="pagina-btn disabled">&raquo;</div>
        @endif
    </div>
</main>

<!-- Mapa -->
<div id="map"></div>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    // Inicializa o mapa
    document.addEventListener('DOMContentLoaded', function () {
        const map = L.map('map').setView([-23.5505, -46.6333], 4);

        // Adiciona uma camada de mapa
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Adiciona marcadores para os restaurantes
        @foreach($restaurantes as $restaurante)
            L.marker([{{ $restaurante->lat }}, {{ $restaurante->lng }}]).addTo(map)
                .bindPopup(`<b>{{ $restaurante->nome }}</b><br>{{ $restaurante->endereco }}`);
        @endforeach

        // Configura o formulário de filtros
        document.getElementById('filtros-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const params = new URLSearchParams(formData);
            window.location.href = "{{ route('restaurante') }}?" + params.toString();
        });

        // Verifica mensagem de sucesso
        @if(session('success'))
            showNotification("{{ session('success') }}", 'success');
        @endif
    });

    // Função para mostrar notificações
    function showNotification(message, type) {
        const notificacao = document.getElementById('notification');
        notificacao.textContent = message;
        notificacao.className = `notification ${type} show`;

        setTimeout(() => {
            notificacao.classList.remove('show');
        }, 4000);
    }
</script>
@endsection
