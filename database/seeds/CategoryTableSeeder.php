<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\Category::create([
            'category_name'          => "Trader",
            'count'                  => 0,
            'percentage'             => 0,
            
        ]);
        \App\Category::create([
            'category_name'          => "Star",
            'count'                  => 5,
            'percentage'             => 1,
            
        ]);
         \App\Category::create([
            'category_name'          => "Superstar",
            'count'                  => 10,
            'percentage'             => 2,
            
        ]);
    }
}
