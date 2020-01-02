<?php

use Illuminate\Database\Seeder;

class TempRegDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
         \App\TempDetails::create([
            'paystatus' => '0'
            
        ]); 
    }
}
