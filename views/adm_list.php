<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de ADMs</title>
</head>
<body>
    <h1>ADMs Cadastrados</h1>

    <?php if (empty($adms)): ?>
        <p>Nenhum ADM cadastrado.</p>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome Completo</th>
                    <th>Data de Nascimento</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th>Nome de Perfil</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($adms as $adm): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($adm['id_adm']); ?></td>
                        <td><?php echo htmlspecialchars($adm['nome_completo']); ?></td>
                        <td><?php echo htmlspecialchars($adm['data_nascimento']); ?></td>
                        <td><?php echo htmlspecialchars($adm['CPF']); ?></td>
                        <td><?php echo htmlspecialchars($adm['e_mail']); ?></td>
                        <td><?php echo htmlspecialchars($adm['nome_perfil']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="/bella_back_novo/public/">Cadastrar novo ADM</a>
</body>
</html>