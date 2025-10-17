@extends('layouts.app')

@section('title', 'Reserva Confirmada')

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

    .confirmation-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        background: var(--primary-bg);
        font-family: 'Inter', sans-serif;
    }

    .confirmation-container {
        max-width: 720px;
        width: 100%;
        margin: 0 auto;
    }

    .confirmation-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: var(--border-radius);
        padding: 2rem;
        box-shadow: var(--shadow-medium);
        border: 1px solid var(--border-color);
        position: relative;
        overflow: hidden;
        animation: slideIn 0.5s ease-out;
    }

    @keyframes slideIn {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .confirmation-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .confirmation-icon {
        font-size: 4rem;
        color: var(--primary-color);
        animation: pulse 2s infinite ease-in-out;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    .confirmation-title {
        font-family: 'GaramondBold', serif;
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .confirmation-message {
        color: var(--text-medium);
        font-size: 1rem;
        line-height: 1.5;
        text-align: center;
        margin: 1rem 0 2rem;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--primary-light);
        color: var(--text-light);
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius-small);
        font-size: 0.875rem;
        font-weight: 600;
        margin: 0 auto 2rem;
        text-transform: uppercase;
        box-shadow: var(--shadow-soft);
        transition: var(--transition-smooth);
    }

    .status-badge:hover {
        transform: translateY(-2px);
        background: var(--primary-color);
    }

    .details-section {
        background: rgba(255, 255, 255, 0.5);
        border-radius: var(--border-radius-small);
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid var(--border-color);
    }

    .details-title {
        font-family: 'GaramondBold', serif;
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border-color);
    }

    .detail-row:last-child {
        border-bottom: none;
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

    .highlight-value {
        color: var(--primary-color);
        font-size: 1.25rem;
        font-weight: 700;
    }

    .info-box {
        background: rgba(167, 208, 150, 0.2);
        border-left: 4px solid var(--primary-color);
        padding: 1rem;
        border-radius: var(--border-radius-small);
        margin-bottom: 2rem;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }

    .info-box-content {
        color: var(--text-medium);
        font-size: 0.875rem;
        line-height: 1.5;
    }

    .info-box-title {
        font-family: 'GaramondBold', serif;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.25rem;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius-small);
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: var(--transition-smooth);
        cursor: pointer;
    }

    .btn-primary {
        background: var(--primary-color);
        color: var(--text-light);
        border: none;
    }

    .btn-primary:hover {
        background: var(--primary-light);
        transform: translateY(-2px);
        box-shadow: var(--shadow-soft);
    }

    .btn-secondary {
        background: transparent;
        color: var(--primary-color);
        border: 1px solid var(--primary-color);
    }

    .btn-secondary:hover {
        background: rgba(167, 208, 150, 0.1);
        color: var(--primary-light);
        transform: translateY(-2px);
    }

    @media (max-width: 600px) {
        .confirmation-card {
            padding: 1.5rem;
        }

        .confirmation-title {
            font-size: 1.5rem;
        }

        .detail-row {
            flex-direction: column;
            gap: 0.25rem;
        }

        .detail-value {
            text-align: left;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<div class="confirmation-wrapper">
    <div class="confirmation-container">
        <div class="confirmation-card">
            <div class="confirmation-header">
                <div class="confirmation-icon">✅</div>
                <h1 class="confirmation-title">Reserva Confirmada</h1>
                <p class="confirmation-message">
                    Sua reserva foi confirmada com sucesso. Prepare-se para uma experiência inesquecível!
                </p>
                <div class="status-badge">
                    <i class="fas fa-check-circle"></i> Confirmada
                </div>
            </div>

            <div class="info-box">
                <i class="fas fa-info-circle"></i>
                <div class="info-box-content">
                    <div class="info-box-title">Confirmação Enviada</div>
                    <div>Os detalhes da sua reserva foram enviados para o email cadastrado.</div>
                </div>
            </div>

            <div class="details-section">
                <h3 class="details-title">
                    <i class="fas fa-clipboard-list"></i> Resumo da Reserva
                </h3>
                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-hotel"></i> Hotel</span>
                    <span class="detail-value">{{ $reserva->hotel->nome ?? 'Hotel' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-calendar-check"></i> Check-in</span>
                    <span class="detail-value">{{ $reserva->data_entrada->format('d/m/Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-calendar-times"></i> Check-out</span>
                    <span class="detail-value">{{ $reserva->data_saida->format('d/m/Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-bed"></i> Tipo de Quarto</span>
                    <span class="detail-value">{{ ucfirst($reserva->tipo_quarto) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-users"></i> Hóspedes</span>
                    <span class="detail-value">{{ $reserva->hospedes }} {{ $reserva->hospedes == 1 ? 'pessoa' : 'pessoas' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-money-bill-wave"></i> Valor Total</span>
                    <span class="detail-value highlight-value">R$ {{ number_format($reserva->valor_total, 2, ',', '.') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-barcode"></i> Código</span>
                    <span class="detail-value" style="font-family: monospace; color: var(--primary-color);">{{ $reserva->codigo_confirmacao }}</span>
                </div>
            </div>

            <div class="action-buttons">
                <a href="{{ route('reservas.minhas') }}" class="btn btn-primary">
                    <i class="fas fa-list"></i> Minhas Reservas
                </a>
                <a href="{{ route('home') }}" class="btn btn-secondary">
                    <i class="fas fa-home"></i> Voltar ao Início
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
