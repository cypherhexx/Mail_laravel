<?php

use Illuminate\Database\Seeder;

class PointTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \App\PointTable::create([
			'user_id' 	     => 1,
			'pv'   => 0,			
		]);
    }
}
