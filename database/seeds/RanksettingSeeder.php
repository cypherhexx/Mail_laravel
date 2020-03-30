<?php

use Illuminate\Database\Seeder;

class RanksettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	\App\Ranksetting::create([
			'rank_name' 	     => "Member",
			'rank_code' 	     => "M",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
		]);

        \App\Ranksetting::create([
			'rank_name' 	     => "Reseller 0.2%",
			'rank_code' 	     => "RS",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 5,
			'minimum_direct_ref1' => 5,
			'minimum_ref_for_each1' => 1,
			'gain'=>'0.2',
			'tree_level'=>'10',
			'image' => '28669604730.png',
			
		]);

		 \App\Ranksetting::create([
			'rank_name' 	     => "Manager 0.4%",
			'rank_code' 	     => "MG",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 5,
			'minimum_direct_ref1' => 5,
			'minimum_ref_for_each1' => 3,
			// 'minimum_direct_ref2' => 3,
			// 'minimum_ref_for_each2' => 1,
			'gain'=>'0.4',
			'tree_level'=>'10',
			'image' => '13795391166.png',
			

		]);

		  \App\Ranksetting::create([
			'rank_name' 	     => "Administrator 0.6%",
			'rank_code' 	     => "AS",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 5,
			'minimum_direct_ref1' => 5,
			'minimum_ref_for_each1' => 5,
			'minimum_direct_ref2' => 0,
			'minimum_ref_for_each2' => 0,
		
			'gain'=>'0.6',
			'tree_level'=>'10',
			'image' => '80672958748.png',
			

		]);

		   \App\Ranksetting::create([
			'rank_name' 	     => "Master 0.8%",
			'rank_code' 	     => "MS",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 5,
			'minimum_direct_ref1' => 5,
			'minimum_ref_for_each1' => 5,
			'minimum_direct_ref3' =>5,
			'minimum_ref_for_each3'=>1,
			
			'gain'=>'0.8',
			'tree_level'=>'10',
			'image' => '99909835404.png',
			

		]);

		    \App\Ranksetting::create([
			'rank_name' 	     => "Chief 0.9%",
			'rank_code' 	     => "CF",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 5,
			'minimum_direct_ref1' => 5,
			'minimum_ref_for_each1' => 5,
			'minimum_direct_ref3' => 5,
			'minimum_ref_for_each3' => 3,
			'gain'=>'0.9',
			'tree_level'=>'10',
			'image' => '52835653340.png',
			

		]);

		 \App\Ranksetting::create([
			'rank_name' 	     => "President 1%",
			'rank_code' 	     => "PD",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 5,
			'minimum_direct_ref1' => 5,
			'minimum_ref_for_each1' => 5,
			'minimum_direct_ref3' => 5,
			'minimum_ref_for_each3' => 5,
			'gain'=>'1',
			'tree_level'=>'10',
			'image' => '58648247423.png',
			

		]);

		
		
      
    }
}
