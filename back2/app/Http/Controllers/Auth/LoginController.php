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
            'email' => 'required|email|exists:usuario,email',
        ]);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => 'Link de redefinição de senha enviado com sucesso.'])
            : back()->withErrors(['email' => 'Não foi possível enviar o link de redefinição.']);
    }
}
