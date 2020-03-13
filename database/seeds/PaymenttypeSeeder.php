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
       
          
        ]);
       App\PaymentType::create([
          'payment_name'=>'Ewallet',
          'code'=>'ewallet',
        
          
        ]);

       App\PaymentType::create([
          'payment_name'=>'Stripe',
          'code'=>'Stripe',
       
          
        ]);
      App\PaymentType::create([
          'payment_name'=>'Paypal',
          'code'=>'paypal',
           'status' => 'yes',
          
          
        ]);
      App\PaymentType::create([
          'payment_name'=>'Voucher',
          'code'=>'voucher',
          
          
        ]);

       App\PaymentType::create([
          'payment_name'=>'Bitcoin',
          'code'=>'bitcoin',
           'status' => 'yes',
          
          
        ]);
    }
}
