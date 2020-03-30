<?php

use Illuminate\Database\Seeder;

class settingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \App\Settings::create([
            'point_value'        => '100',
            'pair_value'        => '10',
            'pair_amount'   => 100,
            'tds'   => '0',
            'service_charge'   => '0',
            'sponsor_Commisions'   => '60',
            'sponsor'=>'90',
            'joinfee' => '0',
            'direct_referral' =>'25',
            'three_friends' => '1',
            'eight_friends' => '1',
            'withdraw_percent' => '5',
            'withdraw_days' => '10',
            'matrix'  =>'3',
            'trader'  =>'3',
            'star'  =>'1',
            'superstar'  =>'2',
        ]); 
    }
}
