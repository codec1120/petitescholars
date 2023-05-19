<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenMedicalInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children_medical_informations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id')
                    ->references('id')
                    ->on('child_informations')
                    ->onDelete('CASCADE');
            $table->string('physician_name')->nullable();
            $table->string('physician_number')->nullable();
            $table->string('physician_address')->nullable();
            $table->string('physician_city')->nullable();
            $table->string('physician_state')->nullable();
            $table->string('physician_zip')->nullable();
            $table->string('child_held_insurance_provider')->nullable();
            $table->string('insurance_policy_number')->nullable();
            $table->string('allergies')->nullable();
            $table->string('prescribe_medication')->nullable();
            $table->string('special_needs')->nullable();
            $table->string('suffer_from')->nullable();
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
        Schema::dropIfExists('children_medical_informations');
    }
}
