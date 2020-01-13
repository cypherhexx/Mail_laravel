<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRanksettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('rank_setting', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('rank_name', 500)->default('rank');
            $table->string('rank_code')->unique();
            $table->integer('top_up')->default('1');
            $table->integer('quali_rank_id')->default('1');
            $table->integer('quali_rank_count')->default('1');
            $table->string('rank_bonus', 500)->default('NA');
            $table->integer('minimum_users1')->default('0');
            $table->integer('rule1')->default('0');
            $table->integer('minimum_users2')->default('0');
            $table->integer('rule2')->default('0');
            $table->integer('minimum_users3')->default('0');
            $table->integer('rule3')->default('0');
            $table->integer('minimum_users4')->default('0');
            $table->integer('rule4')->default('0');
            $table->double('gain')->default('0');
            $table->integer('tree_level')->default('0');
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
       Schema::drop('rank_setting');
    }
}
