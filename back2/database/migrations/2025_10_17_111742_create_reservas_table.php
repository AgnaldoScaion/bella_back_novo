<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // ID do usuário que fez a reserva
            $table->unsignedBigInteger('hotel_id'); // ID do hotel
            $table->date('data_entrada'); // Data de check-in
            $table->date('data_saida'); // Data de check-out
            $table->string('tipo_quarto'); // standard, luxo, familiar
            $table->integer('hospedes'); // Número de hóspedes
            $table->decimal('valor_total', 10, 2); // Valor total da reserva
            $table->enum('status', ['pendente', 'confirmada', 'cancelada', 'concluida'])->default('pendente');
            $table->string('codigo_confirmacao')->unique(); // Código único para confirmar
            $table->timestamp('confirmada_em')->nullable(); // Quando foi confirmada
            $table->text('observacoes')->nullable(); // Observações adicionais
            $table->timestamps();

            // Chaves estrangeiras
            $table->foreign('user_id')->references('id_usuario')->on('usuario')->onDelete('set null');
            $table->foreign('hotel_id')->references('id_hotel')->on('hotel')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
