<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Admin\AdminController;
use App\PurchaseHistory;
use App\AppSettings;
use App\Commission;
use App\Packages;
use App\Payout;
use App\User;
use App\Sponsortree;
use App\PairingHistory;
use App\IpnResponse;
use App\PendingTransactions;

use Illuminate\Http\Request;
use CountryState;
use Validator;
use Assets;
use Auth;
use DB;

class ReportController extends AdminController
{

    public function joiningreport()
    {
        $title     = trans('report.joining_report');
        $sub_title = trans('report.joining_report');
        
        $countries = CountryState::getCountries();        
        $states = CountryState::getStates('US');       

        $base      = trans('report.report');
        $method    = trans('report.joining_report');
        $userss    = User::getUserDetails(Auth::id());
        $user      = $userss[0];
        return view('app.admin.report.joiningreport', compact('title', 'countries', 'user', 'sub_title', 'base', 'method'));
    }

    public function joiningreportview(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'start'   => 'required|date',
            'end'     => 'required|date',
            'country' => '',
            'sponsor' => 'exists:users,username',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        
        $title      = trans('report.joining_report');
        $sub_title  = trans('report.joining_report_view');
        $base       = trans('report.report');
        $method     = trans('report.joining_report_view');
        $app        = AppSettings::find(1);
        $reportdata = User::join('profile_infos', 'profile_infos.user_id', '=', 'users.id')->select('users.username', 'users.name', 'users.lastname', 'users.email', 'profile_infos.mobile', 'users.created_at','profile_infos.country')->where('users.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))->where('users.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))->get();
        return view('app.admin.report.joiningreportview', compact('title', 'countries', 'reportdata', 'sub_title', 'base', 'method','app'));
    }

    public function joiningreportbysponsorview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sponsor' => 'exists:users,username',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $sponsor_id = User::userNameToId($request->sponsor);

        $title     = trans('report.joining_report');
        $base      = trans('report.report');
        $method    = trans('report.joining_report_by_sponsor');
        $sub_title = trans('report.joining_report_by_sponsor');
      
        $reportdata  = DB::table('users')->join('sponsortree', 'sponsortree.user_id', '=', 'users.id')->join('profile_infos','profile_infos.user_id','=','users.id')
        ->where('sponsortree.sponsor', '=', $sponsor_id)->get();
        
        $count_users = count($reportdata);
      

        return view('app.admin.report.joiningreportview', compact('title', 'countries', 'reportdata', 'base', 'method', 'sub_title'));
    }

    public function joiningreportbycountryview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        //echo   $request->country;
        $title       = trans('report.joining_report');
        $base        = trans('report.report');
        $method      = trans('report.joining_report_by_country');
        $sub_title   = trans('report.joining_report_by_country');
        $reportdata  = User::join('profile_infos', 'profile_infos.user_id', '=', 'users.id')->select('users.username', 'users.name', 'users.lastname', 'users.email', 'profile_infos.mobile', 'users.created_at', 'profile_infos.country')->where('profile_infos.country', '=', $request->country)->get();
        
        $count_users = count($reportdata);
        
        return view('app.admin.report.joiningreportview', compact('title', 'countries', 'reportdata', 'base', 'method', 'sub_title'));

    }

    public function fundcredit()
    {
        $title        = trans('report.fund_credit');
        $sub_title    = trans('report.fund_credit');
        $unread_count = 0;
        $unread_mail  = 0;
        $base         = trans('report.fund_credit');
        $method       = trans('report.fund_credit');
        $userss       = User::getUserDetails(Auth::id());
        $user         = $userss[0];
        return view('app.admin.report.fundcredit', compact('title', 'unread_count', 'unread_mail', 'user', 'sub_title', 'base', 'method'));
    }

    public function fundcreditview(Request $request)
    {    

        $validator = Validator::make($request->all(), [
            'start' => 'required|date',
            'end'   => 'required|date|',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $title      = trans('report.fund_credit');
        $sub_title  = trans('report.fund_credit');
        $base       = trans('report.fund_credit');
        $method     = trans('report.fund_credit');
        $app        = AppSettings::find(1);
        $reportdata = Commission::where('commission.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))->where('commission.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->join('users', 'users.id', '=', 'commission.user_id')
            ->select('commission.created_at', 'users.username', 'users.name', 'users.lastname', 'users.email', 'commission.payable_amount as amount', 'commission.payment_type','sponsor.username as sponsor')
            ->where('commission.payment_type', '=', 'credited_by_admin')
            ->join('sponsortree','sponsortree.user_id','=','users.id')
            ->join('users as sponsor','sponsor.id','=','sponsortree.sponsor')
            ->get();
           
        $payable_amount = Commission::where('commission.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))->where('commission.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->join('users', 'users.id', '=', 'commission.user_id')
            ->where('commission.payment_type', '=', 'credited_by_admin')
            ->sum('payable_amount');


        return view('app.admin.report.fundcreditview', compact('title', 'reportdata', 'sub_title', 'payable_amount', 'base', 'method','app'));

    }

    public function ewalletreport()
    {
        $title     = trans('report.members_income_report');
        $sub_title = trans('report.income_report');
        $base      = trans('report.report');
        $method    = trans('report.income_report');

        $userss   = User::getUserDetails(Auth::id());
        $user     = $userss[0];
        $users    = User::where('id', '>', 1)->get();
        $packages = Packages::all();
        $bonus_type = Commission::select('payment_type')->where('payment_type','NOT LIKE','%credited%')->groupBY('payment_type')->get();
        return view('app.admin.report.ewalletreport', compact('title', 'user', 'users', 'sub_title', 'base', 'method', 'packages','bonus_type'));
    }

    public function ewalletreportview(Request $request)
    {
         // dd($request->all());
       
        if($request->username != null){
           $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
            'username' => 'exists:users',
        ]);  
        }
        else{
             $validator = Validator::make($request->all(), [
            'start'    => 'required|date',
            'end'      => 'required|date|',
            // 'username' => 'sometimes|exists:users',
        ]);
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $app        = AppSettings::find(1);

        $user_id = User::where('username', $request->username)->pluck('id');
        

        // dd(count($user_id));
         

        $title     = trans('report.members_income_report');
        $sub_title = trans('report.income_report');
        $base      = trans('report.report');
        $method    = trans('report.income_report');

        $reportdata = Commission::where('commission.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))->where('commission.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->join('users', 'users.id', '=', 'commission.user_id')
            ->join('profile_infos', 'profile_infos.user_id', '=', 'commission.user_id')
            ->join('packages', 'packages.id', '=', 'commission.package')
            ->select('users.username', 'packages.package as position', 'users.lastname', 'users.name', 'commission.created_at', 'commission.total_amount', 'commission.payment_type')
            ->where(function ($query) use ($request, $user_id) {
                if ($request->bonus_type != 'all') {
                    $query->where('commission.payment_type', '=', $request->bonus_type);
                }
                if (count($user_id) != 0) {
                    $query->where('commission.user_id', '=', $user_id);
                }

            })

            ->get();

        $totalamount = Commission::where('commission.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('commission.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('commission.payment_status', '=', 'yes')
            ->where(function ($query) use ($request, $user_id) {
                if ($request->bonus_type != 'all') {
                    $query->where('commission.payment_type', '=', $request->bonus_type);
                }
                if (count($user_id) != 0) {
                    $query->where('commission.user_id', '=', $user_id);
                }
            })
            ->join('users', 'users.id', '=', 'commission.user_id')
            ->sum('total_amount');

        return view('app.admin.report.ewalletreportview', compact('title', 'reportdata', 'totalamount', 'sub_title', 'base', 'method','app'));
    }

    public function payoutreport()
    {
        $title     = trans('report.payout_released_report');
        $sub_title = trans('report.payout_release_report');
        $base      = trans('report.report');
        $method    = trans('report.payout_release_report');
        $users     = User::where('id', '>', 1)->get();
        $packages  = Packages::all();
        $user      = User::find(Auth::user()->id);
        return view('app.admin.report.payoutreport', compact('title', 'users', 'user', 'packages', 'sub_title', 'base', 'method'));
    }

    public function payoutreportview(Request $request)
    {

       

        $validator = Validator::make($request->all(), [
            'start' => 'required|date',
            'end'   => 'required|date|',
            // 'username'=>'required|exists:users'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $title      = trans('report.payout_released_report');
        $sub_title  = trans('report.payout_release_report');
        $base       = trans('report.report');
        $method     = 'Payout release report view';
        $app        = AppSettings::find(1);
        $reportdata = Payout::where(function ($query) use ($request) {
            if ($request->username != 'all') {
                $query->where('payout_request.user_id', '=', $request->username);
            }
        })
            ->where('payout_request.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('payout_request.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('status', '=', 'released')
            ->join('users', 'users.id', '=', 'payout_request.user_id')
            ->join('profile_infos', 'profile_infos.user_id', '=', 'payout_request.user_id')
            // ->join('currency', 'currency.id', '=', 'profile_infos.currency')
            ->select('users.username', 'users.lastname', 'users.name', 'profile_infos.account_holder_name', 'profile_infos.account_number', 'profile_infos.bank_code', 'profile_infos.sort_code', 'profile_infos.swift', 'payout_request.*')
            ->get();

       

        $totalamount = Payout::where(function ($query) use ($request) {
            if ($request->username != 'all') {
                $query->where('payout_request.user_id', '=', $request->username);
            }
        })
            ->where('payout_request.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('payout_request.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('status', '=', 'released')
            ->sum('amount');

        return view('app.admin.report.payoutreportview', compact('title', 'reportdata', 'totalamount', 'sub_title', 'base', 'method','app'));
    }

    public function salesreport()
    {
        $title        = trans('report.sales_report');
        $sub_title    = trans('report.sales_report');
        $unread_count =0;
        $unread_mail  = 0;
        $base         = trans('report.sales_report');
        $method       = trans('report.sales_report');
        $userss       = User::getUserDetails(Auth::id());
        $user         = $userss[0];
        return view('app.admin.report.salesreport', compact('title', 'unread_count', 'unread_mail', 'user', 'sub_title', 'base', 'method'));
    }

    public function salesreportview(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'start' => 'required|date',
            'end'   => 'required|date|',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $title      = trans('report.sales_report');
        $sub_title  = trans('report.sales_report');
        $base       = trans('report.sales_report');
        $method     = trans('report.sales_report');
        $app        = AppSettings::find(1);
        $reportdata = PurchaseHistory::where('purchase_history.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('purchase_history.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('purchase_history.sales_status', 'yes')

            ->join('users', 'users.id', '=', 'purchase_history.purchase_user_id')
            ->join('packages', 'packages.id', '=', 'purchase_history.package_id')
            ->select('purchase_history.created_at', 'users.username', 'users.name', 'users.lastname', 'users.email', 'purchase_history.total_amount as amount')
        // ->sum('total_amount')
            ->get();

        $total_amount = PurchaseHistory::where('purchase_history.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('purchase_history.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('purchase_history.sales_status', 'yes')
            ->sum('total_amount');

        return view('app.admin.report.salesreportview', compact('title', 'reportdata', 'total_amount', 'sub_title', 'base', 'method','app'));

    }

   

    public function topearners()
    {
        $title        = trans('report.top_earners');
        $sub_title    = trans('report.top_earners');
        $unread_count = 0;
        $unread_mail  = 0;
        $base         = trans('report.top_earners');
        $method       = trans('report.top_earners');
        $userss       = User::getUserDetails(Auth::id());
        $user         = $userss[0];
        return view('app.admin.report.topearners', compact('title', 'unread_count', 'unread_mail', 'user', 'sub_title', 'base', 'method'));
    }

    public function topearnersview(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'start' => 'required|date',
            'end'   => 'required|date|',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $title      = trans('report.top_earners_report');
        $sub_title  = trans('report.top_earners_report');
        $base       = trans('report.top_earners_report');
        $method     = trans('report.top_earners_report');
        $app        = AppSettings::find(1);
        $reportdata = Commission::where('commission.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))->where('commission.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('commission.payment_status', '=', 'yes')
            ->join('users', 'users.id', '=', 'commission.user_id')
            ->join('profile_infos', 'profile_infos.user_id', '=', 'commission.user_id')
            ->join('packages', 'packages.id', '=', 'profile_infos.package')
            ->join('sponsortree','sponsortree.user_id','=','users.id')
            ->join('users as sponsor','sponsor.id','=','sponsortree.sponsor')
            ->groupBY('commission.user_id')
            ->select('users.username', 'users.name', 'users.lastname','sponsor.username as sponsor' ,'packages.package', DB::raw('SUM(payable_amount) as amount'))
            ->where('payable_amount', '>', 0)
            ->orderby('amount', 'DESC')
            ->get();

        return view('app.admin.report.topearnersview', compact('title', 'reportdata', 'sub_title', 'base', 'method','app'));

    }
   

    public function salereport()
    {
        $title     = trans('report.sales_report');
        $sub_title = trans('report.sales_report');
        $base      = trans('report.report');
        $method    = trans('report.sales_report');
        $user      = User::find(Auth::id());
        $users     = User::where('id', '>', 1)->get();
        $package   = Packages::all();

        return view('app.admin.report.salesreport', compact('title', 'users', 'user', 'sub_title', 'base', 'method', 'package'));
    }

    public function salereportview(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'start' => 'required|date',
            'end'   => 'required|date|',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($request->user_id != 'all') {
            $request->username = $request->user_id;
        }

        $title      = 'ddfdf';
        $sub_title  = trans('report.sales_report');
        $base       = trans('report.report');
        $method     = trans('report.sales_report');
        $reportdata = PurchaseHistory::where('purchase_history.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
            ->where('purchase_history.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('purchase_history.status', '=', 'approved')
            ->where(function ($query) use ($request) {
                if ($request->username != 'all') {
                    $query->where('purchase_history.user_id', '=', $request->username);
                }
                if ($request->package != 'all') {
                    $query->where('users.package', '=', $request->package);
                }
            })
            ->join('users', 'users.id', '=', 'purchase_history.user_id')
            ->join('packages', 'packages.id', '=', 'users.package')
            ->select('purchase_history.*', 'users.username', 'users.user_id as userid', 'users.lastname', 'users.name', 'packages.package')
            ->orderBy('purchase_history.created_at', 'ASC')
            ->get();

        return view('app.admin.report.salereportview', compact('title', 'reportdata', 'sub_title', 'base', 'method'));

    } 
   
     public function topEnrollerReport()
    {
        $title     = trans('report.top_enroller_report');
        $sub_title = trans('report.top_enroller_report');
        $base      = trans('report.top_enroller_report');
        $method    = trans('report.top_enroller_report');

        return view('app.admin.report.topenrollerreport', compact('title','sub_title', 'base', 'method'));
    }
    
    public function topEnrollerReportView(Request $request){

        // dd($request->all());
        $title     = trans('report.top_enroller_report');
        $sub_title = trans('report.top_enroller_report');
        $base      = trans('report.report');
        $method    = trans('report.top_enroller_report');
        $reportdata = Sponsortree::where('sponsortree.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))->where('sponsortree.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
            ->where('sponsortree.type','<>','vaccant')
            ->join('users', 'users.id', '=', 'sponsortree.sponsor')
            ->join('profile_infos', 'profile_infos.user_id', '=', 'sponsortree.sponsor')
            ->join('packages', 'packages.id', '=', 'profile_infos.package')
            ->groupBy('sponsortree.sponsor')
            ->select('users.username', 'users.name', 'users.lastname','users.email' ,'packages.package', DB::raw('COUNT(sponsortree.user_id) as referals'))
            ->orderby('referals', 'DESC')
            ->get();

         return view('app.admin.report.topenrollerreportview', compact('title', 'reportdata', 'sub_title', 'base', 'method'));
          
    }
     public function pairingreport()
    {
            $title = trans('report.pairing_report');
            $sub_title = trans('report.pairing_report');
            $base =trans('report.report');
            $method = trans('report.pairing_report');
            $user = User::find(Auth::id());
             $users = User::where('id','>',1)->get();
            $packages = Packages::all();

            return view('app.admin.report.pairingreport',compact('title','user','users','sub_title','base','method','packages'));
    }

    public function pairingreportview(Request $request)
    {
                        
            $validator=Validator::make($request->all(),[
                'start'=>'required|date',
                'end'=>'required|date|'                 
                ]);
            if($validator->fails())
                return  redirect()->back()->withErrors($validator);


            $title =trans('report.pairing_report');   
            $sub_title = trans('report.pairing_report');
            $base = trans('report.report');
            $method = trans('report.pairing_report');

            $reportdata=PairingHistory::join('users','users.id','pairing_history.user_id')
                      ->where('pairing_history.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
                      ->where('pairing_history.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
                      ->select('users.username','pairing_history.left_carry','pairing_history.right_carry','pairing_history.pairing_carry as carry','pairing_history.amount','pairing_history.created_at')
                      ->get();


        return view('app.admin.report.pairingreportview',compact('title','reportdata','sub_title','base','method'));
    }

    public function carryreportview(Request $request)
    {
            
            Assets::AddCSS(asset('assets/globals/css/print.css'));
            
            $validator=Validator::make($request->all(),[
                'start'=>'required|date',
                'end'=>'required|date|'                 
                ]);
            if($validator->fails())
                return  redirect()->back()->withErrors($validator);
            
            if($request->user_id != 'all'){
                $request->username = $request->user_id; 
            }
            $title =trans('admin/report.carry_forward'); 
            $sub_title = trans('admin/report.pairing_report');
            $base = trans('admin/report.report');
            $method = trans('admin/report.pairing_report');

            if(date('l',strtotime($request->start)) != 'Sunday'){

                 $nextSunday = strtotime('last Sunday',strtotime($request->start));
                 $request->start = date('Y-m-d', $nextSunday);
            }
            if(date('l',strtotime($request->end)) != 'Saturday'){

                $nextSaturday = strtotime('next Saturday',strtotime($request->end));
                $request->end = date('Y-m-d', $nextSaturday);

            }

            $date_arr = array();
            $start_date = date('Y-m-d', strtotime($request->start));
            $end_date = date('Y-m-d', strtotime($request->end));

            while ( strtotime($end_date) >= strtotime('next Saturday',strtotime($start_date))) {
              $date_arr[] = array('start' => $start_date,'end'  =>date('Y-m-d',strtotime('next Saturday',strtotime($start_date))));
              $start_date = date('Y-m-d',strtotime('next Sunday',strtotime($start_date)));
            }         
            $final_arr = [] ;

                foreach ($date_arr as $key => $value) {
                    $final_arr[] = $reportdata=CarryForwardHistory::where('carry_forward_history.created_at' ,'>',date('Y-m-d 00:00:00',strtotime($value['start'])))
                            ->where('carry_forward_history.created_at', '<',date('Y-m-d 23:59:59',strtotime($value['end'])))
                             ->where(function($query) use($request){
                                if($request->username != 'all'){
                                    $query->where('carry_forward_history.user_id','=',$request->username);
                                }
                                if($request->position != 'all'){
                                    $query->where('users.package','=',$request->position);
                                }      
                            })
                            ->join('users','users.id','=','carry_forward_history.user_id')
                            ->select('users.username','users.lastname','users.name','carry_forward_history.*')
                            ->orderBy('created_at','ASC')
                            ->get();
                }    
            return view('app.admin.report.carryreportview',compact('title','final_arr','date_arr','sub_title','base','method'));
    }

    public function paymentReport(){

        $title = 'Annual and monthly payment report';
        $sub_title =  'Annual and monthly payment report';
        $base =  'Annual and monthly payment report';
        $method =  'Annual and monthly payment report';
        return view('app.admin.report.paymentreport',compact('title','sub_title','base','method'));

    }

    public function paymentReportView(Request $request){

        $validator = Validator::make($request->all(), [
            'start' => 'required|date',
            'end'   => 'required|date|',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $title = 'Annual and monthly payment report';
        $sub_title =  'Annual and monthly payment report';
        $base =  'Annual and monthly payment report';
        $method =  'Annual and monthly payment report';
        $app        = AppSettings::find(1);

        $reportdata1 = array();
        $reportdata2 = array();
        $reportdata1 = IpnResponse::where('ipn_response.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
                                   ->where('ipn_response.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
                                   ->where('ipn_response.payment_status','Completed')
                                   ->join('users', 'users.id', '=', 'ipn_response.user_id')
                                   ->join('packages', 'packages.id', '=', 'ipn_response.package_id')
                                   ->join('pending_transactions','pending_transactions.paypal_agreement_id','=','ipn_response.payment_id')
                                    // ->select('users.username', 'users.name', 'users.lastname', 'users.email','packages.package', 'ipn_response.payment_cycle','ipn_response.payment_date','ipn_response.next_payment_date','ipn_response.profile_status','ipn_response.initial_payment_amount','ipn_response.amount_per_cycle','ipn_response.payment_status','ipn_response.created_at')
                                   ->select('users.username', 'users.name', 'users.lastname', 'users.email','packages.package', 'ipn_response.payment_cycle','ipn_response.amount_per_cycle','pending_transactions.payment_method','ipn_response.profile_status','ipn_response.payment_status','ipn_response.profile_status as payment_type','ipn_response.created_at','ipn_response.response as resp');

        $reportdata2 = PendingTransactions::where('pending_transactions.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
                                   ->where('pending_transactions.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
                                   // ->where('pending_transactions.payment_type','=','upgrade') 
                                   ->where('pending_transactions.payment_method','<>','paypal')
                                   ->where('pending_transactions.payment_status','=','complete')
                                   ->leftjoin('users', 'users.id', '=', 'pending_transactions.user_id')
                                   ->leftjoin('packages', 'packages.id', '=', 'pending_transactions.package')
                                  
                                   ->select('users.username', 'users.name', 'users.lastname', 'users.email','packages.package', 'pending_transactions.payment_period','pending_transactions.amount','pending_transactions.payment_method','pending_transactions.payment_status as profile_status','pending_transactions.payment_status','pending_transactions.payment_type','pending_transactions.created_at','pending_transactions.request_data as resp');
                        
         

         $users = $reportdata1->union($reportdata2)->orderBy('created_at', 'DESC')->get();

         // dd($users);



        return view('app.admin.report.paymentreportview', compact('title', 'sub_title', 'base', 'method','app','users'));

    }


    public function joiningfeereport(){

        $title = 'Joiningfee Report';
        $sub_title = 'Joiningfee Report';
        $base =  'Joiningfee Report';
        $method =  'Joiningfee Report';
        return view('app.admin.report.joiningfeereport',compact('title','sub_title','base','method'));

    }

    public function joiningfeereportview(Request $request){

        $validator = Validator::make($request->all(), [
            'start' => 'required|date',
            'end'   => 'required|date|',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $title = 'Joiningfee Report';
        $sub_title =  'Joiningfee Report';
        $base =  'Joiningfee Report';
        $method = 'Joiningfee Report';
        $app        = AppSettings::find(1);

        $reportdata = array();
      

        $reportdata = PendingTransactions::where('pending_transactions.created_at', '>', date('Y-m-d 00:00:00', strtotime($request->start)))
                                   ->where('pending_transactions.created_at', '<', date('Y-m-d 23:59:59', strtotime($request->end)))
                                   ->where('pending_transactions.payment_type','=','register') 
                                   // ->where('pending_transactions.payment_method','<>','paypal')
                                   ->where('pending_transactions.payment_status','=','complete')
                                   ->leftjoin('users', 'users.id', '=', 'pending_transactions.user_id')
                                   //->leftjoin('packages', 'packages.id', '=', 'pending_transactions.package')
                                  
                                   ->select('users.username', 'users.name', 'users.lastname', 'users.email','pending_transactions.amount','pending_transactions.payment_method','pending_transactions.payment_status as profile_status','pending_transactions.payment_status','pending_transactions.payment_type','pending_transactions.created_at','pending_transactions.request_data as resp')->get();
           
                        
        

         $users = $reportdata;

         // dd($users);



        return view('app.admin.report.joiningfeereportview', compact('title', 'sub_title', 'base', 'method','app','users'));

    }


    



}
