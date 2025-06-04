<h2>Pontos Cadastrados</h2>
<?php if (isset($_SESSION['message'])): ?>
    <p style="color: <?php echo $_SESSION['message_type'] === 'error' ? 'red' : 'green'; ?>;">
        <?php echo htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
    </p>
<?php endif; ?>
<?php if (empty($pontos)): ?>
    <p>Nenhum ponto cadastrado.</p>
<?php else: ?>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Localização</th>
                <th>Quantidade</th>
                <th>Usuário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../models/usuario.php';
            $usuarioModel = new Usuario();
            $usuarios = array_column($usuarioModel->getAll(), 'nome_completo', 'id_usuario');
            foreach ($pontos as $ponto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($ponto['id_pontos']); ?></td>
                    <td><?php echo htmlspecialchars($ponto['nome']); ?></td>
                    <td><?php echo htmlspecialchars($ponto['descricao']); ?></td>
                    <td><?php echo htmlspecialchars($ponto['localizacao']); ?></td>
                    <td><?php echo htmlspecialchars($ponto['quantidade']); ?></td>
                    <td><?php echo htmlspecialchars($usuarios[$ponto['fk_usuario_id_usuario']] ?? 'Desconhecido'); ?></td>
                    <td>
                        <a href="/bella_back/public/edit-ponto?id=<?php echo $ponto['id_pontos']; ?>">Editar</a>
                        <form action="/bella_back/public/delete-ponto" method="GET" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $ponto['id_pontos']; ?>">
                            <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                            <input type="submit" value="Excluir" onclick="return confirm('Tem certeza que deseja excluir?');">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<a href="/bella_back_novo/public/ponto_form">Cadastrar novo ponto</a>