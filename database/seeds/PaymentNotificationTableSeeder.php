<?php

use Illuminate\Database\Seeder;

class PaymentNotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       App\PaymentNotification::create([
          'subject'=>'Payout released',
          'mail_content'=>'<p>Your payout request has been approved.The payout amount will be credited to your account within 48hr.</p>
          <p>If amount will not credited to your account please contact with Admin.</p>',
          
        ]);
    }
}
