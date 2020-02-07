<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\user\UserAdminController;
use App\Http\Controllers;
use App\Http\Requests;

use App\PurchaseHistory;
use App\Tree_Table;
use App\PointTable;
use App\RsHistory;
use App\Currency;
use App\Balance;
use App\Payout;
use App\User;
use App\Voucher;
use App\Commission;
use App\ProfileInfo;
use App\Packages;

use Illuminate\Http\Request;
use Auth;
use DB;

class dashboard extends UserAdminController{

  
    public function index() {

      $current_pack=ProfileInfo::where('user_id','=',Auth::user()->id)->value('package');
      // dd($current_pack);

      if($current_pack == 1){
         return redirect('/user/purchasedashboard');
      }

        $title = trans('dashboard.dashboard');       
        $users = User::count();               
        $total_bv =  Auth::user()->revenue_share;
        $left_bv =  PointTable::where('user_id','=',Auth::user()->id)->value('left_carry');
        $right_bv =  PointTable::where('user_id','=',Auth::user()->id)->value('right_carry');
        $payout =payout::where('user_id', Auth::user()->id) 
                     ->where('status','=','released')->sum('amount');
      
        
        $balance = Balance::getTotalBalance(Auth::user()->id);

        $details = Payout::getUserPayoutDetails();
        $details = explode(',', $details);
        $percentage_balance = 0;
        $percentage_released = 0;

        if($details[0]+$balance != 0)
        $percentage_balance = ($balance*100)/($details[0]+$balance);
        if($details[0]+$details[1] !=0)
        $percentage_released = ($details[0]*100)/($details[0]+$details[1]);
        $new_users = User::getNewUsers();
        $count_new = count($new_users);  
        $total_top_up =  Voucher::where('user_id',Auth::user()->id)->sum('balance_amount');
        $total_invest = PurchaseHistory::where('user_id',Auth::user()->id)->sum('total_amount');
        // $total_rs = RsHistory::where('user_id',Auth::user()->id)->sum('rs_credit');
        $total_rs = Commission::where('user_id',Auth::user()->id)->where('payment_type','like','credited_by_admin')->sum('payable_amount');
        // $credits = User::where('id',Auth::user()->id)->pluck('credits');

        $USER_CURRENCY=Currency::all();

           //Weekly Join
       $weekly_users_count = DB::table('sponsortree')->where('sponsor',Auth::user()->id)->where('type','yes')->whereDate('created_at', '>=', date('Y-m-d H:i:s',strtotime('-7 days')) )->count();
        $monthly_users_count = DB::table('sponsortree')->where('sponsor',Auth::user()->id)->where('type','yes')->whereDate('created_at', '>=', date('Y-m-d H:i:s',strtotime('-1 month')) )->count();
        $yearly_users_count = DB::table('sponsortree')->where('sponsor',Auth::user()->id)->where('type','yes')->whereDate('created_at', '>=', date('Y-m-d H:i:s',strtotime('-1 year')) )->count();

        $base = trans('dashboard.dashboard');
        $method = trans('dashboard.dashboard');
        $sub_title = trans('dashboard.dashboard');

       return view('app.user.dashboard.index', compact('count_new','new_users','title','point_details', 'users', 'balance','percentage_released','percentage_balance','total_bonus','sub_title','right_bv','left_bv','total_bv','total_top_up','total_rs','base','method','USER_CURRENCY','payout','weekly_users_count','monthly_users_count','yearly_users_count','total_invest'));
    }

  
    public function getmonthusers(){
        $downline_users = array();
        Tree_Table::getDownlines(1,true ,Auth::user()->id,$downline_users);
        $users = Tree_Table::getDown();       
        print_r($users);
    }
    
    
    public function getUsersJoiningJson(){

       $users = DB::table('sponsortree')->where('sponsor',Auth::user()->id)->where('type','yes')
          ->select(DB::raw('DATE(created_at) as date'),DB::raw('count(*) as value'))
          ->orderBy('date', 'asc')
          ->groupBy('date')
          ->get();
          return response()->json($users);

    }

    public function purchasedashboard(){
        $title = trans('dashboard.dashboard');   
        $base = trans('dashboard.dashboard');
        $method = trans('dashboard.dashboard');
        $sub_title = trans('dashboard.dashboard');
        $products=Packages::where('id','>',1)->get();
        // dd($packages);

        return view('app.user.dashboard.purchaseindex', compact('title','sub_title','base','method','products'));

    }

}
