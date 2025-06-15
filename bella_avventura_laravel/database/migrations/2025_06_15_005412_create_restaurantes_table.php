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
        Schema::create('restaurantes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->json('tipos'); // Para armazenar array de tipos
            $table->decimal('avaliacao', 2, 1);
            $table->string('endereco');
            $table->string('horario');
            $table->string('preco');
            $table->string('precoTexto');
            $table->string('cidade');
            $table->string('imagem');
            $table->string('badge')->nullable();
            $table->boolean('promocao')->default(false);
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurantes');
    }
};
