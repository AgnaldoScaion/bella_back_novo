@extends('layouts.app')

@section('title', 'Reserva Confirmada')

@section('styles')
<style>
    .confirmada-container {
        max-width: 700px;
        margin: 3rem auto;
        padding: 2rem;
    }
    .confirmada-card {
        background: white;
        border-radius: 12px;
        padding: 3rem 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border: 3px solid #4CAF50;
        text-align: center;
    }
    .confirmada-icon {
        font-size: 5rem;
        color: #4CAF50;
        margin-bottom: 1rem;
        animation: checkmark 0.8s ease;
    }
    @keyframes checkmark {
        0% { transform: scale(0); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }
    .confirmada-titulo {
        font-family: 'Garamond', serif;
        color: #4CAF50;
        font-size: 2rem;
        margin-bottom: 1rem;
    }
    .confirmada-mensagem {
        color: #666;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }
</style>
@endsection

@section('content')
<div class="confirmada-container">
    <div class="confirmada-card">
        <div class="confirmada-icon">✅</div>
        <h1 class="confirmada-titulo">Reserva Confirmada!</h1>
        <p class="confirmada-mensagem">
            Sua reserva foi confirmada com sucesso! Estamos ansiosos para recebê-lo.
        </p>

        <div class="detalhes-reserva">
            <h3 style="margin-top: 0; color: #4CAF50;">📋 Resumo da Reserva</h3>

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
                <span class="detalhe-label">Status:</span>
                <span class="detalhe-valor" style="color: #4CAF50; font-weight: bold;">CONFIRMADA</span>
            </div>
        </div>

        <div class="acoes-botoes">
            <a href="{{ route('reservas.minhas') }}" class="btn btn-primary">
                <i class="fas fa-list"></i> Ver Minhas Reservas
            </a>
            <a href="{{ route('home') }}" class="btn btn-secondary">
                <i class="fas fa-home"></i> Voltar ao Início
            </a>
        </div>
    </div>
</div>
@endsection
