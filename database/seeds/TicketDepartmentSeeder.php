<?php

use Illuminate\Database\Seeder;
use App\Models\Helpdesk\Ticket\TicketDepartment;

class TicketDepartmentSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketDepartment::create(['name' => 'FINANCE', 'description' => 'Dealing with payout	']);
        TicketDepartment::create(['name' => 'Marketing', 'description' => 'Marketing  section	']);
        TicketDepartment::create(['name' => 'TECHNICAL', 'description' => 'TECHNICAL']);
    }
}
