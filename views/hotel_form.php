<h2>Cadastro de Hotéis</h2>
<?php if (isset($_SESSION['message'])): ?>
    <p style="color: <?php echo $_SESSION['message_type'] === 'error' ? 'red' : 'green'; ?>;">
        <?php echo htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
    </p>
<?php endif; ?>
<form action="/bella_back/public/save-hotel" method="POST">
    <label for="nome_hotel">Nome do hotel:</label>
    <input type="text" id="nome_hotel" name="nome_hotel" required>
    <label for="estado">Estado:</label>
    <input type="text" id="estado" name="estado" required>
    <label for="cidade">Cidade:</label>
    <input type="text" id="cidade" name="cidade" required>
    <label for="bairro">Bairro:</label>
    <input type="text" id="bairro" name="bairro" required>
    <label for="rua">Rua:</label>
    <input type="text" id="rua" name="rua" required>
    <label for="numero">Número:</label>
    <input type="number" id="numero" name="numero" required>
    <label for="telefone">Telefone:</label>
    <input type="text" id="telefone" name="telefone">
    <label for="horario_funcionamento">Horário de Funcionamento:</label>
    <input type="text" id="horario_funcionamento" name="horario_funcionamento">
    <label for="sobre">Sobre:</label>
    <textarea id="sobre" name="sobre"></textarea>
    <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
    <input type="submit" value="Cadastrar">
</form>
<a href="/bella_back_novo/public/list-hotel">Ver todos os hotéis</a>