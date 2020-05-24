<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPackageIdToIpnResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ipn_response', function (Blueprint $table) {
            $table->integer('package_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->string('payment_cycle')->default('NA');
            $table->string('payment_date')->default('NA');
            $table->string('next_payment_date')->default('NA');
            $table->double('initial_payment_amount')->default(0);
            $table->double('amount_per_cycle')->default(0);
            $table->string('payment_status')->default('NA');
             $table->string('profile_status')->default('NA');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ipn_response', function (Blueprint $table) {
            //
        });
    }
}
