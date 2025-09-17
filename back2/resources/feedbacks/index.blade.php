@extends('layouts.app')

@section('title', 'Gerenciamento de Feedbacks - Bella Avventura')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>
    :root {
        --primary-color: #5a8f3d;
        --secondary-color: #D8E6D9;
        --text-color: #333;
        --bg-light: #f8f9fa;
    }

    .feedback-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    .page-header {
        display: flex;
        justify-content: between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-title {
        font-family: 'GaramondBold', serif;
        color: var(--primary-color);
        font-size: 2.5rem;
        margin: 0;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        text-align: center;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #666;
        font-size: 0.9rem;
    }

    .filters-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }

    .filters-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .form-group {
        margin-bottom: 0;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--text-color);
    }

    .form-group select,
    .form-group input {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid var(--secondary-color);
        border-radius: 8px;
        font-size: 0.9rem;
    }

    .btn-filter {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        cursor: pointer;
        align-self: end;
    }

    .btn-export {
        background: #6c757d;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .feedback-table {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .table-header {
        display: grid;
        grid-template-columns: 80px 1fr 1fr 120px 200px 120px;
        padding: 1rem;
        background: var(--secondary-color);
        font-weight: 600;
        color: var(--text-color);
    }

    .table-row {
        display: grid;
        grid-template-columns: 80px 1fr 1fr 120px 200px 120px;
        padding: 1rem;
        border-bottom: 1px solid #eee;
        align-items: center;
    }

    .table-row:hover {
        background: #f8f9fa;
    }

    .avaliacao-badge {
        padding: 0.25rem 0.5rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        text-align: center;
    }

    .btn-action {
        padding: 0.5rem;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        margin-right: 0.5rem;
    }

    .btn-view {
        background: var(--primary-color);
        color: white;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #666;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        color: var(--secondary-color);
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
        gap: 0.5rem;
    }

    .page-link {
        padding: 0.5rem 1rem;
        border: 1px solid var(--secondary-color);
        border-radius: 6px;
        text-decoration: none;
        color: var(--text-color);
    }

    .page-link.active {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    @media (max-width: 1024px) {
        .table-header,
        .table-row {
            grid-template-columns: 1fr 1fr 1fr;
            gap: 1rem;
        }

        .mobile-hidden {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .feedback-container {
            padding: 1rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .filters-grid {
            grid-template-columns: 1fr;
        }

        .table-header,
        .table-row {
            grid-template-columns: 1fr;
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
<div class="feedback-container">
    <div class="page-header">
        <h1 class="page-title">Gerenciamento de Feedbacks</h1>
        <a href="{{ route('feedbacks.exportar', request()->query()) }}" class="btn-export">
            <i class="fas fa-download"></i> Exportar CSV
        </a>
    </div>

    <!-- Estatísticas -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $estatisticas['total'] }}</div>
            <div class="stat-label">Total de Feedbacks</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ number_format($estatisticas['media_avaliacao'], 1) }}</div>
            <div class="stat-label">Média de Avaliação</div>
        </div>
        @foreach($estatisticas['distribuicao'] as $avaliacao => $total)
        <div class="stat-card">
            <div class="stat-number">{{ $total }}</div>
            <div class="stat-label">{{ $avaliacao }} Estrelas</div>
        </div>
        @endforeach
    </div>

    <!-- Filtros -->
    <div class="filters-card">
        <form method="GET" action="{{ route('feedbacks.index') }}">
            <div class="filters-grid">
                <div class="form-group">
                    <label for="search">Pesquisar</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}"
                           placeholder="Nome, email ou mensagem...">
                </div>

                <div class="form-group">
                    <label for="avaliacao">Avaliação</label>
                    <select id="avaliacao" name="avaliacao">
                        <option value="">Todas</option>
                        @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ request('avaliacao') == $i ? 'selected' : '' }}>
                            {{ $i }} Estrela(s)
                        </option>
                        @endfor
                    </select>
                </div>

                <div class="form-group">
                    <label for="data_inicio">Data Início</label>
                    <input type="date" id="data_inicio" name="data_inicio" value="{{ request('data_inicio') }}">
                </div>

                <div class="form-group">
                    <label for="data_fim">Data Fim</label>
                    <input type="date" id="data_fim" name="data_fim" value="{{ request('data_fim') }}">
                </div>

                <div class="form-group">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-filter"></i> Filtrar
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Tabela de Feedbacks -->
    <div class="feedback-table">
        <div class="table-header">
            <div>ID</div>
            <div>Ponto Turístico</div>
            <div>Usuário</div>
            <div>Avaliação</div>
            <div>Data</div>
            <div>Ações</div>
        </div>

        @forelse($feedbacks as $feedback)
        <div class="table-row">
            <div>#{{ $feedback->id }}</div>
            <div>{{ $feedback->pontoTuristico->nome }}</div>
            <div>
                <strong>{{ $feedback->nome }}</strong><br>
                <small>{{ $feedback->email }}</small>
            </div>
            <div>
                <span class="avaliacao-badge" style="background: {{ $feedback->cor_avaliacao }}; color: white;">
                    {{ $feedback->avaliacao }} ★
                </span>
            </div>
            <div>{{ $feedback->created_at->format('d/m/Y H:i') }}</div>
            <div>
                <a href="{{ route('feedbacks.show', $feedback) }}" class="btn-action btn-view">
                    <i class="fas fa-eye"></i>
                </a>
                <form action="{{ route('feedbacks.destroy', $feedback) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action btn-delete"
                            onclick="return confirm('Tem certeza que deseja excluir este feedback?')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <i class="fas fa-comment-slash"></i>
            <h3>Nenhum feedback encontrado</h3>
            <p>Não há feedbacks correspondentes aos filtros aplicados.</p>
        </div>
        @endforelse
    </div>

    <!-- Paginação -->
    @if($feedbacks->hasPages())
    <div class="pagination">
        {{ $feedbacks->links() }}
    </div>
    @endif
</div>
@endsection
