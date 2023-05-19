<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone_number_1')->nullable();
            $table->integer('phone_type_1')->nullable();
            $table->string('phone_number_2')->nullable();
            $table->integer('phone_type_2')->nullable();
            $table->string('email_address')->nullable();
            $table->integer('profile_type')->nullable();
            $table->integer('status')->default(0);
            $table->string('password')->nullable();
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
        Schema::dropIfExists('parents');
    }
}
