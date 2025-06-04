<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
</head>
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