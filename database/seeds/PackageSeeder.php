<?php

use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       App\Packages::create([
          'package'=>'member',
          'amount'=>'0',
          'pv'=>0,
          'rs'=>0,
          'code'=>0,
          'daily_limit'=>0,
          'special'=>0,
          'top_count'=>0,
          'ref_top_count'=>0,
           'level_percent' => '0',
           'image' => 'avatar.png',
        ]);
       App\Packages::create([
          'package'=>'Bronze',
          'amount'=>'50',
          'pv'=>0,
          'rs'=>0,
          'code'=>0,
          'daily_limit'=>0,
          'special'=>0,
          'top_count'=>0,
          'ref_top_count'=>0,
           'level_percent' => '2',
           'image' => 'bronze.png',
        ]);
      App\Packages::create([
          'package'=>'Silver',
          'amount'=>'100',
          'pv'=>0,
          'rs'=>0,
          'code'=>0,
          'daily_limit'=>0,
          'special'=>0,
          'top_count'=>0,
          'ref_top_count'=>0,
          'level_percent' => '2.5',
          'image' => 'silver.png',
        ]);

       App\Packages::create([
          'package'=>'Gold',
          'amount'=>'150',
          'pv'=>0,
          'rs'=>0,
          'code'=>0,
          'daily_limit'=>0,
          'special'=>0,
          'top_count'=>0,
          'ref_top_count'=>0,
           'level_percent' =>'2.75', 
           'image' => 'gold.png',
        ]);

        App\Packages::create([
          'package'=>'Diamond',
          'amount'=>'200',
          'pv'=>0,
          'rs'=>0,
          'code'=>0,
          'daily_limit'=>0,
          'special'=>0,
          'top_count'=>0,
          'ref_top_count'=>0,
           'level_percent' => '3',
           'image' => 'diamond.png',

        ]);
    }
}
