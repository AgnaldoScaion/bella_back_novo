<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Viagens</title>
</head>
<body>
    <h1>Cadastro de Viagens</h1>
    <form action="/bella_back/save-viagem" method="POST">
        <label for="nome">Nome da viagem:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="destino">Destino:</label>
        <input type="text" id="destino" name="destino" required><br><br>

        <label for="data_inicio">Data de início:</label>
        <input type="date" id="data_inicio" name="data_inicio" required><br><br>

        <label for="data_fim">Data de fim:</label>
        <input type="date" id="data_fim" name="data_fim" required><br><br>

        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" required><br><br>

        <input type="submit" value="Cadastrar viagem">
    </form>

    <a href="/bella_back_novo/list-viagem">Ver todas as viagens</a>
</body>
</html>