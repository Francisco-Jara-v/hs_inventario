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
        Schema::create('arriendo_detalle', function (Blueprint $table) {
            $table->integer('ID', true);
            $table->integer('Contrato')->index('id_contrato_idx');
            $table->integer('Equipo_id')->index('equipo_id_idx');
            $table->integer('Equipo_detalle_id');
            $table->enum('Estado', ['En stock', 'En arriendo', 'Finalizado']);
            $table->decimal('Precio_equipo', 15);
            $table->decimal('Garantia', 15);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arriendo_detalle');
    }
};
