<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;
use Storage;
use Log;
use DB;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Database:backup';

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
           
             $file_name='dbtody'.self::RandomString();
             Storage::disk('local')->put($file_name, json_encode($file_name));
            // start the backup process
            Artisan::call('backup:run',['--only-db' => 'true']);
            $output = Artisan::output();
            //dd($output);
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            // return the results as a response to the ajax call
           
    }
     public function RandomString()
    {
       $characters = "abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";       
       $charactersLength = strlen($characters);
       $randstring = '';
       for ($i = 0; $i < 5; $i++) {
           $randstring .= $characters[rand(0, $charactersLength - 1)];
       }       
       return $randstring;
    }
}
