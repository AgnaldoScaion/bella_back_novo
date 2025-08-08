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
        'usuario' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
            'table' => 'usuario',
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
