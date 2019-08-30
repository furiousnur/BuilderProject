<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGivenbyToItemTransections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_transections', function (Blueprint $table) {
            $table->integer('given_by')->unsigned()->after('bank_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_transections', function (Blueprint $table) {
            $table->dropColumn('given_by');
        });
    }
}
