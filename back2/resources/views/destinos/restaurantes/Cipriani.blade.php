@extends('layouts.app')

@section('title', 'Bella Avventura - Cipriani')

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
                <h1>Cipriani</h1>
                <img src="{{ asset('images/Banner-Cipriani.png') }}" alt="Cipriani" />
                <div class="estrelas">★★★★★</div>
            </section>

            <!-- Seção sobre o destino -->
            <section class="sobre">
                <h2>Informações Gerais</h2>
                <div class="info-localizacao">
                    <p>📍 Av. Atlântica, 1702 - Copacabana, Rio de Janeiro - RJ</p>
                    <p>📞 Telefone: +55 21 2548-7070</p>
                    <p>🕒 Horário de funcionamento: Segunda a Domingo das 19:00 às 21:00 horas.</p>
                </div>
                <h2>Sobre</h2>
                <p>
                    O Restaurante Cipriani, localizado no Rio de Janeiro, é uma opção sofisticada para quem aprecia a culinária italiana com um toque contemporâneo. Seu cardápio é repleto de pratos deliciosos preparados com ingredientes frescos e de alta qualidade. O ambiente elegante e acolhedor oferece uma experiência gastronômica memorável. Ideal para ocasiões especiais, o atendimento é atencioso e impecável.
                </p>
            </section>

            <!-- Galeria de imagens secundárias -->
            <section class="imagens-secundarias">
                <img src="{{ asset('images/Prato1-Cipriani.jpg') }}" alt="foto 1">
                <img src="{{ asset('images/Prato2-Cipriani.jpg') }}" alt="foto 2">
            </section>

            <!-- Comentários de visitantes -->
            <section class="comentarios">
                <h2>Comentários <span>(3.185 avaliações)</span></h2>
                <div class="comentario">
                    <h3>Cora <span>★★★★★</span></h3>
                    <p>
                        A experiência no Restaurante Cipriani foi impecável! Pratos deliciosos, com sabores autênticos e bem apresentados, em um ambiente elegante e acolhedor. O atendimento foi excelente, tornando a refeição ainda mais especial. Altamente recomendado!
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
            // Carregamento do menu
            fetch('{{ asset('html/MenuNaoLogado.html') }}')
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
@endsection
