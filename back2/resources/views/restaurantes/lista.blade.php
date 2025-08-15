@extends('layouts.app')

@section('content')
    <div style="max-width:600px;margin:40px auto;">
        <h2>Restaurantes</h2>
        @auth
            <p>Usuário logado:
                <strong>{{ Auth::user()->nome_perfil ?? Auth::user()->nome_completo ?? Auth::user()->email }}</strong></p>
        @else
            <p>Você está como visitante.</p>
        @endauth

        <ul>
            @foreach($restaurantes as $restaurante)
                <li>
                    <strong>{{ $restaurante->nome }}</strong>
                    @if(isset($restaurante->tipos) && is_array($restaurante->tipos))
                        <small>({{ implode(', ', $restaurante->tipos) }})</small>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endsection
