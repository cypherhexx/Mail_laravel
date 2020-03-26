<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPackagesToCommissionTable extends Migration
{
    /**
     * Run the migrcations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commission', function (Blueprint $table) {
            $table->integer('package')->after('category');
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
