<h2>Cadastro de Pontos</h2>
<?php if (isset($_SESSION['message'])): ?>
    <p style="color: <?php echo $_SESSION['message_type'] === 'error' ? 'red' : 'green'; ?>;">
        <?php echo htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
    </p>
<?php endif; ?>
<form action="/bella_back/public/save-ponto" method="POST">
    <label for="quantidade">Quantidade:</label>
    <input type="text" id="quantidade" name="quantidade" required>
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required>
    <label for="descricao">Descrição:</label>
    <textarea id="descricao" name="descricao" required></textarea>
    <label for="localizacao">Localização:</label>
    <input type="text" id="localizacao" name="localizacao" required>
    <label for="fk_usuario_id_usuario">Usuário:</label>
    <select id="fk_usuario_id_usuario" name="fk_usuario_id_usuario" required>
        <?php
        require_once '../models/usuario.php';
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->getAll();
        foreach ($usuarios as $usuario) {
            echo "<option value='" . htmlspecialchars($usuario['id_usuario']) . "'>" . htmlspecialchars($usuario['nome_completo']) . "</option>";
        }
        ?>
    </select>
    <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
    <input type="submit" value="Cadastrar">
</form>
<a href="/bella_back_novo/public/list-ponto">Ver todos os pontos</a>