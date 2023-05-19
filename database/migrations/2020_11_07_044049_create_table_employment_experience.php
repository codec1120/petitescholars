<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmploymentExperience extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('employment_experiences', function (Blueprint $table) {
            $table->id()->from(10000000);
            $table->unsignedBigInteger('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
            $table->integer('cnt')->nullable();
            $table->string('employer')->nullable();
            $table->string('employer_address')->nullable();
            $table->string('job_description')->nullable();
            $table->string('job_title')->nullable();
            $table->date('employment_start_date')->nullable();
            $table->date('employment_end_date')->nullable();
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
        Schema::dropIfExists('employment_experiences');
    }
}
