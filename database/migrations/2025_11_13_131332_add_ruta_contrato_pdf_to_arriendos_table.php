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
            $table->string('ruta_contrato_pdf')->nullable()->after('Precio_total');
        });
    }
    
    public function down(): void
    {
        Schema::table('arriendos', function (Blueprint $table) {
            $table->dropColumn('ruta_contrato_pdf');
        });
    }
};
