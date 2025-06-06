<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nome_completo' => 'required|string|max:100',
            'cpf' => [
                'required',
                'string',
                'max:14',
                function ($attribute, $value, $fail) {
                    $digits = preg_replace('/\D/', '', $value);
                    Log::debug('CPF recebido: ' . $value . ', Dígitos: ' . $digits);
                    if (strlen($digits) !== 11) {
                        Log::warning('CPF com tamanho inválido: ' . $digits);
                        $fail('O CPF deve conter 11 dígitos.');
                        return;
                    }
                    if (preg_match('/^(\d)\1{10}$/', $digits)) {
                        Log::warning('CPF repetitivo: ' . $digits);
                        $fail('CPF inválido.');
                        return;
                    }
                    // Primeiro dígito verificador
                    $sum = 0;
                    for ($i = 0; $i < 9; $i++) {
                        $sum += (int)$digits[$i] * (10 - $i);
                    }
                    $remainder = (10 * $sum) % 11;
                    if ($remainder === 10) $remainder = 0;
                    Log::debug('Primeiro dígito verificador: ' . $remainder . ', Esperado: ' . $digits[9]);
                    if ($remainder != $digits[9]) {
                        Log::warning('Primeiro dígito inválido: ' . $digits);
                        $fail('CPF inválido.');
                        return;
                    }
                    // Segundo dígito verificador
                    $sum = 0;
                    for ($i = 0; $i < 10; $i++) {
                        $sum += (int)$digits[$i] * (11 - $i);
                    }
                    $remainder = (10 * $sum) % 11;
                    if ($remainder === 10) $remainder = 0;
                    Log::debug('Segundo dígito verificador: ' . $remainder . ', Esperado: ' . $digits[10]);
                    if ($remainder != $digits[10]) {
                        Log::warning('Segundo dígito inválido: ' . $digits);
                        $fail('CPF inválido.');
                        return;
                    }
                    // Verificar unicidade
                    if (Usuario::where('CPF', $digits)->exists()) {
                        Log::warning('CPF já cadastrado: ' . $digits);
                        $fail('Este CPF já está cadastrado.');
                    }
                },
            ],
            'email' => 'required|email|max:100|unique:usuario,e_mail',
            'senha' => 'required|string|min:8|confirmed',
        ], [
            'nome_completo.required' => 'O nome completo é obrigatório.',
            'cpf.required' => 'O CPF é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ser válido.',
            'email.unique' => 'Este email já está cadastrado.',
            'senha.required' => 'A senha é obrigatória.',
            'senha.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'senha.confirmed' => 'As senhas não coincidem.',
        ]);

        $nome_perfil = explode(' ', $request->nome_completo)[0];

        try {
            $cpfDigits = preg_replace('/\D/', '', $request->cpf);
            Log::info('Tentando salvar usuário com CPF: ' . $cpfDigits);
            Usuario::create([
                'nome_completo' => $request->nome_completo,
                'CPF' => $cpfDigits,
                'e_mail' => $request->email,
                'senha' => Hash::make($request->senha),
                'nome_perfil' => $nome_perfil,
            ]);

            Log::info('Usuário cadastrado com sucesso: ' . $request->email);
            return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso! Faça login.');
        } catch (\Exception $e) {
            Log::error('Erro ao cadastrar usuário: ' . $e->getMessage());
            return back()->withErrors(['cpf' => 'Erro ao salvar o cadastro. Tente novamente.']);
        }
    }
}
