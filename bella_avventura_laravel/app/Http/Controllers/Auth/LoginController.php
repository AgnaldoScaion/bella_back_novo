<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'cpf' => 'required|string|max:14',
            'senha' => 'required|string',
        ], [
            'cpf.required' => 'O CPF é obrigatório.',
            'senha.required' => 'A senha é obrigatória.',
        ]);

        $cpf = preg_replace('/\D/', '', $request->cpf);
        Log::debug('Tentativa de login com CPF: ' . $cpf);

        if (strlen($cpf) !== 11) {
            Log::warning('CPF com tamanho inválido: ' . $cpf);
            return back()->withErrors(['cpf' => 'O CPF deve conter 11 dígitos.']);
        }

        $user = Usuario::where('CPF', $cpf)->first();

        if ($user && Hash::check($request->senha, $user->senha)) {
            Auth::login($user);
            Log::info('Login bem-sucedido para usuário: ' . $user->e_mail);
            return redirect()->route('home')->with('success', 'Login realizado com sucesso!');
        }

        Log::warning('Falha no login para CPF: ' . $cpf);
        return back()->withErrors(['cpf' => 'CPF ou senha incorretos.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Logout realizado com sucesso!');
    }
}
