<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Este método eliminará la tabla empleados.
     */
    public function up(): void
    {
        Schema::dropIfExists('empleados');
    }

    /**
     * Reverse the migrations.
     * Si deseas revertir la eliminación, deberías recrear la tabla aquí (opcional).
     */
    public function down(): void
    {
        // Opción para recrear la tabla si se deshace la migración
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('dni')->unique();
            $table->string('email')->unique();
            $table->decimal('salario_base', 10, 2);
            $table->string('cargo');
            $table->timestamps();
        });
    }
};
