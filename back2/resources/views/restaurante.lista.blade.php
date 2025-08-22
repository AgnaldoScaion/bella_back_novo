@extends('layouts.app')

@section('title', 'Restaurantes - Bella Avventura')

@section('styles')
<style>
    .main-content {
        min-height: 60vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .lista-restaurantes-box {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        border: 2px solid #D8E6D9;
        padding: 2.5rem 2rem;
        max-width: 420px;
        width: 100%;
        text-align: center;
        margin-top: 2rem;
    }
    .lista-restaurantes-box h2 {
        color: #5a8f3d;
        font-family: 'Garamond', serif;
        font-size: 2rem;
        margin-bottom: 1.2rem;
    }
    .lista-restaurantes-box p {
        color: #555;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }
    .lista-restaurantes-box .icon {
        font-size: 3rem;
        color: #A7D096;
        margin-bottom: 1rem;
        display: block;
    }
</style>
@endsection

@section('content')
<main class="main-content">
    <div class="lista-restaurantes-box">
        <span class="icon">🍽️</span>
        <h2>Restaurantes</h2>
        <p>Em breve você verá aqui uma lista incrível de restaurantes cadastrados!</p>
        <p>Volte mais tarde para conferir as novidades.</p>
    </div>
</main>
@endsection
