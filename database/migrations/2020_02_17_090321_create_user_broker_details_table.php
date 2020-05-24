<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBrokerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('user_broker_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('broker_id');
            $table->integer('user_id');
            $table->string('account');
            $table->string('password');
            $table->string('status')->default('started');
            $table->rememberToken();
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
        Schema::dropIfExists('user_broker_details');
    }
}
