<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurantes em Ouro Preto</title>
    <link rel="stylesheet" href="../../CSS/Principais_Restaurantes.css">
    <link rel="icon" type="image/png" href="https://i.ibb.co/vx2Dzj9v/image.png">
</head>
<body>
    <div class="wrapper">

        <!-- Top Header -->
        <div class="top-header">
          <div class="menu-icon">☰</div>
          <div class="user-header">
            <span>👤</span> Visitante
          </div>
        </div>
    
        <!-- Logo -->
        <div class="header">
          <div class="header-img">
            <a href="../Paginas_principais/Entrada.html"></a>
            <img src="https://i.ibb.co/Q7T008b1/image.png" alt="Logo" />
          </div>
        </div>

    <section class="banner">
        <img src="../IMAGENS/Banner_MG.png" alt="Banner de restaurante em Minas Gerais" />
    </section>

    <div class="apresetacao">
        <h1>Restaurantes em Ouro Preto - MG</h1>
        <p>Descubra os melhores restaurantes da cidade e aproveite uma experiência gastronômica única!</p>
    </div>  
    
    <section class="conteudo-geral">

        <div class="intro">
            <p>Quer explorar novos sabores e experiências gastronômicas em Ouro Preto? Temos algumas sugestões de restaurantes que vão surpreender o seu paladar!</p>
        </div>

        <div class="restaurant">
            <img src="https://i.ibb.co/5W1XfZVG/image.png" alt="Bené da Flauta">
            <div class="info">
                <h2>La Mafia Trattoria</h2>
                <p>Um dos restaurantes mais tradicionais de Ouro Preto, oferecendo pratos autênticos da região, como feijão tropeiro, frango com quiabo e pão de queijo.</p>
            </div>
        </div>

        <div class="restaurant">
            <img src="https://i.ibb.co/DP0nRQ81/image.png" alt="Gastro Pub">
            <div class="info">
                <h2>Gastro Pub</h2>
                <p>O Calabouço Gastro Pub em Ouro Preto oferece uma experiência moderna com pratos saborosos e drinks criativos, em um ambiente descontraído e acolhedor.</p>
            </div>
        </div>

        <div class="restaurant">
            <img src="https://i.ibb.co/kVDCLyJK/image.png" alt="Contos dos Reis">
            <div class="info">
                <h2>Contos dos Reis</h2>
                <p>Pratos tradicionais e sobremesas caseiras servidos em ambiente rústico em uma construção histórica.</p>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-top">
          <a href="https://www.bellaavventura.com.br/">
            <img src="https://i.ibb.co/j9vGknyy/image.png" alt="image" border="0">
          </a>
        </div>
        <div class="footer-bottom">
          <div class="footer-left">
            <a href="mailto:bella.avventura@gmail.com">📧 bella.avventura@gmail.com</a>
          </div>
          <div class="footer-center">© 2025 Bella Avventura</div>
          <div class="footer-right">
            <a href="../Paginas_principais/Termos_Condicoes.html">Termos e condições </a>
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
