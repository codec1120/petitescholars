<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildGuardiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_guardians', function (Blueprint $table) {
            $table->id()->from(10000000);
            $table->unsignedBigInteger('child_id')
                    ->references('id')
                    ->on('child_informations')
                    ->onDelete('CASCADE');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->bigInteger('phone_number_1')->nullable();
            $table->integer('phone_type_1')->nullable();
            $table->integer('same_as_child_adress')->default(0);
            $table->string('home_address')->nullable();
            $table->string('email_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->integer('zip')->nullable();
            $table->integer('sameAsChildAddress')->nullable();
            $table->integer('primary_guardian')->default(0);
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
        Schema::dropIfExists('child_guardians');
    }
}
