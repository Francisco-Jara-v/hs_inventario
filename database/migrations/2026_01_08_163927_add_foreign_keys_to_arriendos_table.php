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
        Schema::table('arriendos', function (Blueprint $table) {
            $table->foreign(['ID_Cliente'], 'fk_ID_Cliente')->references(['ID_Clientes'])->on('clientes')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arriendos', function (Blueprint $table) {
            $table->dropForeign('fk_ID_Cliente');
        });
    }
};
