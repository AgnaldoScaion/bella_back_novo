<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'CPF' => 'required|string',
            'password' => 'required|string|min:4',
        ]);

        // Remove formatação do CPF
        $cpf = preg_replace('/\D/', '', $request->CPF);

        // Tenta autenticar com CPF e senha
        if (Auth::attempt(['CPF' => $cpf, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'CPF' => 'CPF ou senha incorretos.',
        ])->onlyInput('CPF');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/home');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'CPF' => 'required|string|exists:users,CPF',
        ]);

        // Remove formatação do CPF
        $cpf = preg_replace('/\D/', '', $request->CPF);

        // Busca o usuário pelo CPF
        $user = DB::table('users')->where('CPF', $cpf)->first();

        if (!$user) {
            return back()->withErrors(['CPF' => 'CPF não encontrado.']);
        }

        // Envia o link de redefinição de senha usando o e-mail do usuário
        $status = Password::sendResetLink(['email' => $user->email]);

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => 'Link de redefinição de senha enviado com sucesso.'])
            : back()->withErrors(['CPF' => 'Não foi possível enviar o link de redefinição.']);
    }
}
