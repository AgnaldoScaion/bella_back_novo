<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'tipos', 'avaliacao', 'endereco', 'horario',
        'preco', 'preco_texto', 'cidade', 'imagem', 'badge',
        'promocao', 'link', 'lat', 'lng'
    ];

    protected $casts = [
        'tipos' => 'array',
        'promocao' => 'boolean',
    ];
}
