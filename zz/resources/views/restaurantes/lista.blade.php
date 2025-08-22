@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Restaurantes</h1>
    @foreach($restaurantes as $restaurante)
        <p>{{ $restaurante->nome }}</p>
    @endforeach
</div>
@endsection
