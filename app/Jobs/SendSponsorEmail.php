<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use \App\Mail\SponsorMailable;

use Mail as Message;
use App\User;

class SendSponsorEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
     public $username; 
       public $email;
       public $firstname; 
       public $lastname; 
      
     

       public $tries = 1;
       public $timeout = 900;

    public function __construct($username,$email,$firstname,$lastname)
    {
        $this->username = $username;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       try {
            $emailclass = new SponsorMailable($this->username,$this->email,$this->firstname,$this->lastname);  
            Message::to($this->email,$this->firstname)->send($emailclass); 
           
       
    } catch (\Exception $e) {
   // Log error
   // Flag email for retry
      // continue;
      }
    }
}
