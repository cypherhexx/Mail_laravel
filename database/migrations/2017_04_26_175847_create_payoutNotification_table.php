<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayoutNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
   Schema::create('payment_notification', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
          
            $table->string('subject',1000);
            $table->string('mail_content',1000);
            $table->string('mail_status')->nullable();
           
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
       Schema::drop('payment_notification');
    }
}
