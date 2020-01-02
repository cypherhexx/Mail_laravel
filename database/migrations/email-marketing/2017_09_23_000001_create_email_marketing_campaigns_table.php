<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailMarketingCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('email_marketing_campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('customer_group'); 
            $table->string('first_name');
            $table->string('last_name');
            $table->string('from_email');
            $table->string('subject'); //Email
            $table->date('datetime'); //Email
            $table->text('campaign-email'); //Email HTML
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('email_marketing_campaigns');
    }
}