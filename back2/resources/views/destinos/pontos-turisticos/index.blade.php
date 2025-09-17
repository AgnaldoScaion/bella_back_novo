@extends('layouts.app')

@section('title', 'Pontos Turísticos - Bella Avventura')

@section('styles')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
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

    .pontos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.8rem;
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .ponto-card {
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

    .ponto-card.show {
        opacity: 1;
        transform: translateY(0);
    }

    .ponto-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-hover);
    }

    .ponto-img {
        height: 220px;
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
        transform: scale(1.08);
    }

    .ponto-content {
        padding: 1.8rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .ponto-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.8rem;
    }

    .ponto-title {
        font-family: 'Inter', sans-serif;
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--primary-color);
        margin: 0;
    }

    .ponto-rating {
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

    .ponto-location {
        margin-bottom: 1rem;
        color: #555;
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        font-weight: 400;
        line-height: 1.5;
    }

    .ponto-info {
        margin-bottom: 1.2rem;
        flex: 1;
    }

    .ponto-info p {
        margin: 0.6rem 0;
        font-family: 'Inter', sans-serif;
        font-weight: 400;
        font-size: 0.95rem;
        color: var(--text-color);
        display: flex;
        align-items: center;
    }

    .ponto-info p span {
        margin-right: 0.6rem;
        font-size: 1.1rem;
    }

    .ponto-price {
        font-weight: 600;
        color: var(--primary-color);
    }

    .ponto-footer {
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

    .map-container {
        display: flex;
        justify-content: center;
        width: 100%;
        margin-top: 2rem;
    }

    #map {
        height: 400px;
        width: 100%;
        max-width: 1000px;
        border-radius: 12px;
        border: 2px solid var(--secondary-color);
        box-shadow: var(--shadow);
        z-index: 1;
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

        .pontos-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .ponto-img {
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
    <!-- Título e Subtítulo -->
    <h1 class="page-title">Pontos Turísticos</h1>
    <p class="page-subtitle">
      Descubra os melhores pontos turísticos para sua visita. Filtre por tipo, localização e avaliações para uma experiência personalizada.
    </p>

    <!-- Filtros -->
    <div class="filtros-container">
      <h3>Filtros</h3>
      <form class="filtros-form" id="filtros-form">
        <div class="filtro-grupo">
          <label for="tipo">Tipo de Atração</label>
          <i class="fas fa-landmark"></i>
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
          <i class="fas fa-map-marker-alt"></i>
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
          <i class="fas fa-star"></i>
          <select id="avaliacao" name="avaliacao">
            <option value="">Qualquer</option>
            <option value="3">3 Estrelas</option>
            <option value="4">4 Estrelas</option>
            <option value="4.5">4.5+ Estrelas</option>
          </select>
        </div>
        <div class="filtro-grupo">
          <label for="preco">Faixa de Preço</label>
          <i class="fas fa-dollar-sign"></i>
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

    <!-- Informações de Paginação -->
    <div class="pagination-info" id="pagination-info">
      Mostrando {{ count($pontosTuristicos) }} pontos turísticos
    </div>

    <!-- Grid de Pontos Turísticos -->
    <div class="pontos-grid" id="pontos-grid">
      @foreach($pontosTuristicos as $ponto)
        <div class="ponto-card">
          <div class="ponto-img">
            <img src="{{ $ponto['imagem'] }}" alt="{{ $ponto['nome'] }}"
                 onerror="this.src='https://via.placeholder.com/320x220/5a8f3d/ffffff?text=Imagem+Indisponível'">
          </div>
          <div class="ponto-content">
            <div class="ponto-header">
              <h3 class="ponto-title">{{ $ponto['nome'] }}</h3>
              <div class="ponto-rating">
                <span class="star">★</span>{{ $ponto['avaliacao'] }}
              </div>
            </div>
            <div class="ponto-location">📍 {{ $ponto['localizacao'] }}</div>
            <div class="ponto-info">
              <p><span>💰</span> <span class="ponto-price">{{ $ponto['precoTexto'] }}</span></p>
              <p><span>⭐</span> {{ $ponto['avaliacoes'] }} avaliações</p>
            </div>
            <div class="ponto-footer">
              <a href="{{ route('pontos-turisticos.show', $ponto['link']) }}" class="btn-ver-mais">Ver Detalhes</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Mapa -->
    <div class="map-container">
      <div id="map"></div>
    </div>

    <!-- Notificação -->
    <div id="notificacao" class="notificacao">
      <i class="fas fa-check-circle"></i>
      <span></span>
    </div>

    <!-- Paginação -->
    <div class="paginacao" id="paginacao"></div>
  </main>
@endsection

@section('scripts')
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
          integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
          crossorigin=""></script>
  <script>
    // Dados dos pontos turísticos passados pelo controller
    const pontosTuristicos = @json($pontosTuristicos);

    // Configurações iniciais
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
                <img src="${ponto.imagem}" alt="${ponto.nome}"
                     onerror="this.src='https://via.placeholder.com/320x220/5a8f3d/ffffff?text=Imagem+Indisponível'">
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
                    <a href="/destinos/pontos-turisticos/${ponto.link}" class="btn-ver-mais">Ver Detalhes</a>
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
        document.getElementById('pagination-info').textContent =
            `Mostrando ${startIndex + 1} a ${Math.min(endIndex, pontosFiltrados.length)} de ${pontosFiltrados.length} pontos turísticos`;
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
        // Ajusta o mapa para a cidade selecionada
        if (localizacao && map) {
            const cidadeCoordenadas = {
                "sp": [-23.5505, -46.6333],
                "rj": [-22.9068, -43.1729],
                "rs": [-30.0346, -51.2177],
                "ma": [-2.5307, -44.3068],
                "mg": [-19.9167, -43.9345],
                "pr": [-25.4296, -49.2713],
                "sc": [-27.5954, -48.5480]
            };
            if (cidadeCoordenadas[localizacao]) {
                map.setView(cidadeCoordenadas[localizacao], 12);
            }
        }
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
        if (map) {
            map.setView([-15.7797, -47.9297], 4); // Volta para a visão padrão
        }
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
            // Força o redimensionamento do mapa
            setTimeout(() => {
                map.invalidateSize();
            }, 100);
        } else {
            // Se não houver marcadores, volta para a visualização padrão do Brasil
            map.setView([-15.7797, -47.9297], 4);
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

    // Inicialização da página
    document.addEventListener('DOMContentLoaded', function () {
        // Configura os botões de filtro
        document.getElementById('btn-filtrar').addEventListener('click', aplicarFiltros);
        document.getElementById('btn-limpar').addEventListener('click', limparFiltros);

        // Inicializa o mapa
        try {
            map = L.map('map').setView([-15.7797, -47.9297], 4);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19,
                detectRetina: true
            }).addTo(map);
            // Força o redimensionamento do mapa após a inicialização
            setTimeout(() => {
                map.invalidateSize();
            }, 100);
            // Exibe os pontos turísticos inicialmente
            exibirPontosTuristicos();
        } catch (error) {
            console.error('Erro ao inicializar o mapa:', error);
            document.getElementById('map').innerHTML = `
                <div style="text-align: center; padding: 20px; color: #666;">
                    <p>⚠️ Não foi possível carregar o mapa</p>
                    <p>Verifique sua conexão com a internet</p>
                </div>
            `;
            exibirPontosTuristicos(); // Ainda exibe os pontos mesmo com erro no mapa
        }
    });
  </script>
@endsection
