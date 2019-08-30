<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoustomerToBankRecharges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_recharges', function (Blueprint $table) {
            $table->integer('coustomer_id')->after('manager_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bank_recharges', function (Blueprint $table) {
            $table->dropColumn('coustomer_id');
        });
    }
}
