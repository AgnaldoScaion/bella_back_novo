@extends('layouts.app')

@section('title', 'Bella Avventura - A Canoa')

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
                <h1>A Canoa</h1>
                <img src="{{ asset('images/Banner_A_Canoa.png') }}" alt="A Canoa" />
                <div class="estrelas">★★★★</div>
            </section>

            <!-- Seção sobre o destino -->
            <section class="sobre">
                <h2>Informações Gerais</h2>
                <div class="info-localizacao">
                    <p>📍 Av. Beira Rio, Barreirinhas - MA</p>
                    <p>📞 Telefone: +55 98 9321-0256</p>
                    <p>🕒 Horário de funcionamento: Segunda a Domingo das 11:30 às 23:00 horas.</p>
                </div>
                <h2>Sobre</h2>
                <p>
                    O Restaurante A Canoa, localizado em Barreirinhas, é uma excelente opção para quem deseja saborear a culinária típica maranhense, especialmente seus pratos com frutos do mar frescos. Com um ambiente simples e acolhedor, o restaurante proporciona uma experiência descontraída, ideal para quem visita os Lençóis Maranhenses e busca uma refeição saborosa e autêntica.
                </p>
            </section>

            <!-- Galeria de imagens secundárias -->
            <section class="imagens-secundarias">
                <img src="{{ asset('images/Prato1-Canoa.png') }}" alt="foto 1">
                <img src="{{ asset('images/Prato2-Canoa.png') }}" alt="foto 2">
            </section>

            <!-- Comentários de visitantes -->
            <section class="comentarios">
                <h2>Comentários <span>(2.002 avaliações)</span></h2>
                <div class="comentario">
                    <h3>Bernardo Souza <span>★★★★★</span></h3>
                    <p>
                        A experiência no Restaurante A Canoa foi muito agradável. Os pratos com frutos do mar são frescos e saborosos, e o ambiente é simples, mas acolhedor. O atendimento é bom, embora possa melhorar em relação à agilidade. No geral, uma excelente opção em Barreirinhas!
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
