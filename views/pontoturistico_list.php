<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pontos Turísticos</title>
</head>
<body>
    <h1>Pontos Turísticos Cadastrados</h1>

    <?php if (empty($pontos_turisticos)): ?>
        <p>Nenhum ponto turístico cadastrado.</p>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Sobre</th>
                    <th>Número</th>
                    <th>Rua</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pontos_turisticos as $ponto_turistico): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($ponto_turistico['id_pontoturistico']); ?></td>
                        <td><?php echo htmlspecialchars($ponto_turistico['nome']); ?></td>
                        <td><?php echo htmlspecialchars($ponto_turistico['sobre']); ?></td>
                        <td><?php echo htmlspecialchars($ponto_turistico['numero']); ?></td>
                        <td><?php echo htmlspecialchars($ponto_turistico['rua']); ?></td>
                        <td><?php echo htmlspecialchars($ponto_turistico['bairro']); ?></td>
                        <td><?php echo htmlspecialchars($ponto_turistico['cidade']); ?></td>
                        <td><?php echo htmlspecialchars($ponto_turistico['estado']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="/bella_back_novo/public/">Cadastrar novo ponto turístico</a>
</body>
</html>