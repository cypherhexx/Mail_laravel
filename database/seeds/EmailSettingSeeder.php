<?php

use Illuminate\Database\Seeder;

class EmailSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_setting')->insert([
        	 
        	  'username' => 'tryu', 
        	  'password' => 'tryp', 
        	  'incoming_server' => 'tryis', 
        	  'incoming_port' => 'tryip', 
        	  'outgoing_server' => 'tryos', 
        	  'outgoing_port' => 'tryop', 

        	   ]);

       


    }
}
