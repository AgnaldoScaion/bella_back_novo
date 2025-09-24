<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel', function (Blueprint $table) {
            $table->id('id_hotel');
            $table->string('nome_hotel', 50);
            $table->string('estado', 50);
            $table->string('cidade', 50);
            $table->string('imagem');
            $table->string('prato');
            $table->string('ambiente');
            $table->string('sobremesas');
            $table->string('bairro', 50);
            $table->string('rua', 100);
            $table->integer('numero');
            $table->string('telefone', 20);
            $table->string('horario_funcionamento', 100);
            $table->string('sobre', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel');
    }
};
