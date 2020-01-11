<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('settings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('point_value');
            $table->integer('pair_value');
            $table->integer('pair_amount');
            $table->integer('tds');
            $table->integer('service_charge');
            $table->integer('sponsor_Commisions');
            $table->integer('joinfee');
            $table->integer('sponsor');
            $table->double('direct_referral');
            $table->double('three_friends');
            $table->double('eight_friends');
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
       Schema::drop('settings');
    }
}
