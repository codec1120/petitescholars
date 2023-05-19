<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePresentPosition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('present_positions', function (Blueprint $table) {
            $table->id()->from(10000000);
            $table->unsignedBigInteger('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
            $table->date('date_start')->nullable();
            $table->string('days_week_available_for_work')->nullable();
            $table->string('hours_available_for_work')->nullable();
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
        Schema::dropIfExists('present_positions');
    }
}
