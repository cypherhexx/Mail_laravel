<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketPrioritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_priorities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('priority');
            $table->string('status');
            $table->string('priority_desc');
            $table->string('priority_color');
            $table->boolean('priority_urgency');
            $table->boolean('ispublic');
            $table->string('is_default');
            $table->text('admin_note');
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
        Schema::drop('ticket_priorities');
    }
}
