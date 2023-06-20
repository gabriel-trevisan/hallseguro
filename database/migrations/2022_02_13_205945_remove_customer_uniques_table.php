<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCustomerUniquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropUnique('customers_rg_unique');
            $table->dropUnique('customers_voter_unique');
            $table->dropUnique('customers_work_card_unique');
            $table->dropUnique('customers_passport_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->unique('rg');
            $table->unique('voter');
            $table->unique('work_card');
            $table->unique('passport');
        });
    }
}
