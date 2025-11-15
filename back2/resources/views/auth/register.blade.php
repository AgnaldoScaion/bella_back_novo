@extends('layouts.app')

@section('title', 'Cadastro')

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

        html,
        body {
            height: 100%;
            font-family: var(--font-main);
            font-weight: 700;
            background: linear-gradient(135deg, #f3f7f3 0%, #e8f3e8 100%);
            color: var(--text-dark);
        }

        .menu-icon {
            font-size: 24px;
            cursor: pointer;
            transition: transform 0.3s ease, color 0.3s ease;
            color: var(--primary-green);
        }

        .menu-icon:hover {
            transform: scale(1.2) rotate(90deg);
            color: var(--primary-color);
        }

        /* Menu Styles */
        .menu-box {
            position: fixed;
            top: 50px;
            left: 20px;
            background: rgba(214, 227, 214, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 20px;
            width: 260px;
            display: flex;
            gap: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            font-family: 'Garamond', serif;
            z-index: 1000;
            transition: opacity 0.3s ease, visibility 0.3s ease, transform 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .menu-lateral {
            background: linear-gradient(to bottom, #88b68b, #6a9a6d);
            width: 24px;
            border-radius: 12px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .menu-conteudo {
            flex: 1;
        }

        .menu-conteudo h2 {
            font-size: 20px;
            margin: 0;
            border-bottom: 2px solid #999;
            padding-bottom: 10px;
            color: var(--primary-green);
        }

        .menu-conteudo ul {
            list-style: none;
            padding: 0;
            margin-top: 15px;
        }

        .menu-conteudo li {
            margin: 15px 0;
            transition: transform 0.2s ease;
        }

        .menu-conteudo li:hover {
            transform: translateX(5px);
        }

        .menu-conteudo a {
            text-decoration: none;
            color: black;
            transition: color 0.2s;
            font-weight: 600;
        }

        .menu-conteudo a:hover {
            color: #3a6545;
        }

        .hidden {
            visibility: hidden;
            opacity: 0;
            pointer-events: none;
            transform: translateX(-20px);
        }

        .visible {
            visibility: visible;
            opacity: 1;
            pointer-events: auto;
            transform: translateX(0);
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

        /* Container de Cadastro */
        .cadastro-container {
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
            animation: fadeInUp 0.6s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .cadastro-title {
            font-family: var(--font-heading);
            color: var(--primary-color);
            font-size: 2.2rem;
            text-align: center;
            margin-bottom: 1.8rem;
            position: relative;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.05);
        }

        .cadastro-title::after {
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

        .cadastro-box {
            background: linear-gradient(135deg, #ffffff 0%, #fafffe 100%);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
            border: 3px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .cadastro-box::before {
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

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
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

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        .cadastro-button {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, #4a7d2d 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: bold;
            cursor: pointer;
            transition: var(--transition-default);
            margin-top: 1.2rem;
            font-size: 1.05rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(90, 143, 61, 0.3);
            position: relative;
            overflow: hidden;
        }

        .cadastro-button::before {
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
        }

        .cadastro-button:hover::before {
            width: 300px;
            height: 300px;
        }

        .cadastro-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(90, 143, 61, 0.4);
        }

        .cadastro-button:active {
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
            transform: translateX(5px);
        }

        .back-button:hover::after {
            margin-left: 12px;
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

        /* Animação Flutuante */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-8px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        /* Footer Styles */
        .footer {
            background: linear-gradient(to right, var(--primary-light), #b8dca8);
            padding: 25px 20px;
            color: #000;
            font-size: 14px;
            text-align: center;
            animation: fadeIn 1s ease;
            margin-top: auto;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.08);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }

            /* Responsividade */
            @media (max-width: 768px) {
                .main-content {
                    padding: 1.5rem 1rem;
                }

                .cadastro-box {
                    padding: 2rem;
                }

                .cadastro-title {
                    font-size: 1.9rem;
                }
            }

            @media (max-width: 600px) {
                .cadastro-title {
                    font-size: 1.7rem;
                }

                .cadastro-box {
                    padding: 1.8rem;
                    border-radius: 16px;
                }

                .form-group input {
                    padding: 0.8rem;
                }

                .cadastro-button {
                    padding: 0.9rem;
                    font-size: 1rem;
                }

                .menu-box {
                    width: 240px;
                }
            }

            @media (max-width: 480px) {
                .cadastro-container {
                    max-width: 100%;
                }

                .cadastro-box {
                    padding: 1.5rem;
                    border-radius: 14px;
                }

                .form-group input {
                    padding: 0.75rem;
                }

                .cadastro-button {
                    padding: 0.85rem;
                }

                .cadastro-title {
                    font-size: 1.6rem;
                }
            }
    </style>
@endsection

@section('content')
    <div class="wrapper">
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
                            <input type="text" id="nome_completo" name="nome_completo" value="{{ old('nome_completo') }}"
                                placeholder="Digite seu nome" required>
                            @error('nome_completo')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="CPF">CPF</label>
                            <input type="text" id="CPF" name="CPF" value="{{ old('CPF') }}" placeholder="000.000.000-00"
                                maxlength="14" required>
                            <span id="cpf_error" class="error"></span>
                            @error('CPF')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                placeholder="email@exemplo.com" required>
                            <span id="email_error" class="error"></span>
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" id="password" name="password" placeholder="Crie uma senha" required>
                            <span id="password_error" class="error"></span>
                            @error('password')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Senha</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Confirme a senha" required>
                            <span id="password_confirmation_error" class="error"></span>
                        </div>
                        <button type="submit" class="cadastro-button">Cadastrar</button>
                    </form>
                    <a href="{{ route('login') }}" class="back-button">Avançar para Login</a>
                </div>
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
            const nomeError = document.querySelector('#nome_completo + .error') || document.createElement('span'); // Fallback se não existir
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('email_error');
            const senhaInput = document.getElementById('password');
            const senhaError = document.getElementById('password_error');
            const confirmarSenhaInput = document.getElementById('password_confirmation');
            const confirmarSenhaError = document.getElementById('password_confirmation_error');

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
                    if (senhaInput.value.length < 4) {
                        senhaError.textContent = 'A senha deve ter pelo menos 4 caracteres.';
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
