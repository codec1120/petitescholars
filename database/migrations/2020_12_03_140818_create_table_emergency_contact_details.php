<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmergencyContactDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_contact_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_home_phone')->nullable();
            $table->string('emergency_work_phone')->nullable();
            $table->string('emergency_cell_phone')->nullable();
            $table->string('emergency_relation_to_staff')->nullable();
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
        Schema::dropIfExists('emergency_contact_details');
    }
}
