@extends('layouts.app')

@section('title', $restaurante->nome . ' - Bella Avventura')

@section('content')
<main class="main-content">
    <h1>{{ $restaurante->nome }}</h1>
    <p><span>📞</span> {{ $restaurante->telefone }}</p>
    <p><span>📍</span> {{ $restaurante->rua }}, {{ $restaurante->numero }} - {{ $restaurante->bairro }}, {{ $restaurante->cidade }} - {{ $restaurante->estado }}</p>
    <p><span>⏰</span> {{ $restaurante->horario_funcionamento }}</p>
    @if($restaurante->sobre)
        <p><span>ℹ️</span> {{ $restaurante->sobre }}</p>
    @endif
    <a href="{{ route('restaurante') }}" class="btn-ver-mais">Voltar</a>
</main>
@endsection
