<?php
namespace App\Http\Controllers\Factory\DemoUtils;

use App\AppSettings;
use App\Balance;
use App\Commission;
use App\Country;
use App\Emails;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\LeadershipBonus;
use App\MenuSettings;
use App\Packages;
use App\Transactions;
use App\PaymentType;
use App\PointTable;
use App\ProfileInfo;
use App\PurchaseHistory;
use App\Settings;
use App\Sponsortree;
use App\TempDetails;
use App\Tree_Table;
use App\RsHistory;
use App\ProfileModel;
use App\User;
use App\Voucher;
use Auth;
use CountryState;
use Crypt;
use DB;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Mail;
use Redirect;
use Session;
use Validator;
use App\Activity;
use App\Models\Helpdesk\Ticket\Ticket;
use Carbon;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;


class DemoUtilsController extends AdminController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller - Admin
    |--------------------------------------------------------------------------
    |
    | This controller handles registering users for the application and
    | redirecting them to preview screen.
    |
     */

    /**
     * Manage Utilities
     *
     */

    

    /**
     * BULK REGISTER BY ASLAM
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function dummynetwork($userslimit)
    {
        // dd($userslimit);
        ini_set('max_execution_time', 5000); 

        /**
         * [$data array to hold specified incming request values]
         * @var array
         */
        $faker = Faker::create();
        $countries_list = CountryState::getCountries();
        //dd($countries_list);
    
        
        if( isset($userslimit)){
            $limit = $userslimit;
        }
        else{
            $limit = 13;
        }

        $output = new ConsoleOutput();
        $progress = new ProgressBar($output, $limit);
        $progress->start(); 

        for ($i = 0; $i < $limit; $i++) {

            $reg_type  = null;
            $sponsor   = User::inRandomOrder()->get()->first()->username;
            $firstname = $faker->firstname;
            $lastname  = $faker->lastname;
            $username  = SELF::cleanusername(trim(strtolower($lastname . $firstname)));
            $password  = '111111';
            $phone     = $faker->phoneNumber;
            $email     = $username . "@cloudmlmdemo.com";

            $positions = ['L', 'R', 'L', 'R', 'L', 'R', 'R', 'R', 'L', 'L', 'R'];
            $position  = $positions[array_rand($positions)];

            $packages = ['1', '2', '3', '1', '2', '3', '1', '2', '3', '1', '2', '3'];
            $package  = $packages[array_rand($packages)];

            $payments = ['Cheque', 'Ewallet', 'Paypal', 'Voucher'];
            $payment  = $payments[array_rand($payments)]; 

            CHOOSECOUNTRY:
          
            $country = array_rand($countries_list);           
            $states  = CountryState::getStates($country);
            if(count($states)){
                $state = $states[array_rand($states)];
            }else{
                goto CHOOSECOUNTRY;
            }
            sleep(1);


            $genders = ['m', 'f'];
            $gender  = $genders[array_rand($genders)];

            if($gender == 'm'){
                $profile = 'avatar-m-'.str_pad($faker->numberBetween($min = 1, $max = 52),2,"0",STR_PAD_LEFT).'.jpg';
            }else{
                $profile = 'avatar-f-'.str_pad($faker->numberBetween($min = 1, $max = 69),2,"0",STR_PAD_LEFT).'.jpg';
            }


            $zip     = $faker->randomNumber($nbDigits = 6, $strict = true);
            $address = $faker->address;
            $city    = $faker->city;

            $created_atX = $faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = null);
            // $created_atX = $faker->dateTimeThisYear($max = 'now');
         
            $created_at = $created_atX->format('Y-m-d H:i:s');

            $data                     = array();
            $data['reg_by']           = $payment;
            $data['firstname']        = $firstname;
            $data['lastname']         = $lastname;
            $data['phone']            = $phone;
            $data['email']            = $email;
            $data['reg_type']         = null;
            $data['cpf']              = null;
            $data['passport']         = null;
            $data['username']         = $username;
            $data['gender']           = $gender;
            $data['profile']           = $profile;
            $data['country']          = $country;
            $data['state']            = $state;
            $data['city']             = $city;
            $data['address']          = $address;
            $data['zip']              = $zip;
            $data['location']         = null;
            $data['password']         = $password;
            $data['transaction_pass'] = self::RandomString();
            $data['sponsor']          = $sponsor;
            $data['package']          = $package;
            $data['leg']              = $position;
            /**
             * if placement user passed from form
             * (Which will be set as hidden input if placement_id specified and if it has vacant positions ),
             * it will set as placement_user, else the placement will be under sponsor
             *
             */

            $data['placement_user'] = $sponsor;

            /**
             * Validation custom messages
             * @var [array]
             */
            $messages = [
                'unique' => 'The :attribute already existis in the system',
                'exists' => 'The :attribute not found in the system',

            ];
            /**
             * Validating the incoming data we stored the $data variable
             * @var [boolean]
             */
            $validator = Validator::make($data, [
                'sponsor'          => 'required|exists:users,username|max:255',
                'placement_user'   => 'sometimes|exists:users,username|max:255',
                'email'            => 'required|unique:users,email|email|max:255',
                'username'         => 'required|unique:users,username|alpha_num|max:255',
                'password'         => 'required|alpha_num|min:6',
                'transaction_pass' => 'required|alpha_num|min:6',
                'package'          => 'required|exists:packages,id',
                'leg'              => 'required',
                'country'          => 'required|country',
            ]);
            /**
             * On fail, redirect back with error messages
             */
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {

                /**
                 * Checking if sponsor_id exist in users table
                 * @var [boolean]
                 */
                $sponsor_id = User::checkUserAvailable($data['sponsor']);
                /**
                 * Checking if placement_user exist in users table
                 * @var [type]
                 */
                $placement_id = User::checkUserAvailable($data['placement_user']);
                if (!$sponsor_id) {
                    /**
                     * If sponsor_id validates as false, redirect back without registering , with errors
                     */
                    return redirect()->back()->withErrors(['The username not exist'])->withInput();
                }
                if (!$placement_id) {
                    /**
                     * If placement_id validates as false, redirect back without registering , with errors
                     */
                    return redirect()->back()->withErrors(['The username not exist'])->withInput();
                }
                /**
                 * Using beginTransaction for rollbacks on registration errors
                 */

                $userresult = SELF::complete_dummy_register($data,$sponsor_id,$placement_id,$created_at);


                $placement_username = User::where('id','=',$placement_id)->get()->first()->username;
                $userPackage = Packages::where('id','=', $package )->get()->first()->package;


                Activity::add("Added user $userresult->username","Added $userresult->username sponsor as $sponsor and placement user as $placement_username in {$data['leg']} Leg");

                Activity::add("Joined as $userresult->username","Joined in system as $userresult->username sponsor as $sponsor and placement user as $placement_username in {$data['leg']} Leg",$userresult->id);

                Activity::add("Package purchased","Purchased package - $userPackage ",$userresult->id);
                
                // echo '_'.$i;
                
            }
            $progress->advance();
        }


        $progress->finish();


        //echo 'Done generating bulk network users';
    }




    public static function complete_dummy_register($data,$sponsor_id,$placement_id,$created_at){

            DB::beginTransaction();

            try {



            /**
             * Creates a user with provided data and stores it for temperory usage
             * @var [type]
             */            
            $userresult = User::create([
                'name'             => $data['firstname'],
                'lastname'         => $data['lastname'],
                'email'            => $data['email'],
                'username'         => $data['username'],
                'rank_id'          => '1',
                'register_by'      => $data['reg_by'],
                'cpf'              => $data['cpf'],
                'transaction_pass' => $data['transaction_pass'],
                'password'         => bcrypt($data['password']),
                'created_at'       =>$created_at
            ]);


            /**
             * Creates Profile info for the created User
             * @var [type]
             */
            $userProfile = ProfileModel::create([
                'user_id'  => $userresult->id,
                'passport' => $data['passport'],
                'mobile'   => $data['phone'],
                'gender'   => $data['gender'],
                'profile'   => $data['profile'],
                'country'  => $data['country'],
                'state'    => $data['state'],
                'city'     => $data['city'],
                'address1' => $data['address'],
                'zip'      => $data['zip'],
                'location' => $data['location'],
                'package'  => $data['package'],
                'created_at' =>$created_at
            ]);


            /**
             * Create purchase history for the user, as it is passed from form
             * Checks against the packages here for the amount and volumes
             * @var [collection]
             */


            $userPackage = Packages::find($data['package']);


            PurchaseHistory::create([
                'user_id'          => $userresult->id,
                'purchase_user_id' => isset(Auth::user()->id)?Auth::user()->id:$userresult->id,
                'package_id'       => $data['package'],
                'pv'               => $userPackage->pv,
                'count'            => 1,
                'total_amount'     => $userPackage->amount,
                'pay_by'           => 0,
                'sales_status'     => 0,       
                'created_at'       =>$created_at,         
                'updated_at'       =>$created_at         
            ]);

             /**
             * Get sponsor tree id where there is a vacant under specified sponsor
             * @var [string]
             */
            $sponsortreeid = Sponsortree::where('sponsor', $sponsor_id)->where('type', 'vaccant')->orderBy('id', 'desc')->take(1)->value('id');
            /**
             * Updates sponsor record linked the sponsor and user
             * @var [Function]
             */
         
            $sponsortree          = Sponsortree::find($sponsortreeid);
            $sponsortree->user_id = $userresult->id;
            $sponsortree->sponsor = $sponsor_id;
            $sponsortree->type    = "yes";
            $sponsortree->save();
            /**
             * Creates vacant for sponsor
             * @var [collection]
             */
            $sponsorvaccant = Sponsortree::createVaccant($sponsor_id, $sponsortree->position);
            /**
             * Creates vacants for user
             * @var [collection]
             */
            $uservaccant = Sponsortree::createVaccant($userresult->id, 0);


            /**
             * returns placement id, to where user to be added,
             * if placement id didnt do well, returns sponsor id and will be placed under sponsor
             * @var [userid]
             */
            $placement_id = Tree_Table::getPlacementId($placement_id, $data['leg']);
            /**
             * Finds the Vaccant Id adn set as tree id
             * @var [type]
             */
            $tree_id = Tree_Table::vaccantId($placement_id, $data['leg']);
            /**
             * updates the tree table with user id and sponsor, with type yes.
             * @var [function]
             */
            $tree          = Tree_Table::find($tree_id);
            $tree->user_id = $userresult->id;
            $tree->sponsor = $sponsor_id;
            $tree->type    = 'yes';
            $tree->save();

             /**
             * All application specific settings, like commission and packages settings
             * @var [collection]
             */
              /**
             * Here goes all the commissions calculations on the successful registration
             */

            Tree_Table::getAllUpline($userresult->id);
            PointTable::updatePoint($userPackage->pv, $userresult->id);
            Transactions::sponsorcommission($sponsor_id,$userresult->id);
            // $sponsor_id
            LeadershipBonus::allocateCommission($sponsor_id,Sponsortree::where('user_id',$sponsor_id)->value('sponsor'),$userPackage->pv / 10);
            RsHistory::create([
                    'user_id'=>$userresult->id,                   
                    'from_id'=>$userresult->id,
                    'rs_credit'=>$userPackage->rs,
            ]);

            PointTable::addPointTable($userresult->id);
            Tree_Table::createVaccant($tree->user_id);
            /**
             * adding user to balance table
             */
            $balanceupdate = User::insertToBalance($userresult->id);

            DB::commit();

            return $userresult ;

              
            } catch (Exception $e) {

              DB::rollback();

              return false;
              
            }
           


    }

    
    public static function cleanusername($username){
            $username = str_replace(' ', '-', $username); // Replaces all spaces with hyphens.

           return preg_replace('/[^A-Za-z0-9\-]/', '', $username); // Removes special chars.
         

    }

    public function RandomString()
    {
        $characters       = "23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
        $charactersLength = strlen($characters);
        $randstring       = '';
        for ($i = 0; $i < 11; $i++) {
            $randstring .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randstring;
    }





     /**
     * DUMMY TICKETS BY ASLAM
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function dummytickets($ticketslimit)
    {   


        
        ini_set('max_execution_time', 900); 

        /**
         * [$data array to hold specified incming request values]
         * @var array
         */
        $faker = Faker::create();
        $dummy_tickets = [];
        $dummy_tickets [1] = ['subject'=>'Please advice on growth. Also thanks for this great software.','description'=>'Everything is good, Please advice me on how to make more donwnline. and this is the best MLM software i have ever used in my life. Its easy to manage and now i can really recommend this for any network marketing company out there! ','priority'=>1,'department'=>2,'category'=>3,'status'=>2];

        $dummy_tickets [2] = ['subject'=>'Please give an option to share with my friends and famil.','description'=>'Please make a share system that will enable us to share right from dashboard. Thank you!','priority'=>3,'department'=>2,'category'=>1,'status'=>2];

        $dummy_tickets [3] = ['subject'=>'I came here looking for the best MLM Software','description'=>'I came here looking for the best MLM software and now i can say, I have finally found it!! This is very cool. Im gonna buy this MLM Software for my business right away! ','priority'=>3,'department'=>2,'category'=>1,'status'=>2];

        $dummy_tickets [4] = ['subject'=>'Please add support for spanish language','description'=>'Hello, This software is amazing and really easy to use, can you please add spanish language support so i can use this more effectively. thank you!','priority'=>3,'department'=>2,'category'=>1,'status'=>2];

        $dummy_tickets [5] = ['subject'=>'Thanks for your reply, that was quick. ','description'=>'Oh dear, that was very helpful. your tech team is the best. Hats off! ','priority'=>3,'department'=>2,'category'=>1,'status'=>2];

        $dummy_tickets [6] = ['subject'=>'What is the price of this software?','description'=>'Hello, please let me know how much this software costs. Thank you!','priority'=>3,'department'=>2,'category'=>1,'status'=>2];

        $dummy_tickets [7] = ['subject'=>'Can i add more packages in this MLM software? ','description'=>'Hello, I am looking for an MLM software with cart. Can i use products as packages in this? Waiting for your reply. Thank you!','priority'=>3,'department'=>2,'category'=>1,'status'=>2];

        $dummy_tickets [8] = ['subject'=>'Block specific country?','description'=>'Can i block specific country from registering in my network?','priority'=>3,'department'=>2,'category'=>1,'status'=>2];

        $dummy_tickets [9] = ['subject'=>'how to update profile photo and cover photo?','description'=>'Hello, where i can change the photos? This looks good, I will buy it for sure.','priority'=>3,'department'=>2,'category'=>1,'status'=>2];

        $dummy_tickets [10] = ['subject'=>'Beautiful MLM Software. This works perfect.','description'=>'I will rate this 10/10. Faster and much much easier than the crap out there. This is simply perfect','priority'=>3,'department'=>2,'category'=>1,'status'=>2];

        $dummy_tickets [11] = ['subject'=>'I have navigated through all sections in this MLM software.and this looks good.','description'=>'This will be the. best MLM software in real. I have studied the system and this software does the job beautifully!. Great work!','priority'=>3,'department'=>2,'category'=>1,'status'=>2];

        $dummy_tickets [12] = ['subject'=>'When you can deliver the project if i order one now? ','description'=>'I have a big project in mind, can we discuss it? I like your software. It seems fair.','priority'=>3,'department'=>2,'category'=>1,'status'=>2];

        if( isset($ticketslimit) ){
            $limit = $ticketslimit;
        }
        else{
            $limit = 5;
        }

        $output = new ConsoleOutput();
        $progress = new ProgressBar($output, $limit);
        $progress->start(); 



        for ($i = 1; $i < $limit; $i++) {
            
            $ticketer   = User::inRandomOrder()->get()->first();
            
            //$dummy_ticket  = $dummy_tickets[array_rand($dummy_tickets)];
            $dummy_ticket  = $dummy_tickets[$i];
            


            $created_atX = $faker->dateTimeBetween($startDate = '-2 months', $endDate = 'now', $timezone = null);

            $created_at = $created_atX->format('Y-m-d H:i:s');




            $data                    = array();
            $data['subject']         = $dummy_ticket['subject'];
            $data['description']     = $dummy_ticket['description'];
            $data['priority']        = $dummy_ticket['priority'];
            $data['department']      = $dummy_ticket['department'];
            $data['category']        = $dummy_ticket['category'];
            $data['type']            = '';
            $data['status']          = $dummy_ticket['status'];
            
        
        $validator = Validator::make($data, [
            'subject' => 'bail|required|max:60000',           
            'description' => 'bail|required|max:60000',           
            'priority' => 'bail|required',           
            'department' => 'bail|required',           
            'category' => 'bail|required',           
            'type' => '',           
            'status' => 'bail|required',           
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($validator);
        }


        $ticket = new Ticket();
        // dd($request);

        $ticket->subject = $data['subject'];        
        $ticket->description = $data['description'];        
        $ticket->priority = $data['priority'];        
        $ticket->department = $data['department'];        
        $ticket->category = $data['category'];        
        $ticket->status = $data['status'];        
        $ticket->type = $data['type'];        


        $ticket->ticket_number =  $this->generateTicketCode();    
        $ticket->user_id =  $ticketer->id;       
        $ticket->ip_address = $faker->ipv4();       
        $ticket->last_message_at = Carbon::now();
        $ticket->created_at = $created_at;




        $ticket->save();


                
                Activity::add("Ticket created ","Ticket created by user",$ticketer->id);
                
                // echo '_'.$i;
                
               $progress->advance();
        }


        $progress->finish();
        // echo('tickets generated');
        }
    
   


    

public function generateTicketCode()
{
         do{
             $rand = $this->generateTicketCodeString();
          }while(!empty(Ticket::where('ticket_number',$rand)->first()));
           return $rand;
        }


    public function generateRandomString($length) 
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
     }


public function generateTicketCodeString(){

    $unique =   FALSE;
    $length =   7;
    $chrDb  =   array('0','1','2','3','4','5','6','7','8','9');

    while (!$unique){

          $str = '';
          for ($count = 0; $count < $length; $count++){

              $chr = $chrDb[rand(0,count($chrDb)-1)];

              if (rand(0,1) == 0){
                 $chr = strtolower($chr);
              }
              if (3 == $count){
                 $str .= '-';
              }
              $str .= $chr;
          }

          /* check if unique */
          $existingCode = Ticket::where('ticket_number',$str)->first();
          if (!$existingCode){
             $unique = TRUE;
          }
    }
    return $str;
}








     /**
     * BULK REGISTER BY ASLAM
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function bulktickets()
    {   

        /*


INSERT INTO `tickets` (`id`, `subject`, `description`, `ticket_number`, `user_id`, `department`, `priority`, `category`, `type`, `status`, `rating`, `ratingreply`, `flags`, `ip_address`, `isoverdue`, `reopened`, `isanswered`, `is_deleted`, `closed`, `reopened_at`, `duedate`, `closed_at`, `last_message_at`, `last_response_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test', '<p>Test</p>',  '346-1722', 1,  2,  3,  2,  NULL,   7,  0,  0,  0,  112133, 0,  0,  0,  0,  0,  NULL,   NULL,   NULL,   '2018-05-20 08:37:44',  NULL,   '2018-05-20 08:37:44',  '2018-05-20 08:38:41',  NULL);


INSERT INTO `ticket_categories` (`id`, `category`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bug',  'Bug',  '2018-05-20 08:27:22',  '2018-05-20 08:27:22',  NULL),
(2, 'Feature Request',  'Feature Request',  '2018-05-20 08:27:23',  '2018-05-20 08:27:23',  NULL),
(3, 'Sales Question',   'Sales Question',   '2018-05-20 08:27:23',  '2018-05-20 08:27:23',  NULL),
(4, 'Cancellation', 'Cancellation', '2018-05-20 08:27:23',  '2018-05-20 08:27:23',  NULL),
(5, 'Technical Issue',  'Technical Issue',  '2018-05-20 08:27:23',  '2018-05-20 08:27:23',  NULL);



INSERT INTO `ticket_departments` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'FINANCE',  'Dealing with payout    ',  '2018-05-20 08:35:50',  '2018-05-20 08:35:50',  NULL),
(2, 'Marketing',    'Marketing  section ',  '2018-05-20 08:35:50',  '2018-05-20 08:35:50',  NULL),
(3, 'TECHNICAL',    'TECHNICAL',    '2018-05-20 08:35:50',  '2018-05-20 08:35:50',  NULL);



INSERT INTO `ticket_priorities` (`id`, `priority`, `status`, `priority_desc`, `priority_color`, `priority_urgency`, `ispublic`, `is_default`, `admin_note`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Low',  '1',    'Low',  '#00a65a',  4,  1,  '', '', '2018-05-20 08:25:34',  '2018-05-20 08:25:34',  NULL),
(2, 'Normal',   '1',    'Normal',   '#00bfef',  3,  1,  '1',    '', '2018-05-20 08:25:34',  '2018-05-20 08:25:34',  NULL),
(3, 'High', '1',    'High', '#f39c11',  2,  1,  '', '', '2018-05-20 08:25:34',  '2018-05-20 08:25:34',  NULL),
(4, 'Emergency',    '1',    'Emergency',    '#dd4b38',  1,  1,  '', '', '2018-05-20 08:25:34',  '2018-05-20 08:25:34',  NULL);


INSERT INTO `ticket_statuses` (`id`, `name`, `state`, `mode`, `message`, `flags`, `sort`, `email_user`, `icon_class`, `properties`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Open', 'open', 3,  'Ticket have been Reopened by', 0,  1,  0,  '', 'Open tickets.',    '2018-05-20 08:24:33',  '2018-05-20 08:24:33',  NULL),
(2, 'Resolved', 'closed',   1,  'Ticket have been Resolved by', 0,  2,  0,  '', 'Resolved tickets.',    '2018-05-20 08:24:33',  '2018-05-20 08:24:33',  NULL),
(3, 'Closed',   'closed',   3,  'Ticket have been Closed by',   0,  3,  0,  '', 'Closed tickets. Tickets will still be accessible on client and staff panels.', '2018-05-20 08:24:33',  '2018-05-20 08:24:33',  NULL),
(4, 'Archived', 'archived', 3,  'Ticket have been Archived by', 0,  4,  0,  '', 'Tickets only adminstratively available but no longer accessible on ticket queues and client panel.',   '2018-05-20 08:24:33',  '2018-05-20 08:24:33',  NULL),
(5, 'Deleted',  'deleted',  3,  'Ticket have been Deleted by',  0,  5,  0,  '', 'Tickets queued for deletion. Not accessible on ticket queues.',    '2018-05-20 08:24:33',  '2018-05-20 08:24:33',  NULL),
(6, 'Unverified',   'unverified',   3,  'User account verification required.',  0,  6,  0,  '', 'Ticket will be open after user verifies his/her account.', '2018-05-20 08:24:33',  '2018-05-20 08:24:33',  NULL),
(7, 'Request Approval', 'unverified',   3,  'Approval requested by',    0,  7,  0,  '', 'Ticket will be approve  after Admin verifies  this ticket',    '2018-05-20 08:24:33',  '2018-05-20 08:24:33',  NULL);



        */












        /**
         * [$data array to hold specified incming request values]
         * @var array
         */
        $faker = Faker::create();

        for ($i = 0; $i < 400; $i++) {

            $reg_type  = null;
            $sponsor   = User::inRandomOrder()->get()->first()->username;
            $firstname = $faker->firstname;
            $lastname  = $faker->lastname;
            $username  = trim(strtolower($lastname . $firstname));
            $password  = '111111';
            $phone     = $faker->phoneNumber;
            $email     = $username . "@cloudmlmdemo.com";


            $validator = Validator::make($data, [
                'sponsor'          => 'required|exists:users,username|max:255',
                'placement_user'   => 'sometimes|exists:users,username|max:255',
                'email'            => 'required|unique:users,email|email|max:255',
                'username'         => 'required|unique:users,username|alpha_num|max:255',
                'password'         => 'required|alpha_num|min:6',
                'transaction_pass' => 'required|alpha_num|min:6',
                'package'          => 'required|exists:packages,id',
                'leg'              => 'required',
                'country'          => 'required|country',
            ]);
            /**
             * On fail, redirect back with error messages
             */
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {

    
                $sponsor_id = User::checkUserAvailable($data['sponsor']);
            
                $commision = Commission::create([
                    'user_id'        => $sponsor_id,
                    'from_id'        => $userresult->id,
                    'total_amount'   => $sponsor_commisions,
                    'tds'            => $tds,
                    'service_charge' => $service_charge,
                    'payable_amount' => $payable_amount,
                    'payment_type'   => 'sponsor_commision',
                    'payment_status' => 'Yes',
                ]);
             
                
                DB::commit();
                
            }
        }
        dd('registered');
    }






}
