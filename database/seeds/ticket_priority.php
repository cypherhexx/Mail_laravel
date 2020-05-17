<?php

use Illuminate\Database\Seeder;
use App\Models\Helpdesk\Ticket\TicketPriority;

class TicketPrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
               /* Ticket priority */
        TicketPriority::create(['priority' => 'Low', 'status' => 1, 'priority_desc' => 'Low', 'priority_color' => '#00a65a', 'priority_urgency' => '4', 'ispublic' => '1']);
        TicketPriority::create(['priority' => 'Normal', 'status' => 1, 'priority_desc' => 'Normal', 'priority_color' => '#00bfef', 'priority_urgency' => '3', 'ispublic' => '1', 'is_default' => '1']);
        TicketPriority::create(['priority' => 'High', 'status' => 1, 'priority_desc' => 'High', 'priority_color' => '#f39c11', 'priority_urgency' => '2', 'ispublic' => '1']);
        TicketPriority::create(['priority' => 'Emergency', 'status' => 1, 'priority_desc' => 'Emergency', 'priority_color' => '#dd4b38', 'priority_urgency' => '1', 'ispublic' => '1']); 
    }
}
