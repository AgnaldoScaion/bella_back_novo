<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Bella Avventura</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @font-face {
            font-family: 'GaramondBold';
            src: local('Garamond'), serif;
            font-weight: bold;
        }

        :root {
            --primary-color: #2d5016;
            --primary-light: #5a8f3d;
            --primary-bg: #f8fdf8;
            --accent-color: #A7D096;
            --border-color: #E5F2E5;
            --error-color: #e74c3c;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --text-dark: #1a1a1a;
            --text-medium: #4a4a4a;
            --text-light: #ffffff;
            --input-bg: #ffffff;
            --shadow-soft: 0 2px 15px rgba(45, 80, 22, 0.08);
            --shadow-medium: 0 8px 30px rgba(45, 80, 22, 0.12);
            --shadow-strong: 0 15px 40px rgba(45, 80, 22, 0.18);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --border-radius: 16px;
            --border-radius-small: 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background: linear-gradient(135deg, var(--primary-bg) 0%, #f0f8f0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .wrapper {
            width: 100%;
            max-width: 480px;
            margin: 2rem;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo {
            font-family: 'GaramondBold', serif;
            font-size: 2rem;
            color: var(--primary-color);
            text-decoration: none;
            display: inline-block;
            transition: var(--transition-smooth);
        }

        .logo:hover {
            color: var(--primary-light);
            transform: scale(1.05);
        }

        .cadastro-container {
            background: var(--input-bg);
            border-radius: var(--border-radius);
            padding: 2.5rem;
            box-shadow: var(--shadow-medium);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .cadastro-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-color), var(--primary-light));
        }

        .cadastro-title {
            font-family: 'GaramondBold', serif;
            font-size: 2rem;
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
        }

        .cadastro-title::after {
            content: '';
            position: absolute;
            bottom: -0.5rem;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 2px;
            background: linear-gradient(90deg, var(--accent-color), var(--primary-light));
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
            font-weight: 600;
            font-size: 0.9rem;
            transition: var(--transition-smooth);
        }

        .input-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .form-group input {
            width: 100%;
            padding: 1rem;
            padding-left: 2.5rem;
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius-small);
            font-size: 1rem;
            font-weight: 400;
            background: var(--input-bg);
            transition: var(--transition-smooth);
            color: var(--text-dark);
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(90, 143, 61, 0.1);
            transform: translateY(-1px);
        }

        .form-group input.valid {
            border-color: var(--success-color);
        }

        .form-group input.invalid {
            border-color: var(--error-color);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            color: var(--text-medium);
            font-size: 1rem;
            z-index: 2;
            transition: var(--transition-smooth);
        }

        .form-group input:focus + .input-icon {
            color: var(--primary-light);
        }

        .validation-icon {
            position: absolute;
            right: 1rem;
            font-size: 1rem;
            opacity: 0;
            transition: var(--transition-smooth);
        }

        .validation-icon.success {
            color: var(--success-color);
            opacity: 1;
        }

        .validation-icon.error {
            color: var(--error-color);
            opacity: 1;
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            opacity: 0;
            transform: translateY(-5px);
            transition: var(--transition-smooth);
        }

        .error-message.show {
            opacity: 1;
            transform: translateY(0);
        }

        .password-strength {
            margin-top: 0.5rem;
            font-size: 0.8rem;
        }

        .strength-bar {
            width: 100%;
            height: 4px;
            background: var(--border-color);
            border-radius: 2px;
            margin-top: 0.5rem;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            transition: var(--transition-smooth);
            border-radius: 2px;
        }

        .strength-weak { background: var(--error-color); width: 25%; }
        .strength-fair { background: var(--warning-color); width: 50%; }
        .strength-good { background: var(--primary-light); width: 75%; }
        .strength-strong { background: var(--success-color); width: 100%; }

        .cadastro-button {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            color: var(--text-light);
            border: none;
            border-radius: var(--border-radius-small);
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-soft);
        }

        .cadastro-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .cadastro-button:hover::before {
            left: 100%;
        }

        .cadastro-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        .cadastro-button:active {
            transform: translateY(0);
        }

        .cadastro-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition-smooth);
        }

        .back-link:hover {
            color: var(--primary-light);
            transform: translateY(-1px);
        }

        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid transparent;
            border-top: 2px solid var(--text-light);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 0.5rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .notification {
            position: fixed;
            top: 2rem;
            right: 2rem;
            padding: 1rem 1.5rem;
            border-radius: var(--border-radius-small);
            color: var(--text-light);
            font-weight: 600;
            z-index: 1000;
            opacity: 0;
            transform: translateX(100%);
            transition: var(--transition-smooth);
        }

        .notification.show {
            opacity: 1;
            transform: translateX(0);
        }

        .notification.success {
            background: var(--success-color);
        }

        .notification.error {
            background: var(--error-color);
        }

        @media (max-width: 768px) {
            .wrapper {
                margin: 1rem;
            }

            .cadastro-container {
                padding: 2rem;
            }

            .cadastro-title {
                font-size: 1.8rem;
            }

            .notification {
                top: 1rem;
                right: 1rem;
                left: 1rem;
                transform: translateY(-100%);
            }

            .notification.show {
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .cadastro-container {
                padding: 1.5rem;
            }

            .form-group input {
                padding: 0.9rem;
                padding-left: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="logo-container">
            <a href="#" class="logo">Bella Avventura</a>
        </div>

        <div class="cadastro-container">
            <h1 class="cadastro-title">Criar Conta</h1>

            <form id="registerForm" novalidate>
                <div class="form-group">
                    <label for="nome_completo">Nome Completo</label>
                    <div class="input-container">
                        <input type="text" id="nome_completo" name="nome_completo" placeholder="Digite seu nome completo" required>
                        <i class="fas fa-user input-icon"></i>
                        <i class="validation-icon fas"></i>
                    </div>
                    <div class="error-message" id="nome_error">
                        <i class="fas fa-exclamation-circle"></i>
                        <span></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <div class="input-container">
                        <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" maxlength="14" required>
                        <i class="fas fa-id-card input-icon"></i>
                        <i class="validation-icon fas"></i>
                    </div>
                    <div class="error-message" id="cpf_error">
                        <i class="fas fa-exclamation-circle"></i>
                        <span></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <div class="input-container">
                        <input type="email" id="email" name="email" placeholder="email@exemplo.com" required>
                        <i class="fas fa-envelope input-icon"></i>
                        <i class="validation-icon fas"></i>
                    </div>
                    <div class="error-message" id="email_error">
                        <i class="fas fa-exclamation-circle"></i>
                        <span></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="senha">Senha</label>
                    <div class="input-container">
                        <input type="password" id="senha" name="senha" placeholder="Crie uma senha segura" required>
                        <i class="fas fa-lock input-icon"></i>
                        <i class="validation-icon fas"></i>
                    </div>
                    <div class="password-strength">
                        <div class="strength-bar">
                            <div class="strength-fill" id="strength-fill"></div>
                        </div>
                        <span id="strength-text">Digite uma senha</span>
                    </div>
                    <div class="error-message" id="senha_error">
                        <i class="fas fa-exclamation-circle"></i>
                        <span></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirmar_senha">Confirmar Senha</label>
                    <div class="input-container">
                        <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="Confirme sua senha" required>
                        <i class="fas fa-lock input-icon"></i>
                        <i class="validation-icon fas"></i>
                    </div>
                    <div class="error-message" id="confirmar_senha_error">
                        <i class="fas fa-exclamation-circle"></i>
                        <span></span>
                    </div>
                </div>

                <button type="submit" class="cadastro-button">
                    <div class="loading-spinner"></div>
                    <span>Criar Conta</span>
                </button>
            </form>

            <a href="#" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Já tenho uma conta
            </a>
        </div>
    </div>

    <div class="notification" id="notification">
        <span id="notification-text"></span>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registerForm');
            const inputs = form.querySelectorAll('input');

            // Campos do formulário
            const nomeInput = document.getElementById('nome_completo');
            const cpfInput = document.getElementById('cpf');
            const emailInput = document.getElementById('email');
            const senhaInput = document.getElementById('senha');
            const confirmarSenhaInput = document.getElementById('confirmar_senha');

            // Elementos de erro
            const nomeError = document.getElementById('nome_error');
            const cpfError = document.getElementById('cpf_error');
            const emailError = document.getElementById('email_error');
            const senhaError = document.getElementById('senha_error');
            const confirmarSenhaError = document.getElementById('confirmar_senha_error');

            // Elementos de força da senha
            const strengthFill = document.getElementById('strength-fill');
            const strengthText = document.getElementById('strength-text');

            // Validação em tempo real
            nomeInput.addEventListener('input', () => validateNome());
            nomeInput.addEventListener('blur', () => validateNome());

            cpfInput.addEventListener('input', (e) => {
                applyCPFMask(e);
                validateCPF();
            });
            cpfInput.addEventListener('blur', () => validateCPF());

            emailInput.addEventListener('input', () => validateEmail());
            emailInput.addEventListener('blur', () => validateEmail());

            senhaInput.addEventListener('input', () => {
                validateSenha();
                checkPasswordStrength();
            });
            senhaInput.addEventListener('blur', () => validateSenha());

            confirmarSenhaInput.addEventListener('input', () => validateConfirmarSenha());
            confirmarSenhaInput.addEventListener('blur', () => validateConfirmarSenha());

            // Validação do nome
            function validateNome() {
                const nome = nomeInput.value.trim();
                const nomeRegex = /^[a-zA-ZÀ-ÿ\s]{2,50}$/;

                if (!nome) {
                    showError(nomeError, 'Nome completo é obrigatório');
                    setInputState(nomeInput, 'invalid');
                    return false;
                } else if (!nomeRegex.test(nome)) {
                    showError(nomeError, 'Nome deve conter apenas letras e espaços');
                    setInputState(nomeInput, 'invalid');
                    return false;
                } else if (nome.split(' ').length < 2) {
                    showError(nomeError, 'Digite nome e sobrenome');
                    setInputState(nomeInput, 'invalid');
                    return false;
                } else {
                    hideError(nomeError);
                    setInputState(nomeInput, 'valid');
                    return true;
                }
            }

            // Máscara e validação do CPF
            function applyCPFMask(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 11) value = value.substring(0, 11);
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                e.target.value = value;
            }

            function validateCPF() {
                const cpf = cpfInput.value.replace(/\D/g, '');

                if (!cpf) {
                    showError(cpfError, 'CPF é obrigatório');
                    setInputState(cpfInput, 'invalid');
                    return false;
                } else if (cpf.length !== 11) {
                    showError(cpfError, 'CPF deve ter 11 dígitos');
                    setInputState(cpfInput, 'invalid');
                    return false;
                } else if (!isValidCPF(cpf)) {
                    showError(cpfError, 'CPF inválido');
                    setInputState(cpfInput, 'invalid');
                    return false;
                } else {
                    hideError(cpfError);
                    setInputState(cpfInput, 'valid');
                    return true;
                }
            }

            function isValidCPF(cpf) {
                // Rejeita CPFs com dígitos repetidos
                if (/^(\d)\1{10}$/.test(cpf)) return false;

                // Calcula primeiro dígito verificador
                let sum = 0;
                for (let i = 0; i < 9; i++) {
                    sum += parseInt(cpf[i]) * (10 - i);
                }
                let remainder = (sum * 10) % 11;
                if (remainder === 10) remainder = 0;
                if (remainder !== parseInt(cpf[9])) return false;

                // Calcula segundo dígito verificador
                sum = 0;
                for (let i = 0; i < 10; i++) {
                    sum += parseInt(cpf[i]) * (11 - i);
                }
                remainder = (sum * 10) % 11;
                if (remainder === 10) remainder = 0;
                if (remainder !== parseInt(cpf[10])) return false;

                return true;
            }

            // Validação do email
            function validateEmail() {
                const email = emailInput.value.trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (!email) {
                    showError(emailError, 'E-mail é obrigatório');
                    setInputState(emailInput, 'invalid');
                    return false;
                } else if (!emailRegex.test(email)) {
                    showError(emailError, 'E-mail inválido');
                    setInputState(emailInput, 'invalid');
                    return false;
                } else {
                    hideError(emailError);
                    setInputState(emailInput, 'valid');
                    return true;
                }
            }

            // Validação da senha
            function validateSenha() {
                const senha = senhaInput.value;

                if (!senha) {
                    showError(senhaError, 'Senha é obrigatória');
                    setInputState(senhaInput, 'invalid');
                    return false;
                } else if (senha.length < 6) {
                    showError(senhaError, 'Senha deve ter pelo menos 6 caracteres');
                    setInputState(senhaInput, 'invalid');
                    return false;
                } else {
                    hideError(senhaError);
                    setInputState(senhaInput, 'valid');
                    return true;
                }
            }

            // Verificação da força da senha
            function checkPasswordStrength() {
                const senha = senhaInput.value;
                let strength = 0;
                let strengthClass = '';
                let strengthTextContent = '';

                if (senha.length >= 6) strength++;
                if (senha.match(/[a-z]/)) strength++;
                if (senha.match(/[A-Z]/)) strength++;
                if (senha.match(/[0-9]/)) strength++;
                if (senha.match(/[^a-zA-Z0-9]/)) strength++;

                switch (strength) {
                    case 0:
                    case 1:
                        strengthClass = 'strength-weak';
                        strengthTextContent = 'Muito fraca';
                        break;
                    case 2:
                        strengthClass = 'strength-fair';
                        strengthTextContent = 'Fraca';
                        break;
                    case 3:
                        strengthClass = 'strength-good';
                        strengthTextContent = 'Boa';
                        break;
                    case 4:
                    case 5:
                        strengthClass = 'strength-strong';
                        strengthTextContent = 'Forte';
                        break;
                }

                strengthFill.className = `strength-fill ${strengthClass}`;
                strengthText.textContent = strengthTextContent;
            }

            // Validação da confirmação de senha
            function validateConfirmarSenha() {
                const senha = senhaInput.value;
                const confirmarSenha = confirmarSenhaInput.value;

                if (!confirmarSenha) {
                    showError(confirmarSenhaError, 'Confirmação de senha é obrigatória');
                    setInputState(confirmarSenhaInput, 'invalid');
                    return false;
                } else if (senha !== confirmarSenha) {
                    showError(confirmarSenhaError, 'Senhas não coincidem');
                    setInputState(confirmarSenhaInput, 'invalid');
                    return false;
                } else {
                    hideError(confirmarSenhaError);
                    setInputState(confirmarSenhaInput, 'valid');
                    return true;
                }
            }

            // Funções auxiliares para mostrar/ocultar erros
            function showError(errorElement, message) {
                errorElement.querySelector('span').textContent = message;
                errorElement.classList.add('show');
            }

            function hideError(errorElement) {
                errorElement.classList.remove('show');
            }

            function setInputState(input, state) {
                const validationIcon = input.parentElement.querySelector('.validation-icon');

                input.classList.remove('valid', 'invalid');
                validationIcon.classList.remove('success', 'error', 'fa-check', 'fa-times');

                if (state === 'valid') {
                    input.classList.add('valid');
                    validationIcon.classList.add('success', 'fa-check');
                } else if (state === 'invalid') {
                    input.classList.add('invalid');
                    validationIcon.classList.add('error', 'fa-times');
                }
            }

            // Validação do formulário
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const isNomeValid = validateNome();
                const isCpfValid = validateCPF();
                const isEmailValid = validateEmail();
                const isSenhaValid = validateSenha();
                const isConfirmarSenhaValid = validateConfirmarSenha();

                if (isNomeValid && isCpfValid && isEmailValid && isSenhaValid && isConfirmarSenhaValid) {
                    // Simular envio do formulário
                    const button = form.querySelector('.cadastro-button');
                    const spinner = button.querySelector('.loading-spinner');
                    const buttonText = button.querySelector('span');

                    button.disabled = true;
                    spinner.style.display = 'block';
                    buttonText.textContent = 'Criando conta...';

                    setTimeout(() => {
                        showNotification('Conta criada com sucesso!', 'success');

                        // Reset do formulário
                        form.reset();
                        inputs.forEach(input => {
                            input.classList.remove('valid', 'invalid');
                            const validationIcon = input.parentElement.querySelector('.validation-icon');
                            validationIcon.classList.remove('success', 'error', 'fa-check', 'fa-times');
                        });

                        // Reset da força da senha
                        strengthFill.className = 'strength-fill';
                        strengthText.textContent = 'Digite uma senha';

                        // Reset do botão
                        button.disabled = false;
                        spinner.style.display = 'none';
                        buttonText.textContent = 'Criar Conta';
                    }, 2000);
                } else {
                    showNotification('Por favor, corrija os erros no formulário', 'error');
                }
            });

            // Função para mostrar notificações
            function showNotification(message, type) {
                const notification = document.getElementById('notification');
                const notificationText = document.getElementById('notification-text');

                notificationText.textContent = message;
                notification.className = `notification ${type}`;
                notification.classList.add('show');

                setTimeout(() => {
                    notification.classList.remove('show');
                }, 4000);
            }
        });
    </script>
</body>
</html>
