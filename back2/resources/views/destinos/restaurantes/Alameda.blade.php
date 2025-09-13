@extends('layouts.app')

@section('title', 'Bella Avventura - Alameda')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/Geral.css') }}">
    <link rel="icon" type="image/png" href="https://i.ibb.co/vx2Dzj9v/image.png">
@endsection

@section('content')
    <main class="grid-container">
        <div class="pilastra-verde"></div>
        <div class="conteudo">
            <!-- Seção do destino principal -->
            <section class="destino">
                <h1>Alameda</h1>
                <img src="{{ asset('images/Banner_Alameda.png') }}" alt="Alameda" />
                <div class="estrelas">★★★★★</div>
            </section>

            <!-- Seção sobre o destino -->
            <section class="sobre">
                <h2>Informações Gerais</h2>
                <div class="info-localizacao">
                    <p>📍 R. Jornalista Haroldo Callado, 25 - Jurerê, Florianópolis - SC</p>
                    <p>📞 Telefone: +55 48 3282-1656</p>
                    <p>🕒 Horário de funcionamento: Segunda a Domingo das 07:00 às 19:00 horas.</p>
                </div>
                <h2>Sobre</h2>
                <p>
                    O Restaurante Alameda, em Florianópolis, é uma excelente opção para quem busca uma refeição sofisticada e cheia de sabor. Com um ambiente elegante e acolhedor, o restaurante oferece pratos criativos que misturam ingredientes frescos e sabores únicos da gastronomia brasileira e internacional. O cardápio variado, aliado a um atendimento impecável, proporciona uma experiência gastronômica memorável, ideal para ocasiões especiais ou para quem deseja desfrutar de uma refeição de alto nível.
                </p>
            </section>

            <!-- Galeria de imagens secundárias -->
            <section class="imagens-secundarias">
                <img src="{{ asset('images/Prato1-Alameda.png') }}" alt="foto 1">
                <img src="{{ asset('images/Prato2-Alameda.png') }}" alt="foto 2">
            </section>

            <!-- Comentários de visitantes -->
            <section class="comentarios">
                <h2>Comentários <span>(3.751 avaliações)</span></h2>
                <div class="comentario">
                    <h3>Sophia Santana <span>★★★★★</span></h3>
                    <p>
                        O Restaurante Alameda oferece uma experiência incrível! Os pratos são saborosos e criativos, com um ambiente sofisticado e atendimento impecável. Uma excelente escolha em Florianópolis!
                    </p>
                </div>
            </section>

            <!-- Seção de feedback -->
            <section class="feedback">
                <p>Gostou? Deixe sua avaliação!</p>
                <a href="{{ route('feedback.restaurante') }}"><button>Enviar feedback</button></a>
            </section>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                    document.getElementById('menuContainer1').innerHTML = html;
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
                    window.location.href = '{{ route('entrada') }}';
                });
            }
        }

        function showNotification(message, type) {
            const notif = document.createElement('div');
            notif.className = `notificacao ${type}`;
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
@endsection
