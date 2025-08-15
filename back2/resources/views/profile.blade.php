```php
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - Bella Avventura</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="https://i.ibb.co/vx2Dzj/image.png">
    <style>
        @font-face {
            font-family: 'GaramondBold';
            src: local('Garamond'), serif;
            font-weight: bold;
        }

        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            display: flex;
            flex-direction: column;
            background-color: #f3f7f3;
        }

        .wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
            padding: 2.4rem;
        }

        .header {
            background-color: #A7D096;
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
            background-color: #A7D096;
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

        .footer {
            background-color: #A7D096;
            padding: 20px;
            color: #000;
            font-size: 14px;
            text-align: center;
        }

        .footer-top {
            margin-bottom: 15px;
        }

        .footer-top img {
            width: 15%;
            height: auto;
            transition: transform 0.5s ease;
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
            transition: all 0.3s ease;
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
            color: black;
            transition: color 0.3s ease;
        }

        .footer-bottom a:hover {
            color: #5a8f3d;
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

        @media (max-width: 600px) {
            .header-img img {
                height: 100px;
                top: -30px;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }

            .footer-left,
            .footer-center,
            .footer-right {
                text-align: center;
            }
        }

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
            transition: opacity 0.3s ease, top: 0.3s ease;
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
                0% { transform: translate(-50%, 0px); }
                50% { transform: translate(-50%, -5px); }
                100% { transform: translate(-50%, 0px); }
            }

            .floating {
                animation: float 3s ease-in-out infinite;
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
                <span>👤</span> {{ auth()->user()->nome_completo }}
            </div>
        </div>

        <div class="header">
            <div class="header-img">
                <a href="{{ route('home') }}">
                    <img src="https://i.ibb.co/Q7T008b/image.png" alt="Logo" class="floating" />
                </a>
            </div>
        </div>

        <!-- Menu -->
        @include('components.menu-logado')

        <!-- Notificação -->
        <div id="notification" class="notification @if(session('success')) success @elseif($errors->any()) error @endif">
            @if(session('success'))
                {{ session('success') }}
            @elseif($errors->any())
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            @endif
        </div>

        <!-- Conteúdo -->
        <main class="main-content">
            <div class="profile-container">
                <div class="profile-header">
                    <h1 class="profile-title">Meu Perfil</h1>
                    <button id="editButton" class="edit-button">Editar Perfil</button>
                </div>

                <form id="profileForm" action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="profile-info">
                        <div class="info-group">
                            <span class="info-label">Nome Completo</span>
                            <div id="nomeValue" class="info-value">{{ auth()->user()->nome_completo }}</div>
                            <div class="edit-form">
                                <input type="text" id="nomeInput" name="nome_completo" value="{{ old('nome_completo', auth()->user()->nome_completo) }}" placeholder="Digite seu nome completo">
                                @error('nome_completo')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="info-group" id="cpfGroup">
                            <span class="info-label">CPF</span>
                            <div id="cpfValue" class="info-value">{{ preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', auth()->user()->CPF) }}</div>
                        </div>

                        <div class="info-group" id="senhaAntigaGroup" style="display: none;">
                            <span class="info-label">Senha Atual</span>
                            <div class="edit-form" style="display: block;">
                                <input type="password" id="senhaAntigaInput" name="senha_atual" placeholder="Digite sua senha atual">
                                @error('senha_atual')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="info-group">
                            <span class="info-label">E-mail</span>
                            <div id="emailValue" class="info-value">{{ auth()->user()->e_mail }}</div>
                            <div class="edit-form">
                                <input type="email" id="emailInput" name="email" value="{{ old('email', auth()->user()->e_mail) }}" placeholder="Digite seu e-mail">
                                @error('email')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="info-group" id="senhaGroup">
                            <span class="info-label">Senha</span>
                            <div class="info-value">••••••••</div>
                            <div class="edit-form">
                                <input type="password" id="novaSenhaInput" name="nova_senha" placeholder="Digite sua nova senha">
                                @error('nova_senha')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="info-group" id="senhaConfirmacaoGroup" style="display: none;">
                            <span class="info-label">Confirmar Nova Senha</span>
                            <div class="edit-form" style="display: block;">
                                <input type="password" id="novaSenhaConfirmacaoInput" name="nova_senha_confirmation" placeholder="Confirme sua nova senha">
                                @error('nova_senha_confirmation')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="profile-actions">
                        <button type="button" id="cancelButton" class="
