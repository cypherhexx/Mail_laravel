<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLevelsToCommissionTable extends Migration
{
    /**
     * Run the mcigrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commission', function (Blueprint $table) {
            $table->double('matrix')->after('payment_status');
            $table->double('level_percent')->after('matrix');
            $table->double('rankgain')->after('level_percent');
            $table->double('category')->after('rankgain');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commission', function (Blueprint $table) {
            //
        });
    }
}
