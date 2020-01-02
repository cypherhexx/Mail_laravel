<?php

use Illuminate\Database\Seeder;
use App\Models\Helpdesk\Ticket\TicketCategory;

class ticket_category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         TicketCategory::create(['category' => 'Bug', 'description' => 'Bug',]);
         TicketCategory::create(['category' => 'Feature Request', 'description' => 'Feature Request',]);
         TicketCategory::create(['category' => 'Sales Question', 'description' => 'Sales Question',]);
         TicketCategory::create(['category' => 'Cancellation', 'description' => 'Cancellation',]);
         TicketCategory::create(['category' => 'Technical Issue', 'description' => 'Technical Issue',]);
        }
}
