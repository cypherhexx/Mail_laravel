<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('company_name', 5000)->default('');
            $table->string('company_address', 1000)->default('');
            $table->string('email_address', 1000)->default('');
            $table->string('logo', 600)->default('bpract.jpg');
            $table->string('logo_ico', 600)->default('bpract.jpg');
            $table->string('theme', 100)->default('default');
            $table->string('currency');
            $table->string('site_mode')->default('yes');
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
        Schema::drop('app_settings');
    }
}
