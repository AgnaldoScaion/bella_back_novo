@extends('layouts.app')

@section('title', 'Reserva Realizada')

@section('styles')
<style>
    .sucesso-container {
        max-width: 700px;
        margin: 3rem auto;
        padding: 2rem;
    }
    .sucesso-card {
        background: white;
        border-radius: 12px;
        padding: 3rem 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border: 3px solid #D8E6D9;
        text-align: center;
    }
    .sucesso-icon {
        font-size: 5rem;
        color: #5a8f3d;
        margin-bottom: 1rem;
        animation: bounce 1s ease;
    }
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-20px); }
        60% { transform: translateY(-10px); }
    }
    .sucesso-titulo {
        font-family: 'Garamond', serif;
        color: #5a8f3d;
        font-size: 2rem;
        margin-bottom: 1rem;
    }
    .sucesso-mensagem {
        color: #666;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }
    .codigo-confirmacao {
        background-color: #fff3cd;
        border: 2px dashed #856404;
        padding: 1.5rem;
        border-radius: 8px;
        margin: 2rem 0;
    }
    .codigo-titulo {
        font-size: 0.9rem;
        color: #856404;
        margin-bottom: 0.5rem;
    }
    .codigo-valor {
        font-size: 1.8rem;
        font-weight: bold;
        letter-spacing: 5px;
        color: #856404;
    }
    .detalhes-reserva {
        background-color: #f9f9f9;
        border-left: 4px solid #5a8f3d;
        padding: 1.5rem;
        text-align: left;
        margin: 2rem 0;
        border-radius: 4px;
    }
    .detalhe-row {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px solid #eee;
    }
    .detalhe-row:last-child {
        border-bottom: none;
    }
    .detalhe-label {
        font-weight: bold;
        color: #666;
    }
    .detalhe-valor {
        color: #333;
    }
    .acoes-botoes {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-top: 2rem;
        flex-wrap: wrap;
    }
    .btn {
        padding: 0.8rem 2rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
        transition: all 0.3s ease;
        display: inline-block;
    }
    .btn-primary {
        background-color: #5a8f3d;
        color: white;
    }
    .btn-primary:hover {
        background-color: #4a7d2d;
    }
    .btn-secondary {
        background-color: #f0f0f0;
        color: #333;
    }
    .btn-secondary:hover {
        background-color: #e0e0e0;
    }
    .info-importante {
        background-color: #e7f3ff;
        border-left: 4px solid #0066cc;
        padding: 1rem;
        margin-top: 2rem;
        text-align: left;
        border-radius: 4px;
        font-size: 0.9rem;
        color: #666;
    }
</style>
@endsection

@section('content')
<div class="sucesso-container">
    <div class="sucesso-card">
        <div class="sucesso-icon">🎉</div>
        <h1 class="sucesso-titulo">Reserva Realizada com Sucesso!</h1>
        <p class="sucesso-mensagem">
            Parabéns! Sua reserva foi registrada em nosso sistema.
            Enviamos um email com todas as informações e o link de confirmação.
        </p>

        <div class="codigo-confirmacao">
            <div class="codigo-titulo">Código de Confirmação</div>
            <div class="codigo-valor">{{ $reserva->codigo_confirmacao }}</div>
        </div>

        <div class="detalhes-reserva">
            <h3 style="margin-top: 0; color: #5a8f3d;">📋 Detalhes da Reserva</h3>

            <div class="detalhe-row">
                <span class="detalhe-label">Hotel:</span>
                <span class="detalhe-valor">{{ $reserva->hotel->nome ?? 'Hotel' }}</span>
            </div>

            <div class="detalhe-row">
                <span class="detalhe-label">Check-in:</span>
                <span class="detalhe-valor">{{ $reserva->data_entrada->format('d/m/Y') }}</span>
            </div>

            <div class="detalhe-row">
                <span class="detalhe-label">Check-out:</span>
                <span class="detalhe-valor">{{ $reserva->data_saida->format('d/m/Y') }}</span>
            </div>

            <div class="detalhe-row">
                <span class="detalhe-label">Tipo de Quarto:</span>
                <span class="detalhe-valor">{{ ucfirst($reserva->tipo_quarto) }}</span>
            </div>

            <div class="detalhe-row">
                <span class="detalhe-label">Hóspedes:</span>
                <span class="detalhe-valor">{{ $reserva->hospedes }}</span>
            </div>

            <div class="detalhe-row">
                <span class="detalhe-label">Valor Total:</span>
                <span class="detalhe-valor" style="font-size: 1.3rem; color: #5a8f3d; font-weight: bold;">
                    R$ {{ number_format($reserva->valor_total, 2, ',', '.') }}
                </span>
            </div>
        </div>

        <div class="info-importante">
            <strong>⚠️ Importante:</strong> Para garantir sua reserva, confirme através do link enviado para seu email
            ou usando o código acima. Você tem até 24 horas para confirmar!
        </div>

        <div class="acoes-botoes">
            <a href="{{ route('reservas.minhas') }}" class="btn btn-primary">
                <i class="fas fa-list"></i> Minhas Reservas
            </a>
            <a href="{{ route('hoteis.index') }}" class="btn btn-secondary">
                <i class="fas fa-hotel"></i> Ver Mais Hotéis
            </a>
        </div>
    </div>
</div>
@endsection
