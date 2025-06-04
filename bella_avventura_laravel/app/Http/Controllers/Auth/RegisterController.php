<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nome_completo' => 'required|string|max:100',
            'cpf' => 'required|string|size:11|unique:usuario,CPF',
            'email' => 'required|email|max:100|unique:usuario,e_mail',
            'senha' => 'required|string|min:6|max:100|confirmed'
        ], [
            'nome_completo.required' => 'O nome completo é obrigatório.',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.size' => 'O CPF deve ter 11 dígitos.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ser válido.',
            'email.unique' => 'Este email já está cadastrado.',
            'senha.required' => 'A senha é obrigatória.',
            'senha.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'senha.confirmed' => 'As senhas não coincidem.'
        ]);

        $usuario = new Usuario();
        $usuario->nome_completo = $request->nome_completo;
        $usuario->CPF = preg_replace('/\D/', '', $request->cpf);
        $usuario->e_mail = $request->email;
        $usuario->senha = Hash::make($request->senha);
        $usuario->save();

        return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso!');
    }
}
