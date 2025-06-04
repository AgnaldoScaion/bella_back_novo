<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de feedbacks</title>
</head>
<body>
    <h1>Feedbacks Cadastrados</h1>

    <?php if (empty($feedbacks)): ?>
        <p>Nenhum feedback cadastrado.</p>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID feedback</th>
                    <th>Feedback</th>
                    <th>Estrelas</th>
                    <th>Quantidade de feedbacks</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($feedbacks as $feedback): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($feedback['id_feedback']); ?></td>
                        <td><?php echo htmlspecialchars($feedback['feedback']); ?></td>
                        <td><?php echo htmlspecialchars($feedback['estrelas']); ?></td>
                        <td><?php echo htmlspecialchars($feedback['quantidade_feedbacks']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="/bella_back_novo/public/">Cadastrar novo feedback</a>
</body>
</html>