<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankRechargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_recharges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bank_id')->unsigned();
            $table->integer('vendor_id')->nullable();
            $table->float('amount',15,2);
            $table->date('date');
            $table->string('type');
            $table->float('balance',15,2);
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
        Schema::dropIfExists('bank_recharges');
    }
}
