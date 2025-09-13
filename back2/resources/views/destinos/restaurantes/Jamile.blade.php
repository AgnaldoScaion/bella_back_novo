<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Jamile</title>
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
        <h1>Jamile</h1>
        <img src="../IMAGENS/Banner-Jasmile.png" alt="Jamile" />
        <div class="estrelas">★★★★★</div>
      </section>
  
      <!-- Seção sobre o destino -->
      <section class="sobre">
        
        <h2>Informações Gerais</h2>
                <!-- Localização com ícone -->
<div class="info-localizacao">
    <p>📍R. Treze de Maio, 647 - Bela Vista, São Paulo - SP</p>
    <p>📞Telefone: +55 112985-3005</p>
    <p>🕒Horário de funcionamento: Segunda a Domingo das 12:00 ás  23:00 horas. </p>
</div>
        <h2> Sobre</h2>
        <p>
          O Restaurante Jamile, localizado em São Paulo, é conhecido por sua cozinha contemporânea e pratos autorais que combinam ingredientes frescos e técnicas inovadoras. Com um ambiente sofisticado e acolhedor, oferece uma experiência gastronômica única, destacando a culinária brasileira com um toque moderno. Ideal para quem busca um jantar especial, o Jamile é um excelente destino para saborear pratos refinados e de alta qualidade em um local agradável e bem localizado.
        </p>
      </section>
  
      <!-- Galeria de imagens secundárias -->
      <section class="imagens-secundarias">
        <img src="../IMAGENS/Prato1-Jasmile.png" alt="foto 1">
        <img src="../IMAGENS/Prato2-Jasmile.png" alt="foto 2">
      </section>
  
      <!-- Comentários de visitantes -->
      <section class="comentarios">
        <h2>Comentários <span>(6.751 avaliações)</span></h2>
        <div class="comentario">
            <h3>Pedro Moura <span>★★★★★</span></h3>
            <p>
              O Restaurante Jamile oferece uma experiência gastronômica incrível, com pratos saborosos e criativos, além de um ambiente sofisticado e acolhedor. O atendimento é impecável, tornando a refeição ainda mais especial. Uma experiência realmente memorável!
            </p>
        </div>
      </section>
  
      <!-- Seção de feedback -->
      <section class="feedback">
        <p>Gostou? Deixe sua avaliação!</p>
        <a href="../HTML/envio_feedback.html"><button>Enviar feedback</button></a>
      </section>
    </div>
  </main>

  <!-- Rodapé -->
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
        <a href="../Paginas_principais/Termos_Condicoes.html">Termos e condições</a>
      </div>
    </div>
  </footer>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
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

      // Verifica se há usuário logado
      const userData = JSON.parse(localStorage.getItem('currentUser'));
      if (userData) {
        document.querySelector('.user-header').innerHTML = `
          <span>👤</span> ${userData.firstName}
        `;
      }
    });

document.addEventListener('DOMContentLoaded', function() {
    const btnVoltar = document.querySelector('.btn-voltar');
    const footer = document.querySelector('.footer');
    const threshold = 100; // 100px antes do final para considerar "no final"
    
    function adjustButtonPosition() {
        const windowHeight = window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight;
        const scrollPosition = window.scrollY || window.pageYOffset;
        const footerRect = footer.getBoundingClientRect();
        const footerTop = footerRect.top;
        
        // Verifica se chegou perto do final da página
        const nearBottom = scrollPosition + windowHeight >= documentHeight - threshold;
        
        if (nearBottom) {
            btnVoltar.classList.add('visible');
            
            // Calcula a posição segura acima do footer
            const safePosition = windowHeight - footerTop - 1; // 20px de margem
            
            if (footerTop < windowHeight) {
                // Footer está visível - ajusta posição
                btnVoltar.style.bottom = `${Math.max(20, safePosition)}px`;
            } else {
                // Footer não está visível - posição padrão
                btnVoltar.style.bottom = '30px';
            }
        } else {
            btnVoltar.classList.remove('visible');
        }
    }
    
    // Event listeners
    window.addEventListener('scroll', adjustButtonPosition);
    window.addEventListener('resize', adjustButtonPosition);
    
    // Verificação inicial
    adjustButtonPosition();
});
  </script>
</body>
</html>