<?php
namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller {
    public function showForm() {
        return view('usuario_form');
    }

    public function saveUsuario(Request $request) {
        $request->validate([
            'nome_completo' => 'required|string|max:100',
            'data_nascimento' => 'required|date',
            'CPF' => 'required|string|max:20',
            'e_mail' => 'required|email|max:100|unique:usuario,e_mail',
            'senha' => 'required|string|max:100',
            'nome_perfil' => 'nullable|string|max:50'
        ]);

        $usuario = new Usuario();
        $usuario->nome_completo = $request->nome_completo;
        $usuario->data_nascimento = $request->data_nascimento;
        $usuario->CPF = $request->CPF;
        $usuario->e_mail = $request->e_mail;
        $usuario->senha = Hash::make($request->senha);
        $usuario->nome_perfil = $request->nome_perfil;
        $usuario->save();

        return redirect()->route('usuarios.list')->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function listUsuario() {
        $usuarios = Usuario::all();
        return view('usuario_list', compact('usuarios'));
    }
}
