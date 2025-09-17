<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id('id_feedback'); // Chave primária personalizada
            $table->unsignedBigInteger('id_usuario'); // Tipo compatível com id_usuario
            $table->string('feedback', 255); // Texto do feedback
            $table->tinyInteger('estrelas')->unsigned(); // Avaliação em estrelas (0-5)
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
            $table->timestamps(); // Adiciona created_at e updated_at
            $table->engine = 'InnoDB'; // Garante suporte a chaves estrangeiras
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
