<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pão de Açúcar</title>
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
        <h1>Pão de açúcar</h1>
        <img src="../../IMAGENS/pao_de_acucar_principal.jpg" alt="Lençóis Maranhenses" />
        <p class="localiza">Urca, Rio de Janeiro • Brasil</p>
        <div class="estrelas">★★★★★</div>
      </section>
  
      <!-- Seção sobre o destino -->
      <section class="sobre">
        
        <h2>Sobre o destino</h2>
                <!-- Localização com ícone -->
<div class="info-localizacao">
  <span>📍 Pão de Açúcar Av. Pasteur, 520 - Urca, Rio de Janeiro - RJ, 22290-255, Brasil.</span>
</div>
        <p>
          O Pão de Açúcar, no Rio de Janeiro, é um dos principais pontos turísticos da cidade, com 396 metros de altura. 
          Seu nome vem da semelhança com os moldes usados para cristalizar o açúcar. A principal atração é o teleférico,
           que oferece uma vista panorâmica deslumbrante da Baía de Guanabara e da cidade. O local é perfeito para apreciar
            o pôr do sol e é um símbolo icônico do Rio.
        </p>
      </section>
  
      <!-- Galeria de imagens secundárias -->
      <section class="imagens-secundarias">
        <img src="../../IMAGENS/pao_de_acucar1.jpg" alt="foto 1">
        <img src="../../IMAGENS/pao_de_acucar2.png" alt="foto 2">
      </section>
  
      <!-- Comentários de visitantes -->
      <section class="comentarios">
        <h2>Comentários <span>(1.934 avaliações)</span></h2>
  
        <div class="comentario">“O Pão de Açúcar oferece uma vista incrível e um passeio de teleférico único. 
            O local é perfeito para fotos e assistir ao pôr do sol, embora o preço seja um pouco alto. Vale a pena pela experiência.”</div>
        <div class="comentario">“O Pão de Açúcar oferece uma das vistas mais deslumbrantes do Rio, unindo mar, cidade e montanhas.
            Seu bondinho icônico torna a experiência ainda mais inesquecível e única.”</div>
      </section>
  
    <!-- Seção de feedback -->
      <section class="feedback">
        <p>Gostou? Deixe sua avaliação!</p>
        <a href="../HTML/envio_feedback_pontos_turisticos.html"><button>Enviar feedback</button></a>
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