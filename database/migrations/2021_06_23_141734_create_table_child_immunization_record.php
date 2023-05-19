<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableChildImmunizationRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_immunization_record', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id')
                    ->references('id')
                    ->on('child_informations')
                    ->onDelete('CASCADE');
            $table->integer('immunization_index')->nullable();
            $table->date('dose0')->nullable();
            $table->date('dose1')->nullable();
            $table->date('dose2')->nullable();
            $table->date('dose3')->nullable();
            $table->date('dose4')->nullable();
            $table->date('dose5')->nullable();
            $table->date('dose6')->nullable();
            $table->date('dose7')->nullable();
            $table->date('dose8')->nullable();
            $table->date('dose9')->nullable();
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
        Schema::dropIfExists('child_immunization_record');
    }
}
