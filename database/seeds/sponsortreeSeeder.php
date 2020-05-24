<?php

use Illuminate\Database\Seeder;

class sponsortreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\Sponsortree::create([
            'user_id'        => '1',
            'sponsor'        => '0',
            'position'   => 1,
            'type'   => 'yes'
        ]); 
       \App\Sponsortree::create([
            'user_id'        => '0',
            'sponsor'        => 1,            
            'position'   => 1,
            'type'   => 'vaccant'
        ]); 
    }
}
