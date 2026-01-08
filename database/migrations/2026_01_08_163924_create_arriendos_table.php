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
        Schema::create('arriendos', function (Blueprint $table) {
            $table->integer('Contrato', true);
            $table->integer('ID_Cliente')->index('fk_id_cliente_idx');
            $table->dateTime('Fecha_inicio');
            $table->dateTime('Fecha_fin');
            $table->integer('Guia_Despacho');
            $table->decimal('Precio_total', 10);
            $table->string('ruta_contrato_pdf')->nullable();
            $table->enum('Estado', ['En curso', 'Finalizado', 'Cancelado']);
            $table->text('Observaciones')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arriendos');
    }
};
