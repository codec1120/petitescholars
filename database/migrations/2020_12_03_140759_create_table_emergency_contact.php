<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmergencyContact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_contact', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
            $table->date('date_of_submission')->nullable();
            $table->string('staff_allergies')->nullable();
            $table->string('staff_reaction_allergies')->nullable();
            $table->string('staff_medication')->nullable();
            $table->string('staff_medical_conditions')->nullable();
            $table->string('actions_needed_to_medical_conditions')->nullable();
            $table->string('staff_medical_insurance')->nullable();
            $table->string('staff_policy_number')->nullable();
            $table->integer('completed')->nullable();
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
        Schema::dropIfExists('emergency_contact');
    }
}
