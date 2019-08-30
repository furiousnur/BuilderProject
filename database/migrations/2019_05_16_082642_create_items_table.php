<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('item_name_id');
            $table->string('unit');
            $table->float('quentity',15,2);
            $table->boolean('reusable');
            $table->integer('vendor_id')->unsinged();
            $table->float('cost',15,2);
            $table->float('paid_amount')->nullable();
            $table->string('payment_status');
            $table->date('payment_date')->nullable();
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
        Schema::dropIfExists('items');
    }
}
