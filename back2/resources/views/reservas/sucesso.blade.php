@extends('layouts.app')

@section('title', 'Reserva Concluída')

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

    .success-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        background: var(--primary-bg);
        font-family: 'Inter', sans-serif;
    }

    .success-container {
        max-width: 640px;
        width: 100%;
        margin: 0 auto;
    }

    .success-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: var(--border-radius);
        padding: 2rem;
        box-shadow: var(--shadow-medium);
        border: 1px solid var(--border-color);
        text-align: center;
        animation: slideIn 0.5s ease-out;
    }

    @keyframes slideIn {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .success-icon {
        font-size: 4rem;
        color: var(--primary-color);
        animation: pulse 2s infinite ease-in-out;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    .success-title {
        font-family: 'GaramondBold', serif;
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1rem;
        text-transform: uppercase;
    }

    .success-message {
        color: var(--text-medium);
        font-size: 1rem;
        line-height: 1.5;
        margin-bottom: 2rem;
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
        .success-card {
            padding: 1.5rem;
        }

        .success-title {
            font-size: 1.5rem;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<div class="success-wrapper">
    <div class="success-container">
        <div class="success-card">
            <div class="success-icon">✅</div>
            <h1 class="success-title">Reserva Concluída!</h1>
            <p class="success-message">
                Sua reserva foi realizada com sucesso. Você receberá um email com os detalhes.
            </p>
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
