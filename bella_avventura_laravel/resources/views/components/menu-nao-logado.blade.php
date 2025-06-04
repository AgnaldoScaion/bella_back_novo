<div id="menu-nao-logado" class="menu-box hidden">
    <div class="menu-lateral"></div>
    <div class="menu-conteudo">
        <h2>MENU</h2>
        <ul>
            <li><a href="{{ route('register') }}">Fazer cadastro</a></li>
            <li><a href="{{ route('login') }}">Logar na conta</a></li>
            <li><a href="{{ route('sobre-nos') }}">Sobre nós</a></li>
        </ul>
    </div>
</div>

<style>
    .menu-box {
        position: absolute;
        top: 50px;
        left: 20px;
        background-color: #d6e3d6;
        border-radius: 8px;
        padding: 20px;
        width: 260px;
        display: flex;
        gap: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        font-family: 'Garamond', serif;
        z-index: 10;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .menu-lateral {
        background-color: #88b68b;
        width: 24px;
        border-radius: 8px;
    }

    .menu-conteudo {
        flex: 1;
    }

    .menu-conteudo h2 {
        font-size: 20px;
        margin: 0;
        border-bottom: 1px solid #999;
        padding-bottom: 10px;
    }

    .menu-conteudo ul {
        list-style: none;
        padding: 0;
        margin-top: 15px;
    }

    .menu-conteudo li {
        margin: 15px 0;
    }

    .menu-conteudo a {
        text-decoration: none;
        color: black;
        transition: color 0.2s;
    }

    .menu-conteudo a:hover {
        color: #3a6545;
    }

    .hidden {
        visibility: hidden;
        opacity: 0;
        pointer-events: none;
    }

    .visible {
        visibility: visible;
        opacity: 1;
        pointer-events: auto;
    }
</style>
