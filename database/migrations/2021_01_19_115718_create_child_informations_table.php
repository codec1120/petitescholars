<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_informations', function (Blueprint $table) {
            $table->id()->from(10000000);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('birthdate')->nullable();
            $table->integer('sex')->default(0);
            $table->string('home_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->integer('zip')->nullable();
            $table->integer('status')->default(0);
            $table->integer('completed_registration_steps')->default(0);
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
        Schema::dropIfExists('child_informations');
    }
}
