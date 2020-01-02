<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('ticket_replies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('ticket_id');
            $table->string('title');
            $table->text('body', 65535);
            $table->string('ip_address');       
            $table->softDeletes();
            $table->timestamps();
        });
       \DB::statement('ALTER TABLE `ticket_replies` MODIFY `body` LONGBLOB');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ticket_replies');
    }
}
