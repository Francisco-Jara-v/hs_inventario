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
        Schema::create('factura_venta_detalle', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('factura_venta_id')->index('factura_venta_id_idx');
            $table->string('descripcion')->nullable();
            $table->decimal('cantidad', 12)->nullable()->default(1);
            $table->decimal('precio_unitario', 12)->nullable()->default(0);
            $table->decimal('descuento', 12)->nullable();
            $table->decimal('subtotal', 12)->nullable()->default(0);
            $table->decimal('afecto_iva', 12)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura_venta_detalle');
    }
};
