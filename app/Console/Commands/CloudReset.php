<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Artisan;

class CloudReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cloud:reset 
    {--prompt=false : Whether you need to reset and upgrade full without prompts set true or false} 
    {--userslimit=10 : The limit of dummy users to be registered,default is 10 } 
    {--ticketslimit=10 : The limit of dummy tickets to be created,default is 10 } 
    {--silent=false : Set to true if you want to silent the informations while running  } 
    {--maintenance=true : Should the application go maintenance mode during the upgrade? default is true, you can set it to false if you want. }';

    

    //https://demo.cloudmlmsoftware.com/factory/dummynetwork
    //https://demo.cloudmlmsoftware.com/factory/dummytickets

    //$this->line("Some text");
    //$this->info("Hey, watch this !");
    //$this->comment("Just a comment passing by");
    //$this->question("Why did you do that?");
    //$this->error("Ops, that should not happen.");



    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "\n".'You can run this to completely reset the database and to generate bulk content in the Cloud MLM Software. This console is developed by aslam@bpract.com'."\n".'Full Example : php artisan cloud:reset --prompt=false --userslimit=10 --ticketslimit=10 --silent=false --maintenance=true'."\n";

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

        



        $prompt = $this->option('prompt');
        $userslimit = $this->option('userslimit');
        $ticketslimit = $this->option('ticketslimit');
        $maintenance = $this->option('maintenance');
        $silent = $this->option('silent');

        SELF::optimize($silent);


        if($maintenance == "true"){
            // $this->call('down');
            $this->info('' . "\n");
        }

        if($prompt == "true"){
            $this->info("You choose to destoy and rebuild the Cloud MLM Software from bpract.". "\n");            
            if ($this->confirm('Do you really want to do this? [y|N]')) {
            


            


                SELF::migrate($silent);
                SELF::seed($silent);                 
                 if ($this->confirm('Do you want to generate bulk users? [y|N]')) {                
                    SELF::dummynetwork($silent,$userslimit);                       
                     if ($this->confirm('Do you want to generate bulk tickets? [y|N]')) {
                      SELF::dummytickets($silent,$ticketslimit);                   
                     }else{
                        $this->info("Tickets not generated". "\n");
                     }
                 }else{
                      $this->info("Network not generated". "\n");
                 }
              
            }else{
                $this->info("Okay, Lets not do it then!". "\n");
            }
        }
        else if($prompt == "false"){
            
            SELF::migrate($silent);
            SELF::seed($silent);
            SELF::dummynetwork($silent,$userslimit); 
            SELF::dummytickets($silent,$ticketslimit);
            
        }

        //Do it for interrupted connections
        //if($maintenance == "true"){
            $this->call('up');
            $this->info('' . "\n"); 
        //}

    }

    public function duration($start,$title){                
        $time = round((microtime(true) - $start) * 1000, 3);
        //$this->info('' . "\n");
        $this->info($title.' took '.$time.' micro seconds to execute' . "\n");
    }


    public function optimize($silent){

          //$start = microtime(true);
            //$this->call('optimize', [
                 
              //]);             
          //SELF::duration($start,'Class Optimization');


          $start = microtime(true);
            $this->call('cache:clear', [
                 
              ]);
          SELF::duration($start,'Application Cache clearing');


          $start = microtime(true);
            $this->call('view:clear', [
                
              ]);
          SELF::duration($start,'Views Cache clearing');


          $start = microtime(true);
            $this->call('config:clear', [
                 
              ]);

          SELF::duration($start,'Config Cache clearing');

          $start = microtime(true);
            $this->call('config:cache', [
                 
              ]);
          SELF::duration($start,'Caching config for better performance');



        if($silent == "false"){
          $this->info("Optimization complete..." . "\n");
        }
    }   



    public function migrate($silent){
         $start = microtime(true);
         $this->call('migrate:refresh',['--path' => ['/database/migrations','/database/migrations/email-marketing','/database/migrations/helpdesk/kb','/database/migrations/helpdesk/tickets','/database/migrations/translations']], [
                '--force' => true,
            ]);
            if($silent == "false"){
                $this->info("Migration complete..." . "\n");
            }
          SELF::duration($start,'Migration');

    }   
    

    public function seed($silent){
            $start = microtime(true);
            $this->call('db:seed', [
                '--force' => true,
            ]);  
            if($silent == "false"){
                $this->info("Seeding complete..." . "\n");     
            }
            SELF::duration($start,'Seeding');
    }  

    public function dummynetwork($silent,$userslimit){
            $start = microtime(true);
            $controller = app()->make('App\Http\Controllers\Factory\DemoUtils\DemoUtilsController');
            app()->call([$controller, 'dummynetwork'], [$userslimit]);   
            if($silent == "false"){
              $this->info("  Dummy network creation complete..." . "\n"); 
            }
            SELF::duration($start,'Dummy network creation');

    } 

    public function dummytickets($silent,$ticketslimit){
            $start = microtime(true);
            $controller = app()->make('App\Http\Controllers\Factory\DemoUtils\DemoUtilsController');
            app()->call([$controller, 'dummytickets'], [$ticketslimit]);   
            if($silent == "false"){
                $this->info("  Dummy ticket creation complete..." . "\n");  
            }
            SELF::duration($start,'Dummy ticket creation');

    }
}
