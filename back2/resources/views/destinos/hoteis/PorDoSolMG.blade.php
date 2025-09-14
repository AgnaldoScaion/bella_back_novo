<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Hotel Pousada Por do Sol</title>
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
        <h1>Hotel Pousada Por do Sol</h1>
        <img src="../../IMAGENS/hotel_sol.avif" alt="Hotel Pousada Por do Sol" />
        <div class="estrelas">★★★★★</div>
      </section>
  
      <!-- Seção sobre o destino -->
      <section class="sobre">
        
        <h2>Informações Gerais</h2>
                <!-- Localização com ícone -->
<div class="info-localizacao">
    <p>📍Estrada de Monte Verde, KM 22, Camanducaia - MG</p>
    <p>📞Telefone: (35) 3433-5560</p>
    <p>🕒Horário de funcionamento: A pousada "Por do Sol" em Camanducaia, MG, geralmente possui horário de check-in a partir das 14h e check-out até as 12h ou 15h, dependendo da acomodação.       </p>
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
  <h2>Hotel Pousada Por do Sol, Camanducaia - MG</h2>
  <div id="map"></div>

  <script src="https://cdn.jsdelivr.net/npm/ol@v7.3.0/dist/ol.js"></script>
  <script>
    const latitude =  -22.7553;
    const longitude = -46.1455;

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
          A Pousada Pôr do Sol está situada em Monte Verde, distrito de Camanducaia, Minas Gerais, oferecendo uma estadia tranquila em meio à natureza. Com chalés equipados com lareira e banheira de hidromassagem, a pousada proporciona conforto e aconchego aos hóspedes. As instalações incluem piscina ao ar livre, jardim e estacionamento privativo gratuito. O café da manhã é servido em estilo buffet, com diversas opções para agradar a todos os gostos. A localização, embora um pouco afastada do centro de Monte Verde, oferece fácil acesso e uma vista deslumbrante das montanhas, ideal para quem busca relaxamento e contato com a natureza. A equipe é elogiada pela cordialidade e atenção aos detalhes, garantindo uma experiência agradável e memorável.   
      

          <!-- Galeria de imagens secundárias -->
      <section class="imagens-secundarias">
        <img src="../../IMAGENS/sol1.jpg" alt="foto 1">
        <img src="../../IMAGENS/sol2.jpg" alt="foto 2">
      </section>
  
      <!-- Comentários de visitantes -->
      <section class="comentarios">
        <h2>Comentários <span>(247 avaliações)</span></h2>
        <div class="comentario">
            <h3>Patricia Prada <span>★★★★★</span></h3>
            <p>
              Chegamos em meio a uma chuva forte e, por conta de uma árvore caída na fiação, a pousada estava sem energia, mas mesmo assim já deu pra sentir que tínhamos feito uma ótima escolha. No dia seguinte, com o tempo mais claro, percebemos como a localização é privilegiada. O chalé estava super limpo, aproveitamos a lareira, as camas eram bem confortáveis e o café da manhã estava maravilhoso — destaque especial para o pão de queijo. Saímos de lá renovados.        </p>
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