<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::rename('conceptos_liquidaciones', 'concept_payouts');
    }

    public function down()
    {
        Schema::rename('concept_payouts', 'conceptos_liquidaciones');
    }

};
