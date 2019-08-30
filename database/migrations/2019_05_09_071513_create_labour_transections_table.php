<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabourTransectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labour_transections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('labour_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->date('date');
            $table->float('amount',15,2);
            $table->string('given_by')->nullable();
            $table->longText('note')->nullable();
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
        Schema::dropIfExists('labour_transections');
    }
}
