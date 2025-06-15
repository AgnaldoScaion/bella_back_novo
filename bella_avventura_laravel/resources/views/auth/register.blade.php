@extends('layouts.app')

@section('title', 'Cadastro')

@section('styles')
<style>
    /* Variáveis CSS */
    :root {
        --primary-color: #5a8f3d;
        --primary-light: #A7D096;
        --primary-bg: #f3f7f3;
        --border-color: #D8E6D9;
        --error-color: #F44336;
        --success-color: #4CAF50;
        --text-dark: #333;
        --text-light: #fff;
        --font-main: 'Inter', sans-serif;
        --font-heading: 'Garamond', serif;
        --shadow-default: 0 4px 15px rgba(0,0,0,0.1);
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
        background-color: var(--primary-bg);
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
        padding: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Container de Cadastro */
    .cadastro-container {
        width: 100%;
        max-width: 420px;
        margin: 0 auto;
    }

    .cadastro-title {
        font-family: var(--font-heading);
        color: var(--primary-color);
        font-size: 1.8rem;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .cadastro-box {
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

    .cadastro-button {
        width: 100%;
        padding: 0.85rem;
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        transition: var(--transition-default);
        margin-top: 1rem;
        font-size: 1rem;
    }

    .cadastro-button:hover {
        background-color: #4a7d2d;
    }

    .back-button {
        display: block;
        text-align: center;
        margin-top: 1.5rem;
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

        .cadastro-box {
            padding: 1.5rem;
        }
    }

    @media (max-width: 600px) {
        .cadastro-title {
            font-size: 1.6rem;
        }

        .cadastro-box {
            padding: 1.2rem;
        }

        .form-group input {
            padding: 0.65rem;
        }

        .cadastro-button {
            padding: 0.75rem;
        }
    }

    @media (max-width: 480px) {
        .cadastro-box {
            padding: 1.2rem;
        }

        .form-group input {
            padding: 0.65rem;
        }

        .cadastro-button {
            padding: 0.75rem;
        }
    }
</style>
@endsection

@section('content')
<div class="main-content">
    <div class="cadastro-container">
        <h1 class="cadastro-title">Cadastre-se</h1>

        @if(session('success'))
        <div class="notification success show">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="notification error show">
            {{ session('error') }}
        </div>
        @endif

        <div class="cadastro-box">
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf
                <div class="form-group">
                    <label for="nome_completo">Nome completo</label>
                    <input type="text" id="nome_completo" name="nome_completo" value="{{ old('nome_completo') }}" placeholder="Digite seu nome" required>
                    @error('nome_completo')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="CPF">CPF</label>
                    <input type="text" id="CPF" name="CPF" value="{{ old('CPF') }}" placeholder="000.000.000-00" maxlength="14" required>
                    @error('CPF')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="email@exemplo.com" required>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" placeholder="Crie uma senha" required>
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Senha</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirme a senha" required>
                </div>

                <button type="submit" class="cadastro-button">Cadastrar</button>
            </form>
            <a href="{{ route('login') }}" class="back-button">Avançar para Login</a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cpfInput = document.getElementById('CPF');
        const cpfError = document.getElementById('cpf_error');
        const registerForm = document.getElementById('registerForm');
        const nomeInput = document.getElementById('nome_completo');
        const nomeError = document.getElementById('nome_error');
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('email_error');
        const senhaInput = document.getElementById('senha');
        const senhaError = document.getElementById('senha_error');
        const confirmarSenhaInput = document.getElementById('senha_confirmation');
        const confirmarSenhaError = document.getElementById('senha_confirmation_error');

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
                // Rejeita CPFs com dígitos repetidos
                if (/^(\d)\1{10}$/.test(cpf)) {
                    return false;
                }

                // Calcula primeiro dígito verificador
                let sum = 0;
                for (let i = 0; i < 9; i++) {
                    sum += parseInt(cpf[i]) * (10 - i);
                }
                let remainder = (sum * 10) % 11;
                if (remainder === 10) remainder = 0;
                if (remainder !== parseInt(cpf[9])) {
                    return false;
                }

                // Calcula segundo dígito verificador
                sum = 0;
                for (let i = 0; i < 10; i++) {
                    sum += parseInt(cpf[i]) * (11 - i);
                }
                remainder = (sum * 10) % 11;
                if (remainder === 10) remainder = 0;
                if (remainder !== parseInt(cpf[10])) {
                    return false;
                }

                return true;
            }
        }

        if (registerForm) {
            registerForm.addEventListener('submit', function (e) {
                let isValid = true;
                clearErrors();

                // Validação do Nome
                if (nomeInput.value.trim() === '') {
                    nomeError.textContent = 'O nome completo é obrigatório.';
                    isValid = false;
                }

                // Validação do CPF
                if (!validateCPF(cpfInput.value)) {
                    isValid = false;
                }

                // Validação do E-mail
                if (!validarEmail(emailInput.value.trim())) {
                    emailError.textContent = 'E-mail inválido.';
                    isValid = false;
                }

                // Validação da Senha
                if (senhaInput.value.length < 8) {
                    senhaError.textContent = 'A senha deve ter pelo menos 8 caracteres.';
                    isValid = false;
                }

                // Validação da Confirmação de Senha
                if (senhaInput.value !== confirmarSenhaInput.value) {
                    confirmarSenhaError.textContent = 'As senhas não coincidem.';
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });

            function clearErrors() {
                const errors = document.querySelectorAll('.error');
                errors.forEach(error => {
                    error.textContent = '';
                });
            }

            function validarEmail(email) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            }
        }
    });
</script>
@endsection
