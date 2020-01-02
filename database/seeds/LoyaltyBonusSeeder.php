<?php

use Illuminate\Database\Seeder;

class LoyaltyBonusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\LoyaltyBonus::create([
        	'personal_sales'=>3000,
        	'bonus_duration'=>36,
        	'bonus_percentage'=>7,
        	]);
    }
}
