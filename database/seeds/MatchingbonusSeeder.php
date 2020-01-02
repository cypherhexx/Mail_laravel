<?php

use Illuminate\Database\Seeder;

class MatchingbonusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\MatchingBonus::create([
        	'package_id'=>1,
        	'pv'=>5,        	     	
        	]);

        App\MatchingBonus::create([
        	'package_id'=>2,
        	'pv'=>10,
        	       	
        	]);

		 App\MatchingBonus::create([
        	'package_id'=>3,
        	'pv'=>10,
        	       	
        	]);        
       



    }
}
