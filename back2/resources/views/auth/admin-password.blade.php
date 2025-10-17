@extends('layouts.app')
@section('title', 'Senha Admin')
@section('content')
<div style="max-width: 340px; margin: 60px auto; background: #fff; border-radius: 12px; box-shadow: 0 2px 16px rgba(0,0,0,0.12); padding: 32px;">
    <h2 style="text-align:center; color:#007bff; margin-bottom:24px;">Digite a senha recebida</h2>
    <form method="POST" action="{{ route('admin.password.verify') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <div style="margin-bottom:18px;">
            <label for="password">Senha Temporária</label>
            <input type="text" name="password" id="password" class="form-control" required style="width:100%;padding:8px;border-radius:6px;border:1px solid #ddd;">
        </div>
        <button type="submit" style="width:100%;background:#007bff;color:#fff;border:none;border-radius:6px;padding:10px 0;font-weight:600;cursor:pointer;">Entrar</button>
        @if($errors->any())
            <div style="color:#d00;margin-top:12px;">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
    </form>
</div>
@endsection
