<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role_name');
            $table->string('link');
            $table->integer('submenu_count');
            $table->string('is_root');
            $table->integer('parent_id');
            $table->integer('main_role');
            $table->string('icon');
            $table->integer('role_no');
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
        Schema::drop('roles');
    }
}
