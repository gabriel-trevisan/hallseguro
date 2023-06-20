<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('company_id');
            $table->string('name');
            $table->string('rg', 12)->unique()->nullable();
            $table->string('voter', 12)->unique()->nullable();
            $table->string('work_card', 13)->unique()->nullable();
            $table->string('passport', 8)->unique()->nullable();
            $table->string('cellphone', 11)->nullable();
            $table->string('email')->nullable();
            $table->string('note')->nullable();
            $table->boolean('bloqued')->default(0);
            $table->date('bloqued_at')->nullable();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);

            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
