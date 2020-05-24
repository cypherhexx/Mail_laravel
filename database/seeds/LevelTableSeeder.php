<?php

use Illuminate\Database\Seeder;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Level::create([
        	'level'=>1,
        	'bonus'=>60,
        	'extra_bonus'=>60,
        	]);
        App\Level::create([
        	'level'=>2,
        	'bonus'=>50,
        	'extra_bonus'=>360,
        	]);
        App\Level::create([
        	'level'=>3,
        	'bonus'=>40,
        	'extra_bonus'=>2160,
        	]);
        App\Level::create([
        	'level'=>4,
        	'bonus'=>30,
        	'extra_bonus'=>12960,
        	]);
        App\Level::create([
        	'level'=>5,
        	'bonus'=>20,
        	'extra_bonus'=>38880,
        	]);
        App\Level::create([
        	'level'=>6,
        	'bonus'=>10,
        	'extra_bonus'=>2332800,
        	]);

    }
}
