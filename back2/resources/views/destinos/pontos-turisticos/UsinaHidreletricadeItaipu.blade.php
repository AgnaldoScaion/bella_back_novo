<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Usina Hidrelétrica de Itaipu</title>
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
        <h1>Usina Hidrelétrica de Itaipu</h1>
        <img src="../../IMAGENS/usina_hidreletrica_itaipu_principal.png" alt="Usina Hidrelétrica de Itaipu" />
        <p class="localiza">Foz do Iguaçu, Paraná • Brasil</p>
        <div class="estrelas">★★★★☆</div>
      </section>
  
      <!-- Seção sobre o destino -->
      <section class="sobre">
        
        <h2>Sobre o destino</h2>
                <!-- Localização com ícone -->
<div class="info-localizacao">
  <span>📍 Parque Nacional do Iguaçu Rodovia BR-469, Km 18 - Foz do Iguaçu, PR, 85855-750, Brasil.</span>
</div>
        <p>
          A Usina Hidrelétrica de Itaipu, localizada no Rio Paraná, na fronteira entre Brasil e Paraguai, é uma das maiores do mundo 
          em capacidade de geração de energia. Inaugurada em 1984, a usina possui 20 turbinas e pode gerar até 14.000 MW, abastecendo
           ambos os países. Itaipu é um exemplo de cooperação internacional e tecnologia avançada, sendo uma das maiores produtoras de 
           energia limpa do planeta. Além de sua importância energética, a usina também é um destino turístico, oferecendo visitas 
           guiadas para conhecer sua imponência e operação.


        </p>
      </section>
  
      <!-- Galeria de imagens secundárias -->
      <section class="imagens-secundarias">
        <img src="../../IMAGENS/usina_hidreletrica_itaipu1.png" alt="foto 1">
        <img src="../../IMAGENS/usina_hidreletrica_itaipu2.jpg" alt="foto 2">
      </section>
  
      <!-- Comentários de visitantes -->
      <section class="comentarios">
        <h2>Comentários <span>(892 avaliações)</span></h2>
  
        <div class="comentario">“Visitar a Usina de Itaipu foi incrível! A grandiosidade da usina e a tecnologia por trás dela são
             impressionantes. A vista da represa é deslumbrante e o passeio é uma experiência única!”</div>
        <div class="comentario">“A Usina de Itaipu impressiona pela grandiosidade e organização das visitas guiadas. O passeio combina 
            paisagens incríveis, história e tecnologia de forma educativa e impactante..”</div>
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