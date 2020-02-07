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
          'package'=>'50€',
          'amount'=>'50',
          'pv'=>0,
          'rs'=>0,
          'code'=>0,
          'daily_limit'=>0,
          'special'=>0,
          'top_count'=>0,
          'ref_top_count'=>0,
           'level_percent' => '2',
        ]);
      App\Packages::create([
          'package'=>'100€',
          'amount'=>'100',
          'pv'=>0,
          'rs'=>0,
          'code'=>0,
          'daily_limit'=>0,
          'special'=>0,
          'top_count'=>0,
          'ref_top_count'=>0,
          'level_percent' => '2.5',
        ]);

       App\Packages::create([
          'package'=>'150€',
          'amount'=>'150',
          'pv'=>0,
          'rs'=>0,
          'code'=>0,
          'daily_limit'=>0,
          'special'=>0,
          'top_count'=>0,
          'ref_top_count'=>0,
           'level_percent' =>'2.75', 
        ]);

        App\Packages::create([
          'package'=>'200€',
          'amount'=>'200',
          'pv'=>0,
          'rs'=>0,
          'code'=>0,
          'daily_limit'=>0,
          'special'=>0,
          'top_count'=>0,
          'ref_top_count'=>0,
           'level_percent' => '3',
        ]);
    }
}
