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
			'rank_name' 	     => "Distributor",
			'rank_code' 	     => "DC",
			'top_up'   => 0,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "NA",
		]);
        \App\Ranksetting::create([
			'rank_name' 	     => " Team Coordinator",
			'rank_code' 	     => "TC",
			'top_up'   => 10,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "iPhone 6S 16GB",
		]);
		 \App\Ranksetting::create([
			'rank_name' 	     => "Executive Team Coordinator",
			'rank_code' 	     => "ETC",
			'top_up'   => 60,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "Trip to France for 2",
		]); 
		 \App\Ranksetting::create([
			'rank_name' 	     => "Director",
			'rank_code' 	     => "DIR",
			'top_up'   => 160,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "Trip to Maldives for 2",
		]);
		 \App\Ranksetting::create([
			'rank_name' 	     => "National Director",
			'rank_code' 	     => "ND",
			'top_up'   => 660,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "Rolex watch worth 10k",
		]);
		 \App\Ranksetting::create([
			'rank_name' 	     => "Global Director",
			'rank_code' 	     => "GD",
			'top_up'   => 1660,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "Mercedes C180",
		]);
		 \App\Ranksetting::create([
			'rank_name' 	     => "Vice President",
			'rank_code' 	     => "VPR",
			'top_up'   => 3660,
			'quali_rank_id'   => 0,
			'quali_rank_count'   =>0,
			'rank_bonus'   => "Petrol Fee $300 per month",
		]); 
		 \App\Ranksetting::create([
			'rank_name' 	     => "President",
			'rank_code' 	     => "PR",
			'top_up'   => 8660,
			'quali_rank_id'   => 0,
			'quali_rank_count'   => 0,
			'rank_bonus'   => "House fee for $1500 per mth",
		]);
		 \App\Ranksetting::create([
			'rank_name' 	     => "Crown 1",
			'rank_code' 	     => "CR1",
			'top_up'   => 0,
			'quali_rank_id'   => 7,
			'quali_rank_count'   => 3,
			'rank_bonus'   => "Global revenue share 1 %",
		]);
		 \App\Ranksetting::create([
			'rank_name' 	     => "Crown 2 ",
			'rank_code' 	     => "CR2 ",
			'top_up'   => 0,
			'quali_rank_id'   => 8,
			'quali_rank_count'   => 3,
			'rank_bonus'   => "Global revenue share 2 %",
		]);

    }
}
