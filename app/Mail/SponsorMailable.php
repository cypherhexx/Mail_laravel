<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Emails ;
use App\AppSettings;
use App\welcomeemail;

class SponsorMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void

     */
       public $username; 
        public $email;
       public $firstname; 
       public $lastname; 
  
     
      
    public function __construct($username,$email,$firstname,$lastname)
    {
         $this->username = $username;
           $this->email = $email;
         $this->firstname = $firstname;
         $this->lastname = $lastname;
        
       
         
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $email = Emails::find(1); 
       $app_settings = AppSettings::find(1);
             
       $return = $this->view('emails.sponsoremail')
                    ->subject('new user')
                    ->from($email->from_email, $email->from_name)
                    ->with([
                            'email'         => $email,
		                    'company_name'   => $app_settings->company_name,
		                    'firstname'      => $this->firstname,
		                    'name'           => $this->lastname,
		                    'newuser' =>  $this->username,
		                   
		                    
                            ]);
        return $return ;
    }
}
