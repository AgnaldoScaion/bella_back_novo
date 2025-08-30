<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    protected $table = 'restaurante'; // Especifica o nome da tabela

    protected $primaryKey = 'id_restaurante'; // Define a chave primária personalizada

    protected $fillable = [
        'nome',
        'telefone',
        'estado',
        'cidade',
        'rua',
        'bairro',
        'numero',
        'horario_funcionamento',
        'sobre',
    ];

    protected $casts = [
        'sobre' => 'string', // Garante que 'sobre' seja tratado como string (nullable)
    ];
}
