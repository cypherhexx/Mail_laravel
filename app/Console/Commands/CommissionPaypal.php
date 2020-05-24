<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ProfileModel;
use App\User;
use App\PendingTransactions;
use App\Packages;

class CommissionPaypal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'commission:paypal';

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
    public function handle(){

       $users=User::where('id','>',1)->pluck('id');
           foreach ($users as $key => $user) {
              $package=ProfileModel::where('user_id',$user)->value('package');
              $transaction=PendingTransactions::where('user_id',$user)
                                              ->where('package',$package)
                                              ->where('payment_type','upgrade')
                                              ->where('payment_period','year')
                                              ->where('payment_method','paypal')
                                              ->where('payment_status','complete')
                                              ->first();
                if($transaction <> null){
                   $next_pay_year = date('Y-m-d', strtotime($transaction->next_payment_date));
                   $next_pay_month = date('Y-m-d', strtotime($transaction->monthly_commission_date));
                     if(date('Y-m-d') <>  $next_pay_year && date('Y-m-d') == $next_pay_month){
                        $pac_amount=Packages::find($package)->amount;
                        Packages::levelCommission($user,$pac_amount,$package);
                        
                     }
                }

            }

           dd("done");

    }
}
