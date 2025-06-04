<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Restaurantes</title>
</head>
<body>
    <h1>Restaurantes Cadastrados</h1>

    <?php if (empty($restaurantes)): ?>
        <p>Nenhum restaurante cadastrado.</p>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Estado</th>
                    <th>Cidade</th>
                    <th>Rua</th>
                    <th>Bairro</th>
                    <th>Número</th>
                    <th>Horário de Funcionamento</th>
                    <th>Sobre</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($restaurantes as $restaurante): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($restaurante['id_restaurante']); ?></td>
                        <td><?php echo htmlspecialchars($restaurante['nome']); ?></td>
                        <td><?php echo htmlspecialchars($restaurante['telefone']); ?></td>
                        <td><?php echo htmlspecialchars($restaurante['estado']); ?></td>
                        <td><?php echo htmlspecialchars($restaurante['cidade']); ?></td>
                        <td><?php echo htmlspecialchars($restaurante['rua']); ?></td>
                        <td><?php echo htmlspecialchars($restaurante['bairro']); ?></td>
                        <td><?php echo htmlspecialchars($restaurante['numero']); ?></td>
                        <td><?php echo htmlspecialchars($restaurante['horario_funcionamento']); ?></td>
                        <td><?php echo htmlspecialchars($restaurante['sobre']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="/bella_back_novo/public/">Cadastrar novo restaurante</a>
</body>
</html>