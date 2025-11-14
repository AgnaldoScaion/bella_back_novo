@extends('layouts.app')
@section('title', 'Confirmar Reserva')
@section('content')
<div class="confirmation-wrapper">
    <div class="confirmation-container">
        <div class="confirmation-card">
            <div class="confirmation-header">
                <div class="confirmation-icon">🔒</div>
                <h1 class="confirmation-title">Confirme sua Reserva</h1>
                <p class="confirmation-message">
                    Insira o código de confirmação que você recebeu por e-mail para validar sua reserva.
                </p>
            </div>
            @if(session('error'))
                <div class="alert alert-danger" style="margin-bottom: 1rem;">{{ session('error') }}</div>
            @endif
            <form method="POST" action="{{ route('reservas.confirmar-codigo') }}">
                @csrf
                <div class="form-group">
                    <label for="codigo_confirmacao">Código de Confirmação</label>
                    <input type="text" id="codigo_confirmacao" name="codigo_confirmacao" class="form-control" required autofocus placeholder="Digite o código recebido">
                </div>
                <button type="submit" class="submit-button">Confirmar Reserva</button>
            </form>
        </div>
    </div>
</div>
@endsection
