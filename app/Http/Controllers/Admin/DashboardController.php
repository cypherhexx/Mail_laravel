<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\PurchaseHistory;
use App\PointTable;
use App\ProfileInfo;
use App\Sponsortree;
use App\Activity;
use App\Packages;
use App\Balance;
use App\Voucher;
use App\Payout;
use App\User;
use App\Mail;
use App\Tree_Table;
use App\Ranksetting;

use App\Models\Helpdesk\Ticket\Ticket;
use Illuminate\Http\Request;
use Carbon;
use Auth;
use DB;

class DashboardController extends AdminController
{

    public function index()
    {


        // $user_id=1;
        // $leg='R';
        // $level=3;
        // $data=Tree_Table::DownlinesByLeg($user_id,$leg);
        // // $level_user=Tree_Table::getLevelUsers($user_id,$level);
        // dd($data);
        
        // Tree_Table::getAllUpline($user_id);
        // Tree_Table::getUplineCount($user_id,0);

        // $network=Tree_Table::getnetworkUsers([1],[]);
        // $network_count=Tree_Table::getnetworkUsersCount($user_id);
       
        // Tree_Table::$downline_users =[];
        // Tree_Table::getDownlines(1);
        // $downline_users=Tree_Table::$downline_users;
        
        // Tree_Table::$downline_id_list =[];
        // $downlines_id=Tree_Table::$downline_id_list;
        // Tree_Table::getDownlines($user_id);

        // Tree_Table::$downline_id_list =[];
        // $data=Tree_Table::getDownlineCount($user_id);

        // Packages::rankCheck(13);

       // $user_arrs=[];
       //      $results=Ranksetting::getTreeUplinePackage(35,1,$user_arrs);
       //      array_push($results, 35);
       //      // dd($results);
          
       //      foreach ($results as $key => $value) {
           
       //          Packages::rankCheck($value);
       //      }

        $title     = trans('dashboard.dashboard');
        $sub_title = trans('dashboard.your-dashboard');
        $base      = trans('dashboard.home');
        $method    = trans('dashboard.dashboard');

       $recent = PurchaseHistory::join('users', 'users.id', '=', 'purchase_history.user_id')
            ->join('packages', 'packages.id', '=', 'purchase_history.package_id')
            ->join('profile_infos', 'profile_infos.user_id', '=', 'purchase_history.user_id')
            // ->where('purchase_history.user_id','=','purchase_history.purchase_user_id')
            ->select('purchase_history.*', 'users.username', 'packages.package','profile_infos.profile')
            ->orderby('purchase_history.id', 'DESC')
            ->take(5)
            ->get();

            // dd($recent);
        $percentage_balance  = 0;
        $percentage_released = 0;
        $payout              = Payout::sum('amount');
        $balance             = Balance::sum('balance');
        // dd($balance);
        if ($balance > 0) {
            $percentage_balance  = ($balance * 100) / ($payout + $balance);
            $percentage_released = ($payout * 100) / ($payout + $balance);
        }

    

          $top_recruiters = ProfileInfo::select(array('users.id', 'users.name', 'users.username', 'country','image','profile','cover', 'users.email', 'users.created_at',
                   DB::raw('COUNT(sponsortree.sponsor) as count'))) 
            ->join('users', 'users.id', '=', 'profile_infos.user_id')           
            ->join('sponsortree', 'sponsortree.sponsor', '=', 'profile_infos.user_id')           
            ->where('sponsortree.type', '<>', 'vaccant') 
            ->where('sponsortree.sponsor', '<>', 0) 
            ->where('users.admin', '<>', 1)
            ->groupBy('sponsortree.sponsor')
            ->orderBy('count', 'desc')
            ->limit('5')
            ->get(); 


            $new_users = ProfileInfo::select(array('users.id', 'users.name', 'users.username', 'country','image','profile','cover', 'users.email', 'users.created_at'))
            ->join('users', 'users.id', '=', 'profile_infos.user_id')           
            ->where('admin', '<>', 1)
            // ->offset($request->start)
            ->orderBy('created_at', 'desc')
            ->limit('5')
            ->get();

            // dd($top_recruiters);
             $top_earners=Balance::join('users','users.id','=','user_balance.user_id')
           ->join('profile_infos','profile_infos.user_id','=','users.id')
          
           ->select('users.name','users.username','users.email','user_balance.balance','profile_infos.profile')
           ->where('users.admin', '<>', 1)
           ->orderby('user_balance.balance','desc')
            ->limit('5')
           ->get();


         // dd($top_earners[0]);  
        $count_new = count($new_users);

        $per_users   = User::getUserPercentage();
        $per_payout  = Payout::getPayoutPercentage();
        $per_mail    = Mail::perMail();
        $per_voucher = Voucher::perVoucher();

        $total_users    = User::where('admin', '<>', 1)->count();
        $total_messages = Mail::where('to_id', '=', 1)->count();
        $total_voucher  = Voucher::count();
        $total_amount   = round(Balance::sum('balance'), 2); 
      


        $all_payout     = Payout::getPayoutAllDetails();
        $unread_count   = Mail::unreadMailCount(Auth::user()->id);
        $unread_mail    = Mail::unreadMail(Auth::user()->id);
        $point_details  = PointTable::getUserPoint(Auth::user()->id);

        $male_users_count  = ProfileInfo::where('user_id', '<>', 1)->where('gender','m')->count();
        $female_users_count  = ProfileInfo::where('user_id', '<>', 1)->where('gender','f')->count();


        //Weekly Join
        $weekly_users_count = User::whereDate('created_at', '>=', date('Y-m-d H:i:s',strtotime('-7 days')) )->count();
        $monthly_users_count = User::whereDate('created_at', '>=', date('Y-m-d H:i:s',strtotime('-1 month')) )->count();
        $yearly_users_count = User::whereDate('created_at', '>=', date('Y-m-d H:i:s',strtotime('-1 year')) )->count();
       
      
        // $purchases_data = Packages::with('PurchaseHistoryR')
        // ->get();

        $packages_data = Packages::where('id','>',1)->select(['id','package','amount','special','image'])->withCount('PurchaseHistoryR')->get();
        

        // $all_activities = Activity::with('user')->paginate(15);

        $all_activities = ProfileInfo::select(array('users.id', 'users.name', 'users.username', 'activity_log.description', 'users.email', 'users.created_at'))
            ->join('users', 'users.id', '=', 'profile_infos.user_id')
            ->join('activity_log', 'activity_log.user_id', '=', 'profile_infos.user_id')
            ->where('admin', '<>', 1)
            ->orderBy('created_at','desc')           
            ->paginate(10);
        // $user_arrs=[];

        // Packages::rankCheck(1);
       // $results=Packages::gettenupllins(12,1,$user_arrs);
       // dd($results);
            $users=1;

        /*vincy*/

        $turnover=PurchaseHistory::sum('total_amount');
                               
                               
        return view('app.admin.dashboard.index', compact('title', 'per_users', 'recent', 'per_payout', 'per_mail', 'per_voucher', 'users', 'all_payout', 'new_users', 'count_new', 'percentage_released', 'percentage_balance', 'total_users', 'total_messages', 'total_voucher', 'total_amount', 'unread_count', 'unread_mail', 'point_details', 'sub_title', 'base', 'method','male_users_count','female_users_count','weekly_users_count','monthly_users_count','yearly_users_count','packages_data','all_activities','top_recruiters','top_earners','turnover'));
    }


       /**
     * Fetching dashboard graph data to implement graph.
     *
     * @return type Json
     */
    public function ChartData($date111 = '', $date122 = '')
    {
        $date11 = strtotime($date122);
        $date12 = strtotime($date111);
        if ($date11 && $date12) {
            $date2 = $date12;
            $date1 = $date11;
        } else {
            // generating current date
            $date2 = strtotime(date('Y-m-d'));
            $date3 = date('Y-m-d');
            $format = 'Y-m-d';
            // generating a date range of 1 month
            $date1 = strtotime(date($format, strtotime('-1 month'.$date3)));
        }
        $return = '';
        $last = '';
        for ($i = $date1; $i <= $date2; $i = $i + 86400) {
            $thisDate = date('Y-m-d', $i);

            $created = \DB::table('tickets')->select('created_at')->where('created_at', 'LIKE', '%'.$thisDate.'%')->count();
            $closed = \DB::table('tickets')->select('closed_at')->where('closed_at', 'LIKE', '%'.$thisDate.'%')->count();
            $reopened = \DB::table('tickets')->select('reopened_at')->where('reopened_at', 'LIKE', '%'.$thisDate.'%')->count();

            $value = ['date' => $thisDate, 'open' => $created, 'closed' => $closed, 'reopened' => $reopened];
            $array = array_map('htmlentities', $value);
            $json = html_entity_decode(json_encode($array));
            $return .= $json.',';
        }
        $last = rtrim($return, ',');

        return '['.$last.']';

    }


    public function getGenderJson(){

            $male_users_count  = ProfileInfo::where('user_id', '<>', 1)->where('gender','m')->count();
            $female_users_count  = ProfileInfo::where('user_id', '<>', 1)->where('gender','f')->count();
            return response()->json(                
                [[
                'gender' => 'Male',
                "value"=> $male_users_count,
                "color"=> "#66BB6A"
                ],
                [
                'gender' => 'Female',
                "value" => $female_users_count,
                "color"=>"#EF5350"
                ]]
            , 200);
    }


    public function getUsersJoiningJson(){

        $users = DB::table('users')
          ->select(DB::raw('DATE(created_at) as date'),DB::raw('count(*) as value'))
          ->orderBy('date', 'asc')
          ->groupBy('date')
          // ->take(15)
          ->get();
          return response()->json($users);
    }

    public function getUsersWeeklyJoiningJson(){

        // this week results
        $fromDate = Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString(); // or ->format(..)
        $tillDate = Carbon\Carbon::now()->subDay()->toDateString();


        $users = DB::table('users')
          ->select(DB::raw('DATE(created_at) as date'),DB::raw('count(*) as value'))
          ->whereBetween( DB::raw('DATE(created_at)'), [$fromDate, $tillDate] )
          ->orderBy('date', 'asc')
          ->groupBy('date')
          // ->take(15)
          ->get();
          return response()->json($users);
    }

    public function getUsersMonthlyJoiningJson(){

        // this week results
        $fromDate = Carbon\Carbon::now()->subDay()->startOfMonth()->toDateString(); // or ->format(..)
        $tillDate = Carbon\Carbon::now()->subDay()->toDateString();


        $users = DB::table('users')
          ->select(DB::raw('DATE(created_at) as date'),DB::raw('count(*) as value'))
          ->whereBetween( DB::raw('DATE(created_at)'), [$fromDate, $tillDate] )
          ->orderBy('date', 'asc')
          ->groupBy('date')
          // ->take(15)
          ->get();
          return response()->json($users);
    }

    public function getUsersYearlyJoiningJson(){

        // this week results
        $fromDate = Carbon\Carbon::now()->subDay()->startOfYear()->toDateString(); // or ->format(..)
        $tillDate = Carbon\Carbon::now()->subDay()->toDateString();


        $users = DB::table('users')
          ->select(DB::raw('DATE(created_at) as date'),DB::raw('count(*) as value'))
          ->whereBetween( DB::raw('DATE(created_at)'), [$fromDate, $tillDate] )
          ->orderBy('date', 'asc')
          ->groupBy('date')
          // ->take(15)
          ->get();
          return response()->json($users);
    }


    public function getPackageSalesJson(){

          // $purchases = DB::table('purchase_history')->join('packages', 'packages.id', '=', 'purchase_history.package_id')
          //   ->groupBy('purchase_history.package_id')
          //   ->get(['purchase_history.id', 'packages.package', DB::raw('count(packages.id) as items')]);
        
    
        // dd($purchases);

    // type,date,Alpha,Delta,Sigma
        // $purchases = DB::table('purchase_history')
        //   ->join('packages', 'purchase_history.package_id', '=', 'packages.id')
        //   // ->select(DB::raw('DATE(created_at) as date'),DB::raw('count(*) as value'),DB::raw('packages.package as package'))          
        //   ->select(
        //     DB::raw('DATE(purchase_history.created_at) as date'),
        //     DB::raw('packages.package as package')
        //     // DB::raw('count(*) as value')
        // )          
        //   // ->groupBy('date')
        //   ->orderBy('date', 'asc')
        //   // ->take(15)
        //   ->get();


        

        //convert into collection, group by "dept_name" key and then convert back into array
        // $data = collect($purchases)->groupBy('package')->all();
        // $data2 = collect($data)->groupBy('date')->all();

          // dd($data);
          // return response()->json($data);
         
        // $purchases_data = Packages::with('PurchaseHistoryR')
        // ->get();

        // $purchases_data = Packages::select(['id','package','amount','special'])
        // // ->with(['PurchaseHistoryR' => function($query) {
        // //     $query->select(['package_id']);
        // // }])
        // ->withCount('PurchaseHistoryR')
        // ->get();

        // return response()->json($purchases_data);


         $packages_data = Packages::select(['id','package','amount','special'])       
            // ->with(array('PurchaseHistoryR'=>function($query){
            //     $query->select(['package_id',DB::raw("DATE(created_at)  as date"),DB::raw('count(*) as value')])
            //     ->groupBy('date');
            // }))->get();

            /*
                SELECT * FROM `purchase_history`  
                WHERE DATE(`created_at`) = '2017-10-23'
                AND `package_id` = '1'
                ORDER BY `purchase_history`.`created_at`  ASC
            */

          
        ->with(array('PurchaseHistoryR'=>function($query){
            $query->select(['package_id',DB::raw("DATE(created_at)  as date"),DB::raw('count(*) as value')])
            ->groupBy('package_id')
            ->orderBy('date', 'asc')
            ->groupBy('date');
        }))->get();

        return response()->json($packages_data);
        // dd($packages_data);



        // dd($packages_data);

           $package1 = DB::table('purchase_history')
              ->select(DB::raw('DATE(created_at) as date'),DB::raw('count(*) as value'))              
              ->orderBy('date', 'asc')
              ->where('package_id', '1')
              ->groupBy('date')
          // ->take(15)
          ->get();     

          $package2 = DB::table('purchase_history')
              ->select(DB::raw('DATE(created_at) as date'),DB::raw('count(*) as value'))              
              ->orderBy('date', 'asc')
              ->where('package_id', '2')
              ->groupBy('date')
          // ->take(15)
          ->get();

          $package3 = DB::table('purchase_history')
              ->select(DB::raw('DATE(created_at) as date'),DB::raw('count(*) as value'))              
              ->orderBy('date', 'asc')
              ->where('package_id', '3')
              ->groupBy('date')
          // ->take(15)
          ->get();

           $datas = [];
           $datas['Elite'] = $package1->toArray();
           $datas['Premium'] = $package2->toArray();
           $datas['VIP'] = $package3->toArray();
            

          // $data = array_merge($package1->toArray(),$package2->toArray(),$package3->toArray());
          
          return response()->json($datas);


    }


    /**
     * Fetching tickets
     *
     * @return type Json
     */
    public function TicketsStatusJson($date111, $date122)
    {   
        
        // $date11 = date('Y-m-d', $date122);
        // $date12 =date('Y-m-d', $date111);

        // dd(date('m/d/Y', $date111));

        $date11 = strtotime($date111);
        $date12 = strtotime($date122);
        // dd($date111);

        // dd(strtotime(date('Y-m-d', strtotime('-1 month'.date('Y-m-d')))));

        if ($date11 && $date12) {
            $date2 = $date12;
            $date1 = $date11;
        } else {
            // generating current date
            $date2 = strtotime(date('Y-m-d'));
            $date3 = date('Y-m-d');
            $format = 'Y-m-d';
            // generating a date range of 1 month
            $date1 = strtotime(date($format, strtotime('-1 month'.$date3)));
        }
        $return = '';
        $last = '';
        for ($i = $date1; $i <= $date2; $i = $i + 86400) {
            $thisDate = date('Y-m-d', $i);

            $created = \DB::table('tickets')->select('created_at')->where('created_at', 'LIKE', '%'.$thisDate.'%')->count();
            $closed = \DB::table('tickets')->select('closed_at')->where('closed_at', 'LIKE', '%'.$thisDate.'%')->count();
            $reopened = \DB::table('tickets')->select('reopened_at')->where('reopened_at', 'LIKE', '%'.$thisDate.'%')->count();

            $value = ['date' => $thisDate, 'open' => $created, 'closed' => $closed, 'reopened' => $reopened];
            $array = array_map('htmlentities', $value);
            $json = html_entity_decode(json_encode($array));
            $return .= $json.',';
        }
        $last = rtrim($return, ',');

        return '['.$last.']';

        // $ticketlist = DB::table('tickets')
        //     ->select(DB::raw('MONTH(updated_at) as month'),DB::raw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as closed'),DB::raw('SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as reopened'),DB::raw('SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as open'),DB::raw('SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) as deleted'),
        //         DB::raw('count(*) as totaltickets'))
        //     ->groupBy('month')
        //     ->orderBy('month', 'asc')
        //     ->get();
        // return $ticketlist;
    }


    public function getmonthusers()
    {

        for ($i = 1; $i <= 12; $i++) {
            echo $count = User::whereMonth('created_at', '=', $i)->whereYear('created_at', '=', date('Y'))->count();
            echo ",";
        }
    }
}
