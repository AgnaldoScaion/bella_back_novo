@extends('layouts.app')

@section('title', 'Sobre Nós')

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        @font-face {
            font-family: 'GaramondBold';
            src: local('Garamond'), serif;
            font-weight: bold;
        }
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9f5e4 100%);
            font-family: 'Inter', sans-serif;
        }
        .container {
            max-width: 1200px;
            margin: 4rem auto 2rem;
            padding: 0 2rem;
        }
        .about-header {
            text-align: center;
            margin-bottom: 4rem;
        }
        .about-header h1 {
            font-family: 'GaramondBold', serif;
            color: #5a8f3d;
            font-size: 3rem;
            margin-bottom: 0.5rem;
            letter-spacing: 1px;
            text-shadow: 0 2px 8px #d8e6d9;
        }
        .about-content {
            background-color: #fff;
            padding: 2.5rem 2rem;
            border-radius: 18px;
            border: 3px solid #D8E6D9;
            box-shadow: 0 8px 32px rgba(90, 143, 61, 0.08);
            margin-bottom: 2rem;
        }
        .about-section {
            margin-bottom: 2.5rem;
        }
        .about-section h2 {
            color: #5a8f3d;
            font-family: 'GaramondBold', serif;
            font-size: 2rem;
            border-bottom: 2px solid #D8E6D9;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            letter-spacing: 0.5px;
        }
        .about-section p {
            color: #555;
            line-height: 1.8;
            font-size: 1.15rem;
            margin-bottom: 0.5rem;
        }
        .values-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }
        .value-card {
            background: linear-gradient(120deg, #e9f5e4 0%, #fff 100%);
            padding: 2.2rem 1.5rem;
            border-radius: 1rem;
            text-align: center;
            border: 2px solid #A7D096;
            box-shadow: 0 4px 16px rgba(90, 143, 61, 0.07);
            transition: all 0.3s ease;
            position: relative;
        }
        .value-card:hover {
            border-color: #5a8f3d;
            box-shadow: 0 12px 32px rgba(90, 143, 61, 0.13);
            transform: translateY(-4px) scale(1.03);
        }
        .value-card h3 {
            font-family: 'GaramondBold', serif;
            color: #5a8f3d;
            font-size: 1.4rem;
            margin-bottom: 0.7rem;
        }
        .value-card p {
            color: #444;
            font-size: 1.08rem;
        }
        @media (max-width: 900px) {
            .container {
                padding: 0 1rem;
            }
            .about-content {
                padding: 1.5rem 0.5rem;
            }
        }
        @media (max-width: 600px) {
            .about-header h1 {
                font-size: 2rem;
            }
            .about-section h2 {
                font-size: 1.3rem;
            }
            .about-content {
                padding: 1rem 0.2rem;
            }
            .values-section {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
<main class="container">
    <section class="about-header">
        <h1>Sobre Nós</h1>
    </section>
    <div class="about-content">
        <section class="about-section">
            <h2>Nossa Missão</h2>
            <p>Na Bella Avventura, transformamos sonhos em experiências memoráveis. Desde 2020, conectamos
                viajantes aos destinos mais incríveis do mundo, oferecendo roteiros personalizados e serviços de
                alta qualidade.</p>
        </section>
        <section class="about-section">
            <h2>Nossa Equipe</h2>
            <p>Contamos com especialistas em viagens de mais de 15 países, todos apaixonados por explorar novas
                culturas e compartilhar conhecimento local autêntico.</p>
        </section>
        <section class="values-section">
            <article class="value-card">
                <h3>Experiência</h3>
                <p>Mais de 50 mil viagens realizadas com excelência</p>
            </article>
            <article class="value-card">
                <h3>Segurança</h3>
                <p>Parceria com os melhores fornecedores do mercado</p>
            </article>
            <article class="value-card">
                <h3>Inovação</h3>
                <p>Tecnologia exclusiva de planejamento de viagens</p>
            </article>
        </section>
        <section class="about-section">
            <h2>Compromisso Sustentável</h2>
            <p>Implementamos programas de turismo responsável em todos os destinos, garantindo que 5% de cada
                reserva seja reinvestido em comunidades locais.</p>
        </section>
    </div>
</main>
@endsection
            font-family: 'GaramondBold', serif;
