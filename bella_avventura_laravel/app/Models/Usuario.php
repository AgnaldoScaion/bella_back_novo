<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'nome_completo', 'data_nascimento', 'CPF', 'e_mail', 'senha', 'nome_perfil'
    ];

    protected $hidden = [
        'senha',
    ];

    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function getEmailAttribute()
    {
        return $this->e_mail;
    }

    public function setEmailAttribute($value)
    {
        $this->e_mail = $value;
    }

    public function getPasswordAttribute()
    {
        return $this->senha;
    }

    public function setPasswordAttribute($value)
    {
        $this->senha = $value;
    }
}
