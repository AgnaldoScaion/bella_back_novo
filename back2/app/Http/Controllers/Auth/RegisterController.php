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

                    // Validação básica
                    if (strlen($digits) !== 11) {
                        $fail('O CPF deve conter 11 dígitos.');
                        return;
                    }

                    // Verifica dígitos repetidos
                    if (preg_match('/^(\d)\1{10}$/', $digits)) {
                        $fail('CPF inválido.');
                        return;
                    }

                    // Cálculo dos dígitos verificadores
                    for ($t = 9; $t < 11; $t++) {
                        $d = 0;
                        for ($c = 0; $c < $t; $c++) {
                            $d += $digits[$c] * (($t + 1) - $c);
                        }
                        $d = ((10 * $d) % 11) % 10;
                        if ($digits[$c] != $d) {
                            $fail('CPF inválido.');
                            return;
                        }
                    }

                    // Verifica se CPF já existe
                    if (User::where('CPF', $digits)->exists()) {
                        $fail('Este CPF já está cadastrado.');
                    }
                },
            ],
            'email' => 'required|email|max:100|unique:usuario,email',
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
                'CPF' => preg_replace('/\D/', '', $request->CPF), // Armazena apenas números
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nome_perfil' => explode(' ', $request->nome_completo)[0], // Pega o primeiro nome
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso! Faça login.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao cadastrar usuário: ' . $e->getMessage());
        }
    }
}
