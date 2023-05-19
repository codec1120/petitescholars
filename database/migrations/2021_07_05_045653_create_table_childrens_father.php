<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableChildrensFather extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childrens_father', function (Blueprint $table) {
            $table->id()->from(20000000);
            $table->unsignedBigInteger('child_id')
                    ->references('id')
                    ->on('child_informations')
                    ->onDelete('CASCADE');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_type')->nullable();
            $table->string('home_address')->nullable();
            $table->string('home_city')->nullable();
            $table->string('home_state')->nullable();
            $table->string('home_zip')->nullable();
            $table->string('businesss_employer')->nullable();
            $table->string('work_phone')->nullable();
            $table->string('work_address')->nullable();
            $table->string('work_city')->nullable();
            $table->string('work_state')->nullable();
            $table->string('work_zip')->nullable();
            $table->integer('primary_guardian')->nullable();
            $table->integer('secondary_guardian')->nullable();
            $table->integer('sameAsChildAddress')->nullable();
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
        Schema::dropIfExists('childrens_father');
    }
}
