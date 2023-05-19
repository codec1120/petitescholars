<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFrequencyChildProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequency_child_profile', function (Blueprint $table) {
            $table->id();
            $table->string('doc_type')->nullable();
            $table->string('activity')->nullable();
            $table->string('frequency')->nullable();
            $table->string('frequency_type')->nullable();
            $table->timestamps();
        });
        
        // Default Data
        DB::table('frequency_child_profile')->insert(
            array(
                array(
                    'doc_type' => 'Emergency Contact Form', 
                    'activity' => 'Enable',
                    'frequency' => '6 Months',
                    'frequency_type' => 'Acknowledgments'
                ),
                array(
                    'doc_type' => 'Fee Agreement', 
                    'activity' => 'Disable',
                    'frequency' => '6 Months',
                    'frequency_type' => 'Revision'
                ),
                array(
                    'doc_type' => 'Health Assessment (0-6 months)', 
                    'activity' => 'Enable',
                    'frequency' => '2 Months',
                    'frequency_type' => 'Acknowledgments'
                ),
                array(
                    'doc_type' => 'Health Assessment (1-5 years)', 
                    'activity' => 'Enable',
                    'frequency' => '1 Year',
                    'frequency_type' => 'Acknowledgments'
                ),
                array(
                    'doc_type' => 'Health Assessment (5-7 years)', 
                    'activity' => 'Enable',
                    'frequency' => '1 Year',
                    'frequency_type' => 'Revision'
                ),
                array(
                    'doc_type' => 'Parent Handbook', 
                    'activity' => 'Enable',
                    'frequency' => '1 Year',
                    'frequency_type' => 'Revision'
                )
            ) 
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frequency_child_profile');
    }
}
