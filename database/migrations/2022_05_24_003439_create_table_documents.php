<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('doc_type')->nullable();
            $table->integer('doc_status')->default(0);
            $table->integer('doc_owner_ident')->default(0);
            $table->timestamps();
        });

        // Insert Child Profile Documents
        DB::table('documents')->insert(
            array(
                array(
                    'doc_type' => 'Employee Data Sheet',
                    'doc_status' => 1,
                    'doc_owner_ident' => 1,
                ),
                array(
                    'doc_type' => 'Employee Emergency Contact',
                    'doc_status' => 1,
                    'doc_owner_ident' => 1,
                ),
                array(
                    'doc_type' => 'Staff Handbook',
                    'doc_status' => 1,
                    'doc_owner_ident' => 1,
                ),
                array(
                    'doc_type' => 'Disclosure Statement',
                    'doc_status' => 1,
                    'doc_owner_ident' => 1,
                ),
                array(
                    'doc_type' => 'Emergency Contact Form',
                    'doc_status' => 1,
                    'doc_owner_ident' => 2,
                ),
                array(
                    'doc_type' => 'Parent Handbook',
                    'doc_status' => 1,
                    'doc_owner_ident' => 2,
                ),
                array(
                    'doc_type' => 'Child health assessment',
                    'doc_status' => 1,
                    'doc_owner_ident' => 2,
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
        Schema::dropIfExists('documents');
    }
}
