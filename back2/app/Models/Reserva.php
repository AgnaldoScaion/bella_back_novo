<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Reserva extends Model
{
    protected $fillable = [
        'user_id',
        'hotel_id',
        'data_entrada',
        'data_saida',
        'tipo_quarto',
        'hospedes',
        'valor_total',
        'status',
        'codigo_confirmacao',
        'confirmada_em',
        'observacoes'
    ];

    protected $casts = [
        'data_entrada' => 'date',
        'data_saida' => 'date',
        'confirmada_em' => 'datetime',
        'valor_total' => 'decimal:2'
    ];

    // Gerar código de confirmação automaticamente
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($reserva) {
            if (empty($reserva->codigo_confirmacao)) {
                $reserva->codigo_confirmacao = strtoupper(Str::random(10));
            }
        });
    }

    // Relacionamentos
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_usuario');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id_hotel');
    }

    // Métodos úteis
    public function confirmar()
    {
        $this->update([
            'status' => 'confirmada',
            'confirmada_em' => now()
        ]);
    }

    public function cancelar()
    {
        $this->update(['status' => 'cancelada']);
    }

    public function calcularDias()
    {
        return $this->data_entrada->diffInDays($this->data_saida);
    }
}
