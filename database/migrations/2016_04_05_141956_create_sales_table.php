<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->default(1);
            $table->double('amount',15,2)->default(false);
            $table->integer('pv')->default(false);
            $table->integer('redeem_pv')->default(false);
            $table->string('description')->default('');
            $table->string('type')->default('');
            $table->string('status')->default('');
            $table->string('pay_by')->default('cash');
            $table->integer('master')->default(false);
            $table->integer('sale_id')->default(false);
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
        Schema::drop('sales');
    }
}
