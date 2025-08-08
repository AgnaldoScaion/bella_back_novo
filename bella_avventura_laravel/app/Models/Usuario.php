<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuario';

    protected $fillable = [
        'nome_completo',
        'data_nascimento',
        'CPF',
        'e_mail', // Mantido como está no banco
        'senha',  // Mantido como está no banco
        'nome_perfil'
    ];

    // Configuração para usar e_mail no lugar de email
    public function getEmailAttribute()
    {
        return $this->attributes['e_mail'];
    }

    // Configuração para usar senha no lugar de password
    public function getAuthPassword()
    {
        return $this->senha;
    }
}
