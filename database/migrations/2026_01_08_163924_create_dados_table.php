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
        Schema::create('dados', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('Id_Equipo')->index('fllave_id_equipo_idx');
            $table->string('Equipo', 100);
            $table->string('Medida', 20)->nullable();
            $table->string('Cuadrante', 20)->nullable();
            $table->integer('Cantidad_disponible')->nullable();
            $table->integer('Cantidad_arriendo');
            $table->decimal('Precio', 15);
            $table->decimal('Garantia', 15);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dados');
    }
};
