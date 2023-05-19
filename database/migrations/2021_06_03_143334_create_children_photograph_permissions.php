<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenPhotographPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children_photograph_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id')
                    ->references('id')
                    ->on('child_informations')
                    ->onDelete('CASCADE');
            $table->string('question_index')->nullable();
            $table->string('question_answer')->nullable();
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
        Schema::dropIfExists('children_photograph_permissions');
    }
}
