<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildAuthorizedAdultsPickupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_authorized_adults_pickups', function (Blueprint $table) {
            $table->id()->from(10000000);
            $table->unsignedBigInteger('child_id')
                    ->references('id')
                    ->on('child_informations')
                    ->onDelete('CASCADE');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->bigInteger('phone_number')->nullable();
            $table->string('absentee_first_name')->nullable();
            $table->string('absentee_last_name')->nullable();
            $table->string('absentee_phone_number')->nullable();
            $table->string('absentee_address')->nullable();
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
        Schema::dropIfExists('child_authorized_adults_pickups');
    }
}
