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
        Schema::create('liquidaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Relación con la tabla de empleados
            $table->date('payout_date');
            $table->decimal('gross_salary', 10, 2);
            $table->decimal('retirement_contribution', 10, 2);
            $table->decimal('health_contribution', 10, 2);
            $table->decimal('risk_contribution', 10, 2);
            $table->decimal('unemployment_contribution', 10, 2);
            $table->decimal('total_contributions', 10, 2);
            $table->decimal('net_salary', 10, 2);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liquidaciones');
    }
};
