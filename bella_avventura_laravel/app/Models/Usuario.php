<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'nome_completo',
        'data_nascimento',
        'CPF',
        'e_mail',
        'senha',
        'nome_perfil'
    ];
}
