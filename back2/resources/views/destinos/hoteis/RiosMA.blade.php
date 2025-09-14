<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Hotel Rios</title>
  <link rel="stylesheet" href="../../CSS/Geral.css">
  <link rel="icon" type="image/png" href="https://i.ibb.co/vx2Dzj9v/image.png">
</head>
<body>

  <!-- Cabeçalho com menu, login e logo -->
  <header>
    <div class="wrapper">

      <!-- Top Header -->
      <div class="top-header">
        <div class="menu-icon">☰</div>
        <div class="user-header">
          <span>👤</span> Visitante
        </div>
      </div>
  
      <div id="menuContainer1"></div>

      <!-- Logo -->
      <div class="header">
        <div class="header-img">
          <a href="../Paginas_principais/Entrada.html">
          <img src="https://i.ibb.co/Q7T008b1/image.png" alt="Logo" />
          </a>
        </div>
      </div>
  </header>

  <main class="grid-container">
    <div class="pilastra-verde"></div>
    <div class="conteudo">
      <!-- Seção do destino principal -->
      <!-- Seção do destino principal -->
      <section class="destino">
        <h1>Hotel Rios</h1>
        <img src="../../IMAGENS/hotel_rios.jpg" alt="Hotel Rios" />
        <div class="estrelas">★★★★</div>
      </section>
  
      <!-- Seção sobre o destino -->
      <section class="sobre">
        
        <h2>Informações Gerais</h2>
                <!-- Localização com ícone -->
<div class="info-localizacao">
    <p>📍Av. Gov. Luiz Rocha, N° 216 - Potosi, Balsas - MA</p>
    <p>📞Telefone: (99) 98529-9393</p>
    <p>🕒Horário de funcionamento: O Hotel Rios em Balsas, MA, oferece recepção 24 horas, Wi-Fi gratuito e quartos com mesa de trabalho e TV de tela plana. O horário de funcionamento da recepção é 24 horas, e o café da manhã é servido de manhã.         </p>
</div>
<h1>🗺️ Localização</h1>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v7.3.0/ol.css">
  <style>
    #map {
      width: 100%;
      height: 450px;
    }
  </style>
</head>
<body>
  <h2>Hotel Rios, Balsas - MA</h2>
  <div id="map"></div>

  <script src="https://cdn.jsdelivr.net/npm/ol@v7.3.0/dist/ol.js"></script>
  <script>
    const latitude = -7.53292;
    const longitude = -46.035;

    const map = new ol.Map({
      target: 'map',
      layers: [
        new ol.layer.Tile({
          source: new ol.source.OSM()
        })
      ],
      view: new ol.View({
        center: ol.proj.fromLonLat([longitude, latitude]),
        zoom: 16
      })
    });

    const marker = new ol.Feature({
      geometry: new ol.geom.Point(
        ol.proj.fromLonLat([longitude, latitude])
      )
    });

    // Estilo com bolinha vermelha
    const markerStyle = new ol.style.Style({
      image: new ol.style.Circle({
        radius: 8,
        fill: new ol.style.Fill({ color: 'red' }),
        stroke: new ol.style.Stroke({ color: 'white', width: 2 })
      })
    });

    marker.setStyle(markerStyle);

    const vectorSource = new ol.source.Vector({
      features: [marker]
    });

    const markerVectorLayer = new ol.layer.Vector({
      source: vectorSource
    });

    map.addLayer(markerVectorLayer);
  </script>
</body>
</html>

  </iframe>
        <h2> Sobre</h2>
        <p>
O Hotel Rios - Balsas é uma opção de hospedagem moderna e confortável localizada na Avenida Governador Luiz Rocha, ao lado da rodoviária de Balsas, Maranhão. Com uma estrutura nova, o hotel oferece quartos equipados com ar-condicionado, TV de tela plana (incluindo Smart TVs com acesso a serviços de streaming como Netflix), frigobar, mesa de trabalho e banheiro privativo.
O hotel oferece Wi-Fi gratuito em todas as áreas e recepção 24 horas. No entanto, não dispõe de estacionamento próprio.


<section class="imagens-secundarias">
        <img src="../../IMAGENS/rios.jpg" alt="foto 1">
        <img src="../../IMAGENS/rios2.jpg" alt="foto 2">
      </section>
  
      <!-- Comentários de visitantes -->
      <section class="comentarios">
        <h2>Comentários <span>(80 avaliações)</span></h2>
        <div class="comentario">
            <h3>Agnaldo Scaion <span>★★★★</span></h3>
            <p>
O Hotel Rios está localizado próximo ao centro de Balsas, ao lado da rodoviária, e se destaca por ser novo, muito limpo e bem cuidado. O ar-condicionado funciona perfeitamente, a cama é confortável, e o quarto conta com mesa, cadeira, área para roupas, TV, Wi-Fi e um espelho grande. O banheiro é impecavelmente limpo, tudo branquinho, e há frigobar e iluminação indireta no teto, o que traz um charme especial. O ambiente é 100% livre de fumaça, o que considero um grande diferencial. O atendimento é rápido e excelente, e o preço é bastante justo, especialmente considerando que a hospedagem em Balsas costuma ser cara. O quarto atendeu perfeitamente às minhas necessidades, e sempre que eu voltar à cidade, com certeza me hospedarei lá novamente.
        </div>
      </section>

  
      <!-- Seção de feedback -->
      <section class="feedback">
        <p>Gostou? Deixe sua avaliação!</p>
        <a href="../../HTML/Feedback/Envio_Feedback_Hoteis.html"><button>Enviar feedback</button></a>
      </section>
    </div>
  </main>


  <!-- Rodapé -->
  <footer class="footer">
    <div class="footer-top">
      <a href="../Paginas_principais/Entrada.html">
        <img src="https://i.ibb.co/j9vGknyy/image.png" alt="image" border="0">
      </a>
    </div>
    <div class="footer-bottom">
      <div class="footer-left">
        <a href="mailto:bella.avventura@gmail.com">📧 bella.avventura@gmail.com</a>
      </div>
      <div class="footer-center">© 2025 Bella Avventura</div>
      <div class="footer-right">
        <a href="../Paginas_principais/Termos_Condicoes.html">Termos e condições</a>
      </div>
    </div>
  </footer>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Verifica autenticação
      checkAuth();

      // Configura menu
      setupMenu();

      // Verifica mensagem de sucesso
      const urlParams = new URLSearchParams(window.location.search);
      const msg = urlParams.get('msg');

      if (msg === 'login') {
        showNotification('Login realizado com sucesso!', 'success');
      } else if (msg === 'cadastro') {
        showNotification('Cadastro realizado com sucesso!', 'success');
      }
    });

    function checkAuth() {
      const userData = JSON.parse(localStorage.getItem('currentUser'));

      if (userData) {
        // Atualiza header
        document.querySelector('.user-header').innerHTML = `
                <span>👤</span> ${userData.firstName}
            `;

        // Carrega menu logado
        loadMenu('Menu_Logado.html');
      } else {
        // Carrega menu não logado
        loadMenu('Menu_Nao_Logado.html');
      }
    }

    function loadMenu(menuFile) {
      fetch(menuFile)
        .then(res => res.text())
        .then(html => {
          document.getElementById('menuContainer').innerHTML = html;
          setupMenu();
        });
    }

    function setupMenu() {
      const menuIcon = document.querySelector('.menu-icon');
      const menu = document.querySelector('.menu-box');

      if (menu && menuIcon) {
        menuIcon.addEventListener('click', () => {
          menu.classList.toggle('hidden');
          menu.classList.toggle('visible');
        });
      }

      // Configura logout se existir
      const logoutBtn = document.getElementById('logout-link');
      if (logoutBtn) {
        logoutBtn.addEventListener('click', function (e) {
          e.preventDefault();
          localStorage.removeItem('currentUser');
          window.location.href = 'Entrada.html';
        });
      }
    }

    function showNotification(message, type) {
      const notif = document.createElement('div');
      notif.className = `notification ${type}`;
      notif.textContent = message;
      document.body.appendChild(notif);

      setTimeout(() => {
        notif.classList.add('show');
      }, 10);

      setTimeout(() => {
        notif.classList.remove('show');
        setTimeout(() => notif.remove(), 300);
      }, 3000);
    }
  </script>
</body>
</html>