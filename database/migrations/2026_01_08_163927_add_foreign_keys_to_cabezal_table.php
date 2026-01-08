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
        Schema::table('cabezal', function (Blueprint $table) {
            $table->foreign(['Id_Equipo'], 'fk_id_equipo')->references(['ID_Equipos'])->on('equipos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cabezal', function (Blueprint $table) {
            $table->dropForeign('fk_id_equipo');
        });
    }
};
