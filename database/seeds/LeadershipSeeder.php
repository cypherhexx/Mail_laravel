<?php

use Illuminate\Database\Seeder;

class LeadershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        App\LeadershipBonus::create([
        	'package_id'=>1,
            'level_1'=>0,
            'level_2'=>0,
            'level_3'=>0,  
        	]);
        App\LeadershipBonus::create([
        	'package_id'=>2,
            'level_1'=>5,
            'level_2'=>5,
            'level_3'=>0, 
        	]);

        App\LeadershipBonus::create([
        	'package_id'=>3,
            'level_1'=>5,
            'level_2'=>5,
            'level_3'=>5,    
        	]);


    }
}
