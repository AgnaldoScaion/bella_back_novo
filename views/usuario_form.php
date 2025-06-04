<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
</head>
<body>
    <h1>Cadastro de Usuários</h1>
    <?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
    <?php if (isset($_SESSION['message'])): ?>
        <p style="color: <?php echo $_SESSION['message_type'] === 'error' ? 'red' : 'green'; ?>;">
            <?php echo htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
        </p>
    <?php endif; ?>
    <form action="/bella_back_novo/public/save-usuario/" method="POST">
        <label for="nome_completo">Nome completo:</label>
        <input type="text" id="nome_completo" name="nome_completo" required><br><br>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required><br><br>

        <label for="CPF">CPF:</label>
        <input type="text" id="CPF" name="CPF" required><br><br>

        <label for="e_mail">Email:</label>
        <input type="email" id="e_mail" name="e_mail" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <label for="nome_perfil">Nome de perfil:</label>
        <input type="text" id="nome_perfil" name="nome_perfil"><br><br>

        <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
        <input type="submit" value="Cadastrar usuário">
    </form>

    <a href="/bella_back_novo/public/list-usuario/">Ver todos os usuários</a>
</body>
</html>