<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('api', function (Blueprint $table) {
            $table->id('id_api');
            $table->unsignedBigInteger('FK_usuario_id_usuario');
            $table->unsignedBigInteger('FK_HOTEL_id_hotel');
            $table->foreign('FK_usuario_id_usuario')->references('id_usuario')->on('usuario')->onDelete('restrict');
            $table->foreign('FK_HOTEL_id_hotel')->references('id_hotel')->on('hotel')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('api');
    }
};
