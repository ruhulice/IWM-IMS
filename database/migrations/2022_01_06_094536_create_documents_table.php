<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();
            $table->bigIncrements('id');
            $table->string('title');           
            $table->string('description')->nullable();       
            $table->bigInteger('doc_type');       
            $table->string('ref_no')->nullable();   
            $table->string('client')->nullable();   
            $table->dateTime('date');         
            $table->string('subject')->nullable();       
            $table->string('to_whome')->nullable();       
            $table->string('from')->nullable();       
            $table->string('doc_link')->nullable();       
            $table->string('thumb_image_link')->nullable();
            $table->string('remarks')->nullable();                
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->bigInteger('is_active')->default(1);
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
        Schema::dropIfExists('documents');
    }
}
