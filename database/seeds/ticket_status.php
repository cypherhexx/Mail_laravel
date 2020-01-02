<?php

use Illuminate\Database\Seeder;
use App\Models\Helpdesk\Ticket\TicketStatus;
class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketStatus::create(['name' => 'Open', 'state' => 'open', 'mode' => '3', 'message' => 'Ticket have been Reopened by', 'flags' => '0', 'sort' => '1', 'properties' => 'Open tickets.']);

        TicketStatus::create(['name' => 'Resolved', 'state' => 'closed', 'mode' => '1', 'message' => 'Ticket have been Resolved by', 'flags' => '0', 'sort' => '2', 'properties' => 'Resolved tickets.']);
        TicketStatus::create(['name' => 'Closed', 'state' => 'closed', 'mode' => '3', 'message' => 'Ticket have been Closed by', 'flags' => '0', 'sort' => '3', 'properties' => 'Closed tickets. Tickets will still be accessible on client and staff panels.']);
        TicketStatus::create(['name' => 'Archived', 'state' => 'archived', 'mode' => '3', 'message' => 'Ticket have been Archived by', 'flags' => '0', 'sort' => '4', 'properties' => 'Tickets only adminstratively available but no longer accessible on ticket queues and client panel.']);
        TicketStatus::create(['name' => 'Deleted', 'state' => 'deleted', 'mode' => '3', 'message' => 'Ticket have been Deleted by', 'flags' => '0', 'sort' => '5', 'properties' => 'Tickets queued for deletion. Not accessible on ticket queues.']);
        TicketStatus::create(['name' => 'Unverified', 'state' => 'unverified', 'mode' => '3', 'message' => 'User account verification required.', 'flags' => '0', 'sort' => '6', 'properties' => 'Ticket will be open after user verifies his/her account.']);
        TicketStatus::create(['name' => 'Request Approval', 'state' => 'unverified', 'mode' => '3', 'message' => 'Approval requested by', 'flags' => '0', 'sort' => '7', 'properties' => 'Ticket will be approve  after Admin verifies  this ticket']);

    }
}


 /* Ticket status */
        
        