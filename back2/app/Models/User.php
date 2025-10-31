<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuario'; // Especifica o nome correto da tabela
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nome_completo',
        'CPF',
        'email',
        'password',
        'nome_perfil',
        'chat_tutorial_closed'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'chat_tutorial_closed' => 'boolean',
    ];
}
