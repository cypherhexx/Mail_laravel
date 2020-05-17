<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Artisan;

class CloudDummyNetwork extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cloud:dummytickets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->info("You choose to generate dummy tickets.");            
        if ($this->confirm('Do you really want to continue? [y|N]')) {
            

           auth()->loginUsingId(1);
           $request = Request::create('factory/dummytickets', 'GET');
           $this->info(app()->make(\Illuminate\Contracts\Http\Kernel::class)->handle($request));


           $this->info("Created dummy tickets...");           

        }else{
            $this->info("Okay, Lets not do it then!");
        }


        
    }
}
