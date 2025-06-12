<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        Log::debug('Dados recebidos no login: ' . json_encode($request->all()));

        $request->validate([
            'CPF' => 'required|string',
            'password' => 'required|string',
        ], [
            'CPF.required' => 'O campo CPF é obrigatório.',
            'password.required' => 'O campo senha é obrigatório.',
        ]);
    }

    protected function credentials(Request $request)
    {
        $cpf = preg_replace('/\D/', '', $request->CPF); // Remove pontos e traços
        Log::debug('CPF formatado para autenticação: ' . $cpf);
        return [
            'CPF' => $cpf,
            'password' => $request->password,
        ];
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $cpf = preg_replace('/\D/', '', $request->CPF);
        Log::debug('Tentativa de login com CPF: ' . $cpf);
        $user = \App\Models\Usuario::where('CPF', $cpf)->first();

        $error = $user
            ? 'Senha incorreta.'
            : 'CPF inexistente.';

        Log::warning('Falha no login: ' . $error . ' para CPF: ' . $cpf);

        return redirect()->route('login')
            ->withInput($request->only('CPF'))
            ->withErrors([
                'CPF' => $error,
            ]);
    }

    public function username()
    {
        Log::debug('Campo de autenticação definido como: CPF');
        return 'CPF';
    }

    protected function redirectTo()
    {
        Log::debug('Redirecionando após login para: /home');
        return '/home';
    }
}
