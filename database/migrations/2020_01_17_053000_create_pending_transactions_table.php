<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendingTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('pending_transactions', function (Blueprint $table) {
             $table->increments('id');
             $table->string('order_id')->unique();
             $table->integer('user_id')->nullable();
             $table->string('username');
             $table->string('email');
             $table->integer('sponsor');
             $table->integer('package')->default(1);
             $table->text('request_data',1000);
             $table->text('paypal_express_data',1000)->nullable();
             $table->string('payment_method');
             $table->string('payment_period')->nullable();
             $table->string('payment_type');
             $table->string('invoice')->nullable();
             $table->string('payment_code')->nullable();
             $table->double('amount');
              $table->string('rave_ref_id')->nullable(); 
             $table->string('payment_address')->nullable();
             $table->text('payment_data',1000)->nullable();
             $table->text('payment_recurring_data',1000)->nullable();
             $table->text('payment_response_data',1000)->nullable();
             $table->text('paypal_recurring_reponse',1000)->nullable();
             $table->text('payment_doexpressresponse_data',1000)->nullable();
             $table->string('profile_id')->nullable();
             $table->string('payment_status')->default('pending');
             $table->string('approved_by')->nullable();
             $table->string('paypal_plan_id')->nullable();
             $table->string('role')->nullable();
             $table->string('paypal')->nullable();
             $table->string('paypal_agreement_id')->nullable();
             $table->string('purchase_id')->nullable();
             
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
        Schema::dropIfExists('pending_transactions');
    }
}
