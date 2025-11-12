@extends('layouts.app')
@section('title', 'Redefinir Senha')
@section('content')
<div class="wrapper">
    <div class="main-content">
        <div class="forgot-password-container">
            <h1 class="forgot-password-title">Redefinir Senha</h1>
            @if(session('status'))
                <div class="notification success show">
                    {{ session('status') }}
                </div>
            @endif
            @if($errors->any())
                <div class="notification error show">
                    {{ $errors->first() }}
                </div>
            @endif
            <div class="forgot-password-box">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $email ?? '') }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password">Nova Senha</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">Confirme a Nova Senha</label>
                        <input type="password" id="password-confirm" name="password_confirmation" required>
                    </div>
                    <button type="submit" class="submit-button">Redefinir Senha</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
