<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\ProfileInfo;
use App\PendingTransactions;
use App\IpnResponse;

class PurchaseActiveCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:purchase';

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
        $users=User::where('id','>',1)->pluck('id');
            foreach ($users as $key => $user) {
              $package=ProfileInfo::where('user_id',$user)->value('package');
              $transaction=PendingTransactions::where('user_id',$user)
                                              ->where('payment_status','complete')
                                              ->where('package',$package)
                                              ->where('payment_type','upgrade')
                                              ->first();

                if($transaction->payment_method == 'paypal'){
                    $next_pay_date = date('Y-m-d', strtotime($transaction->next_payment_date));
                     if(date('Y-m-d') ==  $next_pay_date){
                        $this_date_data=IpnResponse::where('payment_id',$transaction->paypal_agreement_id)
                                    ->whereDate('created_at', '=', date('Y-m-d'))
                                    ->first();
                         if($this_date_data <> null){
                            $this_reponse=json_decode($this_date_data->response);
                              if($this_reponse->payment_status <> 'Completed'){
                                User::where('id',$user)->update(['active_purchase' => 'no']);
                              }
                              else{
                                $next_payment_date=date('Y-m-d H:i:s', strtotime(' + 1'.$transaction->payment_period));
                                PendingTransactions::where('id',$transaction->id)->update(['next_payment_date' => $next_payment_date]);
                              }
                         }else{
                            User::where('id',$user)->update(['active_purchase' => 'no']);
                         }
                     }

                }else{
                    if($next_pay_date < date('Y-m-d H:i:s')){
                        User::where('id',$user)->update(['active_purchase' => 'no']);
                    }
                }
                                             
            }

            dd("done");
    }
}
