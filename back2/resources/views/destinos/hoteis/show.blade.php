@extends('layouts.app')

@section('title', $hotel->nome . ' - Bella Avventura')

@section('styles')
<style>
    .hotel-detail {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .hotel-header {
        display: flex;
        justify-content: between;
        align-items: flex-start;
        margin-bottom: 2rem;
    }

    .hotel-title {
        font-size: 2.5rem;
        color: #5a8f3d;
        margin: 0;
    }

    .hotel-rating {
        display: flex;
        align-items: center;
        font-size: 1.2rem;
        color: #ffd700;
    }

    .hotel-gallery {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .main-image {
        grid-row: span 2;
        height: 400px;
    }

    .secondary-image {
        height: 195px;
    }

    .hotel-gallery img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
    }

    .hotel-info {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    .hotel-description {
        background: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .hotel-booking {
        background: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .price {
        font-size: 2rem;
        color: #5a8f3d;
        font-weight: bold;
    }

    .btn-reserve {
        background: #5a8f3d;
        color: white;
        padding: 1rem 2rem;
        border: none;
        border-radius: 8px;
        width: 100%;
        font-size: 1.1rem;
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="hotel-detail">
    <div class="hotel-header">
        <div>
            <h1 class="hotel-title">{{ $hotel->nome }}</h1>
            <p>📍 {{ $hotel->localizacao }}</p>
        </div>
        <div class="hotel-rating">
            <span class="star">★</span> {{ $hotel->avaliacao }} ({{ $hotel->avaliacoes }} avaliações)
        </div>
    </div>

    <div class="hotel-gallery">
        <div class="main-image">
            <img src="{{ $hotel->imagem }}" alt="{{ $hotel->nome }}">
        </div>
        <div class="secondary-image">
            <img src="{{ $hotel->imagem }}" alt="{{ $hotel->nome }}">
        </div>
        <div class="secondary-image">
            <img src="{{ $hotel->imagem }}" alt="{{ $hotel->nome }}">
        </div>
    </div>

    <div class="hotel-info">
        <div class="hotel-description">
            <h2>Sobre o Hotel</h2>
            <p>Este hotel oferece uma experiência única com {{ implode(', ', $hotel->comodidades) }}.</p>

            <h3>Comodidades</h3>
            <ul>
                @foreach($hotel->comodidades as $comodidade)
                <li>{{ $comodidade }}</li>
                @endforeach
            </ul>
        </div>

        <div class="hotel-booking">
            <div class="price">{{ $hotel->precoTexto }} /noite</div>
            <button class="btn-reserve">Reservar Agora</button>
        </div>
    </div>
</div>
@endsection
