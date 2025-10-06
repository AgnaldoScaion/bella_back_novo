@extends('layouts.app')
@section('title', 'Meu Perfil - Bella Avventura')
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
        --accent-color: #A7D096;
        --border-color: #D8E6D9;
        --error-color: #F44336;
        --success-color: #4CAF50;
        --text-dark: #333;
        --text-medium: #4a4a4a;
        --text-light: #fff;
        --font-main: 'Inter', sans-serif;
        --font-heading: 'Garamond', serif;
        --shadow-default: 0 4px 15px rgba(0, 0, 0, 0.1);
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
    html, body {
        height: 100%;
        font-family: var(--font-main);
        font-weight: 700;
        background: linear-gradient(135deg, #f3f7f3 0%, #e8f3e8 100%);
        color: var(--text-dark);
    }
    /* Menu Icon */
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
    /* Profile Container */
    .profile-container {
        max-width: 800px;
        min-width: 300px;
        width: 90%;
        margin: 0 auto;
        background: linear-gradient(135deg, #ffffff 0%, #fafffe 100%);
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
        border: 3px solid var(--border-color);
        position: relative;
        overflow: hidden;
    }
    .profile-container::before {
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
        0%, 100% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
    }
    .profile-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        border-bottom: 2px solid var(--border-color);
        padding-bottom: 1rem;
    }
    .profile-title {
        font-family: var(--font-heading);
        color: var(--primary-color);
        font-size: 2.2rem;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.05);
    }
    .edit-button {
        background: linear-gradient(135deg, var(--primary-color) 0%, #4a7d2d 100%);
        color: var(--text-light);
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 12px;
        cursor: pointer;
        font-weight: bold;
        transition: var(--transition-default);
        box-shadow: 0 4px 15px rgba(90, 143, 61, 0.3);
        position: relative;
        overflow: hidden;
    }
    .edit-button::before {
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
    .edit-button:hover::before {
        width: 300px;
        height: 300px;
    }
    .edit-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 25px rgba(90, 143, 61, 0.4);
    }
    .edit-button:active {
        transform: translateY(-1px);
    }
    .profile-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
    .info-group {
        margin-bottom: 1.5rem;
        position: relative;
    }
    .info-label {
        display: block;
        margin-bottom: 0.6rem;
        color: var(--primary-color);
        font-weight: bold;
        font-size: 0.95rem;
        transition: var(--transition-default);
    }
    .info-value {
        padding: 0.9rem 1rem;
        background-color: #fafffe;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        font-size: 0.95rem;
    }
    .edit-form input {
        width: 100%;
        padding: 0.9rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        font-size: 0.95rem;
        transition: var(--transition-default);
        background-color: #fafffe;
        font-family: var(--font-main);
    }
    .edit-form input:focus {
        border-color: var(--primary-color);
        outline: none;
        box-shadow: 0 0 0 4px rgba(90, 143, 61, 0.1);
        background-color: white;
        transform: translateY(-2px);
    }
    .edit-form input::placeholder {
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
        0%, 100% {
            transform: translateX(0);
        }
        25% {
            transform: translateX(-5px);
        }
        75% {
            transform: translateX(5px);
        }
    }
    .profile-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
    }
    .action-button {
        padding: 1rem;
        border-radius: 12px;
        font-weight: bold;
        cursor: pointer;
        transition: var(--transition-default);
        font-size: 1.05rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        position: relative;
        overflow: hidden;
    }
    .save-button {
        background: linear-gradient(135deg, var(--primary-color) 0%, #4a7d2d 100%);
        color: var(--text-light);
        border: none;
        display: none;
    }
    .save-button::before {
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
    .save-button:hover::before {
        width: 300px;
        height: 300px;
    }
    .save-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 25px rgba(90, 143, 61, 0.4);
    }
    .save-button:active {
        transform: translateY(-1px);
    }
    .cancel-button {
        background-color: transparent;
        border: 2px solid var(--error-color);
        color: var(--error-color);
        display: none;
    }
    .cancel-button:hover {
        background-color: #ffeeee;
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
    }
    /* Responsividade */
    @media (max-width: 768px) {
        .main-content {
            padding: 1.5rem 1rem;
        }
        .profile-container {
            padding: 2rem;
        }
        .profile-title {
            font-size: 1.9rem;
        }
        .profile-info {
            grid-template-columns: 1fr;
        }
        .profile-actions {
            flex-direction: column;
        }
        .action-button {
            width: 100%;
        }
    }
    @media (max-width: 600px) {
        .profile-title {
            font-size: 1.7rem;
        }
        .profile-container {
            padding: 1.8rem;
            border-radius: 16px;
        }
        .edit-form input {
            padding: 0.8rem;
        }
        .action-button {
            padding: 0.9rem;
            font-size: 1rem;
        }
    }
    @media (max-width: 480px) {
        .profile-container {
            max-width: 100%;
            padding: 1.5rem;
            border-radius: 14px;
        }
        .profile-title {
            font-size: 1.6rem;
        }
        .edit-form input {
            padding: 0.75rem;
        }
        .action-button {
            padding: 0.85rem;
        }
    }
</style>
@endsection
@section('content')
<div class="wrapper">
    <div class="main-content">
        <div class="profile-container">
            <div class="profile-header">
                <h1 class="profile-title">Meu Perfil</h1>
                <button id="editButton" class="edit-button">Editar Perfil</button>
            </div>
            @if(session('success'))
                <div id="notification" class="notification success show">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div id="notification" class="notification error show">
                    {{ $errors->first() }}
                </div>
            @endif
            <div id="notification" class="notification"></div>
            <form id="profileForm">
                @csrf
                <div class="profile-info">
                    <div class="info-group">
                        <span class="info-label">Nome Completo</span>
                        <div id="nomeValue" class="info-value">{{ Auth::user()->nome_completo }}</div>
                        <div class="edit-form" style="display: none;">
                            <input type="text" id="nomeInput" name="nome_completo" placeholder="Digite seu nome completo" value="{{ Auth::user()->nome_completo }}">
                            <span class="error" id="nomeError"></span>
                        </div>
                    </div>
                    <div class="info-group" id="CPFGroup">
                        <span class="info-label">CPF</span>
                        <div id="CPFValue" class="info-value">{{ Auth::user()->CPF }}</div>
                    </div>
                    <div class="info-group" id="senhaAntigaGroup" style="display: none;">
                        <span class="info-label">Senha Atual</span>
                        <div class="edit-form" style="display: block;">
                            <input type="password" id="senhaAntigaInput" name="senha_atual" placeholder="Digite sua senha atual">
                            <span class="error" id="senhaAntigaError"></span>
                        </div>
                    </div>
                    <div class="info-group">
                        <span class="info-label">E-mail</span>
                        <div id="emailValue" class="info-value">{{ Auth::user()->email }}</div>
                        <div class="edit-form" style="display: none;">
                            <input type="email" id="emailInput" name="email" placeholder="Digite seu e-mail" value="{{ Auth::user()->email }}">
                            <span class="error" id="emailError"></span>
                        </div>
                    </div>
                    <div class="info-group" id="senhaGroup" style="display: none;">
                        <span class="info-label">Nova Senha</span>
                        <div class="edit-form" style="display: block;">
                            <input type="password" id="novaSenhaInput" name="nova_senha" placeholder="Digite sua nova senha">
                            <span class="error" id="novaSenhaError"></span>
                        </div>
                    </div>
                    <div class="info-group" id="senhaConfirmacaoGroup" style="display: none;">
                        <span class="info-label">Confirmar Nova Senha</span>
                        <div class="edit-form" style="display: block;">
                            <input type="password" id="novaSenhaConfirmacaoInput" name="nova_senha_confirmation" placeholder="Confirme sua nova senha">
                            <span class="error" id="novaSenhaConfirmacaoError"></span>
                        </div>
                    </div>
                </div>
                <div class="profile-actions">
                    <button type="button" id="cancelButton" class="action-button cancel-button">Cancelar</button>
                    <button type="submit" id="saveButton" class="action-button save-button">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButton = document.getElementById('editButton');
        const cancelButton = document.getElementById('cancelButton');
        const saveButton = document.getElementById('saveButton');
        const profileForm = document.getElementById('profileForm');
        const editForms = document.querySelectorAll('.edit-form');
        const infoValues = document.querySelectorAll('.info-value');
        const notification = document.getElementById('notification');
        const errorFields = {
            nome_completo: document.getElementById('nomeError'),
            email: document.getElementById('emailError'),
            senha_atual: document.getElementById('senhaAntigaError'),
            nova_senha: document.getElementById('novaSenhaError'),
            nova_senha_confirmation: document.getElementById('novaSenhaConfirmacaoError')
        };

        // Toggle edit mode
        editButton.addEventListener('click', function() {
            editForms.forEach(form => form.style.display = 'block');
            infoValues.forEach(value => value.style.display = 'none');
            document.getElementById('CPFGroup').style.display = 'none';
            document.getElementById('senhaAntigaGroup').style.display = 'block';
            document.getElementById('senhaGroup').style.display = 'block';
            document.getElementById('senhaConfirmacaoGroup').style.display = 'block';
            cancelButton.style.display = 'block';
            saveButton.style.display = 'block';
            editButton.style.display = 'none';
            clearErrors();
        });

        // Cancel edit mode
        cancelButton.addEventListener('click', function() {
            editForms.forEach(form => form.style.display = 'none');
            infoValues.forEach(value => value.style.display = 'block');
            document.getElementById('CPFGroup').style.display = 'block';
            document.getElementById('senhaAntigaGroup').style.display = 'none';
            document.getElementById('senhaGroup').style.display = 'none';
            document.getElementById('senhaConfirmacaoGroup').style.display = 'none';
            cancelButton.style.display = 'none';
            saveButton.style.display = 'none';
            editButton.style.display = 'block';
            clearErrors();
            notification.classList.remove('show', 'success', 'error');
        });

        // Form submission
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const newNome = document.getElementById('nomeInput').value;
            const newEmail = document.getElementById('emailInput').value;
            const senhaAntiga = document.getElementById('senhaAntigaInput').value;
            const novaSenha = document.getElementById('novaSenhaInput').value;
            const novaSenhaConfirmacao = document.getElementById('novaSenhaConfirmacaoInput').value;

            // Client-side validation
            clearErrors();
            let hasError = false;

            if (!newNome) {
                errorFields.nome_completo.textContent = 'O nome completo é obrigatório.';
                hasError = true;
            }
            if (!newEmail) {
                errorFields.email.textContent = 'O email é obrigatório.';
                hasError = true;
            } else if (!/\S+@\S+\.\S+/.test(newEmail)) {
                errorFields.email.textContent = 'O email deve ser válido.';
                hasError = true;
            }
            if (!senhaAntiga) {
                errorFields.senha_atual.textContent = 'A senha atual é obrigatória.';
                hasError = true;
            }
            if (novaSenha && novaSenha.length < 4) {
                errorFields.nova_senha.textContent = 'A nova senha deve ter pelo menos 4 caracteres.';
                hasError = true;
            }
            if (novaSenha !== novaSenhaConfirmacao) {
                errorFields.nova_senha_confirmation.textContent = 'As novas senhas não coincidem.';
                hasError = true;
            }

            if (hasError) {
                showNotification('Corrija os erros no formulário.', 'error');
                return;
            }

            // Submit to server
            fetch('{{ route("profile.update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    nome_completo: newNome,
                    email: newEmail,
                    senha_atual: senhaAntiga,
                    nova_senha: novaSenha,
                    nova_senha_confirmation: novaSenhaConfirmacao
                })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Erro ao atualizar perfil!');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                    document.getElementById('nomeValue').textContent = newNome;
                    document.getElementById('emailValue').textContent = newEmail;
                    cancelButton.click();
                }
            })
            .catch(error => {
                showNotification(error.message, 'error');
                console.error('Error:', error);
            });
        });

        function showNotification(message, type) {
            notification.textContent = message;
            notification.className = `notification ${type} show`;
            setTimeout(() => notification.classList.remove('show'), 3000);
        }

        function clearErrors() {
            Object.values(errorFields).forEach(field => field.textContent = '');
        }
    });
</script>
@endsection
