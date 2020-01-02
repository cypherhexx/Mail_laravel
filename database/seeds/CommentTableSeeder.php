<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\CommentTable::create([

            'ticket_no'      =>1,

			'comment' 	     =>1,

			'role'			 =>1
			
		]);
    }
}
