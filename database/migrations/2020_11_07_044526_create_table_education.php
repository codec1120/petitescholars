<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEducation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id()->from(10000000);
            $table->unsignedBigInteger('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
            $table->string('high_school_name')->nullable();
            $table->string('high_school_address')->nullable();
            $table->string('name_of_college')->nullable();
            $table->string('college_address')->nullable();
            $table->integer('grade_completed')->nullable();
            $table->date('graduate_date')->nullable();
            $table->string('semester_hours_completed')->nullable();
            $table->string('degree_earned')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('educations');
    }
}
