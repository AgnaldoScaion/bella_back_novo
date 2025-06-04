<?php
namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('profile.show');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nome_completo' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:usuario,e_mail,' . $user->id_usuario . ',id_usuario',
            'senha_atual' => 'required',
            'nova_senha' => 'nullable|string|min:6|max:100|confirmed'
        ], [
            'nome_completo.required' => 'O nome completo é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ser válido.',
            'email.unique' => 'Este email já está cadastrado.',
            'senha_atual.required' => 'A senha atual é obrigatória.',
            'nova_senha.min' => 'A nova senha deve ter pelo menos 6 caracteres.',
            'nova_senha.confirmed' => 'As novas senhas não coincidem.'
        ]);

        // Verifica a senha atual
        if (!Hash::check($request->senha_atual, $user->senha)) {
            return back()->withErrors(['senha_atual' => 'Senha atual incorreta.']);
        }

        // Atualiza os dados
        $user->nome_completo = $request->nome_completo;
        $user->e_mail = $request->email;
        if ($request->filled('nova_senha')) {
            $user->senha = Hash::make($request->nova_senha);
        }
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Perfil atualizado com sucesso!');
    }
}
