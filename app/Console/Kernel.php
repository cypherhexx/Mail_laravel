<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\CloudReset',
        'App\Console\Commands\BackupUnilevel',
        'App\Console\Commands\PurchaseActiveCheck',
        'App\Console\Commands\CommissionPaypal',
         'App\Console\Commands\DatabaseBackup',

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
      
         // $schedule->command(Artisan::call('backup:run',['--only-db'=>'true']))
         //        ->everyMinute();

                // $schedule->command('backup:run',['--only-db'=>'true'])
                // ->everyFiveMinutes();
                 $schedule->command('check:purchase')
                ->daily();
                 $schedule->command('commission:paypal')
                ->daily();
                $schedule->command('Database:backup')->daily();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }

  
}
