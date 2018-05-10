<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('state');
            $table->mediumText('content');
            $table->integer('document_id')->unsigned();
            $table->integer('chain_id')->unsigned();
            $table->timestamps();

            $table->foreign('document_id')
                  ->references('id')->on('documents')
                  ->nullable($value = true);
            $table->foreign('chain_id')
                  ->references('id')->on('chains')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emails');
    }
}
