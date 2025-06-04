<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
</head>
<body>
    <h1>Usuários Cadastrados</h1>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if ($usuarios->isEmpty())
        <p>Nenhum usuário cadastrado.</p>
    @else
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
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id_usuario }}</td>
                        <td>{{ $usuario->nome_completo }}</td>
                        <td>{{ $usuario->data_nascimento }}</td>
                        <td>{{ $usuario->CPF }}</td>
                        <td>{{ $usuario->e_mail }}</td>
                        <td>{{ $usuario->nome_perfil }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <a href="{{ route('usuarios.form') }}">Cadastrar novo usuário</a>
</body>
</html>
