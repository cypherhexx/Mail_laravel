<?php

use Illuminate\Database\Seeder;

class ProfileInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       App\ProfileInfo::create([

        'user_id'=>1,
       	'profile'=>'avatar-m-38.jpg',
       	'passport' => '661430744',
        'mobile'   => '+1-7865674834',
        'gender'   => 'male',
        'country'  => 'US',
        'state'    => 'NY',
        'city'     => 'Ney York',
        'address1' => 'Room No.2 Fifth floor, TurningPoint Aartment, New York',
        'address2' => 'Room No.45 23th floor, NewEvelyn, New York',
        'zip'      => '452233',
        'location' => '',
       	]);
    }
}
