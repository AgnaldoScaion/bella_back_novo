@extends('layouts.app')

@section('title', 'Hotéis - Bella Avventura')

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

        .hoteis-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.8rem;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .hotel-card {
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

        .hotel-card.show {
            opacity: 1;
            transform: translateY(0);
        }

        .hotel-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
        }

        .hotel-img {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .hotel-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .hotel-card:hover .hotel-img img {
            transform: scale(1.08);
        }

        .hotel-badge {
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

        .hotel-promocao {
            background: #ff6b6b;
        }

        .hotel-content {
            padding: 1.8rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .hotel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.8rem;
        }

        .hotel-title {
            font-family: 'Inter', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }

        .hotel-rating {
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

        .hotel-location {
            margin-bottom: 1rem;
            color: #555;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            font-weight: 400;
            line-height: 1.5;
        }

        .hotel-info {
            margin-bottom: 1.2rem;
            flex: 1;
        }

        .hotel-info p {
            margin: 0.6rem 0;
            font-family: 'Inter', sans-serif;
            font-weight: 400;
            font-size: 0.95rem;
            color: var(--text-color);
            display: flex;
            align-items: center;
        }

        .hotel-info p span {
            margin-right: 0.6rem;
            font-size: 1.1rem;
        }

        .hotel-price {
            font-weight: 600;
            color: var(--primary-color);
        }

        .hotel-footer {
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
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
            from { transform: translateX(-50%) translateY(-20px); opacity: 0; }
            to { transform: translateX(-50%) translateY(0); opacity: 1; }
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            80% { opacity: 1; }
            100% { opacity: 0; }
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
            100% { transform: translateY(0); }
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

            .hoteis-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .hotel-img {
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
    <h1 class="page-title">Hotéis</h1>
    <p class="page-subtitle">Encontre os melhores hotéis para sua estadia. Filtre por preço, localização e comodidades para uma experiência personalizada.</p>
    <!-- Filtros -->
    <div class="filtros-container">
        <h3>Filtros</h3>
        <form class="filtros-form" id="filtros-form">
            <div class="filtro-grupo">
                <label for="destino">Destino</label>
                <i class="fas fa-map-marker-alt"></i>
                <select id="destino" name="destino">
                    <option value="">Todas as Cidades</option>
                    <option value="sp">São Paulo</option>
                    <option value="rj">Rio de Janeiro</option>
                    <option value="rs">Rio Grande do Sul</option>
                    <option value="ma">Maranhão</option>
                    <option value="mg">Minas Gerais</option>
                    <option value="pr">Paraná</option>
                    <option value="sc">Santa Catarina</option>
                </select>
            </div>
            <div class="filtro-grupo">
                <label for="hospedes">Hóspedes</label>
                <i class="fas fa-users"></i>
                <select id="hospedes">
                    <option value="1">1 Adulto</option>
                    <option value="2">2 Adultos</option>
                    <option value="3">3 Adultos</option>
                    <option value="4">4 Adultos</option>
                    <option value="familiar">Família com crianças</option>
                </select>
            </div>
            <div class="filtro-grupo">
                <label for="preco">Faixa de Preço</label>
                <i class="fas fa-dollar-sign"></i>
                <select id="preco">
                    <option value="todos">Qualquer preço</option>
                    <option value="economico">Econômico (até R$200)</option>
                    <option value="medio">Médio (R$200 - R$500)</option>
                    <option value="premium">Premium (R$500+)</option>
                </select>
            </div>
            <div class="filtro-grupo">
                <label for="classificacao">Classificação</label>
                <i class="fas fa-star"></i>
                <select id="classificacao">
                    <option value="todos">Qualquer classificação</option>
                    <option value="5">5 estrelas</option>
                    <option value="4">4 estrelas</option>
                    <option value="3">3 estrelas</option>
                    <option value="2">2 estrelas</option>
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
        Carregando hotéis...
    </div>
    <!-- Hotéis Grid -->
    <div class="hoteis-grid" id="hoteis-grid">
        <div class="loading">Carregando hotéis...</div>
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
        // Base de dados de hotéis
        const hoteis = [
            {
                id: 1,
                nome: "Capsula Hotel",
                avaliacao: 4.8,
                localizacao: "Consolação, São Paulo",
                preco: 650,
                precoTexto: "R$ 650",
                cidade: "sp",
                imagem: "https://i.ibb.co/VYFJ1p3n/capsula-hotel.jpg",
                avaliacoes: 2378,
                link: "hoteis/capsula-hotel-sp",
                categoria: "medio",
                lat: -23.5505,
                lng: -46.6333
            },
            {
                id: 2,
                nome: "Hotel Atlântico Business",
                avaliacao: 4.9,
                localizacao: "Dantas, Rio de Janeiro",
                preco: 850,
                precoTexto: "R$ 850",
                cidade: "rj",
                imagem: "https://i.ibb.co/7NYJH7rM/Hotel-atalntico.webp",
                avaliacoes: 1975,
                link: "hoteis/atlantico-business-rj",
                categoria: "premium",
                lat: -22.9068,
                lng: -43.1729
            },
            {
                id: 3,
                nome: "Minas Garden Hotel",
                avaliacao: 4.7,
                localizacao: "Poços de Caldas, Minas Gerais",
                preco: 550,
                precoTexto: "R$ 550",
                cidade: "mg",
                imagem: "https://i.ibb.co/3yLL6n1c/Minas-Garden-Hotel.jpg",
                avaliacoes: 1526,
                link: "hoteis/minas-garden-mg",
                categoria: "medio",
                lat: -21.7874,
                lng: -46.5693
            },
            {
                id: 4,
                nome: "Blue Tree Towers",
                avaliacao: 4.8,
                localizacao: "São Luís, Maranhão",
                preco: 580,
                precoTexto: "R$ 580",
                cidade: "ma",
                imagem: "https://i.ibb.co/tTWQd0GW/Blue-Tree-Towers.jpg",
                avaliacoes: 3494,
                link: "hoteis/blue-tree-ma",
                categoria: "medio",
                lat: -2.5307,
                lng: -44.3068
            },
            {
                id: 5,
                nome: "Ingleses Palace Hotel",
                avaliacao: 4.9,
                localizacao: "Florianópolis, Santa Catarina",
                preco: 980,
                precoTexto: "R$ 980",
                cidade: "sc",
                imagem: "https://i.ibb.co/1YHgJM9K/ingleses-palace-hotel.jpg",
                avaliacoes: 1550,
                link: "hoteis/ingleses-palace-sc",
                categoria: "premium",
                lat: -27.5954,
                lng: -48.5480
            },
            {
                id: 6,
                nome: "Hotel Colline de France-Gramado",
                avaliacao: 4.6,
                localizacao: "Gramado, Rio Grande do Sul",
                preco: 480,
                precoTexto: "R$ 480",
                cidade: "rs",
                imagem: "https://i.ibb.co/VWH7mcc8/hotel-colline-france-gramado.jpg",
                avaliacoes: 1526,
                link: "hoteis/colline-france-rs",
                categoria: "medio",
                lat: -29.3739,
                lng: -50.8811
            },
            {
                id: 7,
                nome: "Hotel Atlântico Copacabana",
                avaliacao: 4.6,
                localizacao: "Copacabana, Rio de Janeiro",
                preco: 880,
                precoTexto: "R$ 880",
                cidade: "rj",
                imagem: "https://i.ibb.co/V0DXvrSj/hotel-atlantico-business.jpg",
                avaliacoes: 6362,
                link: "hoteis/atlantico-copacabana-rj",
                categoria: "premium",
                lat: -22.9711,
                lng: -43.1828
            },
            {
                id: 8,
                nome: "Hotel Atlântico Praia",
                avaliacao: 4.8,
                localizacao: "Copacabana, Rio de Janeiro",
                preco: 780,
                precoTexto: "R$ 780",
                cidade: "rj",
                imagem: "https://i.ibb.co/NgCYTM38/praia-hotel.jpg",
                avaliacoes: 3695,
                link: "hoteis/atlantico-praia-rj",
                categoria: "premium",
                lat: -22.9721,
                lng: -43.1838
            },
            {
                id: 9,
                nome: "Hotel Continental",
                avaliacao: 4.8,
                localizacao: "Floresta, Porto Alegre",
                preco: 680,
                precoTexto: "R$ 680",
                cidade: "rs",
                imagem: "https://i.ibb.co/Pzj4B8sY/hotel-continental.jpg",
                avaliacoes: 3281,
                link: "hoteis/continental-rs",
                categoria: "medio",
                lat: -30.0346,
                lng: -51.2177
            },
            {
                id: 10,
                nome: "Hotel GoldMen Express Cianorte",
                avaliacao: 4.3,
                localizacao: "Zona 3, Cianorte - PR",
                preco: 680,
                precoTexto: "R$ 680",
                cidade: "pr",
                imagem: "https://i.ibb.co/5Xr5wYRn/hotel-gold.jpg",
                avaliacoes: 58,
                link: "hoteis/goldmen-express-pr",
                categoria: "medio",
                lat: -23.6633,
                lng: -52.6108
            },
            {
                id: 11,
                nome: "Gran Villagio Hotel",
                avaliacao: 4.6,
                localizacao: "Consolação, São Paulo",
                preco: 980,
                precoTexto: "R$ 980",
                cidade: "sp",
                imagem: "https://i.ibb.co/CRj4cTP/Gran-Villagio-Hotel.png",
                avaliacoes: 1425,
                link: "hoteis/gran-villagio-sp",
                categoria: "premium",
                lat: -23.5515,
                lng: -46.6343
            },
            {
                id: 12,
                nome: "Life Infinity - Hotel",
                avaliacao: 4.2,
                localizacao: "Carniel, Gramado",
                preco: 870,
                precoTexto: "R$ 870",
                cidade: "rs",
                imagem: "https://i.ibb.co/1YkDLFzJ/infinity-hotel.jpg",
                avaliacoes: 205,
                link: "hoteis/life-infinity-rs",
                categoria: "premium",
                lat: -29.3749,
                lng: -50.8821
            },
            {
                id: 13,
                nome: "Oceania Park Hotel Spa & Convention Center",
                avaliacao: 4.5,
                localizacao: "Ingleses Centro, Florianópolis",
                preco: 630,
                precoTexto: "R$ 630",
                cidade: "sc",
                imagem: "https://i.ibb.co/qLp1GJFc/Hotel-oceania.jpg",
                avaliacoes: 4103,
                link: "hoteis/oceania-park-sc",
                categoria: "medio",
                lat: -27.4510,
                lng: -48.5500
            },
            {
                id: 14,
                nome: "Hotel Pousada Por do Sol",
                avaliacao: 4.7,
                localizacao: "Camanducaia - MG",
                preco: 680,
                precoTexto: "R$ 680",
                cidade: "mg",
                imagem: "https://i.ibb.co/m5WpdDSv/hotel-sol.jpg",
                avaliacoes: 247,
                link: "hoteis/por-do-sol-mg",
                categoria: "medio",
                lat: -22.7497,
                lng: -45.9911
            },
            {
                id: 15,
                nome: "Hotel Pousada Agua Marinha",
                avaliacao: 4.8,
                localizacao: "Brejatuba, Guaratuba",
                preco: 650,
                precoTexto: "R$ 650",
                cidade: "pr",
                imagem: "https://i.ibb.co/fY0nGHmw/Hotel-Pousada-Agua-Marinha.jpg",
                avaliacoes: 1182,
                link: "hoteis/agua-marinha-pr",
                categoria: "medio",
                lat: -25.8800,
                lng: -48.5833
            },
            {
                id: 16,
                nome: "Hotel Pousada Canto da Vigia",
                avaliacao: 4.9,
                localizacao: "Armação, Penha",
                preco: 580,
                precoTexto: "R$ 580",
                cidade: "sc",
                imagem: "https://i.ibb.co/HfPvqV9P/hotel-canto.jpg",
                avaliacoes: 651,
                link: "hoteis/canto-vigia-sc",
                categoria: "medio",
                lat: -26.7833,
                lng: -48.6167
            },
            {
                id: 17,
                nome: "Hotel Pousada Universal",
                avaliacao: 4.3,
                localizacao: "Setor rodoviário, Riachão",
                preco: 580,
                precoTexto: "R$ 580",
                cidade: "ma",
                imagem: "https://i.ibb.co/wNdvDFv4/hotel-universal.webp",
                avaliacoes: 276,
                link: "hoteis/pousada-universal-ma",
                categoria: "medio",
                lat: -7.3619,
                lng: -46.6744
            },
            {
                id: 18,
                nome: "Hotel Rios",
                avaliacao: 4.4,
                localizacao: "Potosi, Balsas",
                preco: 550,
                precoTexto: "R$ 550",
                cidade: "ma",
                imagem: "https://i.ibb.co/N4tRbrF/hotel-rios.jpg",
                avaliacoes: 80,
                link: "hoteis/hotel-rios-ma",
                categoria: "medio",
                lat: -7.5321,
                lng: -46.0355
            },
            {
                id: 19,
                nome: "San Michel Hotel",
                avaliacao: 4.8,
                localizacao: "República, São Paulo",
                preco: 650,
                precoTexto: "R$ 650",
                cidade: "sp",
                imagem: "https://i.ibb.co/7Jr9J0NJ/michel-hotel.jpg",
                avaliacoes: 2526,
                link: "hoteis/san-michel-sp",
                categoria: "medio",
                lat: -23.5440,
                lng: -46.6423
            },
            {
                id: 20,
                nome: "Hotel Viale Cataratas",
                avaliacao: 4.5,
                localizacao: "Vila Yolanda, Foz do Iguaçu",
                preco: 650,
                precoTexto: "R$ 650",
                cidade: "pr",
                imagem: "https://i.ibb.co/5xnLP14N/Viale-Cataratas-Hotel.jpg",
                avaliacoes: 1864,
                link: "hoteis/viale-cataratas-pr",
                categoria: "medio",
                lat: -25.5478,
                lng: -54.5873
            },
            {
                id: 21,
                nome: "Hotel Villa Lobos Spa Romantik",
                avaliacao: 4.9,
                localizacao: "Pte. Nova, Extrema",
                preco: 550,
                precoTexto: "R$ 550",
                cidade: "mg",
                imagem: "https://i.ibb.co/SXsj4K6f/Hotel-spa.jpg",
                avaliacoes: 13335,
                link: "hoteis/villa-lobos-mg",
                categoria: "medio",
                lat: -22.8548,
                lng: -46.3186
            }
        ];

        // Número de hotéis por página
        const hoteisPorPagina = 6;
        let paginaAtual = 1;
        let hoteisFiltrados = [...hoteis];
        let map;

        // Função para criar um card de hotel
        function criarHotelCard(hotel) {
            const hotelCard = document.createElement('div');
            hotelCard.className = 'hotel-card show';
            hotelCard.innerHTML = `
                <div class="hotel-img">
                    <img src="${hotel.imagem}" alt="${hotel.nome}">
                </div>
                <div class="hotel-content">
                    <div class="hotel-header">
                        <h3 class="hotel-title">${hotel.nome}</h3>
                        <div class="hotel-rating">
                            <span class="star">★</span>${hotel.avaliacao}
                        </div>
                    </div>
                    <div class="hotel-location">📍 ${hotel.localizacao}</div>
                    <div class="hotel-info">
                        <p><span>💰</span> <span class="hotel-price">${hotel.precoTexto}</span> /noite</p>
                        <p><span>⭐</span> ${hotel.avaliacoes} avaliações</p>
                    </div>
                    <div class="hotel-footer">
                        <a href="${hotel.link}" class="btn-ver-mais">Ver Detalhes</a>
                    </div>
                </div>
            `;
            return hotelCard;
        }

        // Função para exibir os hotéis na página atual
        function exibirHoteis() {
            const hoteisGrid = document.getElementById('hoteis-grid');
            hoteisGrid.innerHTML = '';
            const startIndex = (paginaAtual - 1) * hoteisPorPagina;
            const endIndex = startIndex + hoteisPorPagina;
            const hoteisPagina = hoteisFiltrados.slice(startIndex, endIndex);
            if (hoteisPagina.length === 0) {
                hoteisGrid.innerHTML = '<div class="loading">Nenhum hotel encontrado...</div>';
                return;
            }
            hoteisPagina.forEach(hotel => {
                const hotelCard = criarHotelCard(hotel);
                hoteisGrid.appendChild(hotelCard);
            });
            // Atualiza a informação de paginação
            const totalPaginas = Math.ceil(hoteisFiltrados.length / hoteisPorPagina);
            document.getElementById('pagination-info').textContent = `Mostrando ${startIndex + 1} a ${Math.min(endIndex, hoteisFiltrados.length)} de ${hoteisFiltrados.length} hotéis`;
            // Atualiza os botões de paginação
            atualizarPaginacao(totalPaginas);
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
                    exibirHoteis();
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
                    exibirHoteis();
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
                    exibirHoteis();
                }
            });
            paginacao.appendChild(btnProximo);
        }

        // Função para aplicar os filtros
        function aplicarFiltros() {
            const destino = document.getElementById('destino').value;
            const preco = document.getElementById('preco').value;
            const classificacao = document.getElementById('classificacao').value;
            hoteisFiltrados = hoteis.filter(hotel => {
                const atendeDestino = destino === '' || hotel.cidade === destino;
                const atendePreco = preco === 'todos' || hotel.categoria === preco;
                const atendeClassificacao = classificacao === 'todos' || hotel.avaliacao >= parseFloat(classificacao);
                return atendeDestino && atendePreco && atendeClassificacao;
            });
            paginaAtual = 1;
            exibirHoteis();
            // Ajusta o mapa para a cidade selecionada
            if (destino && map) {
                const cidadeCoordenadas = {
                    "sp": [-23.5505, -46.6333],
                    "rj": [-22.9068, -43.1729],
                    "rs": [-30.0346, -51.2177],
                    "ma": [-2.5307, -44.3068],
                    "mg": [-19.9167, -43.9345],
                    "pr": [-25.4296, -49.2713],
                    "sc": [-27.5954, -48.5480]
                };
                if (cidadeCoordenadas[destino]) {
                    map.setView(cidadeCoordenadas[destino], 12);
                }
            }
            showNotification('Filtro aplicado com sucesso!', 'success');
        }

        // Função para limpar os filtros
        function limparFiltros() {
            document.getElementById('destino').value = '';
            document.getElementById('preco').value = 'todos';
            document.getElementById('classificacao').value = 'todos';
            hoteisFiltrados = [...hoteis];
            paginaAtual = 1;
            exibirHoteis();
            if (map) {
                map.setView([-15.7797, -47.9297], 4); // Volta para a visão padrão
            }
            showNotification('Filtros limpos!', 'success');
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
            // Configura os botões de filtro
            document.getElementById('btn-filtrar').addEventListener('click', aplicarFiltros);
            document.getElementById('btn-limpar').addEventListener('click', limparFiltros);

            // Exibe os hotéis inicialmente
            exibirHoteis();

            // Inicializa o mapa com tratamento de erros
            try {
                map = L.map('map').setView([-15.7797, -47.9297], 4);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    maxZoom: 19,
                    detectRetina: true
                }).addTo(map);
                // Adiciona marcadores para os hotéis
                hoteis.forEach(hotel => {
                    if (hotel.lat && hotel.lng) {
                        L.marker([hotel.lat, hotel.lng])
                            .addTo(map)
                            .bindPopup(`<b>${hotel.nome}</b><br>${hotel.localizacao}`);
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
