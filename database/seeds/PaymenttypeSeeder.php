<?php

use Illuminate\Database\Seeder;

class PaymenttypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\PaymentType::create([
          'payment_name'=>'Cheque',
          'code'=>'cheque',
          'status'=>'yes',
          
        ]);
       App\PaymentType::create([
          'payment_name'=>'Ewallet',
          'code'=>'ewallet',
          'status'=>'yes',
          
        ]);

       App\PaymentType::create([
          'payment_name'=>'Stripe',
          'code'=>'Stripe',
          'status' => 'yes',
          
        ]);
      App\PaymentType::create([
          'payment_name'=>'Paypal',
          'code'=>'paypal',
          
        ]);
      App\PaymentType::create([
          'payment_name'=>'Voucher',
          'code'=>'voucher',
          'status' => 'yes',
          
        ]);
    }
}
