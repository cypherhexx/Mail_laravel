<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('package');
            $table->integer('amount')->default(0);
            $table->integer('pv')->default(0);
            $table->integer('rs')->default(0);
            $table->integer('code')->default(0);
            $table->integer('daily_limit')->default(0);
            $table->double('top_count',15,2)->default(0);
            $table->double('ref_top_count',15,2)->default(0);
            $table->string('special')->default('no');
            $table->double('level_percent')->default(0);
            $table->string('image')->nullable();
             $table->string('day_plan')->nullable();
              $table->string('month_plan')->nullable();
            
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
        Schema::drop('packages');
    }
}
