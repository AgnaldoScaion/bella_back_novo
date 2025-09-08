```blade
@extends('layouts.app')
@section('title', 'Restaurantes - Bella Avventura')
@section('styles')
<style>
    @font-face {
        font-family: 'GaramondBold';
        src: local('Garamond'), serif;
        font-weight: bold;
    }
    :root {
        --primary-color: #2d5016;
        --primary-light: #5a8f3d;
        --primary-bg: #f3f7f3;
        --accent-color: #A7D096;
        --border-color: #E5F2E5;
        --text-dark: #1a1a1a;
        --text-medium: #4a4a4a;
        --text-light: #ffffff;
        --shadow-soft: 0 2px 15px rgba(45, 80, 22, 0.08);
        --shadow-medium: 0 8px 30px rgba(45, 80, 22, 0.12);
        --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        --border-radius: 16px;
        --border-radius-small: 8px;
    }
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    html {
        scroll-behavior: smooth;
    }
    body {
        font-family: 'Inter', sans-serif;
        line-height: 1.6;
        color: var(--text-dark);
        background-color: var(--primary-bg);
        overflow-x: hidden;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    .wrapper {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    /* Header Styles */
    .header {
        background-color: var(--accent-color);
        position: relative;
        height: 86px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .header-img img {
        height: 126px;
        transition: transform 0.5s ease;
    }
    .header-img {
        position: absolute;
        top: -50px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1;
    }
    .top-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 30px;
        background-color: var(--accent-color);
        position: relative;
    }
    .menu-icon {
        font-size: 24px;
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    .menu-icon:hover {
        transform: scale(1.1);
    }
    .user-header {
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 700;
    }
    /* Menu Styles */
    .menu-box {
        position: fixed;
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
        z-index: 1000;
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
    /* Main Content */
    .main-content {
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
        flex: 1;
    }
    .page-title {
        font-family: 'GaramondBold', serif;
        text-align: center;
        color: var(--primary-color);
        margin-bottom: 2rem;
        font-size: 2.5rem;
        font-weight: 900;
    }
    .page-subtitle {
        text-align: center;
        font-weight: 400;
        margin-bottom: 3rem;
        color: var(--text-dark);
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }
    .filtros-container {
        background-color: white;
        border-radius: var(--border-radius);
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 3px solid var(--border-color);
        box-shadow: var(--shadow-soft);
        animation: fadeIn 0.8s ease;
    }
    .filtros-container h3 {
        color: var(--primary-color);
        margin-top: 0;
        margin-bottom: 1rem;
    }
    .filtros-form {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .filtro-grupo {
        flex: 1;
        min-width: 200px;
    }
    .filtro-grupo label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 400;
        color: var(--text-dark);
    }
    .filtro-grupo select,
    .filtro-grupo input {
        width: 100%;
        padding: 0.8rem;
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-small);
        font-family: 'Inter', sans-serif;
    }
    .filtro-botoes {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
        justify-content: center;
        width: 100%;
    }
    .btn-filtrar,
    .btn-limpar {
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: var(--border-radius-small);
        font-weight: bold;
        cursor: pointer;
        transition: var(--transition-smooth);
    }
    .btn-filtrar {
        background-color: var(--primary-light);
        color: var(--text-light);
    }
    .btn-filtrar:hover {
        background-color: #4a7d2d;
        transform: translateY(-3px);
        box-shadow: var(--shadow-soft);
    }
    .btn-limpar {
        background-color: #f0f0f0;
        color: var(--text-dark);
    }
    .btn-limpar:hover {
        background-color: #e0e0e0;
        transform: translateY(-3px);
    }
    .pagination-info {
        text-align: center;
        margin-bottom: 1rem;
        color: var(--text-medium);
        font-weight: 400;
    }
    .restaurantes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        min-height: 600px;
    }
    .restaurante-card {
        background: white;
        border-radius: var(--border-radius);
        overflow: hidden;
        border: 3px solid var(--border-color);
        box-shadow: var(--shadow-soft);
        transition: var(--transition-smooth);
        display: flex;
        flex-direction: column;
        animation: fadeInUp 0.8s ease forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    .restaurante-card.show {
        opacity: 1;
        transform: translateY(0);
    }
    .restaurante-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-medium);
    }
    .restaurante-img {
        height: 180px;
        overflow: hidden;
        position: relative;
    }
    .restaurante-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .restaurante-card:hover .restaurante-img img {
        transform: scale(1.1);
    }
    .restaurante-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: var(--primary-light);
        color: var(--text-light);
        padding: 5px 10px;
        border-radius: var(--border-radius-small);
        font-size: 0.8rem;
        font-weight: bold;
    }
    .restaurante-promocao {
        background-color: #ff6b6b;
    }
    .restaurante-content {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .restaurante-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.5rem;
    }
    .restaurante-title {
        font-size: 1.3rem;
        color: var(--primary-color);
        margin: 0;
    }
    .restaurante-rating {
        display: flex;
        align-items: center;
        font-weight: bold;
        color: var(--text-dark);
    }
    .star {
        color: #FFD700;
        margin-right: 3px;
    }
    .restaurante-tipos {
        margin-bottom: 1rem;
        color: var(--text-medium);
        font-size: 0.9rem;
        font-weight: 400;
    }
    .restaurante-info {
        margin-bottom: 1rem;
        flex: 1;
    }
    .restaurante-info p {
        margin: 0.5rem 0;
        font-weight: 400;
        display: flex;
        align-items: center;
    }
    .restaurante-info p span {
        margin-right: 0.5rem;
    }
    .preco {
        font-weight: bold;
        color: var(--primary-color);
    }
    .restaurante-footer {
        display: flex;
        justify-content: space-between;
        margin-top: 1rem;
        border-top: 1px solid var(--border-color);
        padding-top: 1rem;
    }
    .btn-ver-mais {
        padding: 0.6rem 1rem;
        border: none;
        border-radius: var(--border-radius-small);
        font-weight: bold;
        cursor: pointer;
        transition: var(--transition-smooth);
        text-decoration: none;
        text-align: center;
        background-color: var(--primary-color);
        color: var(--text-light);
        width: 100%;
    }
    .btn-ver-mais:hover {
        background-color: #4a7d2d;
        transform: translateY(-3px);
        box-shadow: var(--shadow-soft);
    }
    .paginacao {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 3rem;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .pagina-btn {
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-small);
        cursor: pointer;
        transition: var(--transition-smooth);
        background-color: white;
        font-weight: bold;
    }
    .pagina-btn:hover,
    .pagina-btn.active {
        background-color: var(--primary-light);
        color: var(--text-light);
    }
    .pagina-btn.disabled {
        cursor: not-allowed;
        opacity: 0.5;
    }
    .pagina-seta {
        font-size: 1.2rem;
    }
    .footer {
        background-color: var(--accent-color);
        padding: 20px;
        color: var(--text-dark);
        font-size: 14px;
        text-align: center;
        animation: fadeIn 1s ease;
    }
    .footer-top {
        margin-bottom: 15px;
    }
    .footer-top img {
        width: 15%;
        height: auto;
        transition: transform 0.5s ease;
    }
    .footer-top:hover img {
        transform: rotate(5deg) scale(1.05);
    }
    .footer-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    .footer-left,
    .footer-center,
    .footer-right {
        flex: 1;
        text-align: center;
        transition: all 0.3s ease;
    }
    .footer-left:hover,
    .footer-right:hover {
        transform: translateY(-3px);
    }
    .footer-left {
        text-align: left;
    }
    .footer-right {
        text-align: right;
    }
    .footer-bottom a {
        text-decoration: underline;
        color: var(--text-dark);
        transition: color 0.3s ease;
    }
    .footer-bottom a:hover {
        color: var(--primary-color);
    }
    .notificacao {
        background-color: var(--primary-color);
        color: var(--text-light);
        padding: 16px;
        text-align: center;
        font-weight: bold;
        display: none;
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
        border-radius: var(--border-radius-small);
        box-shadow: var(--shadow-soft);
        min-width: 300px;
    }
    .notificacao.show {
        display: block;
        animation: fadeOut 4s forwards;
    }
    .back-to-top {
        position: fixed;
        right: 30px;
        background-color: var(--primary-color);
        color: var(--text-light);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: var(--shadow-soft);
        transition: var(--transition-smooth);
        opacity: 0;
        visibility: hidden;
        z-index: 999;
        bottom: 30px;
    }
    .back-to-top svg {
        width: 24px;
        height: 24px;
        stroke: var(--text-light);
    }
    .back-to-top.visible {
        opacity: 1;
        visibility: visible;
    }
    .back-to-top:hover {
        background-color: #4a7d2d;
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes fadeOut {
        0% { opacity: 1; }
        80% { opacity: 1; }
        100% { opacity: 0; }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-5px); }
        100% { transform: translateY(0px); }
    }
    .floating {
        animation: float 3s ease-in-out infinite;
    }
    .loading {
        text-align: center;
        padding: 2rem;
        color: var(--text-medium);
    }
    #map {
        height: 300px;
        width: 80%;
        margin: 1rem auto;
        border-radius: var(--border-radius-small);
        box-shadow: var(--shadow-soft);
    }
    @media (max-width: 768px) {
        .restaurantes-grid {
            grid-template-columns: 1fr;
        }
        .page-title {
            font-size: 2rem;
        }
        .filtros-form {
            flex-direction: column;
        }
        .back-to-top {
            width: 45px;
            height: 45px;
            right: 20px;
            bottom: 20px;
        }
    }
    @media (max-width: 600px) {
        .footer-bottom {
            flex-direction: column;
            text-align: center;
        }
        .footer-left,
        .footer-center,
        .footer-right {
            text-align: center;
        }
        .header-img img {
            height: 100px;
            top: -30px;
        }
        .restaurante-footer {
            flex-direction: column;
            gap: 0.5rem;
        }
        .btn-ver-mais {
            width: 100%;
        }
        .paginacao {
            justify-content: center;
        }
    }
</style>
@endsection
@section('content')
    <!-- Main Content -->
    <main class="main-content">
        <h1 class="page-title">Restaurantes</h1>
        <p class="page-subtitle">Descubra os melhores sabores locais e internacionais. Filtre por tipo de cozinha, preço e avaliações para encontrar o restaurante perfeito para sua experiência gastronômica.</p>
        <!-- Filtros -->
        <div class="filtros-container">
            <h3>Filtros</h3>
            <form class="filtros-form">
                <div class="filtro-grupo">
                    <label for="tipo-cozinha">Tipo de Cozinha</label>
                    <select id="tipo-cozinha">
                        <option value="">Todas</option>
                        <option value="italiana">Italiana</option>
                        <option value="japonesa">Japonesa</option>
                        <option value="brasileira">Brasileira</option>
                        <option value="francesa">Francesa</option>
                        <option value="mexicana">Mexicana</option>
                        <option value="arabe">Árabe</option>
                        <option value="chinesa">Chinesa</option>
                        <option value="indiana">Indiana</option>
                    </select>
                </div>
                <div class="filtro-grupo">
                    <label for="preco">Faixa de Preço</label>
                    <select id="preco">
                        <option value="">Todos</option>
                        <option value="economico">$ - Econômico</option>
                        <option value="medio">$$ - Médio</option>
                        <option value="alto">$$$ - Alto</option>
                        <option value="luxo">$$$$ - Luxo</option>
                    </select>
                </div>
                <div class="filtro-grupo">
                    <label for="avaliacao">Avaliação Mínima</label>
                    <select id="avaliacao">
                        <option value="">Qualquer</option>
                        <option value="3">3+ Estrelas</option>
                        <option value="4">4+ Estrelas</option>
                        <option value="4.5">4.5+ Estrelas</option>
                    </select>
                </div>
                <div class="filtro-grupo">
                    <label for="localizacao">Cidade</label>
                    <select id="localizacao">
                        <option value="">Todas</option>
                        <option value="sao-paulo">São Paulo</option>
                        <option value="rio-de-janeiro">Rio de Janeiro</option>
                        <option value="rio-grande-do-sul">Rio Grande do Sul</option>
                        <option value="maranhao">Maranhão</option>
                        <option value="minas-gerais">Minas Gerais</option>
                        <option value="parana">Paraná</option>
                        <option value="santa-catarina">Santa Catarina</option>
                    </select>
                </div>
                <div class="filtro-botoes">
                    <button type="button" class="btn-filtrar">Aplicar Filtros</button>
                    <button type="button" class="btn-limpar">Limpar</button>
                </div>
            </form>
        </div>
        <!-- Info da paginação -->
        <div class="pagination-info" id="pagination-info">
            Carregando restaurantes...
        </div>
        <!-- Restaurantes Grid -->
        <div class="restaurantes-grid" id="restaurantes-grid">
            <div class="loading">Carregando restaurantes...</div>
        </div>
        <!-- Paginação -->
        <div class="paginacao" id="paginacao">
            <!-- Será gerada dinamicamente pelo JavaScript -->
        </div>
        <!-- Back to Top Button -->
        <div class="back-to-top" id="backToTop">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 19V5M5 12l7-7 7 7"/>
            </svg>
        </div>
    </main>
    <!-- Mapa -->
    <div id="map"></div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Base de dados de restaurantes
        const restaurantes = [
            {
                id: 1,
                nome: "Jamile",
                tipos: ["brasileira", "contemporanea", "gourmet"],
                avaliacao: 4.9,
                endereco: "R. Treze de Maio, 647 - Bela Vista, São Paulo",
                horario: "Segunda a Domingo: 12:00 - 23:00",
                preco: "luxo",
                precoTexto: "$$$$",
                cidade: "sao-paulo",
                imagem: "https://i.ibb.co/wNDYyrGF/image.png",
                badge: "Premium",
                promocao: false,
                link: "Restaurante - Jamile.html",
                lat: -23.5505,
                lng: -46.6333
            },
            {
                id: 2,
                nome: "Casa Terracota",
                tipos: ["gourmet", "inovador", "elegante"],
                avaliacao: 4.7,
                endereco: "Av. das Flores, 456 - Gramado, RS",
                horario: "Terça a Sábado: 19:00 - 23:00",
                preco: "alto",
                precoTexto: "$$$",
                cidade: "rio-grande-do-sul",
                imagem: "https://i.ibb.co/sJyf79Pw/image.png",
                badge: null,
                promocao: false,
                link: "RestauranteRS.html",
                lat: -29.3739,
                lng: -50.8811
            },
            {
                id: 3,
                nome: "El Fuego",
                tipos: ["fondue", "carne", "queijo"],
                avaliacao: 4.6,
                endereco: "Rua dos Pinheiros, 789 - Gramado, RS",
                horario: "Quarta a Domingo: 18:00 - 22:00",
                preco: "alto",
                precoTexto: "$$$",
                cidade: "rio-grande-do-sul",
                imagem: "https://i.ibb.co/p6CszR4h/image.png",
                badge: null,
                promocao: false,
                link: "RestauranteRS.html",
                lat: -29.3749,
                lng: -50.8821
            },
            {
                id: 4,
                nome: "Oro",
                tipos: ["brasileira", "gourmet", "contemporanea"],
                avaliacao: 4.9,
                endereco: "Av. Gen. San Martin, 889 - Leblon, Rio de Janeiro",
                horario: "Terça a Sábado: 19:00 - 23:00",
                preco: "luxo",
                precoTexto: "$$$$",
                cidade: "rio-de-janeiro",
                imagem: "https://i.ibb.co/wNDYyrGF/image.png",
                badge: "Premium",
                promocao: false,
                link: "Restaurante - Oro.html",
                lat: -22.9792,
                lng: -43.2236
            },
            {
                id: 5,
                nome: "Cipriani",
                tipos: ["italiana", "contemporanea", "gourmet"],
                avaliacao: 4.9,
                endereco: "Av. Atlântica, 1702 - Copacabana, Rio de Janeiro",
                horario: "Segunda a Domingo: 19:00 - 21:00",
                preco: "luxo",
                precoTexto: "$$$$",
                cidade: "rio-de-janeiro",
                imagem: "https://i.ibb.co/NnswBt5Q/image.png",
                badge: "Premium",
                promocao: false,
                link: "Restaurante - Cipriani.html",
                lat: -22.9711,
                lng: -43.1828
            },
            {
                id: 6,
                nome: "Fasano",
                tipos: ["italiana", "gourmet", "contemporanea"],
                avaliacao: 4.9,
                endereco: "Av. Vieira Souto, 80 - Ipanema, Rio de Janeiro",
                horario: "Segunda a Domingo: 12:00 - 23:00",
                preco: "luxo",
                precoTexto: "$$$$",
                cidade: "rio-de-janeiro",
                imagem: "https://i.ibb.co/Rk9CXfxM/image.png",
                badge: "Premium",
                promocao: false,
                link: "Restaurante - Fasano.html",
                lat: -22.9785,
                lng: -43.2089
            },
            {
                id: 7,
                nome: "Terraço Itália",
                tipos: ["italiana", "gourmet"],
                avaliacao: 4.8,
                endereco: "Rua Floriano Peixoto, 158, São Paulo, SP",
                horario: "Segunda a Sexta: 11:00 - 19:30",
                preco: "alto",
                precoTexto: "$$$",
                cidade: "sao-paulo",
                imagem: "https://i.ibb.co/n8syZSDs/image.png",
                badge: null,
                promocao: false,
                link: "RestauranteSP.html",
                lat: -23.5505,
                lng: -46.6333
            },
            {
                id: 8,
                nome: "Porto Canoas",
                tipos: ["frutos-do-mar", "peixes"],
                avaliacao: 4.5,
                endereco: "Av. das Cataratas, 202 - Foz do Iguaçu, PR",
                horario: "Todos os dias: 11:00 - 23:00",
                preco: "alto",
                precoTexto: "$$$",
                cidade: "parana",
                imagem: "https://i.ibb.co/YBXdWS3Q/image.png",
                badge: null,
                promocao: false,
                link: "RestaurantePR.html",
                lat: -25.5478,
                lng: -54.5873
            },
            {
                id: 9,
                nome: "Rafain",
                tipos: ["churrasco", "cultural"],
                avaliacao: 4.3,
                endereco: "Rua das Danças, 303 - Foz do Iguaçu, PR",
                horario: "Quinta a Domingo: 19:00 - 00:00",
                preco: "medio",
                precoTexto: "$$",
                cidade: "parana",
                imagem: "https://i.ibb.co/B50ZTNgP/image.png",
                badge: null,
                promocao: false,
                link: "RestaurantePR.html",
                lat: -25.5488,
                lng: -54.5883
            },
            {
                id: 10,
                nome: "La Mafia Trattoria",
                tipos: ["italiana", "tradicional"],
                avaliacao: 4.4,
                endereco: "Rua das Tradições, 101 - Foz do Iguaçu, PR",
                horario: "Segunda a Sábado: 18:00 - 23:00",
                preco: "medio",
                precoTexto: "$$",
                cidade: "parana",
                imagem: "https://i.ibb.co/5W1XfZVG/image.png",
                badge: null,
                promocao: false,
                link: "RestaurantePR.html",
                lat: -25.5498,
                lng: -54.5893
            },
            {
                id: 11,
                nome: "Bené da Flauta",
                tipos: ["tradicional", "brasileira"],
                avaliacao: 4.5,
                endereco: "Rua das Tradições, 101 - Ouro Preto, MG",
                horario: "Segunda a Sábado: 18:00 - 23:00",
                preco: "medio",
                precoTexto: "$$",
                cidade: "minas-gerais",
                imagem: "https://i.ibb.co/5W1XfZVG/image.png",
                badge: null,
                promocao: false,
                link: "Restaurante - Bené da Flauta.html",
                lat: -20.3822,
                lng: -43.5039
            },
            {
                id: 12,
                nome: "Gastro Pub",
                tipos: ["moderna", "pub"],
                avaliacao: 4.4,
                endereco: "Rua dos Ingleses, 118 - Ouro Preto, MG",
                horario: "Segunda a Sábado: 12:00 - 23:00",
                preco: "medio",
                precoTexto: "$$",
                cidade: "minas-gerais",
                imagem: "https://i.ibb.co/DP0nRQ81/image.png",
                badge: null,
                promocao: false,
                link: "Restaurante - Gastro Pub.html",
                lat: -20.3832,
                lng: -43.5049
            },
            {
                id: 13,
                nome: "Contos dos Reis",
                tipos: ["tradicional", "brasileira"],
                avaliacao: 4.3,
                endereco: "Rua das Danças, 303 - Ouro Preto, MG",
                horario: "Quinta a Domingo: 19:00 - 00:00",
                preco: "medio",
                precoTexto: "$$",
                cidade: "minas-gerais",
                imagem: "https://i.ibb.co/kVDCLyJK/image.png",
                badge: null,
                promocao: false,
                link: "RestauranteMG.html",
                lat: -20.3842,
                lng: -43.5059
            },
            {
                id: 14,
                nome: "Mangue",
                tipos: ["regional", "frutos-do-mar"],
                avaliacao: 4.5,
                endereco: "Rua das Tradições, 101 - Barreirinhas, MA",
                horario: "Segunda a Sábado: 18:00 - 23:00",
                preco: "medio",
                precoTexto: "$$",
                cidade: "maranhao",
                imagem: "https://i.ibb.co/wNDYyrGF/image.png",
                badge: null,
                promocao: false,
                link: "RestauranteMA.html",
                lat: -2.7478,
                lng: -42.8297
            },
            {
                id: 15,
                nome: "A Canoa",
                tipos: ["regional", "frutos-do-mar"],
                avaliacao: 4.4,
                endereco: "Rua dos Ingleses, 118 - Barreirinhas, MA",
                horario: "Segunda a Sábado: 12:00 - 23:00",
                preco: "medio",
                precoTexto: "$$",
                cidade: "maranhao",
                imagem: "https://i.ibb.co/NnswBt5Q/image.png",
                badge: null,
                promocao: false,
                link: "RestauranteMA.html",
                lat: -2.7488,
                lng: -42.8307
            },
            {
                id: 16,
                nome: "Terral",
                tipos: ["regional", "frutos-do-mar"],
                avaliacao: 4.3,
                endereco: "Rua das Danças, 303 - Barreirinhas, MA",
                horario: "Quinta a Domingo: 19:00 - 00:00",
                preco: "medio",
                precoTexto: "$$",
                cidade: "maranhao",
                imagem: "https://i.ibb.co/Rk9CXfxM/image.png",
                badge: null,
                promocao: false,
                link: "RestauranteMA.html",
                lat: -2.7498,
                lng: -42.8317
            },
            {
                id: 17,
                nome: "Alameda - Jurerê",
                tipos: ["contemporânea", "gourmet"],
                avaliacao: 4.7,
                endereco: "Rua das Praias, 101 - Florianópolis, SC",
                horario: "Segunda a Domingo: 18:00 - 23:00",
                preco: "alto",
                precoTexto: "$$$",
                cidade: "santa-catarina",
                imagem: "https://i.ibb.co/cGRyypv/image.png",
                badge: null,
                promocao: false,
                link: "RestauranteSC.html",
                lat: -27.4500,
                lng: -48.5490
            },
            {
                id: 18,
                nome: "Olivia Cucina",
                tipos: ["italiana", "tradicional"],
                avaliacao: 4.6,
                endereco: "Rua dos Ingleses, 118 - Florianópolis, SC",
                horario: "Segunda a Sábado: 12:00 - 23:00",
                preco: "medio",
                precoTexto: "$$",
                cidade: "santa-catarina",
                imagem: "https://i.ibb.co/Y4KQnVm6/image.png",
                badge: null,
                promocao: false,
                link: "RestauranteSC.html",
                lat: -27.4510,
                lng: -48.5500
            },
            {
                id: 19,
                nome: "Dolce Vita",
                tipos: ["italiana", "gourmet"],
                avaliacao: 4.5,
                endereco: "Rua das Danças, 303 - Florianópolis, SC",
                horario: "Quinta a Domingo: 19:00 - 00:00",
                preco: "alto",
                precoTexto: "$$$",
                cidade: "santa-catarina",
                imagem: "https://i.ibb.co/nqHsNL4R/image.png",
                badge: null,
                promocao: false,
                link: "RestauranteSC.html",
                lat: -27.4520,
                lng: -48.5510
            },
            {
                id: 20,
                nome: "Capim Santo",
                tipos: ["brasileira", "contemporânea"],
                avaliacao: 4.5,
                endereco: "Av. Brig. Faria Lima, 2705 - Jardim Paulistano, São Paulo - SP, 01451-000",
                horario: "Terça a Segunda: 10:00 - 18:00",
                preco: "alto",
                precoTexto: "$$$",
                cidade: "sao-paulo",
                imagem: "https://i.ibb.co/B2sZMYRW/image.png",
                badge: null,
                promocao: false,
                link: "Restaurante - Capim Santo.html",
                lat: -23.5688,
                lng: -46.6824
            }
        ];
        // Número de restaurantes por página
        const restaurantesPorPagina = 6;
        let paginaAtual = 1;
        let restaurantesFiltrados = [...restaurantes];
        let map;
        // Função para criar um card de restaurante
        function criarRestauranteCard(restaurante) {
            const restauranteCard = document.createElement('div');
            restauranteCard.className = 'restaurante-card show';
            const badgeClass = restaurante.promocao ? 'restaurante-badge restaurante-promocao' : 'restaurante-badge';
            const badgeText = restaurante.badge || (restaurante.promocao ? 'Promoção' : '');
            restauranteCard.innerHTML = `
                <div class="restaurante-img">
                    <img src="${restaurante.imagem}" alt="${restaurante.nome}">
                    ${badgeText ? `<div class="${badgeClass}">${badgeText}</div>` : ''}
                </div>
                <div class="restaurante-content">
                    <div class="restaurante-header">
                        <h3 class="restaurante-title">${restaurante.nome}</h3>
                        <div class="restaurante-rating">
                            <span class="star">★</span>${restaurante.avaliacao}
                        </div>
                    </div>
                    <div class="restaurante-tipos">${restaurante.tipos.join(' • ')}</div>
                    <div class="restaurante-info">
                        <p><span>📍</span> ${restaurante.endereco}</p>
                        <p><span>⏰</span> ${restaurante.horario}</p>
                        <p><span>💰</span> <span class="preco">${restaurante.precoTexto}</span> ${restaurante.preco}</p>
                    </div>
                    <div class="restaurante-footer">
                        <a href="${restaurante.link}" class="btn-ver-mais">Ver Detalhes</a>
                    </div>
                </div>
            `;
            return restauranteCard;
        }
        // Função para exibir os restaurantes na página atual
        function exibirRestaurantes() {
            const restaurantesGrid = document.getElementById('restaurantes-grid');
            restaurantesGrid.innerHTML = '';
            const startIndex = (paginaAtual - 1) * restaurantesPorPagina;
            const endIndex = startIndex + restaurantesPorPagina;
            const restaurantesPagina = restaurantesFiltrados.slice(startIndex, endIndex);
            restaurantesPagina.forEach(restaurante => {
                const restauranteCard = criarRestauranteCard(restaurante);
                restaurantesGrid.appendChild(restauranteCard);
            });
            // Atualiza a informação de paginação
            const totalPaginas = Math.ceil(restaurantesFiltrados.length / restaurantesPorPagina);
            document.getElementById('pagination-info').textContent = `Mostrando ${startIndex + 1} a ${Math.min(endIndex, restaurantesFiltrados.length)} de ${restaurantesFiltrados.length} restaurantes`;
            // Atualiza os botões de paginação
            atualizarPaginacao(totalPaginas);
        }
        // Função para criar os botões de paginação
        function atualizarPaginacao(totalPaginas) {
            const paginacao = document.getElementById('paginacao');
            paginacao.innerHTML = '';
            // Botão Anterior
            const btnAnterior = document.createElement('div');
            btnAnterior.className = `pagina-btn ${paginaAtual === 1 ? 'disabled' : ''}`;
            btnAnterior.innerHTML = '&laquo;';
            btnAnterior.addEventListener('click', () => {
                if (paginaAtual > 1) {
                    paginaAtual--;
                    exibirRestaurantes();
                }
            });
            paginacao.appendChild(btnAnterior);
            // Botões de Número
            for (let i = 1; i <= totalPaginas; i++) {
                const paginaBtn = document.createElement('div');
                paginaBtn.className = `pagina-btn ${i === paginaAtual ? 'active' : ''}`;
                paginaBtn.textContent = i;
                paginaBtn.addEventListener('click', () => {
                    paginaAtual = i;
                    exibirRestaurantes();
                });
                paginacao.appendChild(paginaBtn);
            }
            // Botão Próximo
            const btnProximo = document.createElement('div');
            btnProximo.className = `pagina-btn ${paginaAtual === totalPaginas ? 'disabled' : ''}`;
            btnProximo.innerHTML = '&raquo;';
            btnProximo.addEventListener('click', () => {
                if (paginaAtual < totalPaginas) {
                    paginaAtual++;
                    exibirRestaurantes();
                }
            });
            paginacao.appendChild(btnProximo);
        }
        // Função para aplicar os filtros
        function aplicarFiltros() {
            const tipoCozinha = document.getElementById('tipo-cozinha').value;
            const preco = document.getElementById('preco').value;
            const avaliacao = document.getElementById('avaliacao').value;
            const localizacao = document.getElementById('localizacao').value;
            restaurantesFiltrados = restaurantes.filter(restaurante => {
                return (
                    (tipoCozinha === '' || restaurante.tipos.includes(tipoCozinha)) &&
                    (preco === '' || restaurante.preco === preco) &&
                    (avaliacao === '' || restaurante.avaliacao >= parseFloat(avaliacao)) &&
                    (localizacao === '' || restaurante.cidade === localizacao)
                );
            });
            paginaAtual = 1;
            exibirRestaurantes();
            // Ajusta o mapa para a cidade selecionada
            if (localizacao) {
                const cidadeCoordenadas = {
                    "sao-paulo": [-23.5505, -46.6333],
                    "rio-de-janeiro": [-22.9068, -43.1729],
                    "rio-grande-do-sul": [-30.0346, -51.2177],
                    "maranhao": [-2.55, -44.3],
                    "minas-gerais": [-19.9167, -43.9345],
                    "parana": [-25.4296, -49.2713],
                    "santa-catarina": [-27.5954, -48.5480]
                };
                if (cidadeCoordenadas[localizacao]) {
                    map.setView(cidadeCoordenadas[localizacao], 12);
                }
            }
            showNotification('Filtro aplicado com sucesso!', 'success');
        }
        // Função para limpar os filtros
        function limparFiltros() {
            document.getElementById('tipo-cozinha').value = '';
            document.getElementById('preco').value = '';
            document.getElementById('avaliacao').value = '';
            document.getElementById('localizacao').value = '';
            restaurantesFiltrados = [...restaurantes];
            paginaAtual = 1;
            exibirRestaurantes();
            showNotification('Filtros limpos!', 'success');
        }
        // Função para mostrar notificações
        function showNotification(message, type) {
            const notificacao = document.getElementById('notificacao');
            notificacao.textContent = message;
            notificacao.className = `notificacao ${type} show`;
            setTimeout(() => {
                notificacao.classList.remove('show');
            }, 4000);
        }
        // Configura os eventos quando a página é carregada
        document.addEventListener('DOMContentLoaded', function () {
            // Configura os botões de filtro
            document.querySelector('.btn-filtrar').addEventListener('click', aplicarFiltros);
            document.querySelector('.btn-limpar').addEventListener('click', limparFiltros);
            // Exibe os restaurantes inicialmente
            exibirRestaurantes();
            // Inicializa o mapa
            map = L.map('map').setView([-23.5505, -46.6333], 4);
            // Adiciona uma camada de mapa
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            // Adiciona marcadores para os restaurantes
            restaurantes.forEach(restaurante => {
                L.marker([restaurante.lat, restaurante.lng]).addTo(map)
                    .bindPopup(`<b>${restaurante.nome}</b><br>${restaurante.endereco}`)
                    .openPopup();
            });
            // Configura o botão "voltar ao topo"
            const backToTopButton = document.getElementById('backToTop');
            const footer = document.getElementById('pageFooter');
            function adjustBackToTopPosition() {
                if (footer) {
                    const footerRect = footer.getBoundingClientRect();
                    const viewportHeight = window.innerHeight;
                    const footerTop = footerRect.top;
                    if (footerTop < viewportHeight) {
                        const newBottom = (viewportHeight - footerTop) + 10;
                        backToTopButton.style.bottom = `${newBottom}px`;
                    } else {
                        backToTopButton.style.bottom = '30px';
                    }
                }
            }
            window.addEventListener('scroll', function () {
                if (window.pageYOffset > 300) {
                    backToTopButton.classList.add('visible');
                } else {
                    backToTopButton.classList.remove('visible');
                }
                adjustBackToTopPosition();
            });
            backToTopButton.addEventListener('click', function () {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
            window.addEventListener('resize', adjustBackToTopPosition);
            adjustBackToTopPosition();
        });
    </script>
@endsection
```
