<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome_completo' => 'required|string|max:100',
            'CPF' => [
                'required',
                'string',
                'max:14',
                function ($attribute, $value, $fail) {
                    $digits = preg_replace('/\D/', '', $value);

                    if (strlen($digits) !== 11) {
                        $fail('O CPF deve conter 11 dígitos.');
                        return;
                    }

                    if (preg_match('/^(\d)\1{10}$/', $digits)) {
                        $fail('CPF inválido.');
                        return;
                    }

                    // Cálculo do primeiro dígito verificador
                    $sum = 0;
                    for ($i = 0; $i < 9; $i++) {
                        $sum += (int)$digits[$i] * (10 - $i);
                    }
                    $remainder = ($sum * 10) % 11;
                    if ($remainder === 10) $remainder = 0;

                    if ($remainder != $digits[9]) {
                        $fail('CPF inválido.');
                        return;
                    }

                    // Cálculo do segundo dígito verificador
                    $sum = 0;
                    for ($i = 0; $i < 10; $i++) {
                        $sum += (int)$digits[$i] * (11 - $i);
                    }
                    $remainder = ($sum * 10) % 11;
                    if ($remainder === 10) $remainder = 0;

                    if ($remainder != $digits[10]) {
                        $fail('CPF inválido.');
                        return;
                    }

                    if (User::where('CPF', $digits)->exists()) {
                        $fail('Este CPF já está cadastrado.');
                    }
                },
            ],
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'nome_completo.required' => 'O nome completo é obrigatório.',
            'CPF.required' => 'O CPF é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ser válido.',
            'email.unique' => 'Este email já está cadastrado.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'As senhas não coincidem.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            User::create([
                'nome_completo' => $request->nome_completo,
                'CPF' => $request->CPF,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso! Faça login.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao cadastrar usuário: ' . $e->getMessage());
        }
    }
}
