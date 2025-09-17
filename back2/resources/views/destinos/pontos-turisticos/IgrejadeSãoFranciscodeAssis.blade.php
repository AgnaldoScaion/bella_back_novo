<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Igreja de São Francisco de Assis</title>
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
        <h1>Igreja de São Francisco de Assis</h1>
        <img src="../../IMAGENS/Igreja_de_São_Francisco_de_Assis.png" alt="Rua Coberta" />
        <p class="localiza">Ouro Preto, Minas Gerais • Brasil</p>
        <div class="estrelas">★★★★☆</div>
      </section>
  
      <!-- Seção sobre o destino -->
      <section class="sobre">
        
        <h2>Sobre o destino</h2>
                <!-- Localização com ícone -->
<div class="info-localizacao">
  <span>📍  Largo de Coimbra, s/n, Centro, Ouro Preto - MG, 35400-000, Brasil.</span>
</div>
        <p>
        A Igreja de São Francisco de Assis, em Ouro Preto, Minas Gerais, é uma das obras-primas do barroco brasileiro. Projetada por Aleijadinho no século XVIII, a igreja encanta pelos detalhes esculpidos em pedra-sabão e por sua impressionante pintura do teto, feita por Mestre Ataíde. Além de sua importância arquitetônica e artística, o local carrega um grande valor histórico e religioso. Localizada no centro histórico de Ouro Preto, é um dos pontos turísticos mais visitados da cidade e um verdadeiro símbolo do barroco mineiro.        </p>
      </section>
  
      <!-- Galeria de imagens secundárias -->
      <section class="imagens-secundarias">
        <img src="../../IMAGENS/Foto1_Igreja_de_São_Francisco_de_Assis.png" alt="foto 1">
        <img src="../../IMAGENS/Foto2_Igreja_de_São_Francisco_de_Assis.png" alt="foto 2">
      </section>
  
      <!-- Comentários de visitantes -->
      <section class="comentarios">
        <h2>Comentários <span>(2.340 avaliações)</span></h2>
  
        <div class="comentario">“"A Igreja de São Francisco de Assis é simplesmente deslumbrante! A riqueza dos detalhes esculpidos por Aleijadinho e a pintura do teto de Mestre Ataíde são impressionantes.”</div>
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