@extends('layouts.app')

@section('title', 'Pontos Turísticos - Bella Avventura')

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

        .pontos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            min-height: 600px;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .ponto-card {
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

        .ponto-card.show {
            opacity: 1;
            transform: translateY(0);
        }

        .ponto-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .ponto-img {
            height: 180px;
            overflow: hidden;
            position: relative;
        }

        .ponto-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .ponto-card:hover .ponto-img img {
            transform: scale(1.1);
        }

        .ponto-badge {
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

        .ponto-promocao {
            background-color: #ff6b6b;
        }

        .ponto-content {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .ponto-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.5rem;
        }

        .ponto-title {
            font-size: 1.3rem;
            color: #5a8f3d;
            margin: 0;
        }

        .ponto-rating {
            display: flex;
            align-items: center;
            font-weight: bold;
        }

        .star {
            color: #FFD700;
            margin-right: 3px;
        }

        .ponto-location {
            margin-bottom: 1rem;
            color: #666;
            font-size: 0.9rem;
            font-weight: 400;
        }

        .ponto-info {
            margin-bottom: 1rem;
            flex: 1;
        }

        .ponto-info p {
            margin: 0.5rem 0;
            font-weight: 400;
            display: flex;
            align-items: center;
        }

        .ponto-info p span {
            margin-right: 0.5rem;
        }

        .ponto-price {
            font-weight: bold;
            color: #5a8f3d;
        }

        .ponto-footer {
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

        /* Estilos do Mapa */
        #map {
            height: 400px;
            width: 90%;
            margin: 2rem auto;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 3px solid #D8E6D9;
            z-index: 1;
        }

        .map-container {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 2rem;
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
            .pontos-grid {
                grid-template-columns: 1fr;
            }
            .page-title {
                font-size: 2rem;
            }
            .filtros-form {
                flex-direction: column;
            }
            #map {
                height: 300px;
                width: 95%;
            }
        }
    </style>
@endsection

@section('content')
<main class="main-content">
    <h1 class="page-title">Pontos Turísticos</h1>
    <p class="page-subtitle">Descubra os melhores pontos turísticos para sua visita. Filtre por tipo,
        localização e avaliações para uma experiência personalizada.</p>

    <!-- Filtros -->
    <div class="filtros-container">
        <h3>Filtros</h3>
        <form class="filtros-form" id="filtros-form">
            <div class="filtro-grupo">
                <label for="tipo">Tipo de Atração</label>
                <select id="tipo" name="tipo">
                    <option value="">Todos</option>
                    <option value="historico">Histórico</option>
                    <option value="natural">Natural</option>
                    <option value="cultural">Cultural</option>
                    <option value="aventura">Aventura</option>
                    <option value="religioso">Religioso</option>
                </select>
            </div>
            <div class="filtro-grupo">
                <label for="localizacao">Localização</label>
                <select id="localizacao" name="localizacao">
                    <option value="">Todas</option>
                    <option value="sp">São Paulo</option>
                    <option value="mg">Minas Gerais</option>
                    <option value="rs">Rio Grande do Sul</option>
                    <option value="sc">Santa Catarina</option>
                    <option value="pr">Paraná</option>
                    <option value="rj">Rio de Janeiro</option>
                    <option value="ma">Maranhão</option>
                </select>
            </div>
            <div class="filtro-grupo">
                <label for="avaliacao">Avaliação Mínima</label>
                <select id="avaliacao" name="avaliacao">
                    <option value="">Qualquer</option>
                    <option value="3">3 Estrelas</option>
                    <option value="4">4 Estrelas</option>
                    <option value="4.5">4.5+ Estrelas</option>
                </select>
            </div>
            <div class="filtro-grupo">
                <label for="preco">Faixa de Preço</label>
                <select id="preco" name="preco">
                    <option value="">Todos</option>
                    <option value="gratis">Gratuito</option>
                    <option value="economico">Econômico</option>
                    <option value="medio">Médio</option>
                    <option value="alto">Alto</option>
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
        Carregando pontos turísticos...
    </div>

    <!-- Pontos Turísticos Grid -->
    <div class="pontos-grid" id="pontos-grid">
        <div class="loading">Carregando pontos turísticos...</div>
    </div>

    <!-- Paginação -->
    <div class="paginacao" id="paginacao"></div>

    <!-- Mapa -->
    <div class="map-container">
        <div id="map"></div>
    </div>

    <!-- Notificação -->
    <div id="notificacao" class="notificacao"></div>
</main>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Base de dados de pontos turísticos com coordenadas
        const pontosTuristicos = [
            {
                id: 1,
                nome: "Beco do Batman",
                tipo: "cultural",
                avaliacao: 4.9,
                localizacao: "São Paulo, SP • Brasil",
                preco: "gratis",
                precoTexto: "Gratuito",
                cidade: "sp",
                imagem: "https://i.ibb.co/BK3tM0Q6/Beco-do-Batman.png",
                avaliacoes: 12500,
                link: "pontos-turisticos/beco-do-batman",
                lat: -23.5505,
                lng: -46.6333
            },
            {
                id: 2,
                nome: "Museu da Inconfidência",
                tipo: "historico",
                avaliacao: 3.8,
                localizacao: "Praça Tiradentes, 139, Centro, Ouro Preto - MG",
                preco: "medio",
                precoTexto: "Médio",
                cidade: "mg",
                imagem: "https://i.ibb.co/1tYjyVFY/Museu-da-Inconfidencia.png",
                avaliacoes: 9800,
                link: "pontos-turisticos/museu-inconfidencia",
                lat: -20.3855,
                lng: -43.5033
            },
            {
                id: 3,
                nome: "Pão de Açúcar",
                tipo: "natural",
                avaliacao: 4.7,
                localizacao: "Urca, Rio de Janeiro",
                preco: "gratis",
                precoTexto: "Gratuito",
                cidade: "rj",
                imagem: "https://i.ibb.co/DPYLP3Tz/pao-de-acucar-principal.jpg",
                avaliacoes: 8200,
                link: "pontos-turisticos/pao-de-acucar",
                lat: -22.9519,
                lng: -43.1655
            },
            {
                id: 4,
                nome: "Parque das Aves",
                tipo: "natural",
                avaliacao: 4.6,
                localizacao: "Foz do Iguaçu, Paraná",
                preco: "gratis",
                precoTexto: "Gratuito",
                cidade: "pr",
                imagem: "https://i.ibb.co/7xHYWJgC/Parque-das-Aves.png",
                avaliacoes: 7500,
                link: "pontos-turisticos/parque-das-aves",
                lat: -25.5163,
                lng: -54.5854
            },
            {
                id: 5,
                nome: "Palácio dos Leões",
                tipo: "historico",
                avaliacao: 4.9,
                localizacao: "São Luíz, MA",
                preco: "alto",
                precoTexto: "Alto",
                cidade: "ma",
                imagem: "https://i.ibb.co/605Jtfp9/Palacio-dos-Leoes.png",
                avaliacoes: 10200,
                link: "pontos-turisticos/palacio-dos-leoes",
                lat: -2.5307,
                lng: -44.3068
            },
            {
                id: 6,
                nome: "Mina da Passagem",
                tipo: "historico",
                avaliacao: 3.9,
                localizacao: "Mariana, MG",
                preco: "alto",
                precoTexto: "Alto",
                cidade: "mg",
                imagem: "https://i.ibb.co/CrRHrzy/Mina-da-Passagem.png",
                avaliacoes: 10200,
                link: "pontos-turisticos/mina-da-passagem",
                lat: -20.3772,
                lng: -43.4163
            },
            {
                id: 7,
                nome: "Catedral da Sé",
                tipo: "religioso",
                avaliacao: 4.9,
                localizacao: "São Paulo, SP",
                preco: "alto",
                precoTexto: "Alto",
                cidade: "sp",
                imagem: "https://i.ibb.co/5XLKDyhC/Catedral-da-S.png",
                avaliacoes: 10200,
                link: "pontos-turisticos/catedral-da-se",
                lat: -23.5505,
                lng: -46.6333
            },
            {
                id: 8,
                nome: "Centro Histórico de São Luís",
                tipo: "historico",
                avaliacao: 4.9,
                localizacao: "São Luíz, MA",
                preco: "alto",
                precoTexto: "Alto",
                cidade: "ma",
                imagem: "https://i.ibb.co/LzsHKZSR/Centro-Hist-rico-de-S-o-Lu-s.png",
                avaliacoes: 10200,
                link: "pontos-turisticos/centro-historico-sao-luis",
                lat: -2.5307,
                lng: -44.3068
            },
            {
                id: 9,
                nome: "Praia da Joaquina",
                tipo: "natural",
                avaliacao: 4.9,
                localizacao: "Florianópolis, SC",
                preco: "alto",
                precoTexto: "Alto",
                cidade: "sc",
                imagem: "https://i.ibb.co/ZRMkQCrw/Praia-da-Joaquina.png",
                avaliacoes: 10200,
                link: "pontos-turisticos/praia-joaquina",
                lat: -27.6355,
                lng: -48.4462
            },
            {
                id: 10,
                nome: "Mirante do Morro da Cruz",
                tipo: "natural",
                avaliacao: 4.9,
                localizacao: "Florianópolis, SC",
                preco: "alto",
                precoTexto: "Alto",
                cidade: "sc",
                imagem: "https://i.ibb.co/tMc9JSjv/Mirante-do-Morro-da-Cruz.png",
                avaliacoes: 10200,
                link: "pontos-turisticos/mirante-morro-cruz",
                lat: -27.5969,
                lng: -48.5496
            },
            {
                id: 11,
                nome: "Cataratas do Iguaçu",
                tipo: "natural",
                avaliacao: 4.9,
                localizacao: "Foz do Iguaçu, PR",
                preco: "alto",
                precoTexto: "Alto",
                cidade: "pr",
                imagem: "https://i.ibb.co/4nwCr50p/cataratas-do-iguacu-principal.jpg",
                avaliacoes: 10200,
                link: "pontos-turisticos/cataratas-do-iguacu",
                lat: -25.6953,
                lng: -54.4367
            },
            {
                id: 12,
                nome: "Cristo Redentor",
                tipo: "religioso",
                avaliacao: 4.9,
                localizacao: "Rio de Janeiro, RJ",
                preco: "alto",
                precoTexto: "Alto",
                cidade: "rj",
                imagem: "https://i.ibb.co/tpFRvZ6Y/cristo-redentor-principal.jpg",
                avaliacoes: 10200,
                link: "pontos-turisticos/cristo-redentor",
                lat: -22.9519,
                lng: -43.2105
            },
            {
                id: 13,
                nome: "Ilha do Campeche",
                tipo: "natural",
                avaliacao: 4.9,
                localizacao: "Florianópolis, SC",
                preco: "alto",
                precoTexto: "Alto",
                cidade: "sc",
                imagem: "https://i.ibb.co/nMhtHm77/Ilha-do-Campeche.png",
                avaliacoes: 10200,
                link: "pontos-turisticos/ilha-do-campeche",
                lat: -27.6892,
                lng: -48.4754
            },
            {
                id: 14,
                nome: "Lençóis Maranhenses",
                tipo: "natural",
                avaliacao: 4.9,
                localizacao: "Parque Nacional dos Lençóis Maranhenses, MA",
                preco: "alto",
                precoTexto: "Alto",
                cidade: "ma",
                imagem: "https://i.ibb.co/BK4v8LsX/Len-ois-Maranhenses.png",
                avaliacoes: 10200,
                link: "pontos-turisticos/lencois-maranhenses",
                lat: -2.5469,
                lng: -43.1235
            },
            {
                id: 15,
                nome: "Mini Mundo",
                tipo: "cultural",
                avaliacao: 4.9,
                localizacao: "Gramado, RS",
                preco: "alto",
                precoTexto: "Alto",
                cidade: "rs",
                imagem: "https://i.ibb.co/jvNDDqdk/mini-mundo-principal.png",
                avaliacoes: 10200,
                link: "pontos-turisticos/mini-mundo",
                lat: -29.3739,
                lng: -50.8811
            },
            {
                id: 16,
                nome: "Praia de Copacabana",
                tipo: "natural",
                avaliacao: 4.9,
                localizacao: "Copacabana, RJ",
                preco: "alto",
                precoTexto: "Alto",
                cidade: "rj",
                imagem: "https://i.ibb.co/RpspQCJb/praia-copacabanaprincipal.jpg",
                avaliacoes: 10200,
                link: "pontos-turisticos/praia-copacabana",
                lat: -22.9712,
                lng: -43.1823
            },
            {
                id: 17,
                nome: "Rua Coberta",
                tipo: "cultural",
                avaliacao: 4.9,
                localizacao: "Gramado, RS",
                preco: "alto",
                precoTexto: "Alto",
                cidade: "rs",
                imagem: "https://i.ibb.co/RGPQnFfQ/Foto-Rua-Coberta.png",
                avaliacoes: 10200,
                link: "pontos-turisticos/rua-coberta",
                lat: -29.3785,
                lng: -50.8754
            },
            {
                id: 18,
                nome: "Usina Hidrelétrica de Itaipu",
                tipo: "cultural",
                avaliacao: 4.9,
                localizacao: "Foz do Iguaçu, PR",
                preco: "alto",
                precoTexto: "Alto",
                cidade: "pr",
                imagem: "https://i.ibb.co/bgFwbx4F/usina-hidreletrica-itaipu-principal.png",
                avaliacoes: 10200,
                link: "pontos-turisticos/itaipu",
                lat: -25.4086,
                lng: -54.5888
            },
            {
                id: 19,
                nome: "Igreja de São Francisco de Assis",
                tipo: "religioso",
                avaliacao: 4.9,
                localizacao: "Ouro de Preto, MG",
                preco: "alto",
                precoTexto: "Alto",
                cidade: "mg",
                imagem: "https://i.ibb.co/DTSkvSy/Igreja-de-S-o-Francisco-de-Assis.png",
                avaliacoes: 10200,
                link: "pontos-turisticos/igreja-sao-francisco",
                lat: -20.3855,
                lng: -43.5033
            },
            {
                id: 20,
                nome: "Parque Ibirapuera",
                tipo: "natural",
                avaliacao: 4.9,
                localizacao: "São Paulo, SP",
                preco: "alto",
                precoTexto: "Alto",
                cidade: "sp",
                imagem: "https://i.ibb.co/dJWhkRQ5/Ibirapuera-Park.png",
                avaliacoes: 10200,
                link: "pontos-turisticos/parque-ibirapuera",
                lat: -23.5878,
                lng: -46.6580
            },
            {
                id: 21,
                nome: "Lago Negro",
                tipo: "natural",
                avaliacao: 4.5,
                localizacao: "Gramado, Rio Grande do Sul",
                preco: "medio",
                precoTexto: "Médio",
                cidade: "rs",
                imagem: "https://i.ibb.co/k2x0S05T/Lago-Negro.png",
                avaliacoes: 6800,
                link: "pontos-turisticos/lago-negro",
                lat: -29.3769,
                lng: -50.8764
            }
        ];

        // Número de pontos turísticos por página
        const pontosPorPagina = 6;
        let paginaAtual = 1;
        let pontosFiltrados = [...pontosTuristicos];
        let map;
        let markers = [];

        // Função para criar um card de ponto turístico
        function criarPontoCard(ponto) {
            const pontoCard = document.createElement('div');
            pontoCard.className = 'ponto-card';

            pontoCard.innerHTML = `
                <div class="ponto-img">
                    <img src="${ponto.imagem}" alt="${ponto.nome}" onerror="this.src='https://via.placeholder.com/300x180/5a8f3d/ffffff?text=Imagem+Indisponível'">
                </div>
                <div class="ponto-content">
                    <div class="ponto-header">
                        <h3 class="ponto-title">${ponto.nome}</h3>
                        <div class="ponto-rating">
                            <span class="star">★</span>${ponto.avaliacao}
                        </div>
                    </div>
                    <div class="ponto-location">📍 ${ponto.localizacao}</div>
                    <div class="ponto-info">
                        <p><span>💰</span> <span class="ponto-price">${ponto.precoTexto}</span></p>
                        <p><span>⭐</span> ${ponto.avaliacoes} avaliações</p>
                    </div>
                    <div class="ponto-footer">
                        <a href="${ponto.link}" class="btn-ver-mais">Ver Detalhes</a>
                    </div>
                </div>
            `;

            // Adiciona a animação após um pequeno delay
            setTimeout(() => {
                pontoCard.classList.add('show');
            }, 100);

            return pontoCard;
        }

        // Função para exibir os pontos turísticos na página atual
        function exibirPontosTuristicos() {
            const pontosGrid = document.getElementById('pontos-grid');
            pontosGrid.innerHTML = '';

            const startIndex = (paginaAtual - 1) * pontosPorPagina;
            const endIndex = startIndex + pontosPorPagina;
            const pontosPagina = pontosFiltrados.slice(startIndex, endIndex);

            if (pontosPagina.length === 0) {
                pontosGrid.innerHTML = '<div class="loading">Nenhum ponto turístico encontrado...</div>';
                atualizarPaginacao(0);
                atualizarMapa();
                return;
            }

            pontosPagina.forEach(ponto => {
                const pontoCard = criarPontoCard(ponto);
                pontosGrid.appendChild(pontoCard);
            });

            // Atualiza a informação de paginação
            const totalPaginas = Math.ceil(pontosFiltrados.length / pontosPorPagina);
            document.getElementById('pagination-info').textContent = `Mostrando ${startIndex + 1} a ${Math.min(endIndex, pontosFiltrados.length)} de ${pontosFiltrados.length} pontos turísticos`;

            // Atualiza os botões de paginação
            atualizarPaginacao(totalPaginas);

            // Atualiza o mapa
            atualizarMapa();
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
                    exibirPontosTuristicos();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
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
                    exibirPontosTuristicos();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
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
                    exibirPontosTuristicos();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
            paginacao.appendChild(btnProximo);
        }

        // Função para aplicar os filtros
        function aplicarFiltros() {
            const tipo = document.getElementById('tipo').value;
            const localizacao = document.getElementById('localizacao').value;
            const avaliacao = document.getElementById('avaliacao').value;
            const preco = document.getElementById('preco').value;

            pontosFiltrados = pontosTuristicos.filter(ponto => {
                return (
                    (tipo === '' || ponto.tipo === tipo) &&
                    (localizacao === '' || ponto.cidade === localizacao) &&
                    (avaliacao === '' || ponto.avaliacao >= parseFloat(avaliacao)) &&
                    (preco === '' || ponto.preco === preco)
                );
            });

            paginaAtual = 1;
            exibirPontosTuristicos();
            showNotification('Filtro aplicado com sucesso!', 'success');
        }

        // Função para limpar os filtros
        function limparFiltros() {
            document.getElementById('tipo').value = '';
            document.getElementById('localizacao').value = '';
            document.getElementById('avaliacao').value = '';
            document.getElementById('preco').value = '';

            pontosFiltrados = [...pontosTuristicos];
            paginaAtual = 1;
            exibirPontosTuristicos();
            showNotification('Filtros limpos!', 'success');
        }

        // Função para atualizar o mapa com os pontos filtrados
        function atualizarMapa() {
            // Limpa marcadores anteriores
            markers.forEach(marker => map.removeLayer(marker));
            markers = [];

            // Adiciona novos marcadores
            pontosFiltrados.forEach(ponto => {
                if (ponto.lat && ponto.lng) {
                    const marker = L.marker([ponto.lat, ponto.lng]).addTo(map)
                        .bindPopup(`<b>${ponto.nome}</b><br>${ponto.localizacao}`);
                    markers.push(marker);
                }
            });

            // Ajusta a visualização do mapa para mostrar todos os marcadores
            if (markers.length > 0) {
                const group = new L.featureGroup(markers);
                map.fitBounds(group.getBounds().pad(0.1));
            } else {
                // Se não houver marcadores, volta para a visualização padrão do Brasil
                map.setView([-15.7797, -47.9297], 4);
            }
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

            // Inicializa o mapa
            try {
                map = L.map('map').setView([-15.7797, -47.9297], 4);

                // Adiciona uma camada de mapa
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                // Exibe os pontos turísticos inicialmente
                exibirPontosTuristicos();
            } catch (error) {
                console.error('Erro ao inicializar o mapa:', error);
                document.getElementById('pagination-info').textContent = 'Erro ao carregar o mapa.';
                exibirPontosTuristicos(); // Ainda exibe os pontos mesmo com erro no mapa
            }
        });
    </script>
@endsection