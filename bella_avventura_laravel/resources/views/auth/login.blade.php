@extends('layouts.app')

@section('title', 'Login')

@section('styles')
<style>
    /* Variáveis CSS */
    :root {
        --primary-color: #5a8f3d;
        --primary-light: #A7D096;
        --primary-bg: #f3f7f3;
        --accent-color: #A7D096;
        --border-color: #D8E6D9;
        --error-color: #F44336;
        --success-color: #4CAF50;
        --text-dark: #333;
        --text-medium: #4a4a4a;
        --text-light: #fff;
        --font-main: 'Inter', sans-serif;
        --font-heading: 'Garamond', serif;
        --shadow-default: 0 4px 15px rgba(0,0,0,0.1);
        --shadow-soft: 0 2px 15px rgba(45, 80, 22, 0.08);
        --shadow-medium: 0 8px 30px rgba(45, 80, 22, 0.12);
        --shadow-strong: 0 15px 40px rgba(45, 80, 22, 0.18);
        --transition-default: all 0.3s ease;
        --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        --border-radius: 16px;
        --border-radius-small: 8px;
    }

    /* Reset e Estilos Globais */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        height: 100%;
        font-family: var(--font-main);
        font-weight: 700;
        background-color: var(--primary-bg);
        color: var(--text-dark);
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    /* Estrutura Principal */
    .wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    /* Header Styles */
    .header {
        background-color: var(--accent-color);
        position: relative;
        height: 86px;
    }

    .header-img img {
        height: 126px;
        transition: transform 0.5s ease;
    }

    .header-img {
        position: absolute;
        top: -50px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1;
    }

    .top-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 30px;
        background-color: var(--accent-color);
        position: relative;
    }

    .menu-icon {
        font-size: 24px;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .menu-icon:hover {
        transform: scale(1.1);
    }

    .user-header {
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 700;
    }

    /* Menu Styles */
    .menu-box {
        position: fixed;
        top: 0;
        left: 0;
        width: 300px;
        height: 100vh;
        background: linear-gradient(135deg, var(--primary-bg) 0%, var(--border-color) 100%);
        box-shadow: var(--shadow-strong);
        z-index: 1000;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        transform: translateX(-100%);
        display: flex;
        flex-direction: column;
        padding: 20px;
    }

    .menu-box.visible {
        transform: translateX(0);
    }

    .menu-logo {
        text-align: center;
        padding: 20px 0;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 20px;
    }

    .menu-logo img {
        max-width: 80px;
        height: auto;
    }

    .menu-content {
        flex: 1;
        overflow-y: auto;
    }

    .menu-list {
        list-style: none;
    }

    .menu-list li {
        margin-bottom: 10px;
    }

    .menu-list a {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        color: var(--text-dark);
        text-decoration: none;
        border-radius: var(--border-radius-small);
        transition: var(--transition-smooth);
    }

    .menu-list a:hover {
        background-color: var(--accent-color);
        color: var(--text-dark);
        transform: translateX(5px);
    }

    .menu-list a i {
        margin-right: 12px;
        width: 20px;
        text-align: center;
    }

    /* Main Content */
    .main-content {
        flex: 1;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Container de Login */
    .login-container {
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
    }

    .login-title {
        font-family: var(--font-heading);
        color: var(--primary-color);
        font-size: 1.8rem;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .login-box {
        background-color: white;
        border-radius: 12px;
        padding: 1.8rem;
        box-shadow: var(--shadow-default);
        border: 3px solid var(--border-color);
    }

    /* Formulário */
    .form-group {
        margin-bottom: 1.2rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--primary-color);
        font-weight: bold;
        font-size: 0.95rem;
    }

    .form-group input {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 0.95rem;
        transition: var(--transition-default);
    }

    .form-group input:focus {
        border-color: var(--primary-color);
        outline: none;
    }

    .error {
        color: var(--error-color);
        font-size: 0.8rem;
        margin-top: 0.3rem;
        display: block;
    }

    .forgot-password {
        display: block;
        text-align: right;
        margin-bottom: 1.5rem;
        color: var(--primary-color);
        text-decoration: none;
        font-size: 0.9rem;
        transition: var(--transition-default);
    }

    .forgot-password:hover {
        text-decoration: underline;
    }

    .login-button {
        width: 100%;
        padding: 0.85rem;
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        transition: var(--transition-default);
        margin-bottom: 1rem;
        font-size: 1rem;
    }

    .login-button:hover {
        background-color: #4a7d2d;
    }

    .back-button {
        display: block;
        text-align: center;
        color: var(--primary-color);
        text-decoration: none;
        font-size: 0.95rem;
        transition: var(--transition-default);
    }

    .back-button:hover {
        text-decoration: underline;
    }

    /* Notificação */
    .notification {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        padding: 12px 24px;
        border-radius: 8px;
        color: var(--text-light);
        font-weight: bold;
        z-index: 1000;
        opacity: 0;
        transition: opacity 0.3s ease, top 0.3s ease;
        font-size: 0.9rem;
    }

    .notification.show {
        top: 30px;
        opacity: 1;
    }

    .notification.success {
        background-color: var(--success-color);
    }

    .notification.error {
        background-color: var(--error-color);
    }

    /* Animação Flutuante */
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-5px); }
        100% { transform: translateY(0px); }
    }

    .floating {
        animation: float 3s ease-in-out infinite;
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .main-content {
            padding: 1rem;
        }

        .login-box {
            padding: 1.5rem;
        }

        .top-header {
            padding: 10px 20px;
        }

        .header-img img {
            height: 100px;
            top: -30px;
        }

        .menu-box {
            width: 280px;
        }
    }

    @media (max-width: 600px) {
        .login-title {
            font-size: 1.6rem;
        }

        .login-box {
            padding: 1.2rem;
        }

        .form-group input {
            padding: 0.65rem;
        }

        .login-button {
            padding: 0.75rem;
        }
    }

    @media (max-width: 480px) {
        .login-box {
            padding: 1.2rem;
        }

        .form-group input {
            padding: 0.65rem;
        }

        .login-button {
            padding: 0.75rem;
        }

        .top-header {
            padding: 10px 15px;
        }
    }
</style>
@endsection

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="login-container">
            <h1 class="login-title">Login</h1>
            <div class="login-box">
                <form method="POST" action="{{ route('login') }}" id="login-form">
                    @csrf
                    <div class="form-group">
                        <label for="CPF">CPF</label>
                        <input type="text" id="CPF" name="CPF" value="{{ old('CPF') }}" placeholder="000.000.000-00" maxlength="14" required>
                        @error('CPF')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        <span id="cpf_error" class="error"></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        <span id="password_error" class="error"></span>
                    </div>

                    <a href="{{ route('password.request') }}" class="forgot-password">Esqueci minha senha</a>

                    <button type="submit" class="login-button">Entrar</button>
                </form>
                <a href="{{ route('register') }}" class="back-button">Voltar para a página de Cadastro</a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cpfInput = document.getElementById('CPF');
        const cpfError = document.getElementById('cpf_error');
        const menuToggle = document.getElementById('menuToggle');
        const menuBox = document.getElementById('menuBox');

        // Menu functionality
        if (menuToggle && menuBox) {
            menuToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                menuBox.classList.toggle('visible');
            });

            // Close menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!menuBox.contains(e.target) && e.target !== menuToggle) {
                    menuBox.classList.remove('visible');
                }
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    if (this.getAttribute('href') !== '#') {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                            // Close menu after navigation
                            menuBox.classList.remove('visible');
                        }
                    }
                });
            });
        }

        // CPF validation
        if (cpfInput) {
            // Máscara de CPF
            cpfInput.addEventListener('input', function (e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 11) value = value.substring(0, 11);
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                e.target.value = value;
                validateCPF(value);
            });

            // Validação ao perder foco
            cpfInput.addEventListener('blur', function (e) {
                validateCPF(e.target.value);
            });

            function validateCPF(value) {
                const digits = value.replace(/\D/g, '');
                console.log('Validando CPF:', digits);
                if (digits.length === 0) {
                    cpfError.textContent = 'O CPF é obrigatório.';
                    return false;
                }
                if (digits.length !== 11) {
                    cpfError.textContent = 'O CPF deve conter 11 números.';
                    return false;
                }
                if (!isValidCPF(digits)) {
                    cpfError.textContent = 'CPF inválido.';
                    return false;
                }
                cpfError.textContent = '';
                return true;
            }

            function isValidCPF(cpf) {
                console.log('Iniciando validação para:', cpf);
                // Rejeita CPFs com dígitos repetidos
                if (/^(\d)\1{10}$/.test(cpf)) {
                    console.log('CPF rejeitado: dígitos repetidos');
                    return false;
                }

                // Calcula primeiro dígito verificador
                let sum = 0;
                for (let i = 0; i < 9; i++) {
                    sum += parseInt(cpf[i]) * (10 - i);
                }
                let remainder = (sum * 10) % 11;
                if (remainder === 10) remainder = 0;
                console.log('Primeiro dígito verificador calculado:', remainder, 'Esperado:', cpf[9]);
                if (remainder !== parseInt(cpf[9])) {
                    console.log('Primeiro dígito inválido');
                    return false;
                }

                // Calcula segundo dígito verificador
                sum = 0;
                for (let i = 0; i < 10; i++) {
                    sum += parseInt(cpf[i]) * (11 - i);
                }
                remainder = (sum * 10) % 11;
                if (remainder === 10) remainder = 0;
                console.log('Segundo dígito verificador calculado:', remainder, 'Esperado:', cpf[10]);
                if (remainder !== parseInt(cpf[10])) {
                    console.log('Segundo dígito inválido');
                    return false;
                }

                console.log('CPF válido');
                return true;
            }
        }
    });
</script>
@endsection
