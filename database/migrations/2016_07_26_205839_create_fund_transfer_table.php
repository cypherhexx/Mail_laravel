<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_transfer', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('debit_user_id')->unsigned();
            $table->foreign('debit_user_id')->references('id')->on('users');
            $table->integer('credit_user_id')->unsigned();
            $table->foreign('credit_user_id')->references('id')->on('users');
            $table->double('amount',15,2)->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fund_transfer');
    }
}
