<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBankToProfileInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('profile_infos', function (Blueprint $table) {
             $table->string('iban')->after('bank_name')->default(false)->nullable();
             $table->string('bank_country')->after('bank_address')->default(false)->nullable();
             $table->string('branch_count')->after('bank_country')->default(false)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile_infos', function (Blueprint $table) {
            //
        });
    }
}
