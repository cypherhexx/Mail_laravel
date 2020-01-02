<?php

use Illuminate\Database\Seeder;

class ticket_tags extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\TicketTags::create([
            'tags'        => '1',
           
         
        ]); 

    }
}
