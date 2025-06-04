<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de feedbacks</title>
</head>
<body>
    <h1>Cadastro de feedbacks</h1>
    <form action="/bella_back/save-feedback" method="POST">
        <label for="feedback">Feedback:</label>
        <input type="text" id="feedback" name="feedback" required><br><br>

        <label for="estrelas">Estrelas:</label>
        <input type="number" id="estrelas" name="estrelas" required><br><br>

        <label for="quantidade_feedbacks">Quantidade de feedbacks:</label>
        <input type="number" id="quantidade_feedbacks" name="quantidade_feedbacks" required><br><br>

        <input type="submit" value="Cadastrar feedback">
    </form>

    <a href="/bella_back_novo/list-feedback">Ver todos os feedbacks</a>
</body>
</html>