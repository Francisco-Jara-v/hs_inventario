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
        Schema::table('cilindros', function (Blueprint $table) {
            $table->foreign(['Id_Equipo'], 'llave_id_equipo')->references(['ID_Equipos'])->on('equipos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cilindros', function (Blueprint $table) {
            $table->dropForeign('llave_id_equipo');
        });
    }
};
