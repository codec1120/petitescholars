<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildRelativeInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_relative_informations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id')
                    ->references('id')
                    ->on('child_informations')
                    ->onDelete('CASCADE');
            $table->string('family_name')->nullable();
            $table->string('relationship')->nullable();
            $table->string('age')->nullable();
            $table->string('pet_species')->nullable();
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
        Schema::dropIfExists('child_relative_informations');
    }
}
