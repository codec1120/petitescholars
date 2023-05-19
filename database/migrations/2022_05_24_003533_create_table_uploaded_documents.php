<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUploadedDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploaded_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doc_id')
                    ->references('id')
                    ->on('documents')
                    ->onDelete('CASCADE');
            $table->integer('default_file')->default(0);
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
        Schema::dropIfExists('uploaded_documents');
    }
}
