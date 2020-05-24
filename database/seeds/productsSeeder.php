<?php

use Illuminate\Database\Seeder;

class productsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         

         App\Products::create([
         	'product'=>'Body revival cream ',
         	'size'=>'100 ml',
         	'member_amount'=>'380',
         	'nonmember_amount'=>'420',
         	'pv'=>'160',
         	
         	]);

         App\Products::create([
         	'product'=>'Body balancing cream ',
         	'size'=>'100 ml',
         	'member_amount'=>'380',
         	'nonmember_amount'=>'420',
         	'pv'=>'160',
         	
         	]);

          App\Products::create([
         	'product'=>'plant  placenta fluid ',
         	'size'=>'60 ml',
         	'member_amount'=>'380',
         	'nonmember_amount'=>'420',
         	'pv'=>'160',
         	
         	]);
		 
		  App\Products::create([
         	'product'=>'plant  placenta cream ',
         	'size'=>'60 ml',
         	'member_amount'=>'380',
         	'nonmember_amount'=>'420',
         	'pv'=>'160',
         	
         	]);



		  App\Products::create([
         	'product'=>'Golden recipe ',
         	'size'=>'30 sc',
         	'member_amount'=>'380',
         	'nonmember_amount'=>'420',
         	'pv'=>'160',
         	
         	]);

		  App\Products::create([
         	'product'=>'Nature glow juice ',
         	'size'=>'30 sc',
         	'member_amount'=>'380',
         	'nonmember_amount'=>'420',
         	'pv'=>'160',
         	
         	]);

		  App\Products::create([
         	'product'=>'Inner young ',
         	'size'=>'30 sc',
         	'member_amount'=>'380',
         	'nonmember_amount'=>'420',
         	'pv'=>'160',
         	
         	]);





    }
}
