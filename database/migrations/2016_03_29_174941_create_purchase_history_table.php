<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_history', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('purchase_user_id')->unsigned();
            $table->foreign('purchase_user_id')->references('id')->on('users');
            $table->integer('package_id')->unsigned();
            $table->foreign('package_id')->references('id')->on('packages');  
            $table->double('pv',15,2)->default(0);
            $table->double('count',15,2)->default(0);
            $table->double('total_amount',15,2)->default(0);
            $table->string('pay_by')->default(false);
            $table->string('sales_status')->default('yes');
            $table->string('datas',1000)->default('no');
            $table->double('rs_balance')->default(false);
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
        Schema::drop('purchase_history');
    }
}
