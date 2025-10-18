<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Twilio\Rest\Client;
use App\Http\Controllers\Controller;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', $request->email)->where('is_admin', true)->first();
        if (!$user || !$user->phone) {
            return back()->withErrors(['email' => 'Admin não encontrado ou sem telefone cadastrado.']);
        }
        // Gerar senha temporária
        $tempPassword = Str::random(8);
        $user->temp_password = Hash::make($tempPassword);
        $user->save();
        // Enviar SMS (Twilio exemplo)
        try {
            $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
            $twilio->messages->create($user->phone, [
                'from' => env('TWILIO_FROM'),
                'body' => 'Sua senha temporária: ' . $tempPassword
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['sms' => 'Erro ao enviar SMS: ' . $e->getMessage()]);
        }
        // Redireciona para tela de senha
        return redirect()->route('admin.password', ['email' => $user->email]);
    }

    public function showPasswordForm(Request $request)
    {
        $email = $request->query('email');
        return view('auth.admin-password', compact('email'));
    }

    public function verifyPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $user = User::where('email', $request->email)->where('is_admin', true)->first();
        if (!$user || !Hash::check($request->password, $user->temp_password)) {
            return back()->withErrors(['password' => 'Senha inválida.']);
        }
        Auth::login($user);
        // Limpa senha temporária
        $user->temp_password = null;
        $user->save();
        return redirect()->route('admin.dashboard');
    }
}
