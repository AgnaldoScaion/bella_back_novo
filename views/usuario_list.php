<h2>Usuários Cadastrados</h2>
<?php if (isset($_SESSION['message'])): ?>
    <p style="color: <?php echo $_SESSION['message_type'] === 'error' ? 'red' : 'green'; ?>;">
        <?php echo htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
    </p>
<?php endif; ?>
<?php if (empty($usuarios)): ?>
    <p>Nenhum usuário cadastrado.</p>
<?php else: ?>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome Completo</th>
                <th>Data de Nascimento</th>
                <th>CPF</th>
                <th>Email</th>
                <th>Nome de Perfil</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo htmlspecialchars($usuario['id_usuario']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['nome_completo']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['data_nascimento']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['CPF']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['e_mail']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['nome_perfil']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<a href="/bella_back_novo/public/usuario_form/">Cadastrar novo usuário</a>