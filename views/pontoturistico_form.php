<h2>Cadastro de Ponto Turístico</h2>
<?php if (isset($_SESSION['message'])): ?>
    <p style="color: <?php echo $_SESSION['message_type'] === 'error' ? 'red' : 'green'; ?>;">
        <?php echo htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
    </p>
<?php endif; ?>
<form action="/bella_back_novo/public/save-pontoturistico/" method="POST">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required>
    <label for="sobre">Sobre:</label>
    <textarea id="sobre" name="sobre" required></textarea>
    <label for="numero">Número:</label>
    <input type="number" id="numero" name="numero" required>
    <label for="rua">Rua:</label>
    <input type="text" id="rua" name="rua" required>
    <label for="bairro">Bairro:</label>
    <input type="text" id="bairro" name="bairro" required>
    <label for="cidade">Cidade:</label>
    <input type="text" id="cidade" name="cidade" required>
    <label for="estado">Estado:</label>
    <input type="text" id="estado" name="estado" required>
    <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
    <input type="submit" value="Cadastrar">
</form>
<a href="/bella_back_novo/public/list-pontoturistico/">Ver todos os pontos turísticos</a>