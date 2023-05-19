<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_reviews', function (Blueprint $table) {
            $table->id()->startingValue(10000000);
            $table->date('date_completed')->nullable();
            $table->unsignedBigInteger('completed_by')->nullable();
            $table->string('yearly_review')->nullable();
            $table->enum('title', [
                'owner', 'co_teacher', 'director', 'admin_aide'
            ]);
            $table->decimal('overall_score')->nullable();
            $table->unsignedBigInteger('staff_id');
            $table->timestamps();

            $table->foreign('completed_by')
                ->references('id')->on('users')
                ->onDelete('SET NULL');

            $table->foreign('staff_id')
                ->references('id')->on('users')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff_reviews');
    }
}
