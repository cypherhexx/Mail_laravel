<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('mimetype', 255)->nullable();
            $table->string('filename',255)->nullable();
            $table->string('original_filename',255)->nullable();
            $table->string('filesize',255)->nullable();
            $table->string('author',255)->nullable();
            $table->boolean('zip',255)->default(false);
            $table->boolean('thumbnailable',255)->default(false);


            $table->string('type',100)->nullable(); //profile , cover , Gallery
            $table->boolean('in_album',255)->default(false); //false
            $table->string('album_id',255)->nullable(); //1


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
        Schema::dropIfExists('images');
    }
}
