<?php

use Illuminate\Database\Seeder;

class userbalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Balance::create([
			'user_id' 	     => 1,
			'balance'   => 0
		]);
    }
}
