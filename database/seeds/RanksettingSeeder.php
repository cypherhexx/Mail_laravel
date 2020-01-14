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
			'rank_name' 	     => "A",
			'rank_code' 	     => "A",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 3,
			'minimum_direct_ref1' => 3,
			'minimum_ref_for_each1' => 1,
			'gain'=>'0.2',
			'tree_level'=>'12',


		]);
        \App\Ranksetting::create([
			'rank_name' 	     => "B",
			'rank_code' 	     => "B",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 3,
			'minimum_direct_ref1' => 3,
			'minimum_ref_for_each1' => 3,
			'gain'=>'0.4',
			'tree_level'=>'14',
			
		]);

		 \App\Ranksetting::create([
			'rank_name' 	     => "C",
			'rank_code' 	     => "C",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 6,
			'minimum_direct_ref1' => 3,
			'minimum_ref_for_each1' => 3,
			'minimum_direct_ref2' => 3,
			'minimum_ref_for_each2' => 1,
			'gain'=>'0.6',
			'tree_level'=>'15',
			

		]);

		  \App\Ranksetting::create([
			'rank_name' 	     => "D",
			'rank_code' 	     => "D",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 6,
			'minimum_direct_ref1' => 6,
			'minimum_ref_for_each1' => 3,
		
			'gain'=>'0.7',
			'tree_level'=>'16',
			

		]);

		   \App\Ranksetting::create([
			'rank_name' 	     => "E",
			'rank_code' 	     => "E",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 6,
			'minimum_direct_ref1' => 3,
			'minimum_ref_for_each1' => 6,
			'minimum_direct_ref2' => 3,
			'minimum_ref_for_each2' => 3,
			'gain'=>'0.8',
			'tree_level'=>'17',
			

		]);
		 \App\Ranksetting::create([
			'rank_name' 	     => "F",
			'rank_code' 	     => "F",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 6,
			'minimum_direct_ref1' => 6,
			'minimum_ref_for_each1' => 6,
			'minimum_direct_ref3' => 3,
			'minimum_ref_for_each3' => 3,
			'gain'=>'0.9',
			'tree_level'=>'18',
			

		]);

		 \App\Ranksetting::create([
			'rank_name' 	     => "G",
			'rank_code' 	     => "G",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 6,
			'minimum_direct_ref1' => 6,
			'minimum_ref_for_each1' => 6,
			'minimum_direct_ref3' => 6,
			'minimum_ref_for_each3' => 1,
			'gain'=>'1',
			'tree_level'=>'19',
			

		]);

		 	 \App\Ranksetting::create([
			'rank_name' 	     => "H",
			'rank_code' 	     => "H",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct_referral' => 6,
			'minimum_direct_ref1' => 6,
			'minimum_ref_for_each1' => 6,
			'minimum_direct_ref3' => 6,
			'minimum_ref_for_each3' => 3,
			'gain'=>'1',
			'tree_level'=>'19',
			
			
			

		]);
      
    }
}
