<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Restaurantes</title>
</head>
<body>
    <h1>Cadastro de Restaurantes</h1>
    <form action="/bella_back/save-restaurante" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required><br><br>

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" required><br><br>

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" required><br><br>

        <label for="rua">Rua:</label>
        <input type="text" id="rua" name="rua" required><br><br>

        <label for="bairro">Bairro:</label>
        <input type="text" id="bairro" name="bairro"><br><br>

        <label for="numero">Número:</label>
        <input type="number" id="numero" name="numero" required><br><br>

        <label for="horario_funcionamento">Horário de Funcionamento:</label>
        <input type="text" id="horario_funcionamento" name="horario_funcionamento" required><br><br>

        <label for="sobre">Sobre:</label>
        <input type="text" id="sobre" name="sobre" required><br><br>

        <input type="submit" value="Cadastrar restaurante">
    </form>

    <a href="/bella_back_novo/list-restaurante">Ver todos os restaurantes</a>
</body>
</html>