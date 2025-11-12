<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{


    /**
     * Exibe o formulário de redefinição de senha.
     */
    public function showResetForm(Request $request, $token = null)
    {
        $email = $request->email ?? null;
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $email,
        ]);
    }
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    // ...existing code...
}
