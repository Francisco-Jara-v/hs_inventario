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
        Schema::create('pistolas', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('Id_equipo')->index('foranea_id_equipo_idx');
            $table->string('Equipo', 100);
            $table->string('Descripcion')->nullable();
            $table->string('Marca', 45)->nullable();
            $table->string('Modelo', 45)->nullable();
            $table->string('Serie', 45)->nullable();
            $table->string('Codigo', 45)->nullable();
            $table->string('Observacion')->nullable();
            $table->decimal('Precio', 10);
            $table->decimal('Garantia', 10);
            $table->enum('Estado', ['En stock', 'En arriendo', 'En reparacion', 'Fuera de servicio'])->default('En stock');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pistolas');
    }
};
