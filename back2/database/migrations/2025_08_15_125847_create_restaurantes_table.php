<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('restaurantes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('tipos'); // JSON ou relacionamento separado
            $table->decimal('avaliacao', 2, 1);
            $table->text('endereco');
            $table->string('horario');
            $table->enum('preco', ['economico', 'medio', 'alto', 'luxo']);
            $table->string('preco_texto');
            $table->string('cidade');
            $table->string('imagem');
            $table->string('prato');
            $table->string('ambiente');
            $table->string('sobremesas');
            $table->string('badge')->nullable();
            $table->boolean('promocao')->default(false);
            $table->string('link');
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restaurante');
    }
};
