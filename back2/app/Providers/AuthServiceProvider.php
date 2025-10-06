<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\Facades\Hash;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPolicies();

        // Adicionar custom user provider
        Auth::provider('custom-user', function ($app, array $config) {
            return new EloquentUserProvider($app['hash'], $config['model']);
        });

        // Configurar password broker para usar a tabela 'usuario'
        Password::resetting(function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        });
    }
}
