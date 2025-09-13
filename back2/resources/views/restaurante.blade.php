@extends('layouts.app')

@section('title', 'Restaurantes - Bella Avventura')

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        @font-face {
            font-family: 'GaramondBold';
            src: local('Garamond'), serif;
            font-weight: bold;
        }

        .main-content {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            flex: 1;
        }

        .page-title {
            font-family: 'GaramondBold', serif;
            text-align: center;
            color: #5a8f3d;
            margin-bottom: 2rem;
            font-size: 2.5rem;
        }

        .page-subtitle {
            text-align: center;
            font-weight: 400;
            margin-bottom: 3rem;
            color: #333;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .filtros-container {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 3px solid #D8E6D9;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.8s ease;
            max-width: 900px;
            width: 100%;
        }

        .filtros-container h3 {
            color: #5a8f3d;
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
            color: #333;
        }

        .filtro-grupo select,
        .filtro-grupo input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #D8E6D9;
            border-radius: 5px;
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
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-filtrar {
            background-color: #5a8f3d;
            color: white;
        }

        .btn-filtrar:hover {
            background-color: #4a7d2d;
        }

        .btn-limpar {
            background-color: #f0f0f0;
            color: #333;
        }

        .btn-limpar:hover {
            background-color: #e0e0e0;
        }

        .pagination-info {
            text-align: center;
            margin-bottom: 1rem;
            color: #666;
            font-weight: 400;
        }

        .restaurantes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            min-height: 600px;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .restaurante-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            border: 3px solid #D8E6D9;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
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
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
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
            background-color: #5a8f3d;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
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
            color: #5a8f3d;
            margin: 0;
        }

        .restaurante-rating {
            display: flex;
            align-items: center;
            font-weight: bold;
        }

        .star {
            color: #FFD700;
            margin-right: 3px;
        }

        .restaurante-tipos {
            margin-bottom: 1rem;
            color: #666;
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
            color: #5a8f3d;
        }

        .restaurante-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
            border-top: 1px solid #D8E6D9;
            padding-top: 1rem;
        }

        .btn-ver-mais {
            background-color: #f0f0f0;
            color: #333;
            width: 40%;
            padding: 0.6rem 1rem;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
        }

        .btn-ver-mais:hover {
            background-color: #e0e0e0;
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
            border: 1px solid #D8E6D9;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: white;
            font-weight: bold;
        }

        .pagina-btn:hover,
        .pagina-btn.active {
            background-color: #5a8f3d;
            color: white;
        }

        .pagina-btn.disabled {
            cursor: not-allowed;
            opacity: 0.5;
        }

        .pagina-seta {
            font-size: 1.2rem;
        }

        .loading {
            text-align: center;
            padding: 2rem;
            color: #666;
            grid-column: 1/-1;
        }

        #map {
            height: 300px;
            width: 80%;
            margin: 1rem auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .notificacao {
            background-color: #5a8f3d;
            color: white;
            padding: 16px;
            text-align: center;
            font-weight: bold;
            display: none;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            min-width: 300px;
        }

        .notificacao.show {
            display: block;
            animation: fadeOut 4s forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
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

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-5px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
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
        }
    </style>
@endsection

@section('content')
    <main class="main-content">
        <h1 class="page-title">Restaurantes</h1>
        <p class="page-subtitle">Descubra os melhores sabores locais e internacionais. Filtre por tipo de cozinha,
            preço e avaliações para encontrar o restaurante perfeito para sua experiência gastronômica.</p>

        <!-- Filtros -->
        <div class="filtros-container">
            <h3>Filtros</h3>
            <form class="filtros-form" id="filtros-form">
                <div class="filtro-grupo">
                    <label for="tipo-cozinha">Tipo de Cozinha</label>
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
                    <select id="avaliacao" name="avaliacao">
                        <option value="">Qualquer</option>
                        <option value="3">3+ Estrelas</option>
                        <option value="4">4+ Estrelas</option>
                        <option value="4.5">4.5+ Estrelas</option>
                    </select>
                </div>
                <div class="filtro-grupo">
                    <label for="localizacao">Cidade</label>
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
        <div id="notificacao" class="notificacao"></div>
    </main>
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
                link: "Restaurante_Jamile.html",
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
                imagem: "https://i.ibb.co/ZpcfkT9f/120736342-945661575912829-652691859883304712-n.jpg",
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
                imagem: "https://lh3.googleusercontent.com/gps-cs-s/AC9h4npAFzSInmryDEoV82CI7lJHUv9hBubTuYzOLuzfpf9xlrPt4hRDz-6oxNZB-2zXsuoe1MA3qMje5Z_3iI6TyIiD1spmJd98YSTItd3J_ittauvVea60ljzy2YnL1gEo2T0gmZLnWA=s680-w680-h510",
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
                imagem: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/24/c6/4c/e4/salao-1.jpg?w=900&h=500&s=1",
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
                imagem: "https://lh3.googleusercontent.com/p/AF1QipOkHJiEMiwiP1IJFBn9O1wZcrXG_xcyUUoqn-FW=s680-w680-h510",
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
            document.getElementById('btn-filtrar').addEventListener('click', aplicarFiltros);
            document.getElementById('btn-limpar').addEventListener('click', limparFiltros);

            // Exibe os restaurantes inicialmente
            exibirRestaurantes();

            // Inicializa o mapa com tratamento de erros
            try {
                map = L.map('map').setView([-15.7797, -47.9297], 4);

                // CORREÇÃO: URL correto do tile layer (removida a barra extra)
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    maxZoom: 19,
                    detectRetina: true // Melhora a qualidade em displays retina
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
                // Exibe uma mensagem de erro no container do mapa
                document.getElementById('map').innerHTML = `
                    <div style="text-align: center; padding: 20px; color: #666;">
                        <p>⚠️ Não foi possível carregar o mapa</p>
                        <p>Verifique sua conexão com a internet</p>
                    </div>
                `;
            }
        });

        // Função para aplicar os filtros - ATUALIZADA para funcionar com o mapa
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
    </script>
@endsection
