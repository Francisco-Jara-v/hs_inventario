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
        Schema::create('facturas_compra_detalle', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('factura_compra_id')->index('facturas_compra_detalle_factura_compra_id_foreign');
            $table->string('descripcion');
            $table->decimal('cantidad', 12)->default(1);
            $table->decimal('precio_unitario', 12)->default(0);
            $table->decimal('descuento', 12)->default(0);
            $table->decimal('subtotal', 12)->default(0);
            $table->boolean('afecto_iva')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas_compra_detalle');
    }
};
