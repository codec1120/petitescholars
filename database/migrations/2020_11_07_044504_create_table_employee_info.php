<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmployeeInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_infos', function (Blueprint $table) {
            $table->id()->from(10000000);
            $table->unsignedBigInteger('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('dob')->nullable();
            $table->date('date_submitted')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('employee_infos');
    }
}
