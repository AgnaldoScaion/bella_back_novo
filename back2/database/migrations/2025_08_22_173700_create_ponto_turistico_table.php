<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ponto_turistico', function (Blueprint $table) {
            $table->id('id_ponto_turistico');
            $table->string('nome', 100);
            $table->string('sobre', 255)->nullable();
            $table->integer('numero');
            $table->string('rua', 100);
            $table->string('bairro', 50);
            $table->string('cidade', 50);
            $table->string('estado', 50);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ponto_turistico');
    }
};
