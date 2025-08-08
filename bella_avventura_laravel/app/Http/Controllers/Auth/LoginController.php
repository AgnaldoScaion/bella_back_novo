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
        $credentials = $request->validate([
            'e_mail' => 'required|email',
            'senha' => 'required',
        ]);

        // Autenticação personalizada
        if (Auth::attempt(['e_mail' => $credentials['e_mail'], 'senha' => $credentials['senha']])) {
            $request->session()->regenerate();
            return redirect()->intended('/destinos');
        }

        return back()->withErrors([
            'e_mail' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
