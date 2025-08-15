@extends('layouts.app')

@section('title', 'Meu Perfil - Bella Avventura')

@section('styles')
<style>
    @font-face {
        font-family: 'GaramondBold';
        src: local('Garamond'), serif;
        font-weight: bold;
    }

    .profile-container {
        max-width: 800px;
        margin: 0 auto;
        background-color: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border: 3px solid #D8E6D9;
    }

    .profile-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        border-bottom: 2px solid #D8E6D9;
        padding-bottom: 1rem;
    }

    .profile-title {
        font-family: 'GaramondBold', serif;
        color: #5a8f3d;
        font-size: 2rem;
        margin: 0;
    }

    .edit-button {
        background-color: #5a8f3d;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .edit-button:hover {
        background-color: #4a7d2d;
    }

    .profile-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .info-group {
        margin-bottom: 1.5rem;
    }

    .info-label {
        display: block;
        margin-bottom: 0.5rem;
        color: #5a8f3d;
        font-weight: bold;
    }

    .info-value {
        padding: 0.8rem;
        background-color: #f3f7f3;
        border-radius: 8px;
        border: 1px solid #D8E6D9;
    }

    .profile-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
    }

    .action-button {
        padding: 0.8rem 1.5rem;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s;
    }

    .save-button {
        background-color: #5a8f3d;
        color: white;
        border: none;
        display: none;
    }

    .save-button:hover {
        background-color: #4a7d2d;
    }

    .cancel-button {
        background-color: transparent;
        border: 2px solid #d32f2f;
        color: #d32f2f;
        display: none;
    }

    .cancel-button:hover {
        background-color: #ffeeee;
    }

    .edit-form {
        display: none;
    }

    .edit-form input {
        width: 94%;
        padding: 0.8rem;
        border: 2px solid #D8E6D9;
        border-radius: 8px;
        font-size: 1rem;
    }

    @media (max-width: 768px) {
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

    /* Notificação */
    .notification {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        padding: 15px 25px;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        z-index: 1000;
        opacity: 0;
        transition: opacity 0.3s ease, top 0.3s ease;
    }

    .notification.show {
        top: 30px;
        opacity: 1;
    }

    .success {
        background-color: #4CAF50;
    }

    .error {
        background-color: #F44336;
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-5px); }
        100% { transform: translateY(0px); }
    }

    .floating {
        animation: float 3s ease-in-out infinite;
    }
</style>
@endsection

@section('content')
<div id="notification" class="notification"></div>

<div class="main-content">
    <div class="profile-container">
        <div class="profile-header">
            <h1 class="profile-title">Meu Perfil</h1>
            <button id="editButton" class="edit-button">Editar Perfil</button>
        </div>

        <div class="profile-info">
            <div class="info-group">
                <span class="info-label">Nome Completo</span>
                <div id="nomeValue" class="info-value">{{ Auth::user()->name }}</div>
                <div class="edit-form">
                    <input type="text" id="nomeInput" placeholder="Digite seu nome completo" value="{{ Auth::user()->name }}">
                </div>
            </div>

            <div class="info-group" id="cpfGroup">
                <span class="info-label">CPF</span>
                <div id="cpfValue" class="info-value">{{ Auth::user()->cpf }}</div>
            </div>

            <div class="info-group" id="senhaAntigaGroup" style="display: none;">
                <span class="info-label">Senha Atual</span>
                <div class="edit-form" style="display: block;">
                    <input type="password" id="senhaAntigaInput" placeholder="Digite sua senha atual">
                </div>
            </div>

            <div class="info-group">
                <span class="info-label">E-mail</span>
                <div id="emailValue" class="info-value">{{ Auth::user()->email }}</div>
                <div class="edit-form">
                    <input type="email" id="emailInput" placeholder="Digite seu e-mail" value="{{ Auth::user()->email }}">
                </div>
            </div>

            <div class="info-group" id="senhaGroup">
                <span class="info-label">Senha</span>
                <div class="info-value">••••••••</div>
                <div class="edit-form">
                    <input type="password" id="novaSenhaInput" placeholder="Digite sua nova senha">
                </div>
            </div>
        </div>

        <div class="profile-actions">
            <button id="cancelButton" class="action-button cancel-button">Cancelar</button>
            <button id="saveButton" class="action-button save-button">Salvar Alterações</button>
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
        const editForms = document.querySelectorAll('.edit-form');
        const infoValues = document.querySelectorAll('.info-value');

        editButton.addEventListener('click', function() {
            // Mostra formulários e esconde valores
            editForms.forEach(form => form.style.display = 'block');
            infoValues.forEach(value => value.style.display = 'none');

            // Esconde grupo do CPF e mostra grupo da senha antiga em seu lugar
            document.getElementById('cpfGroup').style.display = 'none';
            document.getElementById('senhaAntigaGroup').style.display = 'block';

            // Mostra botões de ação
            cancelButton.style.display = 'block';
            saveButton.style.display = 'block';
            editButton.style.display = 'none';
        });

        cancelButton.addEventListener('click', function() {
            // Esconde formulários e mostra valores
            editForms.forEach(form => form.style.display = 'none');
            infoValues.forEach(value => value.style.display = 'block');

            // Mostra grupo do CPF e esconde grupo da senha antiga
            document.getElementById('cpfGroup').style.display = 'block';
            document.getElementById('senhaAntigaGroup').style.display = 'none';

            // Esconde botões de ação
            cancelButton.style.display = 'none';
            saveButton.style.display = 'none';
            editButton.style.display = 'block';
        });

        saveButton.addEventListener('click', function() {
            const newNome = document.getElementById('nomeInput').value;
            const newEmail = document.getElementById('emailInput').value;
            const senhaAntiga = document.getElementById('senhaAntigaInput').value;
            const novaSenha = document.getElementById('novaSenhaInput').value;

            if (!newNome || !newEmail) {
                showNotification('Preencha todos os campos obrigatórios!', 'error');
                return;
            }

            // Envia os dados para o servidor
            fetch('{{ route("profile.update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    name: newNome,
                    email: newEmail,
                    current_password: senhaAntiga,
                    new_password: novaSenha
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Perfil atualizado com sucesso!', 'success');
                    // Atualiza os valores exibidos
                    document.getElementById('nomeValue').textContent = newNome;
                    document.getElementById('emailValue').textContent = newEmail;
                    // Volta para modo de visualização
                    cancelButton.click();
                } else {
                    showNotification(data.message || 'Erro ao atualizar perfil!', 'error');
                }
            })
            .catch(error => {
                showNotification('Erro ao atualizar perfil!', 'error');
                console.error('Error:', error);
            });
        });

        function showNotification(message, type) {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.className = `notification ${type} show`;

            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }
    });
</script>
@endsection
