<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ShareBonus ;
use App\Sales ;
use App\PointHistory ;
use App\Commission ;
use App\User ;
use App\Balance ;
use App\Payout ;
use DB ;

// 9946159096

class ShareBonusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $share_bonus_settings = ShareBonus::find(1);

        $point_history = Sales::join('users','users.id','=','sales.master')
                        ->whereYear('sales.created_at', '=', date('Y'))
                        ->whereMonth('sales.created_at', '=', date('m'))
                        ->where('users.package', '=', '2')
                        ->where('sales.master', '>', '1')
                        ->groupBy('sales.master')
                        ->select('sales.*',DB::raw('SUM(pv) as total_sales'))
                        ->get();

     $users = array();

     $total_sales = 0 ;
     $total_divident_sales = 0 ;

     foreach ($point_history as $key => $value) {

         $total_sales += $value->total_sales ;
          
                if($value->total_sales >= 5000 ){ 

                    $total_divident_sales += $value->total_sales ;                 

                        $users[] = ['user_id'=>$value->master, 'total_sales'=>$value->total_sales];                        


                }

       
     }


     Echo  " Total sales  == > $total_sales  <br/>" ;


     $percent_total_sales  = $total_sales * 5 / 100 ;

     Echo  "  5 % of Total sales  == > $percent_total_sales  <br/>" ;

     Echo " Total user qualified to get share bonus . ". count($users) .'<br/> ';

     echo "<br/>  USER DETALS AND COMMISSIONS ";

     foreach ($users as $key => $master) {


         $share_bonus =   ($master['total_sales'] /$total_divident_sales) * $percent_total_sales ;

        echo "<br/>  USER NAME  =>" . User::userIdToName($master['user_id']) . "TOTAL SALE OF MASTER  => ". $master['total_sales'] ."   BONUS AMOUNT  => ". $share_bonus ." PV" ;

            Commission::sharebonus($master['user_id'], $share_bonus);

        


     }



    }

   
    public function payout()
    {
        // echo "auto/payout" ;die();
        $variable = Balance::where('balance','>',0)->select('user_id','balance')->get();
        foreach ($variable as $users => $value) {
            Payout::create([
            'user_id'        => $value->user_id,            
            'amount'        => $value->balance,
            'status'   => 'released'
            ]);
             Balance::updateBalance($value->user_id, $value->balance);
        }



        Echo "Payout completed <br>" ;
    }
}
