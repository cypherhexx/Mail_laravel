<?php

use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         App\AppSettings::create([ 
           'company_name' => 'Solidus Gold',
           'company_address' => 'Mumbai',
           'email_address' => 'info@solidus.cc',
           'logo' => 'cloud-pic-febda.png ',
           'logo_ico' => 'cloud-pic-febda.png ',
           'theme' => 'default',
           'currency' => '$',
           'site_mode' => 'yes',
          ]);
    }
}
