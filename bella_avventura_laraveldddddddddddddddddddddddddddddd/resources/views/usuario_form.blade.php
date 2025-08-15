<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
</head>
<body>
    <h1>Cadastro de Usuários</h1>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ route('usuarios.save') }}" method="POST">
        @csrf
        <label for="nome_completo">Nome completo:</label>
        <input type="text" id="nome_completo" name="nome_completo" value="{{ old('nome_completo') }}" required><br><br>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" value="{{ old('data_nascimento') }}" required><br><br>

        <label for="CPF">CPF:</label>
        <input type="text" id="CPF" name="CPF" value="{{ old('CPF') }}" required><br><br>

        <label for="e_mail">Email:</label>
        <input type="email" id="e_mail" name="e_mail" value="{{ old('e_mail') }}" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <label for="nome_perfil">Nome de perfil:</label>
        <input type="text" id="nome_perfil" name="nome_perfil" value="{{ old('nome_perfil') }}"><br><br>

        <input type="submit" value="Cadastrar usuário">
    </form>
    <a href="{{ route('usuarios.list') }}">Ver todos os usuários</a>
</body>
</html>
