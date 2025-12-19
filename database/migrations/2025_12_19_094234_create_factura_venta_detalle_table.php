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
            $table->id();

            $table->unsignedBigInteger('factura_compra_id');

            // Descripción del producto o servicio comprado
            $table->string('descripcion', 255);

            $table->decimal('cantidad', 12, 2)->default(1);
            $table->decimal('precio_unitario', 12, 2)->default(0);
            $table->decimal('descuento', 12, 2)->default(0);
            $table->decimal('subtotal', 12, 2)->default(0);

            $table->boolean('afecto_iva')->default(true);

            $table->timestamps();

            $table->foreign('factura_venta_id')
                ->references('id')->on('facturas_venta')
                ->onDelete('cascade');
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
