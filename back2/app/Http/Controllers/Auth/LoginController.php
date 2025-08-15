<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'password' => 'required|string',
        ]);

        // Remove formatação do CPF
        $cpf = preg_replace('/\D/', '', $request->CPF);

        // Tenta autenticar com CPF e senha
        if (Auth::attempt(['CPF' => $cpf, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/destinos');
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
        return redirect('/');
    }
}
