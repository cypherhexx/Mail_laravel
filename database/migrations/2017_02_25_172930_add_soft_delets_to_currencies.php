<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeletsToCurrencies extends Migration
{

    /**
     * Currencies table name
     *
     * @var string
     */
    protected $table_name;

    /**
     * Create a new migration instance.
     */
    public function __construct()
    {
        $this->table_name = config('currency.drivers.database.table');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table($this->table_name, function($table) {
        
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
       
    }
}

            

           