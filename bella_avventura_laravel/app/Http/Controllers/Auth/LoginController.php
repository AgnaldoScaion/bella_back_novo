<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ], [
            'CPF.required' => 'O campo CPF é obrigatório.',
            'password.required' => 'O campo senha é obrigatório.',
        ]);
    }

    protected function credentials(Request $request)
    {
        return [
            'CPF' => preg_replace('/\D/', '', $request->CPF),
            'password' => $request->password,
        ];
    }

    public function username()
    {
        return 'CPF';
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        $user = $this->guard()->user();
        $user->loadMissing([]); // Força o carregamento do modelo

        // Armazena dados do usuário na sessão
        $request->session()->put([
            'user_name' => $user->nome,
            'user_first_name' => $user->firstName
        ]);

        return $this->authenticated($request, $user)
                ?: redirect()->intended($this->redirectPath());
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    protected function loggedOut(Request $request)
    {
        return redirect('/');
    }
}
