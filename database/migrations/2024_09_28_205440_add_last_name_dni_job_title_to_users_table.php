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
        Schema::table('users', function (Blueprint $table) {
            // Agregar nuevas columnas
            $table->string('last_name')->after('name'); // Columna last_name después de name
            $table->string('dni')->unique()->after('email'); // Columna dni, única y después de email
            $table->string('job_title')->nullable()->after('password'); // Columna job_title, puede ser nula
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Eliminar las columnas agregadas
            $table->dropColumn(['last_name', 'dni', 'job_title']);
        });
    }
};
