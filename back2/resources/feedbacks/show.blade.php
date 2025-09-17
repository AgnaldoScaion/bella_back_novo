@extends('layouts.app')

@section('title', 'Feedback #' . $feedback->id . ' - Bella Avventura')

@section('styles')
<style>
    .feedback-detail-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        margin-bottom: 2rem;
        color: #5a8f3d;
        text-decoration: none;
        font-weight: 500;
    }

    .feedback-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .feedback-header {
        background: #5a8f3d;
        color: white;
        padding: 2rem;
    }

    .feedback-rating {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .feedback-meta {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        padding: 2rem;
        background: #f8f9fa;
    }

    .meta-item {
        display: flex;
        flex-direction: column;
    }

    .meta-label {
        font-size: 0.8rem;
        color: #666;
        margin-bottom: 0.25rem;
    }

    .meta-value {
        font-weight: 500;
    }

    .feedback-body {
        padding: 2rem;
    }

    .feedback-message {
        line-height: 1.6;
        color: #333;
    }

    .actions {
        padding: 1.5rem 2rem;
        background: #f8f9fa;
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-back {
        background: #6c757d;
        color: white;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }
</style>
@endsection

@section('content')
<div class="feedback-detail-container">
    <a href="{{ route('feedbacks.index') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Voltar para a lista
    </a>

    <div class="feedback-card">
        <div class="feedback-header">
            <div class="feedback-rating">
                {!! $feedback->estrelas !!}
            </div>
            <h1>Feedback #{{ $feedback->id }}</h1>
        </div>

        <div class="feedback-meta">
            <div class="meta-item">
                <span class="meta-label">Ponto Turístico</span>
                <span class="meta-value">{{ $feedback->pontoTuristico->nome }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Usuário</span>
                <span class="meta-value">{{ $feedback->nome }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Email</span>
                <span class="meta-value">{{ $feedback->email }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Data</span>
                <span class="meta-value">{{ $feedback->created_at->format('d/m/Y H:i') }}</span>
            </div>
        </div>

        <div class="feedback-body">
            <h3>Mensagem</h3>
            <div class="feedback-message">
                {{ $feedback->mensagem }}
            </div>
        </div>

        <div class="actions">
            <a href="{{ route('feedbacks.index') }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
            <form action="{{ route('feedbacks.destroy', $feedback) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete"
                        onclick="return confirm('Tem certeza que deseja excluir este feedback?')">
                    <i class="fas fa-trash"></i> Excluir
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
