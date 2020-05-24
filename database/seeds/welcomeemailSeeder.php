<?php

use Illuminate\Database\Seeder;

class welcomeemailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         DB::table('welcomeemail')->insert([
        	 
        	  'to_email' => 'info@algolight.com', 
        	  'subject' => '<p>Welcome to Algolight! Thanks so much for joining us. You’re on your way to a brand new business. </p>', 
        	  'body' => '
<p>Algolight is a MLM app that helps you focus wide range of earning possibilities  by only allowing you to grow your network members at high payout. Set and track daily, weekly, and monthly income.  </p>
<p>
Purchase plan regularly to keep earnings from Algolight. Here you can track your growth and monitor your income. 
</p>
',
              ]);
    }
}
