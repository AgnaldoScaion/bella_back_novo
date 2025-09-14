<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lago Negro</title>
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
        <h1>Lago Negro</h1>
        <img src="../../IMAGENS/lago_negro_principal.png" alt="Lago Negro" />
        <p class="localiza">Gramado, Rio Grande do Sul • Brasil</p>
        <div class="estrelas">★★★★☆</div>
      </section>
  
      <!-- Seção sobre o destino -->
      <section class="sobre">
        
        <h2>Sobre o destino</h2>
                <!-- Localização com ícone -->
<div class="info-localizacao">
  <span>📍  Rua A. J. Renner, s/n, Gramado - RS, 95670-000, Brasil.</span>
</div>
        <p>
          O Lago Negro, em Gramado, é um dos locais mais tranquilos e bonitos da cidade. Cercado por araucárias e jardins, o lago oferece 
          um cenário perfeito para passeios de pedalinho e caminhadas ao redor de suas margens. É um lugar ideal para quem busca relaxamento,
            contato com a natureza e belas paisagens, sendo uma atração imperdível para quem visita Gramado.
        </p>
      </section>
  
      <!-- Galeria de imagens secundárias -->
      <section class="imagens-secundarias">
        <img src="../../IMAGENS/lago_negro1.png" alt="foto 1">
        <img src="../../IMAGENS/lago_negro2.png" alt="foto 2">
      </section>
  
      <!-- Comentários de visitantes -->
      <section class="comentarios">
        <h2>Comentários <span>(817 avaliações)</span></h2>
  
        <div class="comentario">“O Lago Negro em Gramado é um lugar simplesmente encantador! O passeio de pedalinho pelo lago é relaxante e a 
            paisagem ao redor, com as araucárias e jardins, cria um ambiente perfeito para quem busca tranquilidade e beleza natural. Um ótimo 
            destino para uma pausa em meio à cidade.”</div>
        <div class="comentario">“O Lago Negro é um dos pontos turísticos mais visitados de Gramado, oferecendo um ambiente tranquilo com trilhas 
            para caminhada e passeios de pedalinho. Embora seja encantador, pode ficar bastante movimentado em alta temporada, o que pode impactar
             a experiência de quem busca mais sossego. Ainda assim, é uma visita recomendada para apreciar a natureza e relaxar.”</div>
      </section>
  
      <!-- Seção de feedback -->
      <!-- Seção de feedback -->
      <section class="feedback">
        <p>Gostou? Deixe sua avaliação!</p>
        <a href="../../HTML/Feedback/Envio_Feedback_Pontos_Turisticos.html"><button>Enviar feedback</button></a>
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