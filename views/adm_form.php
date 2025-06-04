<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de ADMs</title>
</head>
<body>
    <h1>Cadastro de ADMs</h1>
    <form action="/bella_back/save-adm" method="POST">
        <label for="nome_completo">Nome completo:</label>
        <input type="text" id="nome_completo" name="nome_completo" required><br><br>

        <label for="data_nascimento">Data de nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required><br><br>

        <label for="CPF">CPF:</label>
        <input type="text" id="CPF" name="CPF" required><br><br>

        <label for="e_mail">E-mail:</label>
        <input type="email" id="e_mail" name="e_mail" required><br><br>

        <label for="senha_adm">Senha ADM:</label>
        <input type="password" id="senha_adm" name="senha_adm" required><br><br>

        <label for="nome_perfil">Nome de perfil:</label>
        <input type="text" id="nome_perfil" name="nome_perfil" required><br><br>

        <input type="submit" value="Cadastrar ADM">
    </form>

    <a href="/bella_back_novo/list-adm">Ver todos os ADMs</a>
</body>
</html>