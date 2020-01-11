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
			'direct' => 3,
			'sub_direct1' => 1,
			'sub_direct2' => 1,
			'sub_direct3' => 1,
			'gain'=>'0.2',
			'tree_level'=>'12',
			'referral_level'=>'2',


		]);
        \App\Ranksetting::create([
			'rank_name' 	     => "B",
			'rank_code' 	     => "B",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct' => 3,
			'sub_direct1' => 3,
			'sub_direct2' => 3,
			'sub_direct3' => 3,
			'gain'=>'0.4',
			'tree_level'=>'14',
			'referral_level'=>'2',

		]);

		 \App\Ranksetting::create([
			'rank_name' 	     => "C",
			'rank_code' 	     => "C",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct' => 6,
			'sub_direct1' => 3,
			'sub_direct2' => 3,
			'sub_direct3' => 3,
			'sub_direct4' => 1,
			'sub_direct5' => 1,
			'sub_direct6' => 1,
			'gain'=>'0.6',
			'tree_level'=>'15',
			'referral_level'=>'2',

		]);

		  \App\Ranksetting::create([
			'rank_name' 	     => "D",
			'rank_code' 	     => "D",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct' => 6,
			'sub_direct1' => 3,
			'sub_direct2' => 3,
			'sub_direct3' => 3,
			'sub_direct4' => 3,
			'sub_direct5' => 3,
			'sub_direct6' => 3,
			'gain'=>'0.7',
			'tree_level'=>'16',
			'referral_level'=>'2',

		]);

		   \App\Ranksetting::create([
			'rank_name' 	     => "E",
			'rank_code' 	     => "E",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct' => 6,
			'sub_direct1' => 6,
			'sub_direct2' => 6,
			'sub_direct3' => 6,
			'sub_direct4' => 3,
			'sub_direct5' => 3,
			'sub_direct6' => 3,
			'gain'=>'0.8',
			'tree_level'=>'17',
			'referral_level'=>'2',

		]);
		 \App\Ranksetting::create([
			'rank_name' 	     => "F",
			'rank_code' 	     => "F",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct' => 6,
			'sub_direct1' => 6,
			'sub_direct2' => 6,
			'sub_direct3' => 6,
			'sub_direct4' => 6,
			'sub_direct5' => 6,
			'sub_direct6' => 6,
			'sub_junior_direct1' => 3,
			'sub_junior_direct2' => 3,
			'sub_junior_direct3' => 3,
			'gain'=>'0.9',
			'tree_level'=>'18',
			'referral_level'=>'3',

		]);

		 \App\Ranksetting::create([
			'rank_name' 	     => "G",
			'rank_code' 	     => "G",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct' => 6,
			'sub_direct1' => 6,
			'sub_direct2' => 6,
			'sub_direct3' => 6,
			'sub_direct4' => 6,
			'sub_direct5' => 6,
			'sub_direct6' => 6,
			'sub_junior_direct1' => 1,
			'sub_junior_direct2' => 1,
			'sub_junior_direct3' => 1,
			'sub_junior_direct4' => 1,
			'sub_junior_direct5' => 1,
			'sub_junior_direct6' => 1,
			'gain'=>'1',
			'tree_level'=>'19',
			'referral_level'=>'3',

		]);

		 	 \App\Ranksetting::create([
			'rank_name' 	     => "H",
			'rank_code' 	     => "H",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "na",
			'direct' => 6,
			'sub_direct1' => 6,
			'sub_direct2' => 6,
			'sub_direct3' => 6,
			'sub_direct4' => 6,
			'sub_direct5' => 6,
			'sub_direct6' => 6,
			'sub_junior_direct1' => 3,
			'sub_junior_direct2' => 3,
			'sub_junior_direct3' => 3,
			'sub_junior_direct4' => 3,
			'sub_junior_direct5' => 3,
			'sub_junior_direct6' => 3,
			'gain'=>'1',
			'tree_level'=>'20',
			'referral_level'=>'3',

		]);
      
    }
}
