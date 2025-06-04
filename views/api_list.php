<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de APIs</title>
</head>
<body>
    <h1>APIs Cadastradas</h1>

    <?php if (empty($apis)): ?>
        <p>Nenhuma API cadastrada.</p>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>URL</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($apis as $api): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($api['id_api']); ?></td>
                        <td><?php echo htmlspecialchars($api['nome']); ?></td>
                        <td><?php echo htmlspecialchars($api['url']); ?></td>
                        <td><?php echo htmlspecialchars($api['descricao']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="/bella_back_novo/public/">Cadastrar nova API</a>
</body>
</html>