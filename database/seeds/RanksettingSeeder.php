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
			'rank_code' 	     => "M1",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
		]);
  //      \App\Ranksetting::create([
		// 	'rank_name' 	     => "A",
		// 	'rank_code' 	     => "A",
		// 	'top_up'   => 0,
		// 	'quali_rank_id'   => 0,
		// 	'quali_rank_count'   => 0,
		// 	'rank_bonus'   => "na",
		// 	'direct_referral' => 5,
		// 	'minimum_direct_ref1' => 5,
		// 	'minimum_ref_for_each1' => 0,
		// 	'gain'=>'1',
		// 	'tree_level'=>'10',


		// ]);
        \App\Ranksetting::create([
			'rank_name' 	     => "Reseller",
			'rank_code' 	     => "Reseller1",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 5,
			'minimum_direct_ref1' => 5,
			'minimum_ref_for_each1' => 1,
			'gain'=>'0.2',
			'tree_level'=>'10',
			
		]);

		 \App\Ranksetting::create([
			'rank_name' 	     => "Manager",
			'rank_code' 	     => "Manager1",
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
			

		]);

		  \App\Ranksetting::create([
			'rank_name' 	     => "Administrator",
			'rank_code' 	     => "Administrator1",
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
			

		]);

		   \App\Ranksetting::create([
			'rank_name' 	     => "Master",
			'rank_code' 	     => "Master1",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 5,
			'minimum_direct_ref1' => 5,
			'minimum_ref_for_each1' => 0,
			'minimum_direct_ref3' =>25,
			'minimum_ref_for_each3'=>1,
			
			'gain'=>'0.8',
			'tree_level'=>'10',
			

		]);

		    \App\Ranksetting::create([
			'rank_name' 	     => "Chief",
			'rank_code' 	     => "Chief1",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 5,
			'minimum_direct_ref1' => 5,
			'minimum_ref_for_each1' => 0,
			'minimum_direct_ref3' => 25,
			'minimum_ref_for_each3' => 3,
			'gain'=>'0.9',
			'tree_level'=>'10',
			

		]);

		 \App\Ranksetting::create([
			'rank_name' 	     => "President",
			'rank_code' 	     => "President1",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 5,
			'minimum_direct_ref1' => 5,
			'minimum_ref_for_each1' => 0,
			'minimum_direct_ref3' => 25,
			'minimum_ref_for_each3' => 5,
			'gain'=>'1',
			'tree_level'=>'10',
			

		]);

		
		
      
    }
}
