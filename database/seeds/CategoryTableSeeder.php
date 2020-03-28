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
            'category_name'          => "Trader 0%",
            'count'                  => 0,
            'percentage'             => 0,
            'image'                  =>'61449130148.jpg',
            
        ]);
        \App\Category::create([
            'category_name'          => "Star 1%",
            'count'                  => 5,
            'percentage'             => 1,
             'image'                  =>'97474272665.png',
            
        ]);
         \App\Category::create([
            'category_name'          => "Superstar 2%",
            'count'                  => 10,
            'percentage'             => 2,
             'image'                  =>'65492280238.png',
            
        ]);
    }
}
