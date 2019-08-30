<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTransectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_transections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->integer('item_id')->unsigned();
            $table->integer('vendor_id')->unsigned();
            $table->integer('bank_id')->unsigned();
            $table->float('paid',15,2);
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
        Schema::dropIfExists('item_transections');
    }
}
