@extends('layouts.app')

@section('title', 'Restaurantes - Bella Avventura')

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        @font-face {
            font-family: 'GaramondBold';
            src: local('Garamond'), serif;
            font-weight: bold;
        }

        :root {
            --primary-color: #5a8f3d;
            --secondary-color: #D8E6D9;
            --text-color: #333;
            --bg-light: #f8f9fa;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .main-content {
            padding: 2.5rem 1rem;
            max-width: 1280px;
            margin: 0 auto;
            flex: 1;
            background: var(--bg-light);
        }

        .page-title {
            font-family: 'GaramondBold', serif;
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-size: 2.8rem;
            letter-spacing: 0.5px;
        }

        .page-subtitle {
            text-align: center;
            font-family: 'Inter', sans-serif;
            font-weight: 400;
            font-size: 1.1rem;
            line-height: 1.6;
            color: #444;
            max-width: 700px;
            margin: 0 auto 2.5rem;
        }

        .filtros-container {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2.5rem;
            border: 2px solid var(--secondary-color);
            box-shadow: var(--shadow);
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
            transition: transform 0.3s ease;
        }

        .filtros-container:hover {
            transform: translateY(-5px);
        }

        .filtros-container h3 {
            color: var(--primary-color);
            margin: 0 0 1.2rem;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .filtros-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.2rem;
            align-items: end;
        }

        .filtro-grupo {
            position: relative;
        }

        .filtro-grupo label {
            display: block;
            margin-bottom: 0.6rem;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            color: var(--text-color);
            font-size: 0.95rem;
        }

        .filtro-grupo select,
        .filtro-grupo input {
            width: 100%;
            padding: 0.9rem 1rem 0.9rem 2.5rem;
            border: 1px solid var(--secondary-color);
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            background: white;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .filtro-grupo select:focus,
        .filtro-grupo input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(90, 143, 61, 0.2);
            outline: none;
        }

        .filtro-grupo i {
            position: absolute;
            left: 0.8rem;
            top: 2.6rem;
            color: var(--primary-color);
            font-size: 1rem;
        }

        .filtro-botoes {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 1.5rem;
        }

        .btn-filtrar,
        .btn-limpar {
            padding: 0.9rem 2rem;
            border: none;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-filtrar {
            background: linear-gradient(135deg, var(--primary-color), #4a7d2d);
            color: white;
        }

        .btn-filtrar:hover {
            background: linear-gradient(135deg, #4a7d2d, var(--primary-color));
            transform: translateY(-2px);
        }

        .btn-limpar {
            background: #e9ecef;
            color: var(--text-color);
        }

        .btn-limpar:hover {
            background: #dee2e6;
            transform: translateY(-2px);
        }

        .pagination-info {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #555;
            font-family: 'Inter', sans-serif;
            font-weight: 400;
            font-size: 0.95rem;
        }

        .restaurantes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.8rem;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .restaurante-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            border: 2px solid var(--secondary-color);
            box-shadow: var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            animation: fadeInUp 0.8s ease forwards;
        }

        .restaurante-card.show {
            opacity: 1;
            transform: translateY(0);
        }

        .restaurante-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
        }

        .restaurante-img {
            height: 220px;
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
            transform: scale(1.08);
        }

        .restaurante-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: var(--primary-color);
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .restaurante-promocao {
            background: #ff6b6b;
        }

        .restaurante-content {
            padding: 1.8rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .restaurante-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.8rem;
        }

        .restaurante-title {
            font-family: 'Inter', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }

        .restaurante-rating {
            display: flex;
            align-items: center;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            color: var(--text-color);
        }

        .star {
            color: #FFD700;
            margin-right: 4px;
            font-size: 1.1rem;
        }

        .restaurante-tipos {
            margin-bottom: 1rem;
            color: #555;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            font-weight: 400;
            line-height: 1.5;
        }

        .restaurante-info {
            margin-bottom: 1.2rem;
            flex: 1;
        }

        .restaurante-info p {
            margin: 0.6rem 0;
            font-family: 'Inter', sans-serif;
            font-weight: 400;
            font-size: 0.95rem;
            color: var(--text-color);
            display: flex;
            align-items: center;
        }

        .restaurante-info p span {
            margin-right: 0.6rem;
            font-size: 1.1rem;
        }

        .preco {
            font-weight: 600;
            color: var(--primary-color);
        }

        .restaurante-footer {
            display: flex;
            justify-content: flex-end;
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid var(--secondary-color);
        }

        .btn-ver-mais {
            background: var(--secondary-color);
            color: var(--text-color);
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
        }

        .btn-ver-mais:hover {
            background: #c8d6c9;
            transform: translateY(-2px);
        }

        .btn-ver-mais:focus {
            box-shadow: 0 0 0 3px rgba(90, 143, 61, 0.2);
            outline: none;
        }

        .paginacao {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 3rem 0;
            gap: 0.8rem;
            flex-wrap: wrap;
        }

        .pagina-btn {
            width: 48px;
            height: 48px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid var(--secondary-color);
            border-radius: 8px;
            cursor: pointer;
            background: white;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .pagina-btn:hover,
        .pagina-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .pagina-btn.disabled {
            cursor: not-allowed;
            opacity: 0.5;
        }

        .pagina-seta {
            font-size: 1.4rem;
        }

        .loading {
            text-align: center;
            padding: 2rem;
            color: #555;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            grid-column: 1/-1;
        }

        #map {
            height: 400px;
            width: 100%;
            max-width: 1000px;
            margin: 2rem auto;
            border-radius: 12px;
            border: 2px solid var(--secondary-color);
            box-shadow: var(--shadow);
        }

        .notificacao {
            background: var(--primary-color);
            color: white;
            padding: 1rem 2rem;
            text-align: center;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            display: none;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            border-radius: 8px;
            box-shadow: var(--shadow);
            min-width: 320px;
        }

        .notificacao.show {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            animation: slideIn 0.5s ease forwards, fadeOut 4s 1s forwards;
        }

        .notificacao i {
            font-size: 1.2rem;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-50%) translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateX(-50%) translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            80% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }

        @keyframes float {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-6px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1.5rem 0.8rem;
            }

            .page-title {
                font-size: 2.2rem;
            }

            .page-subtitle {
                font-size: 1rem;
                margin-bottom: 2rem;
            }

            .filtros-form {
                grid-template-columns: 1fr;
            }

            .restaurantes-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .restaurante-img {
                height: 200px;
            }

            #map {
                height: 300px;
                width: 90%;
            }

            .paginacao {
                gap: 0.5rem;
            }

            .pagina-btn {
                width: 40px;
                height: 40px;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 1.8rem;
            }

            .filtros-container {
                padding: 1.5rem;
            }

            .filtro-grupo select,
            .filtro-grupo input {
                padding: 0.8rem 0.8rem 0.8rem 2.2rem;
                font-size: 0.9rem;
            }

            .btn-ver-mais {
                width: 100%;
                padding: 0.7rem;
            }
        }
    </style>
@endsection

@section('content')
    <main class="main-content">
        <h1 class="page-title">Restaurantes</h1>
        <p class="page-subtitle">Descubra os melhores sabores locais e internacionais. Filtre por tipo de cozinha, preço e
            avaliações para encontrar o restaurante perfeito para sua experiência gastronômica.</p>
        <!-- Filtros -->
        <div class="filtros-container">
            <h3>Filtros</h3>
            <form class="filtros-form" id="filtros-form">
                <div class="filtro-grupo">
                    <label for="tipo-cozinha">Tipo de Cozinha</label>
                    <i class="fas fa-utensils"></i>
                    <select id="tipo-cozinha" name="tipo_cozinha">
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
                    <i class="fas fa-dollar-sign"></i>
                    <select id="preco" name="preco">
                        <option value="">Todos</option>
                        <option value="economico">$ - Econômico</option>
                        <option value="medio">$$ - Médio</option>
                        <option value="alto">$$$ - Alto</option>
                        <option value="luxo">$$$$ - Luxo</option>
                    </select>
                </div>
                <div class="filtro-grupo">
                    <label for="avaliacao">Avaliação Mínima</label>
                    <i class="fas fa-star"></i>
                    <select id="avaliacao" name="avaliacao">
                        <option value="">Qualquer</option>
                        <option value="3">3+ Estrelas</option>
                        <option value="4">4+ Estrelas</option>
                        <option value="4.5">4.5+ Estrelas</option>
                    </select>
                </div>
                <div class="filtro-grupo">
                    <label for="localizacao">Cidade</label>
                    <i class="fas fa-map-marker-alt"></i>
                    <select id="localizacao" name="localizacao">
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
                    <button type="button" class="btn-filtrar" id="btn-filtrar">Aplicar Filtros</button>
                    <button type="button" class="btn-limpar" id="btn-limpar">Limpar</button>
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
        <div class="paginacao" id="paginacao"></div>
        <!-- Mapa -->
        <div id="map"></div>
        <!-- Notificação -->
        <div id="notificacao" class="notificacao"><i class="fas fa-check-circle"></i><span></span></div>
    </main>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Base de dados de restaurantes (dados locais)
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
                prato: "",
                ambiente: "",
                sobremesas: "",
                badge: "Premium",
                promocao: false,
                link: "jamile",
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
                prato: "",
                ambiente: "",
                sobremesas: "",
                badge: null,
                promocao: false,
                link: "casa-terracota",
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
                prato: "",
                ambiente: "",
                sobremesas: "",
                badge: null,
                promocao: false,
                link: "el-fuego",
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
                imagem: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/21/62/f0/19/caption.jpg?w=1100&h=-1&s=1",
                prato: "",
                ambiente: "",
                sobremesas: "",
                badge: "Premium",
                promocao: false,
                link: "oro",
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
                imagem: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/29/96/b5/24/caption.jpg?w=1100&h=-1&s=1",
                prato: "",
                ambiente: "",
                sobremesas: "",
                badge: "Premium",
                promocao: false,
                link: "cipriani",
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
                imagem: "https://uploads.metroimg.com/wp-content/uploads/2021/04/19115037/Gero-Fasano-Ambiente-externo-1-1-1.jpg",
                prato: "",
                ambiente: "",
                sobremesas: "",
                badge: "Premium",
                promocao: false,
                link: "fasano",
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
                prato: "",
                ambiente: "",
                sobremesas: "",
                badge: null,
                promocao: false,
                link: "terraco-italia",
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
                prato: "",
                ambiente: "",
                sobremesas: "",
                badge: null,
                promocao: false,
                link: "porto-canoas",
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
                prato: "",
                ambiente: "",
                sobremesas: "",
                badge: null,
                promocao: false,
                link: "rafain",
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
                imagem: "https://www.iguassu.com.br/wp-content/uploads/elementor/thumbs/la-mafia1-pq2oybbk1cb4qpx4j2ivb0l80yupyv0sv87fhn5k3k.jpg",
                prato: "",
                ambiente: "",
                sobremesas: "",
                badge: null,
                promocao: false,
                link: "la-mafia-trattoria",
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
                imagem: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/07/c9/69/46/bene-da-flauta.jpg?w=1400&h=800&s=1",
                prato: "",
                ambiente: "",
                sobremesas: "",
                badge: null,
                promocao: false,
                link: "bene-da-flauta",
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
                imagem: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/24/c6/4c/e4/salao-1.jpg?w=900&h=500&s=1",
                prato: "",
                ambiente: "",
                sobremesas: "",
                badge: null,
                promocao: false,
                link: "gastro-pub",
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
                imagem: "https://lh3.googleusercontent.com/p/AF1QipOkHJiEMiwiP1IJFBn9O1wZcrXG_xcyUUoqn-FW=s680-w680-h510",
                prato: "",
                ambiente: "",
                sobremesas: "",
                badge: null,
                promocao: false,
                link: "contos-dos-reis",
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
                prato: "",
                ambiente: "",
                sobremesas: "",
                badge: null,
                promocao: false,
                link: "mangue",
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
                prato: "",
                ambiente: "",
                sobremesas: "",
                badge: null,
                promocao: false,
                link: "canoa",
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
                prato: "",
                ambiente: "",
                sobremesas: "",
                badge: null,
                promocao: false,
                link: "terral",
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
                imagem: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/0a/d2/13/82/ambiente-climatizado.jpg?w=1600&h=900&s=1",
                prato: "",
                ambiente: "",
                sobremesas: "",
                badge: null,
                promocao: false,
                link: "alameda",
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
                prato: "",
                ambiente: "",
                sobremesas: "",
                badge: null,
                promocao: false,
                link: "olivia-cucina",
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
                prato: "",
                ambiente: "",
                sobremesas: "",
                badge: null,
                promocao: false,
                link: "dolce-vita",
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
                prato: "",
                ambiente: "",
                sobremesas: "",
                badge: null,
                promocao: false,
                link: "capim-santo",
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
                        <img src="${restaurante.imagem}" alt="${restaurante.nome}" onerror="this.src='https://via.placeholder.com/320x220/5a8f3d/ffffff?text=Restaurante'">
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
                            <a href="/destinos/restaurantes/${restaurante.id}" class="btn-ver-mais">Ver Detalhes</a>
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

            if (restaurantesPagina.length === 0) {
                restaurantesGrid.innerHTML = '<div class="loading">Nenhum restaurante encontrado...</div>';
                return;
            }

            restaurantesPagina.forEach(restaurante => {
                const restauranteCard = criarRestauranteCard(restaurante);
                restaurantesGrid.appendChild(restauranteCard);
            });

            // Atualiza a informação de paginação
            const totalPaginas = Math.ceil(restaurantesFiltrados.length / restaurantesPorPagina);
            document.getElementById('pagination-info').textContent = `Mostrando ${startIndex + 1} a ${Math.min(endIndex, restaurantesFiltrados.length)} de ${restaurantesFiltrados.length} restaurantes`;

            // Atualiza os botões de paginação
            atualizarPaginacao(totalPaginas);

            // Atualiza o mapa com os restaurantes filtrados
            atualizarMapa(restaurantesPagina);
        }

        // Função para criar os botões de paginação
        function atualizarPaginacao(totalPaginas) {
            const paginacao = document.getElementById('paginacao');
            paginacao.innerHTML = '';
            if (totalPaginas <= 1) return;

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
            if (localizacao && map) {
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

            if (map) {
                map.setView([-15.7797, -47.9297], 4);
            }

            showNotification('Filtros limpos!', 'success');
        }

        // Função para atualizar o mapa com os restaurantes
        function atualizarMapa(restaurantes) {
            // Limpa marcadores existentes
            if (map) {
                map.eachLayer(function (layer) {
                    if (layer instanceof L.Marker) {
                        map.removeLayer(layer);
                    }
                });

                // Adiciona novos marcadores
                restaurantes.forEach(restaurante => {
                    if (restaurante.lat && restaurante.lng) {
                        L.marker([restaurante.lat, restaurante.lng])
                            .addTo(map)
                            .bindPopup(`<b>${restaurante.nome}</b><br>${restaurante.endereco}`);
                    }
                });
            }
        }

        // Função para mostrar notificações
        function showNotification(message, type) {
            const notificacao = document.getElementById('notificacao');
            const notificacaoSpan = notificacao.querySelector('span');
            notificacaoSpan.textContent = message;
            notificacao.className = `notificacao ${type} show`;
            setTimeout(() => {
                notificacao.classList.remove('show');
            }, 4000);
        }

        // Configura os eventos quando a página é carregada
        document.addEventListener('DOMContentLoaded', function () {
            // Exibe os restaurantes inicialmente
            exibirRestaurantes();

            // Configura os botões de filtro
            document.getElementById('btn-filtrar').addEventListener('click', aplicarFiltros);
            document.getElementById('btn-limpar').addEventListener('click', limparFiltros);

            // Inicializa o mapa com tratamento de erros
            try {
                map = L.map('map').setView([-15.7797, -47.9297], 4);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    maxZoom: 19,
                    detectRetina: true
                }).addTo(map);

                // Adiciona marcadores para os restaurantes
                restaurantes.forEach(restaurante => {
                    if (restaurante.lat && restaurante.lng) {
                        L.marker([restaurante.lat, restaurante.lng])
                            .addTo(map)
                            .bindPopup(`<b>${restaurante.nome}</b><br>${restaurante.endereco}`);
                    }
                });
            } catch (error) {
                console.error('Erro ao carregar o mapa:', error);
                document.getElementById('map').innerHTML = `
                        <div style="text-align: center; padding: 20px; color: #666;">
                            <p>⚠️ Não foi possível carregar o mapa</p>
                            <p>Verifique sua conexão com a internet</p>
                        </div>
                    `;
            }
        });
    </script>
@endsection
