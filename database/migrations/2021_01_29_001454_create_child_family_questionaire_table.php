<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildFamilyQuestionaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_family_questionaire', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id')
                    ->references('id')
                    ->on('child_informations')
                    ->onDelete('CASCADE');
            $table->string('nickname')->nullable();
            $table->string('cultural_bg')->nullable();
            $table->string('language')->nullable();
            $table->string('family_celebrate_occasions')->nullable();
            $table->string('daycare_bg')->nullable();
            $table->string('daycare_bg_name')->nullable();
            $table->string('daycare_bg_phone_number')->nullable();
            $table->string('daycare_bg_address')->nullable();
            $table->date('daycare_bg_start_date')->nullable();
            $table->date('daycare_bg_end_date')->nullable();
            $table->string('daycare_bg_reason_termination')->nullable();
            $table->string('daycare_bg_contact_reference')->nullable();
            $table->string('eating_habits')->nullable();
            $table->string('child_drink')->nullable();
            $table->string('special_diet')->nullable();
            $table->string('child_food_refrain')->nullable();
            $table->string('hours_of_sleep')->nullable();
            $table->string('bed_time')->nullable();
            $table->string('nap_days')->nullable();
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
        Schema::dropIfExists('child_family_questionaire');
    }
}
