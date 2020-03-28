<?php

use Illuminate\Database\Seeder;
use \App\ProfileInfo;

class UsersTableSeeder extends Seeder {

	public function run()
	{

		$user = \App\User::create([
			'name' 	     => 'John',
			'lastname'   => 'Doe',
			'username'   => 'algolight',
			'email'		 => 'info@cloudmlmsoftware.com',
		    'rank_id'    => '1',
			'password'   => bcrypt('#1MLMsoftware'),
			'transaction_pass'   => bcrypt('#1MLMsoftware'),
			'confirmed'  => 1,
            'admin'      => 1,
			'confirmation_code' => md5(microtime() . env('APP_KEY')),
		]);	


	}

}
