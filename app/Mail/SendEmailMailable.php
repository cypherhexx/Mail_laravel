<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Emails ;
use App\AppSettings;
use App\welcomeemail;

class SendEmailMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void

     */
       public $firstname; 
       public $lastname; 
       public $username; 
       public $password; 
        public $email;
     
      
    public function __construct($firstname,$lastname,$username,$password,$email)
    {
         $this->firstname = $firstname;
         $this->lastname = $lastname;
         $this->username = $username;
         $this->password = $password;
           $this->email = $email;
       
         
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
        $welcome=welcomeemail::find(1);       
       $return = $this->view('emails.register')
                    ->subject('registration')
                    ->from($email->from_email, $email->from_name)
                    ->with([
                            'email'         => $email,
		                    'company_name'   => $app_settings->company_name,
		                    'firstname'      => $this->firstname,
		                    'name'           => $this->lastname,
		                    'login_username' =>  $this->username,
		                    'password'       => $this->password,
		                    'welcome'        =>$welcome,
                            ]);
        return $return ;
    }
}
