<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettings2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('settings2', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
           $table->integer('matrixlevel')->nullable();
            $table->double('percent')->nullable();
            $table->double('cpercent')->nullable();
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
        //
    }
}
