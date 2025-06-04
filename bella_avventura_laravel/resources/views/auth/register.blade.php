<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Bella Avventura</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="https://i.ibb.co/vx2Dzj9v/image.png">
    <style>
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

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            padding: 2.4rem;
        }

        .header {
            background-color: var(--primary-light);
            position: relative;
            height: 86px;
        }

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            background-color: var(--primary-light);
            position: relative;
        }

        .header-img {
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
        }

        .header-img img {
            height: 126px;
            transition: var(--transition-default);
        }

        .menu-icon {
            font-size: 24px;
            cursor: pointer;
            transition: var(--transition-default);
        }

        .menu-icon:hover {
            transform: scale(1.1);
        }

        .user-header {
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .menu-box {
            position: absolute;
            top: 50px;
            left: 20px;
            background-color: #d6e3d6;
            border-radius: 8px;
            padding: 20px;
            width: 260px;
            display: flex;
            gap: 20px;
            box-shadow: var(--shadow-default);
            font-family: var(--font-heading);
            z-index: 10;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .hidden {
            visibility: hidden;
            opacity: 0;
            pointer-events: none;
        }

        .visible {
            visibility: visible;
            opacity: 1;
            pointer-events: auto;
        }

        .cadastro-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem 0;
        }

        .cadastro-title {
            font-family: var(--font-heading);
            color: var(--primary-color);
            font-size: 2rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .cadastro-box {
            background-color: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: var(--shadow-default);
            border: 3px solid var(--border-color);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition-default);
        }

        .form-group input:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .error {
            color: var(--error-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
        }

        .cadastro-button {
            width: 100%;
            padding: 1rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: var(--transition-default);
            margin-top: 1rem;
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
            transition: var(--transition-default);
        }

        .back-button:hover {
            text-decoration: underline;
        }

        .footer {
            background-color: var(--primary-light);
            padding: 20px;
            color: var(--text-dark);
            font-size: 14px;
            text-align: center;
        }

        .footer-top {
            margin-bottom: 15px;
            font-size: 33%;
        }

        .footer-top img {
            width: 15%;
            height: auto;
            transition: var(--transition-default);
        }

        .footer-top:hover img {
            transform: rotate(5deg) scale(1.05);
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .footer-left,
        .footer-center,
        .footer-right {
            flex: 1;
            text-align: center;
            transition: var(--transition-default);
        }

        .footer-left:hover,
        .footer-right:hover {
            transform: translateY(-3px);
        }

        .footer-left {
            text-align: left;
        }

        .footer-right {
            text-align: right;
        }

        .footer-bottom a {
            text-decoration: underline;
            color: var(--text-dark);
            transition: var(--transition-default);
        }

        .footer-bottom a:hover {
            color: var(--primary-color);
        }

        .notification {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px 25px;
            border-radius: 5px;
            color: var(--text-light);
            font-weight: bold;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease, top 0.3s ease;
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

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1.5rem;
            }

            .cadastro-container {
                padding: 1rem 0;
            }

            .footer-bottom {
                flex-direction: column;
            }

            .footer-left,
            .footer-center,
            .footer-right {
                text-align: center;
            }
        }

        @media (max-width: 600px) {
            .header-img img {
                height: 100px;
                top: -30px;
            }

            .footer-top img {
                width: 30%;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Header -->
        <div class="top-header">
            <div class="menu-icon">☰</div>
            <div class="user-header">
                <span>👤</span> {{ auth()->check() ? auth()->user()->nome_completo : 'Visitante' }}
            </div>
        </div>

        <div class="header">
            <div class="header-img">
                <a href="{{ route('home') }}">
                    <img src="https://i.ibb.co/Q7T008b1/image.png" alt="Logo" class="floating"/>
                </a>
            </div>
        </div>

        <!-- Menu (simplificado para exemplo) -->
        <div id="menu-nao-logado" class="menu-box hidden">
            <ul>
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Cadastro</a></li>
                <li><a href="{{ route('home') }}">Início</a></li>
            </ul>
        </div>

        <!-- Notificação -->
        <div id="notification" class="notification @if(session('success')) success @elseif($errors->any())) error @endif">
            @if(session('success'))
                {{ session('success') }}
            @elseif($errors->any())
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            @endif
        </div>

        <!-- Conteúdo Principal -->
        <main class="main-content">
            <div class="cadastro-container">
                <h1 class="cadastro-title">Cadastre-se</h1>
                <div class="cadastro-box">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nome_completo">Nome completo</label>
                            <input type="text" id="nome_completo" name="nome_completo" value="{{ old('nome_completo') }}" placeholder="Digite seu nome" required>
                            @error('nome_completo')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}" placeholder="000.000.000-00" maxlength="14" required>
                            @error('cpf')
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
                            <label for="senha">Senha</label>
                            <input type="password" id="senha" name="senha" placeholder="Crie uma senha" required>
                            @error('senha')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="senha_confirmation">Confirmar Senha</label>
                            <input type="password" id="senha_confirmation" name="senha_confirmation" placeholder="Confirme a senha" required>
                        </div>

                        <button type="submit" class="cadastro-button">Cadastrar</button>
                    </form>
                    <a href="{{ route('login') }}" class="back-button">Voltar para o Login</a>
                </div>
            </div>
        </main>

        <!-- Rodapé -->
        <footer class="footer">
            <div class="footer-top">
                <a href="https://www.bellaavventura.com.br/">
                    <img src="https://i.ibb.co/j9vGknyy/image.png" alt="Bella Avventura" border="0">
                </a>
            </div>
            <div class="footer-bottom">
                <div class="footer-left">
                    <a href="mailto:bella.avventura@gmail.com">📧 bella.avventura@gmail.com</a>
                </div>
                <div class="footer-center">© 2025 Bella Avventura</div>
                <div class="footer-right">
                    <a href="{{ route('termos') }}">Termos e condições</a>
                </div>
            </div>
        </footer>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cpfInput = document.getElementById('cpf');
        const cpfErrorMsg = document.getElementById('cpf-error-msg');

        if (cpfInput) {
            // Aplicar máscara
            cpfInput.addEventListener('input', function (e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 11) value = value.substring(0, 11);
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                e.target.value = value;

                // Validar em tempo real
                validateCPF(value);
            });

            // Validação ao perder foco
            cpfInput.addEventListener('blur', function (e) {
                validateCPF(e.target.value);
            });

            function validateCPF(value) {
                const digits = value.replace(/\D/g, '');
                if (digits.length === 0) {
                    cpfErrorMsg.textContent = 'O CPF é obrigatório.';
                    return false;
                }
                if (digits.length !== 11) {
                    cpfErrorMsg.textContent = 'O CPF deve conter 11 números.';
                    return false;
                }
                if (!isValidCPF(digits)) {
                    cpfErrorMsg.textContent = 'CPF inválido.';
                    return false;
                }
                cpfErrorMsg.textContent = '';
                return true;
            }

            function isValidCPF(cpf) {
                if (/^(\d)\1{10}$/.test(cpf)) return false; // Evita CPFs como 11111111111

                // Primeiro dígito verificador
                let sum = 0;
                for (let i = 0; i < 9; i++) {
                    sum += parseInt(cpf[i]) * (10 - i);
                }
                let digit1 = (sum * 10) % 10;
                digit1 = digit1 === 10 ? 0 : digit1;
                if (digit1 !== parseInt(cpf[9])) return false;

                // Segundo dígito verificador
                sum = 0;
                for (let i = 0; i < 10; i++) {
                    sum += parseInt(cpf[i]) * (11 - i);
                }
                let digit2 = (sum * 10) % 10;
                digit2 = digit2 === 10 ? 0 : digit2;
                return digit2 === parseInt(cpf[10]);
            }
        }
    });
</script>
</body>
</html>
