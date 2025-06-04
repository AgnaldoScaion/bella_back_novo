<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Viagens</title>
</head>
<body>
    <h1>Viagens Cadastradas</h1>

    <?php if (empty($viagens)): ?>
        <p>Nenhuma viagem cadastrada.</p>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Destino</th>
                    <th>Data de início</th>
                    <th>Data de fim</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($viagens as $viagem): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($viagem['id_viagem']); ?></td>
                        <td><?php echo htmlspecialchars($viagem['nome']); ?></td>
                        <td><?php echo htmlspecialchars($viagem['destino']); ?></td>
                        <td><?php echo htmlspecialchars($viagem['data_inicio']); ?></td>
                        <td><?php echo htmlspecialchars($viagem['data_fim']); ?></td>
                        <td><?php echo htmlspecialchars($viagem['descricao']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="/bella_back_novo/public/">Cadastrar nova viagem</a>
</body>
</html>