<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nome_completo', 100);
            $table->date('data_nascimento');
            $table->string('CPF', 20);
            $table->string('e_mail', 100);
            $table->string('senha', 100);
            $table->string('nome_perfil', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('usuario');
    }
};
