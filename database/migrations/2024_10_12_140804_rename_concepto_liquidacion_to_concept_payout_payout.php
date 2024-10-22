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
    Schema::rename('concepto_liquidacion', 'concept_payout_payout');
}

public function down(): void
{
    Schema::rename('concept_payout_payout', 'concepto_liquidacion');
}

};
