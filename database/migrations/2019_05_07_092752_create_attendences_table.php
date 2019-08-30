<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('labour_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->boolean('first')->default(0);
            $table->boolean('secound')->default(0);
            $table->boolean('third')->default(0);
            $table->boolean('fourth')->default(0);
            $table->date('date');
            $table->float('payable_money',15,2);
            $table->float('paid',15,2)->nullable();
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
        Schema::dropIfExists('attendences');
    }
}
