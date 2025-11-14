@extends('layouts.app')

@section('title', 'Esqueceu a Senha')

@section('styles')
<style>
    @font-face {
        font-family: 'GaramondBold';
        src: local('Garamond'), serif;
        font-weight: bold;
    }

    /* Variáveis CSS */
    :root {
        --primary-color: #5a8f3d;
        --primary-green: #2d5016;
        --primary-light: #A7D096;
        --primary-bg: #f3f7f3;
        --border-color: #D8E6D9;
        --error-color: #F44336;
        --success-color: #4CAF50;
        --text-dark: #333;
        --text-light: #fff;
        --font-main: 'Inter', sans-serif;
        --font-heading: 'Garamond', serif;
        --shadow-default: 0 4px 15px rgba(0, 0, 0, 0.1);
        --transition-default: all 0.3s ease;
    }

    /* Reset e Estilos Globais */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html, body {
        height: 100%;
        font-family: var(--font-main);
        font-weight: 700;
        background: linear-gradient(135deg, #f3f7f3 0%, #e8f3e8 100%);
        color: var(--text-dark);
    }

    /* Estrutura Principal */
    .wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .main-content {
        flex: 1;
        padding: 2rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Container de Esqueceu a Senha */
    .forgot-password-container {
        width: 100%;
        max-width: 480px;
        margin: 0 auto;
        animation: fadeInUp 0.6s ease;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .forgot-password-title {
        font-family: var(--font-heading);
        color: var(--primary-color);
        font-size: 2.2rem;
        text-align: center;
        margin-bottom: 1.8rem;
        position: relative;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.05);
    }

    .forgot-password-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(to right, var(--primary-color), var(--primary-light));
        border-radius: 2px;
    }

    .forgot-password-box {
        background: linear-gradient(135deg, #ffffff 0%, #fafffe 100%);
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
        border: 3px solid var(--border-color);
        position: relative;
        overflow: hidden;
    }

    .forgot-password-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(to right, var(--primary-color), var(--primary-light), var(--primary-color));
        background-size: 200% 100%;
        animation: gradientShift 3s ease infinite;
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* Formulário */
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.6rem;
        color: var(--primary-color);
        font-weight: bold;
        font-size: 0.95rem;
        transition: var(--transition-default);
    }

    .form-group input {
        width: 100%;
        padding: 0.9rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        font-size: 0.95rem;
        transition: var(--transition-default);
        background-color: #fafffe;
        font-family: var(--font-main);
    }

    .form-group input:focus {
        border-color: var(--primary-color);
        outline: none;
        box-shadow: 0 0 0 4px rgba(90, 143, 61, 0.1);
        background-color: white;
        transform: translateY(-2px);
    }

    .form-group input::placeholder {
        color: #aaa;
        font-weight: 400;
    }

    .error {
        color: var(--error-color);
        font-size: 0.8rem;
        margin-top: 0.4rem;
        display: block;
        font-weight: 600;
        animation: shake 0.3s ease;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    /* BOTÃO COM TEXTO CENTRALIZADO PERFEITAMENTE */
    .submit-button {
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, var(--primary-color) 0%, #4a7d2d 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: bold;
        cursor: pointer;
        transition: var(--transition-default);
        margin-bottom: 1.2rem;
        font-size: 1.05rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(90, 143, 61, 0.3);
        position: relative;
        overflow: hidden;

        /* CENTRALIZAÇÃO PERFEITA */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .submit-button::before {
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
        z-index: 0;
    }

    .submit-button span {
        position: relative;
        z-index: 1;
    }

    .submit-button:hover::before {
        width: 300px;
        height: 300px;
    }

    .submit-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 25px rgba(90, 143, 61, 0.4);
    }

    .submit-button:active {
        transform: translateY(-1px);
    }

    .back-button {
        display: block;
        text-align: center;
        margin-top: 1.8rem;
        color: var(--primary-color);
        text-decoration: none;
        font-size: 0.95rem;
        transition: var(--transition-default);
        font-weight: 600;
        position: relative;
    }

    .back-button::after {
        content: '→';
        margin-left: 8px;
        transition: var(--transition-default);
    }

    .back-button:hover {
        color: var(--primary-green);
        transform: translateX(-5px);
    }

    .back-button:hover::after {
        margin-left: 4px;
    }

    /* Notificação */
    .notification {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        padding: 14px 28px;
        border-radius: 12px;
        color: var(--text-light);
        font-weight: bold;
        z-index: 1000;
        opacity: 0;
        transition: opacity 0.3s ease, top 0.3s ease;
        font-size: 0.95rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px);
    }

    .notification.show {
        top: 30px;
        opacity: 1;
        animation: slideInDown 0.4s ease;
    }

    @keyframes slideInDown {
        from {
            transform: translateX(-50%) translateY(-100px);
            opacity: 0;
        }
        to {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }
    }

    .notification.success {
        background: linear-gradient(135deg, var(--success-color) 0%, #45a049 100%);
    }

    .notification.error {
        background: linear-gradient(135deg, var(--error-color) 0%, #d32f2f 100%);
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .main-content { padding: 1.5rem 1rem; }
        .forgot-password-box { padding: 2rem; }
        .forgot-password-title { font-size: 1.9rem; }
    }

    @media (max-width: 600px) {
        .forgot-password-title { font-size: 1.7rem; }
        .forgot-password-box { padding: 1.8rem; border-radius: 16px; }
        .form-group input { padding: 0.8rem; }
        .submit-button { padding: 0.9rem; font-size: 1rem; }
    }

    @media (max-width: 480px) {
        .forgot-password-container { max-width: 100%; }
        .forgot-password-box { padding: 1.5rem; border-radius: 14px; }
        .form-group input { padding: 0.75rem; }
        .submit-button { padding: 0.85rem; }
        .forgot-password-title { font-size: 1.6rem; }
    }
</style>
@endsection

@section('content')
<div class="wrapper">
    <div class="main-content">
        <div class="forgot-password-container">
            <h1 class="forgot-password-title">Esqueceu a Senha?</h1>

            @if(session('status'))
                <div class="notification success show">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->has('email'))
                <div class="notification error show">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <div class="forgot-password-box">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="email@exemplo.com" required autofocus>
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- BOTÃO COM TEXTO CENTRALIZADO -->
                    <button type="submit" class="submit-button">
                        <span>Enviar Link de Redefinição</span>
                    </button>
                </form>

                <a href="{{ route('login') }}" class="back-button">Voltar ao Login</a>
            </div>
        </div>
    </div>
</div>
@endsection
