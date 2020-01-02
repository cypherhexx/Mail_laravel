<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Model::unguard();
          // Add calls to Seeders here
      

        $this->call('UsersTableSeeder');
        $this->call('settingsTableSeeder');
        $this->call('TreeTableSeeder');
        $this->call('PointTableSeeder');
        $this->call('userbalanceSeeder');
        $this->call('RanksettingSeeder');
        $this->call('sponsortreeSeeder');
        // $this->call('CountriesSeeder');
        // $this->command->info('Seeded the countries!'); 
        
        
        $this->call('PackageSeeder');
        
        $this->call('LoyaltyBonusSeeder');
        $this->call('LeadershipSeeder');
        $this->call('MatchingbonusSeeder');

        
        $this->call('productsSeeder');
        $this->call('AppSeeder');
        $this->call('CurencySeeder');
        $this->call('EmailsSeeder');
        $this->call('EmailSettingSeeder');
         $this->call('welcomeemailSeeder');
       $this->call('TempDetailsSeeder');
       $this->call('PaymenttypeSeeder');
       $this->call('PaymentNotificationTableSeeder');
       $this->call('MenuSettingsTableSeeder');
       $this->call('ProfileInfoSeeder');
       $this->call('TicketStatusSeeder');
       $this->call('TicketPrioritySeeder');
       $this->call('ticket_category');
       $this->call('TicketDepartmentSeeder');
       $this->call('RolesTableSeeder');
       // $this->call('TicketFaqSeeder');
       // $this->call('ticket_category');
       // $this->call('ticket_priority');
       // $this->call('ticket_status');
       // $this->call('ticket_tags');
       


      
      

        Model::reguard();
    
    }
}
