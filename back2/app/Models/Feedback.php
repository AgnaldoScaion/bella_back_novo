<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'ponto_turistico_id',
        'nome',
        'email',
        'avaliacao',
        'mensagem'
    ];

    public function pontoTuristico(): BelongsTo
    {
        return $this->belongsTo(PontoTuristico::class);
    }

    // Acessor para as estrelas de avaliação
    public function getEstrelasAttribute(): string
    {
        return str_repeat('★', $this->avaliacao) . str_repeat('☆', 5 - $this->avaliacao);
    }

    // Acessor para a cor baseada na avaliação
    public function getCorAvaliacaoAttribute(): string
    {
        return match($this->avaliacao) {
            1 => '#ff4757', // Vermelho
            2 => '#ffa502', // Laranja
            3 => '#ffd700', // Amarelo
            4 => '#2ed573', // Verde claro
            5 => '#2ed573', // Verde
            default => '#a4b0be' // Cinza
        };
    }
}
