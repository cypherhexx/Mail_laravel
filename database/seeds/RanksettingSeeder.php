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
			'rank_code' 	     => "Reseller",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 10,
			'minimum_direct_ref1' => 10,
			'minimum_ref_for_each1' => 0,
			'gain'=>'1',
			'tree_level'=>'10',
			
		]);

		 \App\Ranksetting::create([
			'rank_name' 	     => "Manager",
			'rank_code' 	     => "Manager",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 5,
			'minimum_direct_ref1' => 5,
			'minimum_ref_for_each1' => 1,
			// 'minimum_direct_ref2' => 3,
			// 'minimum_ref_for_each2' => 1,
			'gain'=>'0.2',
			'tree_level'=>'10',
			

		]);

		  \App\Ranksetting::create([
			'rank_name' 	     => "Administrator",
			'rank_code' 	     => "Administrator",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 10,
			'minimum_direct_ref1' => 5,
			'minimum_ref_for_each1' => 5,
			'minimum_direct_ref2' => 5,
			'minimum_ref_for_each2' => 1,
		
			'gain'=>'0.6',
			'tree_level'=>'10',
			

		]);

		   \App\Ranksetting::create([
			'rank_name' 	     => "Master",
			'rank_code' 	     => "Master",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 10,
			'minimum_direct_ref1' => 10,
			'minimum_ref_for_each1' => 5,
			
			'gain'=>'0.8',
			'tree_level'=>'10',
			

		]);

		    \App\Ranksetting::create([
			'rank_name' 	     => "Chief",
			'rank_code' 	     => "Chief",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 10,
			'minimum_direct_ref1' => 10,
			'minimum_ref_for_each1' => 5,
			'minimum_direct_ref3' => 50,
			'minimum_ref_for_each3' => 1,
			'gain'=>'0.2',
			'tree_level'=>'10',
			

		]);

		 \App\Ranksetting::create([
			'rank_name' 	     => "President",
			'rank_code' 	     => "President",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 10,
			'minimum_direct_ref1' => 10,
			'minimum_ref_for_each1' => 5,
			'minimum_direct_ref3' => 50,
			'minimum_ref_for_each3' => 5,
			'gain'=>'1',
			'tree_level'=>'10',
			

		]);

		
		
      
    }
}
