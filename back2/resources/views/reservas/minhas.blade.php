@extends('layouts.app')

@section('title', 'Minhas Reservas')

@section('styles')
<style>
    :root {
        --primary-color: #2d5016;
        --primary-light: #5a8f3d;
        --accent-color: #a7d096;
        --primary-bg: #f3f7f3;
        --border-color: #e5f2e5;
        --text-dark: #1a1a1a;
        --text-medium: #4a4a4a;
        --text-light: #ffffff;
        --shadow-soft: 0 2px 15px rgba(45, 80, 22, 0.08);
        --shadow-medium: 0 8px 30px rgba(45, 80, 22, 0.12);
        --shadow-strong: 0 15px 40px rgba(45, 80, 22, 0.18);
        --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        --border-radius: 16px;
        --border-radius-small: 8px;
    }

    .reservations-hero {
        background: var(--accent-color);
        padding: 2rem 1rem;
        color: var(--text-dark);
    }

    .hero-content {
        max-width: 960px;
        margin: 0 auto;
        text-align: center;
    }

    .hero-title {
        font-family: 'GaramondBold', serif;
        font-size: 1.75rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .hero-subtitle {
        font-size: 1rem;
        color: var(--text-medium);
    }

    .reservations-container {
        max-width: 960px;
        margin: 0 auto;
        padding: 1rem;
    }

    .filters-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: var(--border-radius);
        padding: 1.5rem;
        box-shadow: var(--shadow-medium);
        margin-bottom: 1.5rem;
        border: 1px solid var(--border-color);
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
    }

    .filter-group label {
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--text-medium);
        margin-bottom: 0.5rem;
        display: block;
    }

    .filter-select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-small);
        font-size: 0.875rem;
        background: rgba(255, 255, 255, 0.5);
        color: var(--text-dark);
        transition: var(--transition-smooth);
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(45, 80, 22, 0.2);
    }

    .filter-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-filter {
        padding: 0.75rem 1rem;
        border-radius: var(--border-radius-small);
        font-size: 0.875rem;
        font-weight: 600;
        transition: var(--transition-smooth);
    }

    .btn-filter.primary {
        background: var(--primary-color);
        color: var(--text-light);
        border: none;
    }

    .btn-filter.secondary {
        background: transparent;
        color: var(--primary-color);
        border: 1px solid var(--primary-color);
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-soft);
    }

    .reservations-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1rem;
    }

    .reservation-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-medium);
        overflow: hidden;
        transition: var(--transition-smooth);
    }

    .reservation-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-strong);
    }

    .reservation-header {
        padding: 1rem;
        color: var(--text-light);
        font-weight: 500;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .status-confirmada { background: var(--primary-light); }
    .status-pendente { background: #f59e0b; }
    .status-cancelada { background: #f44336; }
    .status-concluida { background: #6366f1; }

    .status-icon {
        font-size: 1rem;
    }

    .code-badge {
        background: rgba(255, 255, 255, 0.2);
        padding: 0.5rem;
        border-radius: var(--border-radius-small);
        font-size: 0.75rem;
    }

    .reservation-body {
        padding: 1.5rem;
    }

    .hotel-name {
        font-family: 'GaramondBold', serif;
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .hotel-location {
        color: var(--text-medium);
        font-size: 0.875rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .reservation-details {
        display: grid;
        gap: 0.5rem;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem;
        background: rgba(255, 255, 255, 0.5);
        border-radius: var(--border-radius-small);
    }

    .detail-label {
        color: var(--text-medium);
        font-size: 0.875rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detail-value {
        color: var(--text-dark);
        font-weight: 600;
        font-size: 0.875rem;
    }

    .total-value {
        background: rgba(167, 208, 150, 0.2);
        padding: 1rem;
        border-radius: var(--border-radius-small);
        text-align: center;
        margin-bottom: 1rem;
    }

    .total-label {
        font-size: 0.875rem;
        color: var(--primary-color);
        font-weight: 500;
    }

    .total-amount {
        font-family: 'GaramondBold', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
    }

    .observacoes-box {
        background: rgba(167, 208, 150, 0.2);
        border-left: 4px solid var(--primary-color);
        padding: 1rem;
        border-radius: var(--border-radius-small);
        font-size: 0.875rem;
        margin-bottom: 1rem;
    }

    .reservation-actions {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .action-btn {
        flex: 1;
        padding: 0.75rem;
        border-radius: var(--border-radius-small);
        font-size: 0.875rem;
        font-weight: 600;
        text-align: center;
        transition: var(--transition-smooth);
    }

    .btn-confirmar {
        background: var(--primary-light);
        color: var(--text-light);
    }

    .btn-confirmar:hover {
        background: var(--primary-color);
        transform: translateY(-2px);
    }

    .btn-cancelar {
        background: #f44336;
        color: var(--text-light);
    }

    .btn-cancelar:hover {
        background: #d32f2f;
        transform: translateY(-2px);
    }

    .btn-ver-hotel {
        background: transparent;
        color: var(--primary-color);
        border: 1px solid var(--primary-color);
    }

    .btn-ver-hotel:hover {
        background: rgba(167, 208, 150, 0.1);
        color: var(--primary-light);
        transform: translateY(-2px);
    }

    .btn-disabled {
        background: #e5e7eb;
        color: #9ca3af;
        cursor: not-allowed;
    }

    .timestamp {
        font-size: 0.75rem;
        color: var(--text-medium);
        text-align: center;
        margin-top: 0.75rem;
        padding-top: 0.75rem;
        border-top: 1px solid var(--border-color);
    }

    .empty-state {
        text-align: center;
        padding: 2rem;
        background: rgba(255, 255, 255, 0.9);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-medium);
    }

    .empty-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: var(--text-medium);
    }

    .empty-title {
        font-family: 'GaramondBold', serif;
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    .empty-text {
        color: var(--text-medium);
        margin-bottom: 1rem;
    }

    .btn-explore {
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius-small);
        background: var(--primary-color);
        color: var(--text-light);
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 600;
        transition: var(--transition-smooth);
    }

    .btn-explore:hover {
        background: var(--primary-light);
        transform: translateY(-2px);
        box-shadow: var(--shadow-soft);
    }

    .new-reservation-section {
        text-align: center;
        margin-top: 2rem;
    }

    .btn-new-reservation {
        padding: 1rem 2rem;
        border-radius: var(--border-radius-small);
        background: var(--primary-color);
        color: var(--text-light);
        text-decoration: none;
        font-size: 1rem;
        font-weight: 600;
        transition: var(--transition-smooth);
    }

    .btn-new-reservation:hover {
        background: var(--primary-light);
        transform: translateY(-2px);
        box-shadow: var(--shadow-soft);
    }

    @media (max-width: 600px) {
        .reservations-grid {
            grid-template-columns: 1fr;
        }

        .filter-grid {
            grid-template-columns: 1fr;
        }

        .hero-title {
            font-size: 1.5rem;
        }
    }
</style>
@endsection

@section('content')
<div class="reservations-hero">
    <div class="hero-content">
        <h1 class="hero-title"><i class="fas fa-calendar-check"></i> Minhas Reservas</h1>
        <p class="hero-subtitle">Gerencie todas as suas reservas em um só lugar</p>
    </div>
</div>

<div class="reservations-container">
    @if($reservas->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">🏨</div>
            <h2 class="empty-title">Nenhuma reserva encontrada</h2>
            <p class="empty-text">Explore nossos hotéis e faça sua próxima reserva!</p>
            <a href="{{ route('hoteis.alternative') }}" class="btn-explore">
                <i class="fas fa-search"></i> Explorar Hotéis
            </a>
        </div>
    @else
        <div class="filters-card">
            <form method="GET" action="{{ route('reservas.minhas') }}">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label><i class="fas fa-filter"></i> Status da Reserva</label>
                        <select name="status" class="filter-select">
                            <option value="">Todas as reservas</option>
                            <option value="pendente" {{ request('status') == 'pendente' ? 'selected' : '' }}>⏳ Pendentes</option>
                            <option value="confirmada" {{ request('status') == 'confirmada' ? 'selected' : '' }}>✅ Confirmadas</option>
                            <option value="cancelada" {{ request('status') == 'cancelada' ? 'selected' : '' }}>❌ Canceladas</option>
                            <option value="concluida" {{ request('status') == 'concluida' ? 'selected' : '' }}>✔️ Concluídas</option>
                        </select>
                    </div>
                    <div class="filter-buttons">
                        <button type="submit" class="btn-filter primary"><i class="fas fa-search"></i> Filtrar</button>
                        <a href="{{ route('reservas.minhas') }}" class="btn-filter secondary"><i class="fas fa-redo"></i> Limpar</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="reservations-grid">
            @foreach($reservas as $reserva)
                <div class="reservation-card">
                    <div class="reservation-header status-{{ $reserva->status }}">
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
                        <span class="code-badge">{{ $reserva->codigo_confirmacao }}</span>
                    </div>

                    <div class="reservation-body">
                        <h3 class="hotel-name">{{ $reserva->hotel->nome ?? 'Hotel' }}</h3>
                        <div class="hotel-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $reserva->hotel->localizacao ?? 'Localização não disponível' }}</span>
                        </div>

                        <div class="reservation-details">
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-calendar-check"></i> Check-in</span>
                                <span class="detail-value">{{ $reserva->data_entrada->format('d/m/Y') }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-calendar-times"></i> Check-out</span>
                                <span class="detail-value">{{ $reserva->data_saida->format('d/m/Y') }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-bed"></i> Quarto</span>
                                <span class="detail-value">{{ ucfirst($reserva->tipo_quarto) }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-users"></i> Hóspedes</span>
                                <span class="detail-value">{{ $reserva->hospedes }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label"><i class="fas fa-moon"></i> Noites</span>
                                <span class="detail-value">{{ $reserva->calcularDias() }}</span>
                            </div>
                        </div>

                        <div class="total-value">
                            <div class="total-label">Valor Total</div>
                            <div class="total-amount">R$ {{ number_format($reserva->valor_total, 2, ',', '.') }}</div>
                        </div>

                        @if($reserva->observacoes)
                            <div class="observacoes-box">
                                <strong><i class="fas fa-info-circle"></i> Observações:</strong><br>
                                {{ $reserva->observacoes }}
                            </div>
                        @endif

                        <div class="reservation-actions">
                            @if($reserva->status == 'pendente')
                                <a href="{{ route('reservas.confirmar', $reserva->codigo_confirmacao) }}" class="action-btn btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </a>
                            @endif

                            @if($reserva->status == 'pendente' || $reserva->status == 'confirmada')
                                @php
                                    $diasAteCheckIn = now()->diffInDays($reserva->data_entrada, false);
                                @endphp
                                @if($diasAteCheckIn > 2)
                                    <form method="POST" action="{{ route('reservas.cancelar', $reserva->id) }}" style="flex: 1;" onsubmit="return confirm('⚠️ Tem certeza que deseja cancelar esta reserva?');">
                                        @csrf
                                        <button type="submit" class="action-btn btn-cancelar"><i class="fas fa-times"></i> Cancelar</button>
                                    </form>
                                @else
                                    <button class="action-btn btn-disabled" title="Cancelamento disponível apenas 48h antes do check-in">
                                        <i class="fas fa-ban"></i> Indisponível
                                    </button>
                                @endif
                            @endif

                            <a href="{{ route('hoteis.show', $reserva->hotel->id ?? 1) }}" class="action-btn btn-ver-hotel">
                                <i class="fas fa-hotel"></i> Ver Hotel
                            </a>
                        </div>

                        @if($reserva->confirmada_em)
                            <div class="timestamp">
                                <i class="fas fa-clock"></i> Confirmada em {{ $reserva->confirmada_em->format('d/m/Y H:i') }}
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $reservas->links() }}
        </div>
    @endif

    <div class="new-reservation-section">
        <a href="{{ route('hoteis.alternative') }}" class="btn-new-reservation">
            <i class="fas fa-plus-circle"></i> Fazer Nova Reserva
        </a>
    </div>
</div>
@endsection
