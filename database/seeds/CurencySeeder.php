<?php

use Illuminate\Database\Seeder;

class CurencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Currency::create([
            'name'=>'US Dollar',
            'code'=>'USD',
            'symbol'=>'$',
            'format'=>'1,0.00 F.CFA',
            'exchange_rate'=>'1.0',
            'active'=>'1'
            ]);   

        App\Currency::create([
            'name'=>'Euro',
            'code'=>'EUR',
            'symbol'=>'€',
            'format'=>'1,0.00 F.CFA',
            'exchange_rate'=>'0.8397749919',
            'active'=>'1'
            ]);        

        App\Currency::create([
            'name'=>'British Pound',
            'code'=>'GBP',
            'symbol'=>'£',
            'format'=>'1,0.00 F.CFA',
            'exchange_rate'=>'0.7694659090  ',
            'active'=>'1'
            ]);

        
        App\Currency::create([
            'name'=>'Indian Rupee',
            'code'=>'INR',
            'symbol'=>'₹',
            'format'=>'1,0.00 F.CFA',
            'exchange_rate'=>'64.1340410473 ',
            'active'=>'1'
            ]);

        
        App\Currency::create([
            'name'=>'Australian Dollar',
            'code'=>'AUD',
            'symbol'=>'A$',
            'format'=>'1,0.00 F.CFA',
            'exchange_rate'=>'1.2463121412  ',
            'active'=>'1'
            ]);

        
        App\Currency::create([
            'name'=>'Canadian Dollar',
            'code'=>'CAD',
            'symbol'=>'C$',
            'format'=>'1,0.00 F.CFA',
            'exchange_rate'=>'1.2361081300',
            'active'=>'1'
            ]);

        
        App\Currency::create([
            'name'=>'Singapore Dollar',
            'code'=>'SGD',
            'symbol'=>'S$',
            'format'=>'1,0.00 F.CFA',
            'exchange_rate'=>'1.3526211686',
            'active'=>'1'
            ]);

        App\Currency::create([
            'name'=>'Malaysian Ringgit',
            'code'=>'MYR',
            'symbol'=>'RM',
            'format'=>'1,0.00 F.CFA',
            'exchange_rate'=>'4.2617085601',
            'active'=>'1'
            ]);

        App\Currency::create([
            'name'=>'Japanese Yen',
            'code'=>'JPY',
            'symbol'=>'¥',
            'format'=>'1,0.00 F.CFA',
            'exchange_rate'=>'109.1473166611',
            'active'=>'1'
            ]);


        App\Currency::create([
            'name'=>'Chinese Yuan Renminbi',
            'code'=>'CNY',
            'symbol'=>'¥',
            'format'=>'1,0.00 F.CFA',
            'exchange_rate'=>'6.5427432429',
            'active'=>'1'
            ]);


        App\Currency::create([
            'name'=>'New Zealand Dollar',
            'code'=>'NZD',
            'symbol'=>'$',
            'format'=>'1,0.00 F.CFA',
            'exchange_rate'=>'1.3804191338',
            'active'=>'1'
            ]);


        App\Currency::create([
            'name'=>'Indonesian Rupiah',
            'code'=>'IDR',
            'symbol'=>'Rp',
            'format'=>'1,0.00 F.CFA',
            'exchange_rate'=>'13331.0638210560',
            'active'=>'1'
            ]);


        App\Currency::create([
            'name'=>'Saudi Arabian Riyal',
            'code'=>'SAR',
            'symbol'=>'﷼',
            'format'=>'1,0.00 F.CFA',
            'exchange_rate'=>'3.7513558992  ',
            'active'=>'1'
            ]);


        App\Currency::create([
            'name'=>'Brazilian Real',
            'code'=>'BRL',
            'symbol'=>'R$',
            'format'=>'1,0.00 F.CFA',
            'exchange_rate'=>'3.1184158028',
            'active'=>'1'
            ]);


        App\Currency::create([
        	'name'=>'South African Rand',
        	'code'=>'ZAR',
        	'symbol'=>'R',
        	'format'=>'1,0.00 F.CFA',
            'exchange_rate'=>'12.8703691948 ',
        	'active'=>'1'
        	]);


    }
}
