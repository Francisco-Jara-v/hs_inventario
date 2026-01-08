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
        Schema::table('factura_venta_detalle', function (Blueprint $table) {
            $table->foreign(['factura_venta_id'], 'factura_venta_id')->references(['id'])->on('factura_venta')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('factura_venta_detalle', function (Blueprint $table) {
            $table->dropForeign('factura_venta_id');
        });
    }
};
