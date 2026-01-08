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
        Schema::table('arriendo_detalle', function (Blueprint $table) {
            $table->foreign(['Equipo_id'], 'equipo_id')->references(['ID_Equipos'])->on('equipos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['Contrato'], 'id_contrato')->references(['Contrato'])->on('arriendos')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arriendo_detalle', function (Blueprint $table) {
            $table->dropForeign('equipo_id');
            $table->dropForeign('id_contrato');
        });
    }
};
