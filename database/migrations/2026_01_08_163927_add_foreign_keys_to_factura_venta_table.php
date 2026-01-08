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
        Schema::table('factura_venta', function (Blueprint $table) {
            $table->foreign(['cliente_id'], 'cliente_id')->references(['ID_Clientes'])->on('clientes')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('factura_venta', function (Blueprint $table) {
            $table->dropForeign('cliente_id');
        });
    }
};
