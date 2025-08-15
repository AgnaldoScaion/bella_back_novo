<?php

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'usuario',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'usuario',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\Usuario::class,
        ],
    ],

    'passwords' => [
        'usuario' => [
            'provider' => 'usuario',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];
