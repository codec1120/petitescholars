<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableImmunizationConfigurations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immunization_configurations', function (Blueprint $table) {
            $table->id();
            $table->integer('immunization_index')->nullable();
            $table->string('selected_immunization_dosage')->nullable();
            $table->string('dose_age_month')->nullable();
            $table->string('dose_age_year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_immunization_configurations');
    }
}
