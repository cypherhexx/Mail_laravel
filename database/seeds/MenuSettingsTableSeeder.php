<?php

use Illuminate\Database\Seeder;

class MenuSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\MenuSettings::create([

       'menu_name'=>'Register new'

      	]);

      App\MenuSettings::create([

       'menu_name'=>'Login'

        ]);

       App\MenuSettings::create([

       'menu_name'=>'Site Management'

        ]);
    }
}
