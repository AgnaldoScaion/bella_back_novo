<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'cpf' => 'required|string',
            'password' => 'required|string',
        ], [
            'cpf.required' => 'O campo CPF é obrigatório.',
            'password.required' => 'O campo senha é obrigatório.',
        ]);
    }

    protected function credentials(Request $request)
    {
        return [
            'cpf' => $request->cpf,
            'password' => $request->password,
        ];
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $user = \App\Models\User::where('cpf', $request->cpf)->first();

        $error = $user
            ? 'Senha incorreta.'
            : 'CPF inexistente.';

        return redirect()->route('login')
            ->withInput($request->only('cpf'))
            ->withErrors([
                'cpf' => $error,
            ]);
    }
}
