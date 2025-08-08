<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['showRegistrationForm', 'register']);
    }

    // Método para exibir formulário de cadastro (se ainda necessário)
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Método para registrar (compatível com auth padrão)
    public function register(Request $request)
    {
        $request->validate([
            'nome_completo' => 'required|string|max:100',
            'CPF' => 'required|string|max:20|unique:usuario,CPF',
            'e_mail' => 'required|email|max:100|unique:usuario,e_mail',
            'senha' => 'required|string|min:8|confirmed',
        ]);

        $usuario = Usuario::create([
            'nome_completo' => $request->nome_completo,
            'CPF' => $request->CPF,
            'e_mail' => $request->e_mail,
            'senha' => Hash::make($request->senha),
            'nome_perfil' => explode(' ', $request->nome_completo)[0],
        ]);

        // Login automático após registro
        Auth::login($usuario);

        return redirect('/destinos')->with('success', 'Cadastro realizado com sucesso!');
    }

    // Métodos para administração
    public function listUsuario()
    {
        $usuarios = Usuario::all();
        return view('usuario_list', compact('usuarios'));
    }
}
