<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableImmunizationSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immunization_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('immunization_index')->nullable();
            $table->string('selected_immunization_dosage')->nullable();
            $table->string('dose_1age_month')->nullable();
            $table->string('dose_1age_year')->nullable();
            $table->string('dose_2age_month')->nullable();
            $table->string('dose_2age_year')->nullable();
            $table->string('dose_3age_month')->nullable();
            $table->string('dose_3age_year')->nullable();
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
        Schema::dropIfExists('immunization_settings');
    }
}
