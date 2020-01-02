<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailMarketingAutoRespondersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('email_marketing_autoresponders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('default title');
            $table->integer('campaign')->nullable();
            $table->integer('contact')->nullable();
            $table->text('content')->nullable();
            $table->integer('unique_clicks')->default(0); 
            $table->integer('total_clicks')->default(0); 
            $table->integer('days')->default(0); 
            $table->integer('hours')->default(0); 
            $table->integer('status')->default(1); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('email_marketing_autoresponders');
    }
}