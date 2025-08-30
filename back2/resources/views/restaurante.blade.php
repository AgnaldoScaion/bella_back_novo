@extends('layouts.app')

@section('title', 'Restaurantes - Bella Avventura')

@section('styles')
<style>
    @font-face {
        font-family: 'GaramondBold';
        src: local('Garamond'), serif;
        font-weight: bold;
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

    .restaurante-footer {
        display: flex;
        justify-content: space-between;
        margin-top: 1rem;
        border-top: 1px solid #D8E6D9;
        padding-top: 1rem;
    }

    .btn-ver-mais {
        padding: 0.6rem 1rem;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
        background-color: #f0f0f0;
        color: #333;
        width: 100%;
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

    @keyframes fadeOut {
        0% { opacity: 1; }
        80% { opacity: 1; }
        100% { opacity: 0; }
    }

    @media (max-width: 768px) {
        .restaurantes-grid {
            grid-template-columns: 1fr;
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
    }
</style>
@endsection

@section('content')
<div id="notification" class="notificacao"></div>
<main class="main-content">
    <h1 class="page-title">Restaurantes</h1>
    <p class="page-subtitle">Explore os melhores restaurantes cadastrados.</p>

    <!-- Info da paginação -->
    <div class="pagination-info" id="pagination-info">
        Mostrando {{ $restaurantes->firstItem() }} a {{ $restaurantes->lastItem() }} de {{ $restaurantes->total() }} restaurantes
    </div>

    <!-- Restaurantes Grid -->
    <div class="restaurantes-grid" id="restaurantes-grid">
        @forelse($restaurantes as $restaurante)
            <div class="restaurante-card show">
                <div class="restaurante-content">
                    <div class="restaurante-header">
                        <h3 class="restaurante-title">{{ $restaurante->nome }}</h3>
                    </div>
                    <div class="restaurante-info">
                        <p><span>📞</span> {{ $restaurante->telefone }}</p>
                        <p><span>📍</span> {{ $restaurante->rua }}, {{ $restaurante->numero }} - {{ $restaurante->bairro }}, {{ $restaurante->cidade }} - {{ $restaurante->estado }}</p>
                        <p><span>⏰</span> {{ $restaurante->horario_funcionamento }}</p>
                        @if($restaurante->sobre)
                            <p><span>ℹ️</span> {{ $restaurante->sobre }}</p>
                        @endif
                    </div>
                    <div class="restaurante-footer">
                        <a href="{{ route('restaurante.show', $restaurante->id_restaurante) }}" class="btn-ver-mais">Ver Detalhes</a>
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
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            showNotification("{{ session('success') }}", 'success');
        @endif
    });

    function showNotification(message, type) {
        const notificacao = document.getElementById('notification');
        notificacao.textContent = message;
        notificacao.className = `notificacao ${type} show`;
        setTimeout(() => {
            notificacao.classList.remove('show');
        }, 4000);
    }
</script>
@endsection
