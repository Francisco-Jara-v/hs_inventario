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
        Schema::create('clientes', function (Blueprint $table) {
            $table->integer('ID_Clientes', true);
            $table->string('Empresa', 100);
            $table->string('Rut', 20);
            $table->string('Giro')->nullable();
            $table->string('Telefono', 20)->nullable();
            $table->string('Correo', 100)->nullable();
            $table->string('Direccion', 100)->nullable();
            $table->string('Ciudad', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
