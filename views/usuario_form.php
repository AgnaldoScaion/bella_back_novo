<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
</head>
<style>
    /* Reset e configurações básicas */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px;
    line-height: 1.6;
}

/* Container principal */
.container {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    padding: 40px;
    width: 100%;
    max-width: 500px;
    margin: 20px;
}

/* Título */
h1 {
    color: #2c3e50;
    text-align: center;
    margin-bottom: 30px;
    font-size: 2.2em;
    font-weight: 600;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Mensagens de feedback */
.message {
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: 500;
    text-align: center;
    border-left: 4px solid;
}

.message.success {
    background-color: #d4edda;
    color: #155724;
    border-left-color: #28a745;
}

.message.error {
    background-color: #f8d7da;
    color: #721c24;
    border-left-color: #dc3545;
}

/* Formulário */
form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* Grupos de campos */
.field-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

/* Labels */
label {
    font-weight: 600;
    color: #2c3e50;
    font-size: 0.95em;
    margin-bottom: 5px;
}

/* Inputs */
input[type="text"],
input[type="email"],
input[type="password"],
input[type="date"] {
    padding: 12px 16px;
    border: 2px solid #e1e8ed;
    border-radius: 8px;
    font-size: 16px;
    transition: all 0.3s ease;
    background-color: #fff;
    outline: none;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus,
input[type="date"]:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    transform: translateY(-1px);
}

input[type="text"]:hover,
input[type="email"]:hover,
input[type="password"]:hover,
input[type="date"]:hover {
    border-color: #cbd5e0;
}

/* Botão de submit */
input[type="submit"] {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 14px 24px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-top: 10px;
}

input[type="submit"]:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

input[type="submit"]:active {
    transform: translateY(0);
}

/* Link para ver usuários */
.link-container {
    text-align: center;
    margin-top: 25px;
}

a {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    padding: 8px 16px;
    border-radius: 6px;
    transition: all 0.3s ease;
    display: inline-block;
}

a:hover {
    background-color: rgba(102, 126, 234, 0.1);
    transform: translateY(-1px);
}

/* Responsividade */
@media (max-width: 768px) {
    .container {
        padding: 30px 20px;
        margin: 10px;
    }
    
    h1 {
        font-size: 1.8em;
    }
    
    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="date"] {
        font-size: 16px; /* Evita zoom no iOS */
    }
}

@media (max-width: 480px) {
    body {
        padding: 10px;
    }
    
    .container {
        padding: 25px 15px;
    }
    
    h1 {
        font-size: 1.6em;
        margin-bottom: 25px;
    }
}

/* Animações */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.container {
    animation: fadeIn 0.6s ease-out;
}

/* Estilo para campos obrigatórios */
input:required {
    border-left: 3px solid #667eea;
}

input:required:valid {
    border-left-color: #28a745;
}

input:required:invalid:not(:placeholder-shown) {
    border-left-color: #dc3545;
}

/* Melhorias para acessibilidade */
input:focus-visible {
    outline: 2px solid #667eea;
    outline-offset: 2px;
}

/* Estilo para o campo CPF (pode ser usado com máscara JS) */
#CPF {
    letter-spacing: 1px;
}
</style>
<body>
    <div class="container">
        <h1>Cadastro de Usuários</h1>
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message <?php echo $_SESSION['message_type'] === 'error' ? 'error' : 'success'; ?>">
                <?php echo htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
            </div>
        <?php endif; ?>
        
        <form action="/bella_back_novo/public/save-usuario/" method="POST">
            <div class="field-group">
                <label for="nome_completo">Nome completo:</label>
                <input type="text" id="nome_completo" name="nome_completo" required>
            </div>

            <div class="field-group">
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" id="data_nascimento" name="data_nascimento" required>
            </div>

            <div class="field-group">
                <label for="CPF">CPF:</label>
                <input type="text" id="CPF" name="CPF" required placeholder="000.000.000-00">
            </div>

            <div class="field-group">
                <label for="e_mail">Email:</label>
                <input type="email" id="e_mail" name="e_mail" required>
            </div>

            <div class="field-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>

            <div class="field-group">
                <label for="nome_perfil">Nome de perfil:</label>
                <input type="text" id="nome_perfil" name="nome_perfil">
            </div>

            <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
            <input type="submit" value="Cadastrar usuário">
        </form>

        <div class="link-container">
            <a href="/bella_back_novo/public/list-usuario/">Ver todos os usuários</a>
        </div>
    </div>
</body>
</html>