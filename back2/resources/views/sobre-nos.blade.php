<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós - Bella Avventura</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="https://i.ibb.co/vx2Dzj9v/image.png">
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
@extends('layouts.app')

@section('title', 'Sobre Nós')

@section('styles')
    <style>
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
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        .about-content {
            background-color: white;
            padding: 2rem;
            border-radius: 12px;
            border: 3px solid #D8E6D9;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .about-section {
            margin-bottom: 2rem;
        }
        .about-section h2 {
            color: #5a8f3d;
            font-family: 'GaramondBold', serif;
            font-size: 1.8rem;
            border-bottom: 2px solid #D8E6D9;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .about-section p {
            color: #555;
            line-height: 1.8;
            font-size: 1.1rem;
        }
        .values-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }
        .value-card {
            background: white;
            padding: 2rem;
            border-radius: 0.75rem;
            text-align: center;
            border: 2px solid #E9F5E4;
            transition: all 0.3s ease;
        }
        .value-card:hover {
            border-color: #A7D096;
            box-shadow: 0 8px 24px rgba(167, 208, 150, 0.15);
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
