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

                $schedule->command('backup:run',['--only-db'=>'true'])
                ->everyFiveMinutes();
                 $schedule->command('check:purchase')
                ->daily();
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
