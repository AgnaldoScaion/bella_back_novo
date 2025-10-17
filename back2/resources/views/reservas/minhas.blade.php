@extends('layouts.app')

@section('title', 'Minhas Reservas')

@section('styles')
<style>
    :root {
        --primary-color: #2d5016;
        --primary-light: #5a8f3d;
        --accent-color: #a7d096;
        --primary-bg: #0a0e0a;
        --secondary-bg: #141914;
        --card-bg: rgba(20, 25, 20, 0.8);
        --border-color: rgba(167, 208, 150, 0.1);
        --text-dark: #ffffff;
        --text-medium: #b4c9b4;
        --text-light: #ffffff;
        --glow-primary: rgba(167, 208, 150, 0.4);
        --glow-strong: rgba(167, 208, 150, 0.6);
        --shadow-glow: 0 0 20px var(--glow-primary);
        --shadow-strong-glow: 0 0 40px var(--glow-strong);
        --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        --border-radius: 20px;
        --border-radius-small: 12px;
    }

    body {
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background:
            radial-gradient(circle at 20% 30%, rgba(167, 208, 150, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(90, 143, 61, 0.05) 0%, transparent 50%);
        pointer-events: none;
        z-index: 0;
    }

    .reservations-hero {
        background: linear-gradient(135deg, rgba(45, 80, 22, 0.9) 0%, rgba(90, 143, 61, 0.8) 100%);
        padding: 3rem 1rem;
        position: relative;
        overflow: hidden;
        border-bottom: 2px solid var(--accent-color);
        box-shadow: 0 10px 40px rgba(167, 208, 150, 0.2);
    }

    .reservations-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: repeating-linear-gradient(
            45deg,
            transparent,
            transparent 10px,
            rgba(167, 208, 150, 0.03) 10px,
            rgba(167, 208, 150, 0.03) 20px
        );
        animation: heroPattern 20s linear infinite;
    }

    @keyframes heroPattern {
        0% { transform: translate(0, 0); }
        100% { transform: translate(50px, 50px); }
    }

    .hero-content {
        max-width: 960px;
        margin: 0 auto;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .hero-title {
        font-family: 'GaramondBold', serif;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: var(--text-light);
        text-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
        animation: fadeInDown 0.8s ease-out;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.9);
        text-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
        animation: fadeInUp 0.8s ease-out 0.2s backwards;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .reservations-container {
        max-width: 960px;
        margin: 0 auto;
        padding: 2rem 1rem;
        position: relative;
        z-index: 1;
    }

    .filters-card {
        background: var(--card-bg);
        backdrop-filter: blur(20px);
        border-radius: var(--border-radius);
        padding: 1.5rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4), 0 0 0 1px var(--border-color);
        margin-bottom: 2rem;
        border: 1px solid var(--border-color);
        position: relative;
        overflow: hidden;
        animation: slideInUp 0.6s ease-out;
    }

    .filters-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(167, 208, 150, 0.1), transparent);
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        align-items: end;
    }

    .filter-group label {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--accent-color);
        margin-bottom: 0.5rem;
        display: block;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-select {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-small);
        font-size: 0.875rem;
        background: rgba(20, 25, 20, 0.6);
        color: var(--text-dark);
        transition: var(--transition-smooth);
        cursor: pointer;
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--accent-color);
        box-shadow: 0 0 0 3px rgba(167, 208, 150, 0.2), var(--shadow-glow);
        background: rgba(20, 25, 20, 0.9);
    }

    .filter-buttons {
        display: flex;
        gap: 0.75rem;
    }

    .btn-filter {
        padding: 0.875rem 1.5rem;
        border-radius: var(--border-radius-small);
        font-size: 0.875rem;
        font-weight: 600;
        transition: var(--transition-smooth);
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .btn-filter::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-filter:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-filter.primary {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-color) 100%);
        color: var(--text-light);
        box-shadow: 0 4px 15px rgba(90, 143, 61, 0.4);
    }

    .btn-filter.primary:hover {
        box-shadow: 0 6px 25px rgba(90, 143, 61, 0.6);
        transform: translateY(-2px);
    }

    .btn-filter.secondary {
        background: transparent;
        color: var(--accent-color);
        border: 2px solid var(--accent-color);
    }

    .btn-filter.secondary:hover {
        background: rgba(167, 208, 150, 0.1);
        transform: translateY(-2px);
        box-shadow: var(--shadow-glow);
    }

    .reservations-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 1.5rem;
        animation: fadeIn 0.8s ease-out 0.4s backwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .reservation-card {
        background: var(--card-bg);
        backdrop-filter: blur(20px);
        border-radius: var(--border-radius);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4), 0 0 0 1px var(--border-color);
        overflow: hidden;
        transition: var(--transition-smooth);
        position: relative;
        border: 1px solid var(--border-color);
    }

    .reservation-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--accent-color), var(--primary-light));
        opacity: 0;
        transition: opacity 0.3s;
    }

    .reservation-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6), var(--shadow-strong-glow);
    }

    .reservation-card:hover::before {
        opacity: 1;
    }

    .reservation-header {
        padding: 1.25rem;
        color: var(--text-light);
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .reservation-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, transparent 0%, rgba(255, 255, 255, 0.05) 100%);
    }

    .status-confirmada {
        background: linear-gradient(135deg, var(--primary-light) 0%, #4a7530 100%);
        box-shadow: 0 4px 15px rgba(90, 143, 61, 0.3);
    }

    .status-pendente {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }

    .status-cancelada {
        background: linear-gradient(135deg, #f44336 0%, #c62828 100%);
        box-shadow: 0 4px 15px rgba(244, 67, 54, 0.3);
    }

    .status-concluida {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
    }

    .status-icon {
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
        z-index: 1;
    }

    .code-badge {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        padding: 0.5rem 0.75rem;
        border-radius: var(--border-radius-small);
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        position: relative;
        z-index: 1;
    }

    .reservation-body {
        padding: 1.5rem;
    }

    .hotel-name {
        font-family: 'GaramondBold', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, #ffffff 0%, var(--accent-color) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hotel-location {
        color: var(--text-medium);
        font-size: 0.875rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .hotel-location i {
        color: var(--accent-color);
    }

    .reservation-details {
        display: grid;
        gap: 0.75rem;
        margin-bottom: 1.25rem;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 0.875rem;
        background: rgba(167, 208, 150, 0.05);
        border-radius: var(--border-radius-small);
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
    }

    .detail-row:hover {
        background: rgba(167, 208, 150, 0.1);
        border-color: rgba(167, 208, 150, 0.3);
        transform: translateX(5px);
    }

    .detail-label {
        color: var(--text-medium);
        font-size: 0.875rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detail-label i {
        color: var(--accent-color);
    }

    .detail-value {
        color: var(--text-dark);
        font-weight: 700;
        font-size: 0.875rem;
    }

    .total-value {
        background: linear-gradient(135deg, rgba(167, 208, 150, 0.15) 0%, rgba(90, 143, 61, 0.15) 100%);
        padding: 1.25rem;
        border-radius: var(--border-radius-small);
        text-align: center;
        margin-bottom: 1.25rem;
        border: 1px solid var(--border-color);
        position: relative;
        overflow: hidden;
    }

    .total-value::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(167, 208, 150, 0.2), transparent);
        animation: shimmer 2s infinite;
    }

    .total-label {
        font-size: 0.875rem;
        color: var(--accent-color);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }

    .total-amount {
        font-family: 'GaramondBold', serif;
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--accent-color) 0%, #ffffff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .observacoes-box {
        background: rgba(167, 208, 150, 0.1);
        border-left: 4px solid var(--accent-color);
        padding: 1rem;
        border-radius: var(--border-radius-small);
        font-size: 0.875rem;
        margin-bottom: 1.25rem;
        color: var(--text-medium);
        border: 1px solid var(--border-color);
        border-left: 4px solid var(--accent-color);
    }

    .observacoes-box strong {
        color: var(--accent-color);
    }

    .reservation-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .action-btn {
        flex: 1;
        padding: 0.875rem;
        border-radius: var(--border-radius-small);
        font-size: 0.875rem;
        font-weight: 600;
        text-align: center;
        transition: var(--transition-smooth);
        cursor: pointer;
        border: none;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        position: relative;
        overflow: hidden;
    }

    .action-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .action-btn:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-confirmar {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-color) 100%);
        color: var(--text-light);
        box-shadow: 0 4px 15px rgba(90, 143, 61, 0.4);
    }

    .btn-confirmar:hover {
        box-shadow: 0 6px 25px rgba(90, 143, 61, 0.6);
        transform: translateY(-3px);
    }

    .btn-cancelar {
        background: linear-gradient(135deg, #f44336 0%, #c62828 100%);
        color: var(--text-light);
        box-shadow: 0 4px 15px rgba(244, 67, 54, 0.4);
    }

    .btn-cancelar:hover {
        box-shadow: 0 6px 25px rgba(244, 67, 54, 0.6);
        transform: translateY(-3px);
    }

    .btn-ver-hotel {
        background: transparent;
        color: var(--accent-color);
        border: 2px solid var(--accent-color);
    }

    .btn-ver-hotel:hover {
        background: rgba(167, 208, 150, 0.15);
        box-shadow: var(--shadow-glow);
        transform: translateY(-3px);
    }

    .btn-disabled {
        background: rgba(100, 100, 100, 0.3);
        color: rgba(255, 255, 255, 0.3);
        cursor: not-allowed;
        border: 1px solid rgba(100, 100, 100, 0.3);
    }

    .btn-disabled:hover {
        transform: none;
    }

    .timestamp {
        font-size: 0.75rem;
        color: var(--text-medium);
        text-align: center;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
    }

    .timestamp i {
        color: var(--accent-color);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--card-bg);
        backdrop-filter: blur(20px);
        border-radius: var(--border-radius);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4), 0 0 0 1px var(--border-color);
        border: 1px solid var(--border-color);
        animation: fadeInUp 0.8s ease-out;
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    .empty-title {
        font-family: 'GaramondBold', serif;
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #ffffff 0%, var(--accent-color) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .empty-text {
        color: var(--text-medium);
        margin-bottom: 2rem;
        font-size: 1.1rem;
    }

    .btn-explore {
        padding: 1rem 2rem;
        border-radius: var(--border-radius-small);
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-color) 100%);
        color: var(--text-light);
        text-decoration: none;
        font-size: 1rem;
        font-weight: 600;
        transition: var(--transition-smooth);
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        box-shadow: 0 4px 15px rgba(90, 143, 61, 0.4);
        position: relative;
        overflow: hidden;
    }

    .btn-explore::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-explore:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-explore:hover {
        box-shadow: 0 6px 25px rgba(90, 143, 61, 0.6);
        transform: translateY(-3px);
    }

    .new-reservation-section {
        text-align: center;
        margin-top: 3rem;
        animation: fadeInUp 0.8s ease-out 0.6s backwards;
    }

    .btn-new-reservation {
        padding: 1.25rem 2.5rem;
        border-radius: var(--border-radius-small);
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-color) 100%);
        color: var(--text-light);
        text-decoration: none;
        font-size: 1.1rem;
        font-weight: 700;
        transition: var(--transition-smooth);
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        box-shadow: 0 4px 15px rgba(90, 143, 61, 0.4);
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-new-reservation::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-new-reservation:hover::before {
        width: 400px;
        height: 400px;
    }

    .btn-new-reservation:hover {
        box-shadow: 0 8px 35px rgba(90, 143, 61, 0.8);
        transform: translateY(-5px) scale(1.05);
    }

    .d-flex {
        display: flex;
    }

    .justify-content-center {
        justify-content: center;
    }

    .mt-4 {
        margin-top: 2rem;
    }

    @media (max-width: 768px) {
        .reservations-grid {
            grid-template-columns: 1fr;
        }

        .filter-grid {
            grid-template-columns: 1fr;
        }

        .hero-title {
            font-size: 2rem;
        }

        .reservation-actions {
            flex-direction: column;
        }

        .action-btn {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .hero-title {
            font-size: 1.75rem;
        }

        .hotel-name {
            font-size: 1.25rem;
        }

        .total-amount {
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
