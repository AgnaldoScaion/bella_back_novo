<h2>Hotéis Cadastrados</h2>
<?php if (isset($_SESSION['message'])): ?>
    <p style="color: <?php echo $_SESSION['message_type'] === 'error' ? 'red' : 'green'; ?>;">
        <?php echo htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
    </p>
<?php endif; ?>
<?php if (empty($hoteis)): ?>
    <p>Nenhum hotel cadastrado.</p>
<?php else: ?>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Hotel</th>
                <th>Estado</th>
                <th>Cidade</th>
                <th>Bairro</th>
                <th>Rua</th>
                <th>Número</th>
                <th>Telefone</th>
                <th>Horário de Funcionamento</th>
                <th>Sobre</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hoteis as $hotel): ?>
                <tr>
                    <td><?php echo htmlspecialchars($hotel['id_hotel']); ?></td>
                    <td><?php echo htmlspecialchars($hotel['nome_hotel']); ?></td>
                    <td><?php echo htmlspecialchars($hotel['estado']); ?></td>
                    <td><?php echo htmlspecialchars($hotel['cidade']); ?></td>
                    <td><?php echo htmlspecialchars($hotel['bairro']); ?></td>
                    <td><?php echo htmlspecialchars($hotel['rua']); ?></td>
                    <td><?php echo htmlspecialchars($hotel['numero']); ?></td>
                    <td><?php echo htmlspecialchars($hotel['telefone']); ?></td>
                    <td><?php echo htmlspecialchars($hotel['horario_funcionamento']); ?></td>
                    <td><?php echo htmlspecialchars($hotel['sobre']); ?></td>
                    <td>
                        <a href="/bella_back/public/edit-hotel?id=<?php echo $hotel['id_hotel']; ?>">Editar</a>
                        <form action="/bella_back/public/delete-hotel" method="GET" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $hotel['id_hotel']; ?>">
                            <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                            <input type="submit" value="Excluir" onclick="return confirm('Tem certeza que deseja excluir?');">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<a href="/bella_back_novo/public/hotel_form">Cadastrar novo hotel</a>