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
        Schema::create('cilindros', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('Id_Equipo')->index('fk_id_equipo_idx');
            $table->string('Equipo', 100);
            $table->string('Marca', 45)->nullable();
            $table->string('Modelo', 45)->nullable();
            $table->enum('Accion', ['Simple', 'Doble'])->nullable();
            $table->integer('Toneladas')->nullable();
            $table->string('Altura', 20)->nullable();
            $table->string('Carrera', 20)->nullable();
            $table->string('Codigo', 50);
            $table->decimal('Precio', 15);
            $table->decimal('Garantia', 15);
            $table->enum('Estado', ['En stock', 'En arriendo', 'En reparacion', 'Fuera de servicio'])->default('En stock');

            $table->index(['Id_Equipo'], 'llave_id_equipo_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cilindros');
    }
};
