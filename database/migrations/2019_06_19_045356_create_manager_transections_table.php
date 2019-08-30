<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerTransectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager_transections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('manager_id')->unsigned();
            $table->integer('bank_id')->unsigned()->nullable();
            $table->float('amount',15,2);
            $table->string('type');
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
        Schema::dropIfExists('manager_transections');
    }
}
