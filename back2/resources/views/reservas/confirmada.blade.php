@extends('layouts.app')

@section('title', 'Reserva Confirmada')

@section('styles')
<style>
    .confirmada-wrapper {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }

    .confirmada-container {
        max-width: 800px;
        width: 100%;
    }

    .confirmada-card {
        background: white;
        border-radius: 24px;
        padding: 3rem 2rem;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        position: relative;
        overflow: hidden;
    }

    .confirmada-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #10b981, #059669);
    }

    .celebration-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0.03;
        pointer-events: none;
        background-image:
            radial-gradient(circle at 20% 30%, #10b981 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, #059669 0%, transparent 50%);
    }

    .confirmada-content {
        position: relative;
        z-index: 1;
    }

    .success-icon-wrapper {
        text-align: center;
        margin-bottom: 2rem;
    }

    .confirmada-icon {
        font-size: 6rem;
        animation: celebrate 1s ease-out;
        display: inline-block;
    }

    @keyframes celebrate {
        0% {
            transform: scale(0) rotate(-180deg);
            opacity: 0;
        }
        50% {
            transform: scale(1.2) rotate(10deg);
        }
        100% {
            transform: scale(1) rotate(0deg);
            opacity: 1;
        }
    }

    .confirmada-titulo {
        font-family: 'Garamond', serif;
        color: #10b981;
        font-size: 2.5rem;
        text-align: center;
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .confirmada-mensagem {
        text-align: center;
        color: #4a5568;
        font-size: 1.1rem;
        margin-bottom: 2.5rem;
        line-height: 1.6;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        color: #065f46;
        padding: 1rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        margin: 0 auto 2.5rem;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .status-badge i {
        font-size: 1.3rem;
    }

    .detalhes-reserva {
        background: #f9fafb;
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .detalhes-titulo {
        color: #1f2937;
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .detalhe-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .detalhe-row:last-child {
        border-bottom: none;
    }

    .detalhe-label {
        color: #6b7280;
        font-weight: 500;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detalhe-label i {
        color: #10b981;
        width: 20px;
    }

    .detalhe-valor {
        color: #1f2937;
        font-weight: 600;
        font-size: 1rem;
        text-align: right;
    }

    .valor-destaque {
        color: #10b981;
        font-size: 1.8rem;
        font-weight: 700;
    }

    .info-box {
        background: linear-gradient(135deg, #e0f2fe, #bae6fd);
        border-left: 4px solid #0ea5e9;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .info-box i {
        color: #0369a1;
        font-size: 1.5rem;
        margin-right: 1rem;
    }

    .info-box-content {
        display: inline-block;
        color: #075985;
        line-height: 1.6;
    }

    .info-box-title {
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .acoes-botoes {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 2rem;
    }

    .btn-action {
        flex: 1;
        min-width: 200px;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        color: white;
    }

    .btn-secondary {
        background: white;
        color: #10b981;
        border: 2px solid #10b981;
    }

    .btn-secondary:hover {
        background: #f0fdf4;
        transform: translateY(-2px);
        color: #059669;
        border-color: #059669;
    }

    @media (max-width: 768px) {
        .confirmada-titulo {
            font-size: 2rem;
        }

        .confirmada-card {
            padding: 2rem 1.5rem;
        }

        .btn-action {
            min-width: 100%;
        }

        .detalhe-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .detalhe-valor {
            text-align: left;
        }
    }

    /* Animação de pulso para o badge */
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.8;
        }
    }

    .status-badge {
        animation: pulse 2s infinite;
    }
</style>
@endsection

@section('content')
<div class="confirmada-wrapper">
    <div class="confirmada-container">
        <div class="confirmada-card">
            <div class="celebration-bg"></div>

            <div class="confirmada-content">
                <!-- Ícone de Sucesso -->
                <div class="success-icon-wrapper">
                    <div class="confirmada-icon">✅</div>
                </div>

                <!-- Título e Mensagem -->
                <h1 class="confirmada-titulo">Reserva Confirmada!</h1>
                <p class="confirmada-mensagem">
                    Parabéns! Sua reserva foi confirmada com sucesso. <br>
                    Estamos ansiosos para recebê-lo e proporcionar uma experiência inesquecível.
                </p>

                <!-- Badge de Status -->
                <div style="text-align: center;">
                    <div class="status-badge">
                        <i class="fas fa-check-circle"></i>
                        CONFIRMADA
                    </div>
                </div>

                <!-- Informação Importante -->
                <div class="info-box">
                    <i class="fas fa-info-circle"></i>
                    <div class="info-box-content">
                        <div class="info-box-title">📧 Confirmação enviada por email</div>
                        <div>Você receberá todos os detalhes da sua reserva no email cadastrado.</div>
                    </div>
                </div>

                <!-- Detalhes da Reserva -->
                <div class="detalhes-reserva">
                    <h3 class="detalhes-titulo">
                        <i class="fas fa-clipboard-list"></i>
                        Resumo da Reserva
                    </h3>

                    <div class="detalhe-row">
                        <span class="detalhe-label">
                            <i class="fas fa-hotel"></i>
                            Hotel
                        </span>
                        <span class="detalhe-valor">{{ $reserva->hotel->nome ?? 'Hotel' }}</span>
                    </div>

                    <div class="detalhe-row">
                        <span class="detalhe-label">
                            <i class="fas fa-calendar-check"></i>
                            Check-in
                        </span>
                        <span class="detalhe-valor">{{ $reserva->data_entrada->format('d/m/Y') }}</span>
                    </div>

                    <div class="detalhe-row">
                        <span class="detalhe-label">
                            <i class="fas fa-calendar-times"></i>
                            Check-out
                        </span>
                        <span class="detalhe-valor">{{ $reserva->data_saida->format('d/m/Y') }}</span>
                    </div>

                    <div class="detalhe-row">
                        <span class="detalhe-label">
                            <i class="fas fa-bed"></i>
                            Tipo de Quarto
                        </span>
                        <span class="detalhe-valor">{{ ucfirst($reserva->tipo_quarto) }}</span>
                    </div>

                    <div class="detalhe-row">
                        <span class="detalhe-label">
                            <i class="fas fa-users"></i>
                            Hóspedes
                        </span>
                        <span class="detalhe-valor">{{ $reserva->hospedes }} {{ $reserva->hospedes == 1 ? 'pessoa' : 'pessoas' }}</span>
                    </div>

                    <div class="detalhe-row">
                        <span class="detalhe-label">
                            <i class="fas fa-money-bill-wave"></i>
                            Valor Total
                        </span>
                        <span class="detalhe-valor valor-destaque">R$ {{ number_format($reserva->valor_total, 2, ',', '.') }}</span>
                    </div>

                    <div class="detalhe-row">
                        <span class="detalhe-label">
                            <i class="fas fa-barcode"></i>
                            Código de Confirmação
                        </span>
                        <span class="detalhe-valor" style="font-family: monospace; color: #10b981;">{{ $reserva->codigo_confirmacao }}</span>
                    </div>
                </div>

                <!-- Botões de Ação -->
                <div class="acoes-botoes">
                    <a href="{{ route('reservas.minhas') }}" class="btn-action btn-primary">
                        <i class="fas fa-list"></i>
                        Ver Minhas Reservas
                    </a>
                    <a href="{{ route('home') }}" class="btn-action btn-secondary">
                        <i class="fas fa-home"></i>
                        Voltar ao Início
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
