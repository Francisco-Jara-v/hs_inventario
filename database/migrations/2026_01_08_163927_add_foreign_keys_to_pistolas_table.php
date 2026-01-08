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
        Schema::table('pistolas', function (Blueprint $table) {
            $table->foreign(['Id_equipo'], 'foranea_id_equipo')->references(['ID_Equipos'])->on('equipos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pistolas', function (Blueprint $table) {
            $table->dropForeign('foranea_id_equipo');
        });
    }
};
