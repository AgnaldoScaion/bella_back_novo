<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lençóis Maranhenses</title>
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
      <section class="destino">
        <h1>Lençóis Maranhenses</h1>
        <img src="../IMAGENS/lençois maranhenses.png" alt="Ibirapuera Park" />
        <p class="localiza">MA • Brasil</p>
        <div class="estrelas">★★★★★</div>
      </section>
  
      <!-- Seção sobre o destino -->
      <section class="sobre">
        
        <h2>Informações Gerais</h2>
                <!-- Localização com ícone -->
    <div class="info-localizacao">
        <p>📍 Parque Nacional dos Lençóis Maranhenses</p>
    </div>
        <h2> Sobre</h2>
        <p>
        Os Lençóis Maranhenses, no Maranhão, são uma das paisagens naturais mais impressionantes do Brasil. Com dunas de até 40 metros de altura, formam um deserto de areia branca que se mistura com lagoas de água doce formadas pelas chuvas. O Parque Nacional dos Lençóis Maranhenses oferece uma experiência única, com trilhas, passeios de 4x4 e banhos nas lagoas, proporcionando aos visitantes um cenário surreal de beleza. É um destino imperdível para quem busca aventura e contato com a natureza.
        
        <p>   
        </section>
  
      <!-- Galeria de imagens secundárias -->
      <section class="imagens-secundarias">
        <img src="../../IMAGENS/Foto1_Lençóis_Maranhenses.png" alt="Lençóis Maranhenses">
        <img src="../../IMAGENS/Foto2_Lençóis_Maranhenses.png" alt="Lençóis Maranhenses">
      </section>
  
      <!-- Comentários de visitantes -->
      <section class="comentarios">
        <h2>Comentários <span>(3.751 avaliações)</span></h2>
        <div class="comentario">
            <h3>Sophia Santana <span>★★★★★</span></h3>
            </p>Os Lençóis Maranhenses são simplesmente de outro mundo! As dunas gigantes e as lagoas de água cristalina criam uma paisagem surreal e inesquecível. Passeios de 4x4 e banhos nas lagoas tornam a experiência ainda mais incrível. É um lugar único no Brasil, que definitivamente vale a pena visitar!</p>  
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
          window.location.href = '../Paginas_principais/Entrada.html';
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