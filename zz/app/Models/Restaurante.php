<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Restaurante extends Model
{
    protected $table = 'restaurante'; // Especifica o nome da tabela no singular
    
    protected $fillable = [
        'nome',
        'tipos',
        'avaliacao',
        'endereco',
        'horario',
        'preco',
        'precoTexto',
        'cidade',
        'imagem',
        'badge',
        'promocao',
        'lat',
        'lng'
    ];

    protected $casts = [
        'tipos' => 'array',
        'promocao' => 'boolean'
    ];
}
