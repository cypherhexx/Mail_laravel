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
          'package'=>'Elite',
          'amount'=>'300',
          'pv'=>'150',
          'rs'=>'600',
          'code'=>'5',
          'daily_limit'=>'5000',
          'special'=>'no',
          'top_count'=>'0.5',
          'ref_top_count'=>'0.25',
        ]);
       App\Packages::create([
          'package'=>'Premium',
          'amount'=>'600',
          'pv'=>'300',
          'rs'=>'1200',
          'code'=>'10',
          'daily_limit'=>'10000',
          'special'=>'yes',
          'top_count'=>'1',
          'ref_top_count'=>'0.5',
        ]);
      App\Packages::create([
       		'package'=>'VIP',
          'amount'=>'1200',
          'pv'=>'600',
       		'rs'=>'2400',
          'code'=>'20',
          'daily_limit'=>'15000',
          'special'=>'yes',
          'top_count'=>'2',
       		'ref_top_count'=>'1',
       	]);
    }
}
