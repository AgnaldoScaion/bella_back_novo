<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuario';

    protected $fillable = [
        'nome_completo',
        'CPF',
        'nome_perfil',
        'email',
        'password',
        'data_nascimento'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'CPF' => 'string',
    ];

    protected $appends = ['nome'];

    public function getAuthIdentifierName()
    {
        return 'CPF';
    }

    public function getNomeAttribute()
    {
        return $this->nome_completo ?? $this->nome_perfil;
    }

    public function getFirstNameAttribute()
    {
        return $this->nome_perfil ?? explode(' ', $this->nome_completo)[0];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->nome_perfil = $user->nome_perfil ?? explode(' ', $user->nome_completo)[0];
            $user->CPF = preg_replace('/\D/', '', $user->CPF);
        });
    }
}
