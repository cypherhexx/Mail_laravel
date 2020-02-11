<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use \App\Mail\SendEmailMailable;

use Mail as Message;
use App\User;

class SendAllEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

       public $firstname; 
       public $lastname; 
       public $username; 
       public $password; 
       public $email;
     

       public $tries = 1;
       public $timeout = 900;

     public function __construct($firstname,$lastname,$username,$password,$email)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
       


    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       try {
            $emailclass = new SendEmailMailable($this->firstname,$this->lastname,$this->username,$this->password,$this->email);  
            Message::to($this->email,$this->username)->send($emailclass); 
           
       }
       // exit();
    catch (\Exception $e) {
   // Log error
   // Flag email for retry
      // continue;
      }
    }
}
