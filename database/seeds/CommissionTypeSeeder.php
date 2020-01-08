<?php

use Illuminate\Database\Seeder;

class CommissionType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\CommissionType::create([
          'Commission_name'=>'fast_start',
          'status'=>'yes',
          
        ]);

        App\CommissionType::create([
          'Commission_name'=>'Indirect_fast_start',
          'status'=>'yes',
          
        ]);


        App\CommissionType::create([
          'Commission_name'=>'binary_commission',
          'status'=>'no',
          
        ]);
    }
}
