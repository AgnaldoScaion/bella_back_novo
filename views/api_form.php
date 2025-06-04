<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de APIs</title>
</head>
<body>
    <h1>Cadastro de APIs</h1>
    <form action="/bella_back/save-api" method="POST">
        <label for="nome">Nome da API:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="url">URL:</label>
        <input type="text" id="url" name="url" required><br><br>

        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" required><br><br>

        <input type="submit" value="Cadastrar API">
    </form>

    <a href="/bella_back_novo/list-api">Ver todas as APIs</a>
</body>
</html>