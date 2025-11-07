{{-- resources/views/profile/edit.blade.php --}}
@extends('layouts.app')
@section('title', 'Meu Perfil - Bella Avventura')

@section('styles')
<style>
    :root {
        --cor-primaria: #5a8f3d;
        --cor-primaria-escura: #2d5016;
        --cor-fundo: #f3f7f3;
        --cor-borda: #D8E6D9;
        --cor-texto: #333;
        --cor-erro: #e74c3c;
        --cor-sucesso: #27ae60;
        --cor-aviso: #f39c12;
        --radius: 12px;
        --sombra: 0 4px 12px rgba(0,0,0,0.08);
        --transicao: all 0.25s ease;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
        font-family: 'Garamond', serif;
        background: linear-gradient(135deg, #f3f7f3 0%, #e8f3e8 100%);
        color: var(--cor-texto);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .container {
        flex: 1;
        padding: 2rem 1rem;
        display: flex;
        justify-content: center;
    }

    .perfil-card {
        background: white;
        border-radius: var(--radius);
        padding: 2rem;
        width: 100%;
        max-width: 900px;
        box-shadow: var(--sombra);
        border: 2px solid var(--cor-borda);
    }

    .cabecalho {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--cor-borda);
    }

    .titulo {
        font-family: 'Garamond', serif;
        font-size: 1.8rem;
        color: var(--cor-primaria-escura);
        margin: 0;
    }

    .modo-edicao {
        font-size: 0.85rem;
        color: var(--cor-aviso);
        font-weight: 600;
        display: none;
        align-items: center;
        gap: 0.4rem;
    }
    .modo-edicao.ativo { display: flex; }

    .btn {
        padding: 0.7rem 1.4rem;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transicao);
        font-size: 0.95rem;
    }

    .btn-editar {
        background: var(--cor-primaria);
        color: white;
    }
    .btn-editar:hover { background: #4a7d2d; transform: translateY(-1px); }

    .secao {
        margin-bottom: 1.8rem;
        padding: 1.3rem;
        background: #fafafa;
        border-radius: 10px;
        border: 1px solid var(--cor-borda);
    }

    .secao-titulo {
        font-family: 'Garamond', serif;
        color: var(--cor-primaria-escura);
        font-size: 1.4rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.2rem;
    }

    .campo {
        margin-bottom: 0.8rem;
    }

    .label {
        display: block;
        margin-bottom: 0.4rem;
        font-weight: 600;
        color: var(--cor-primaria);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .valor {
        padding: 0.8rem 1rem;
        background: white;
        border: 1px solid var(--cor-borda);
        border-radius: 10px;
        min-height: 44px;
        display: flex;
        align-items: center;
        font-size: 0.95rem;
    }

    .input-edicao {
        display: none;
        position: relative;
    }
    .input-edicao.mostrando { display: block; }

    .input-edicao input {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1px solid var(--cor-borda);
        border-radius: 10px;
        font-size: 0.95rem;
        transition: var(--transicao);
    }
    .input-edicao input:focus {
        outline: none;
        border-color: var(--cor-primaria);
        box-shadow: 0 0 0 3px rgba(90,143,61,0.15);
    }

    .senha-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: var(--cor-primaria);
        font-size: 1.1rem;
    }

    .erro {
        color: var(--cor-erro);
        font-size: 0.8rem;
        margin-top: 0.3rem;
        display: none;
    }
    .erro.mostrando { display: block; }

    .ajuda {
        font-size: 0.75rem;
        color: #666;
        margin-top: 0.3rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .forca-senha {
        font-size: 0.8rem;
        font-weight: 600;
        margin-top: 0.4rem;
        display: none;
    }
    .forca-senha.ativa { display: block; }
    .forca-senha.fraca { color: var(--cor-erro); }
    .forca-senha.media { color: var(--cor-aviso); }
    .forca-senha.forte { color: var(--cor-sucesso); }

    .acoes {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 1.5rem;
        padding-top: 1.2rem;
        border-top: 1px solid var(--cor-borda);
    }

    .btn-cancelar {
        background: #f5f5f5;
        color: #555;
        border: 1px solid var(--cor-borda);
    }
    .btn-cancelar:hover { background: #eaeaea; }

    .btn-salvar {
        background: var(--cor-primaria);
        color: white;
        display: none;
    }
    .btn-salvar:hover { background: #4a7d2d; }
    .btn-salvar:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 10000;
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-width: 380px;
    }

    .toast {
        background: white;
        padding: 14px 18px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        gap: 12px;
        transform: translateX(120%);
        opacity: 0;
        transition: all 0.3s ease;
    }
    .toast.mostrando {
        transform: translateX(0);
        opacity: 1;
    }

    .toast.sucesso { border-left: 5px solid var(--cor-sucesso); }
    .toast.erro { border-left: 5px solid var(--cor-erro); }
    .toast.aviso { border-left: 5px solid var(--cor-aviso); }

    .toast-icone { font-size: 1.4rem; }
    .toast-texto { flex: 1; }
    .toast-titulo { font-weight: 600; font-size: 0.95rem; }
    .toast-mensagem { font-size: 0.85rem; color: #555; }
    .toast-fechar { cursor: pointer; opacity: 0.7; }
    .toast-fechar:hover { opacity: 1; }

    .carregando {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.4);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        backdrop-filter: blur(3px);
    }
    .carregando.ativo { display: flex; }
    .spinner {
        width: 50px;
        height: 50px;
        border: 4px solid #ddd;
        border-top-color: var(--cor-primaria);
        border-radius: 50%;
        animation: girar 1s linear infinite;
    }
    @keyframes girar { to { transform: rotate(360deg); } }

    @media (max-width: 768px) {
        .grid { grid-template-columns: 1fr; }
        .acoes { flex-direction: column; }
        .btn { width: 100%; }
        .toast-container { left: 10px; right: 10px; }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="perfil-card">
        <div class="cabecalho">
            <div>
                <h1 class="titulo">Meu Perfil</h1>
                <div class="modo-edicao" id="modoEdicao">
                    Edição ativa
                </div>
            </div>
            <button id="botaoEditar" class="btn btn-editar">Editar Perfil</button>
        </div>

        <form id="formPerfil">
            @csrf

            <!-- Dados Pessoais -->
            <div class="secao">
                <h2 class="secao-titulo">Informações Pessoais</h2>
                <div class="grid">
                    <div class="campo">
                        <label class="label">Nome Completo</label>
                        <div id="valorNome" class="valor">{{ Auth::user()->nome_completo ?? '' }}</div>
                        <div class="input-edicao" id="inputNome">
                            <input type="text" name="nome_completo" value="{{ Auth::user()->nome_completo ?? '' }}" placeholder="Seu nome completo">
                            <span class="erro" id="erroNome"></span>
                        </div>
                    </div>
                    <div class="campo">
                        <label class="label">CPF</label>
                        <div id="valorCPF" class="valor">{{ Auth::user()->CPF ?? '' }}</div>
                        <div class="ajuda">CPF não pode ser alterado</div>
                    </div>
                </div>
            </div>

            <!-- Conta -->
            <div class="secao">
                <h2 class="secao-titulo">Conta</h2>
                <div class="grid">
                    <div class="campo">
                        <label class="label">E-mail</label>
                        <div id="valorEmail" class="valor">{{ Auth::user()->email ?? '' }}</div>
                        <div class="input-edicao" id="inputEmail">
                            <input type="email" name="email" value="{{ Auth::user()->email ?? '' }}" placeholder="seu@email.com">
                            <span class="erro" id="erroEmail"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Senha (oculta até edição) -->
            <div class="secao" id="secaoSenha" style="display: none;">
                <h2 class="secao-titulo">Alterar Senha</h2>
                <div class="grid">
                    <div class="campo">
                        <label class="label">Senha Atual</label>
                        <div class="input-edicao mostrando">
                            <input type="password" id="senhaAtual" name="senha_atual" placeholder="Para confirmar alterações">
                            <span class="senha-toggle" onclick="alternarSenha('senhaAtual')">Mostrar</span>
                            <span class="erro" id="erroSenhaAtual"></span>
                            <div class="ajuda">Obrigatório para salvar</div>
                        </div>
                    </div>
                    <div class="campo">
                        <label class="label">Nova Senha</label>
                        <div class="input-edicao mostrando">
                            <input type="password" id="novaSenha" name="nova_senha" placeholder="Opcional">
                            <span class="senha-toggle" onclick="alternarSenha('novaSenha')">Mostrar</span>
                            <div class="forca-senha" id="forcaSenha"></div>
                            <span class="erro" id="erroNovaSenha"></span>
                        </div>
                    </div>
                    <div class="campo">
                        <label class="label">Confirmar Nova Senha</label>
                        <div class="input-edicao mostrando">
                            <input type="password" id="confirmaSenha" name="nova_senha_confirmation" placeholder="Repita a nova senha">
                            <span class="senha-toggle" onclick="alternarSenha('confirmaSenha')">Mostrar</span>
                            <span class="erro" id="erroConfirma"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="acoes">
                <button type="button" id="botaoCancelar" class="btn btn-cancelar" style="display: none;">Cancelar</button>
                <button type="submit" id="botaoSalvar" class="btn btn-salvar" style="display: none;">Salvar Alterações</button>
            </div>
        </form>
    </div>
</div>

<div class="toast-container" id="toastContainer"></div>
<div class="carregando" id="carregando">
    <div class="spinner"></div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const botaoEditar = document.getElementById('botaoEditar');
        const botaoCancelar = document.getElementById('botaoCancelar');
        const botaoSalvar = document.getElementById('botaoSalvar');
        const form = document.getElementById('formPerfil');
        const modoEdicao = document.getElementById('modoEdicao');
        const secaoSenha = document.getElementById('secaoSenha');

        const campos = {
            nome: { valor: 'valorNome', input: 'inputNome', erro: 'erroNome' },
            email: { valor: 'valorEmail', input: 'inputEmail', erro: 'erroEmail' },
            senhaAtual: { erro: 'erroSenhaAtual' },
            novaSenha: { erro: 'erroNovaSenha' },
            confirma: { erro: 'erroConfirma' }
        };

        // Mensagens de sessão
        @if(session('success'))
            mostrarToast('Sucesso', '{{ session('success') }}', 'sucesso');
        @endif
        @if($errors->any())
            mostrarToast('Erro', '{{ $errors->first() }}', 'erro');
        @endif

        botaoEditar.addEventListener('click', () => {
            entrarEdicao();
            mostrarToast('Modo Edição', 'Altere os campos e salve.', 'aviso');
        });

        botaoCancelar.addEventListener('click', sairEdicao);

        // Força da senha
        document.getElementById('novaSenha').addEventListener('input', function() {
            const forca = document.getElementById('forcaSenha');
            const senha = this.value;
            if (!senha) { forca.classList.remove('ativa'); return; }

            let pontos = 0;
            if (senha.length >= 8) pontos++;
            if (/[a-z]/.test(senha)) pontos++;
            if (/[A-Z]/.test(senha)) pontos++;
            if (/\d/.test(senha)) pontos++;
            if (/[\W_]/.test(senha)) pontos++;

            forca.classList.add('ativa');
            forca.classList.remove('fraca', 'media', 'forte');
            if (pontos <= 2) forca.classList.add('fraca'), forca.innerHTML = 'Fraca';
            else if (pontos <= 3) forca.classList.add('media'), forca.innerHTML = 'Média';
            else forca.classList.add('forte'), forca.innerHTML = 'Forte';
        });

        // Envio do formulário
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            limparErros();

            const dados = {
                nome_completo: document.querySelector('[name="nome_completo"]').value.trim(),
                email: document.querySelector('[name="email"]').value.trim(),
                senha_atual: document.getElementById('senhaAtual').value,
                nova_senha: document.getElementById('novaSenha').value,
                nova_senha_confirmation: document.getElementById('confirmaSenha').value
            };

            let erros = false;

            if (!dados.nome_completo) { erro('nome', 'Nome é obrigatório'); erros = true; }
            if (!dados.email) { erro('email', 'E-mail é obrigatório'); erros = true; }
            else if (!/\S+@\S+\.\S+/.test(dados.email)) { erro('email', 'E-mail inválido'); erros = true; }
            if (!dados.senha_atual) { erro('senhaAtual', 'Senha atual é obrigatória'); erros = true; }
            if (dados.nova_senha && dados.nova_senha.length < 4) { erro('novaSenha', 'Mínimo 4 caracteres'); erros = true; }
            if (dados.nova_senha !== dados.nova_senha_confirmation) { erro('confirma', 'Senhas não coincidem'); erros = true; }

            if (erros) {
                mostrarToast('Erro', 'Corrija os campos destacados.', 'erro');
                return;
            }

            mostrarCarregando();
            botaoSalvar.disabled = true;

            try {
                const res = await fetch('{{ route("profile.update") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(dados)
                });

                const json = await res.json();

                if (!res.ok) throw new Error(json.message || 'Erro ao salvar');

                document.getElementById('valorNome').textContent = dados.nome_completo;
                document.getElementById('valorEmail').textContent = dados.email;

                sairEdicao();
                mostrarToast('Sucesso', json.message || 'Perfil atualizado!', 'sucesso');

                document.getElementById('senhaAtual').value = '';
                document.getElementById('novaSenha').value = '';
                document.getElementById('confirmaSenha').value = '';
            } catch (err) {
                mostrarToast('Erro', err.message, 'erro');
            } finally {
                esconderCarregando();
                botaoSalvar.disabled = false;
            }
        });

        function entrarEdicao() {
            document.querySelectorAll('.input-edicao').forEach(el => el.classList.add('mostrando'));
            document.querySelectorAll('.valor').forEach(el => el.style.display = 'none');
            secaoSenha.style.display = 'block';
            botaoCancelar.style.display = 'block';
            botaoSalvar.style.display = 'block';
            botaoEditar.style.display = 'none';
            modoEdicao.classList.add('ativo');
        }

        function sairEdicao() {
            document.querySelectorAll('.input-edicao').forEach(el => el.classList.remove('mostrando'));
            document.querySelectorAll('.valor').forEach(el => el.style.display = 'flex');
            secaoSenha.style.display = 'none';
            botaoCancelar.style.display = 'none';
            botaoSalvar.style.display = 'none';
            botaoEditar.style.display = 'block';
            modoEdicao.classList.remove('ativo');
            limparErros();
        }

        function erro(campo, msg) {
            const el = document.getElementById(campos[campo]?.erro || `erro${campo.charAt(0).toUpperCase() + campo.slice(1)}`);
            if (el) {
                el.textContent = msg;
                el.classList.add('mostrando');
            }
        }

        function limparErros() {
            document.querySelectorAll('.erro').forEach(el => {
                el.textContent = '';
                el.classList.remove('mostrando');
            });
        }

        function mostrarToast(titulo, msg, tipo) {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${tipo}`;
            toast.innerHTML = `
                <span class="toast-icone">${tipo === 'sucesso' ? 'Check' : tipo === 'erro' ? 'Error' : 'Warning'}</span>
                <div class="toast-texto">
                    <div class="toast-titulo">${titulo}</div>
                    <div class="toast-mensagem">${msg}</div>
                </div>
                <span class="toast-fechar" onclick="this.parentElement.remove()">×</span>
            `;
            container.appendChild(toast);
            setTimeout(() => toast.classList.add('mostrando'), 50);
            setTimeout(() => toast.remove(), 5000);
        }

        function mostrarCarregando() { document.getElementById('carregando').classList.add('ativo'); }
        function esconderCarregando() { document.getElementById('carregando').classList.remove('ativo'); }
    });

    function alternarSenha(id) {
        const input = document.getElementById(id);
        const botao = input.nextElementSibling;
        if (input.type === 'password') {
            input.type = 'text';
            botao.textContent = 'Esconder';
        } else {
            input.type = 'password';
            botao.textContent = 'Mostrar';
        }
    }

    window.addEventListener('load', () => {
        const cpf = document.getElementById('valorCPF').textContent;
        if (cpf.length === 11) {
            document.getElementById('valorCPF').textContent = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
        }
    });
</script>
@endsection
