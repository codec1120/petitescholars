<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildFeeAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_fee_agreements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id')
                    ->references('id')
                    ->on('child_informations')
                    ->onDelete('CASCADE');
            $table->integer('payee')->nullable();
            $table->string('other_payee_first_name')->nullable();
            $table->string('other_payee_last_name')->nullable();
            $table->string('other_payee_address')->nullable();
            $table->string('other_payee_city')->nullable();
            $table->string('other_payee_state')->nullable();
            $table->string('other_payee_zip')->nullable();
            $table->string('other_payee_phone_number')->nullable();
            $table->string('other_payee_phone_type')->nullable();
            $table->string('other_payee_email_address')->nullable();
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
        Schema::dropIfExists('child_fee_agreements');
    }
}
