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
        Schema::table('facturas_compra_detalle', function (Blueprint $table) {
            $table->foreign(['factura_compra_id'])->references(['id'])->on('facturas_compra')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facturas_compra_detalle', function (Blueprint $table) {
            $table->dropForeign('facturas_compra_detalle_factura_compra_id_foreign');
        });
    }
};
