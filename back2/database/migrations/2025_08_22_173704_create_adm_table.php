<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adm', function (Blueprint $table) {
            $table->id('id_adm');
            $table->string('nome_completo', 100);
            $table->date('data_nascimento')->nullable();
            $table->string('CPF', 20);
            $table->string('email', 100);
            $table->string('password', 255);
            $table->string('nome_perfil', 50)->nullable();
            $table->unsignedBigInteger('fk_usuario_id_usuario');
            $table->foreign('fk_usuario_id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adm');
    }
};
