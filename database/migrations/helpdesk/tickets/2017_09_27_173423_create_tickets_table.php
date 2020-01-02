<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->text('description');
            $table->string('ticket_number');
            $table->integer('user_id')->unsigned()->nullable()->index('user_id');
            $table->integer('department')->unsigned()->nullable()->index('department');
            $table->integer('priority')->unsigned()->nullable()->index('priority');
            $table->integer('category')->unsigned()->nullable()->index('category');
            $table->integer('type')->unsigned()->nullable()->index('type');
            $table->integer('status')->unsigned()->nullable()->index('status');
            $table->boolean('rating');
            $table->boolean('ratingreply');
            $table->integer('flags');
            $table->integer('ip_address');
            $table->integer('isoverdue');
            $table->integer('reopened');
            $table->integer('isanswered');
            $table->integer('is_deleted');
            $table->integer('closed');
            $table->dateTime('reopened_at')->nullable();
            $table->dateTime('duedate')->nullable();
            $table->dateTime('closed_at')->nullable();
            $table->dateTime('last_message_at')->nullable();
            $table->dateTime('last_response_at')->nullable();
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
        Schema::drop('tickets');
    }
}
