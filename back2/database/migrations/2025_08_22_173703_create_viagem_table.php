<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('viagem', function (Blueprint $table) {
            $table->id('id_viagem');
            $table->string('destino', 100);
            $table->string('descricao', 255);
            $table->unsignedBigInteger('fk_usuario_id_usuario');
            $table->foreign('fk_usuario_id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('viagem');
    }
};
