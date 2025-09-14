<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cristo Redentor</title>
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
          <span>👤</span> Usuário
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
        <h1>Cristo Redentor</h1>
        <img src="../../IMAGENS/cristo_redentor_principal.jpg" alt="Cristo Redentor" />
        <p class="localiza">Rio de Janeiro, RJ • Brasil</p>
        <div class="estrelas">★★★★★</div>
      </section>
  
      <!-- Seção sobre o destino -->
      <section class="sobre">
        
        <h2>Sobre o destino</h2>
                <!-- Localização com ícone -->
<div class="info-localizacao">
  <span>📍 Estrada Redentor- Alto da Boa Vista, Rio de Janeiro - RJ, 22241-330, Brasil.</span>
</div>
        <p>
            O Cristo Redentor, localizado no Morro do Corcovado, no Rio de Janeiro, é um dos maiores ícones do Brasil. 
          Inaugurado em 12 de outubro de 1931, o monumento tem 30 metros de altura, com os braços alcançando 28 metros de largura.
          Feito de concreto armado e revestido com pedras de sabão, a estátua simboliza fé, acolhimento e paz. Com uma vista 
          deslumbrante da cidade, é um dos principais pontos turísticos do Brasil, atraindo milhões de visitantes todos os anos.
          Em 2007, o Cristo Redentor foi eleito uma das Novas Sete Maravilhas do Mundo, reconhecendo seu impacto cultural e religioso 
          global.

        </p>
      </section>
  
      <!-- Galeria de imagens secundárias -->
      <section class="imagens-secundarias">
        <img src="../../IMAGENS/cristo_redentor1.jpg" alt="foto 1">
        <img src="../../IMAGENS/cristo_redentor2.png" alt="foto 2">
      </section>
  
      <!-- Comentários de visitantes -->
      <section class="comentarios">
        <h2>Comentários <span>(2.597 avaliações)</span></h2>
  
        <div class="comentario">“A experiência no Cristo Redentor foi inesquecível! A vista panorâmica do Rio de Janeiro é deslumbrante, 
          e a grandiosidade da estátua torna o momento ainda mais especial. O acesso é bem organizado, e o ambiente transmite uma energia
           única. Um passeio imperdível!”</div>
        <div class="comentario">“O Cristo Redentor impressiona com sua vista panorâmica incrível e simboliza paz e acolhimento no coração do Rio.”</div>
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
    document.addEventListener('DOMContentLoaded', function() {
      // Carregamento do menu
      fetch('../HTML/MenuNaoLogado.html')
        .then(response => response.text())
        .then(html => {
          document.getElementById('menuContainer1').innerHTML = html;
          const menuIcon = document.querySelector('.menu-icon');
          const menu = document.getElementById('menu-nao-logado');
          
          menuIcon.addEventListener('click', () => {
            menu.classList.toggle('visible');
          });
        });
    });
  </script>
</body>
</html>