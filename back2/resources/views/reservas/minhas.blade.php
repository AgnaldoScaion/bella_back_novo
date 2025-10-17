@extends('layouts.app')

@section('title', 'Minhas Reservas')

@section('styles')
<style>
    .reservas-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 3rem 0 4rem;
        color: white;
        margin-bottom: -2rem;
    }

    .hero-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .hero-title {
        font-family: 'Garamond', serif;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }

    .hero-subtitle {
        opacity: 0.9;
        font-size: 1.1rem;
    }

    .reservas-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem 3rem;
    }

    .filters-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        align-items: end;
    }

    .filter-group label {
        display: block;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .filter-select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8fafc;
    }

    .filter-select:focus {
        outline: none;
        border-color: #667eea;
        background: white;
    }

    .filter-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-filter {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-filter.primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }

    .btn-filter.secondary {
        background: #e2e8f0;
        color: #4a5568;
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .reservas-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .reserva-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }

    .reserva-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }

    .reserva-header {
        padding: 1.25rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: white;
        font-weight: 600;
    }

    .status-confirmada { background: linear-gradient(135deg, #10b981, #059669); }
    .status-pendente { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .status-cancelada { background: linear-gradient(135deg, #ef4444, #dc2626); }
    .status-concluida { background: linear-gradient(135deg, #6366f1, #4f46e5); }

    .status-icon {
        font-size: 1.5rem;
    }

    .codigo-badge {
        background: rgba(255,255,255,0.2);
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        backdrop-filter: blur(10px);
    }

    .reserva-body {
        padding: 1.5rem;
    }

    .hotel-name {
        font-family: 'Garamond', serif;
        font-size: 1.4rem;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .hotel-location {
        color: #718096;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .reserva-details {
        display: grid;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem;
        background: #f8fafc;
        border-radius: 8px;
    }

    .detail-label {
        color: #718096;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detail-value {
        color: #2c3e50;
        font-weight: 600;
    }

    .total-value {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        border: 2px solid #667eea;
        padding: 1rem;
        border-radius: 12px;
        text-align: center;
        margin-bottom: 1rem;
    }

    .total-label {
        font-size: 0.85rem;
        color: #667eea;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .total-amount {
        font-size: 1.8rem;
        font-weight: bold;
        color: #667eea;
    }

    .observacoes-box {
        background: #fff3cd;
        border-left: 4px solid #ffc107;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        font-size: 0.9rem;
    }

    .reserva-actions {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .action-btn {
        flex: 1;
        min-width: 120px;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 0.9rem;
    }

    .btn-confirmar {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }

    .btn-confirmar:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-cancelar {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
    }

    .btn-cancelar:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .btn-ver-hotel {
        background: white;
        color: #667eea;
        border: 2px solid #667eea;
    }

    .btn-ver-hotel:hover {
        background: #667eea;
        color: white;
    }

    .btn-disabled {
        background: #e2e8f0;
        color: #94a3b8;
        cursor: not-allowed;
    }

    .timestamp {
        font-size: 0.8rem;
        color: #94a3b8;
        text-align: center;
        margin-top: 0.75rem;
        padding-top: 0.75rem;
        border-top: 1px solid #e2e8f0;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .empty-icon {
        font-size: 5rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-title {
        font-family: 'Garamond', serif;
        font-size: 1.8rem;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .empty-text {
        color: #718096;
        margin-bottom: 2rem;
    }

    .btn-explore {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem 2rem;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        text-decoration: none;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-explore:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        color: white;
    }

    .nova-reserva-section {
        text-align: center;
        margin-top: 3rem;
    }

    .btn-nova-reserva {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1.25rem 3rem;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        text-decoration: none;
        border-radius: 16px;
        font-size: 1.1rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
    }

    .btn-nova-reserva:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(102, 126, 234, 0.4);
        color: white;
    }

    @media (max-width: 768px) {
        .reservas-grid {
            grid-template-columns: 1fr;
        }

        .filter-grid {
            grid-template-columns: 1fr;
        }

        .hero-title {
            font-size: 2rem;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<div class="reservas-hero">
    <div class="hero-content">
        <h1 class="hero-title">
            <i class="fas fa-calendar-check"></i> Minhas Reservas
        </h1>
        <p class="hero-subtitle">Gerencie todas as suas reservas em um só lugar</p>
    </div>
</div>

<div class="reservas-container">
    @if($reservas->isEmpty())
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">🏨</div>
            <h2 class="empty-title">Nenhuma reserva encontrada</h2>
            <p class="empty-text">Você ainda não possui reservas. Que tal explorar nossos hotéis incríveis?</p>
            <a href="{{ route('hoteis.alternative') }}" class="btn-explore">
                <i class="fas fa-search"></i>
                <span>Explorar Hotéis</span>
            </a>
        </div>
    @else
        <!-- Filtros -->
        <div class="filters-card">
            <form method="GET" action="{{ route('reservas.minhas') }}">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label>
                            <i class="fas fa-filter"></i> Status da Reserva
                        </label>
                        <select name="status" class="filter-select">
                            <option value="">Todas as reservas</option>
                            <option value="pendente" {{ request('status') == 'pendente' ? 'selected' : '' }}>
                                ⏳ Pendentes
                            </option>
                            <option value="confirmada" {{ request('status') == 'confirmada' ? 'selected' : '' }}>
                                ✅ Confirmadas
                            </option>
                            <option value="cancelada" {{ request('status') == 'cancelada' ? 'selected' : '' }}>
                                ❌ Canceladas
                            </option>
                            <option value="concluida" {{ request('status') == 'concluida' ? 'selected' : '' }}>
                                ✔️ Concluídas
                            </option>
                        </select>
                    </div>
                    <div class="filter-buttons">
                        <button type="submit" class="btn-filter primary">
                            <i class="fas fa-search"></i> Filtrar
                        </button>
                        <a href="{{ route('reservas.minhas') }}" class="btn-filter secondary">
                            <i class="fas fa-redo"></i> Limpar
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Grid de Reservas -->
        <div class="reservas-grid">
            @foreach($reservas as $reserva)
                <div class="reserva-card">
                    <!-- Header com Status -->
                    <div class="reserva-header status-{{ $reserva->status }}">
                        <span class="status-icon">
                            @if($reserva->status == 'pendente')
                                ⏳
                            @elseif($reserva->status == 'confirmada')
                                ✅
                            @elseif($reserva->status == 'cancelada')
                                ❌
                            @else
                                ✔️
                            @endif
                            {{ ucfirst($reserva->status) }}
                        </span>
                        <span class="codigo-badge">
                            {{ $reserva->codigo_confirmacao }}
                        </span>
                    </div>

                    <!-- Corpo do Card -->
                    <div class="reserva-body">
                        <h3 class="hotel-name">{{ $reserva->hotel->nome ?? 'Hotel' }}</h3>
                        <div class="hotel-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $reserva->hotel->localizacao ?? 'Localização não disponível' }}</span>
                        </div>

                        <!-- Detalhes -->
                        <div class="reserva-details">
                            <div class="detail-row">
                                <span class="detail-label">
                                    <i class="fas fa-calendar-check"></i> Check-in
                                </span>
                                <span class="detail-value">{{ $reserva->data_entrada->format('d/m/Y') }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">
                                    <i class="fas fa-calendar-times"></i> Check-out
                                </span>
                                <span class="detail-value">{{ $reserva->data_saida->format('d/m/Y') }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">
                                    <i class="fas fa-bed"></i> Quarto
                                </span>
                                <span class="detail-value">{{ ucfirst($reserva->tipo_quarto) }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">
                                    <i class="fas fa-users"></i> Hóspedes
                                </span>
                                <span class="detail-value">{{ $reserva->hospedes }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">
                                    <i class="fas fa-moon"></i> Noites
                                </span>
                                <span class="detail-value">{{ $reserva->calcularDias() }}</span>
                            </div>
                        </div>

                        <!-- Valor Total -->
                        <div class="total-value">
                            <div class="total-label">Valor Total</div>
                            <div class="total-amount">R$ {{ number_format($reserva->valor_total, 2, ',', '.') }}</div>
                        </div>

                        <!-- Observações -->
                        @if($reserva->observacoes)
                            <div class="observacoes-box">
                                <strong><i class="fas fa-info-circle"></i> Observações:</strong><br>
                                {{ $reserva->observacoes }}
                            </div>
                        @endif

                        <!-- Ações -->
                        <div class="reserva-actions">
                            @if($reserva->status == 'pendente')
                                <a href="{{ route('reservas.confirmar', $reserva->codigo_confirmacao) }}"
                                   class="action-btn btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </a>
                            @endif

                            @if($reserva->status == 'pendente' || $reserva->status == 'confirmada')
                                @php
                                    $diasAteCheckIn = now()->diffInDays($reserva->data_entrada, false);
                                @endphp
                                @if($diasAteCheckIn > 2)
                                    <form method="POST"
                                          action="{{ route('reservas.cancelar', $reserva->id) }}"
                                          style="flex: 1; min-width: 120px;"
                                          onsubmit="return confirm('⚠️ Tem certeza que deseja cancelar esta reserva?');">
                                        @csrf
                                        <button type="submit" class="action-btn btn-cancelar" style="width: 100%;">
                                            <i class="fas fa-times"></i> Cancelar
                                        </button>
                                    </form>
                                @else
                                    <button class="action-btn btn-disabled"
                                            title="Cancelamento disponível apenas 48h antes do check-in">
                                        <i class="fas fa-ban"></i> Indisponível
                                    </button>
                                @endif
                            @endif

                            <a href="{{ route('hoteis.show', $reserva->hotel->id ?? 1) }}"
                               class="action-btn btn-ver-hotel">
                                <i class="fas fa-hotel"></i> Ver Hotel
                            </a>
                        </div>

                        <!-- Timestamp de Confirmação -->
                        @if($reserva->confirmada_em)
                            <div class="timestamp">
                                <i class="fas fa-clock"></i>
                                Confirmada em {{ $reserva->confirmada_em->format('d/m/Y H:i') }}
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginação -->
        <div class="d-flex justify-content-center mt-4">
            {{ $reservas->links() }}
        </div>
    @endif

    <!-- Botão Nova Reserva -->
    <div class="nova-reserva-section">
        <a href="{{ route('hoteis.alternative') }}" class="btn-nova-reserva">
            <i class="fas fa-plus-circle"></i>
            <span>Fazer Nova Reserva</span>
        </a>
    </div>
</div>
@endsection
