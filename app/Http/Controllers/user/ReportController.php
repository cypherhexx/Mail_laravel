<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Country;
use App\User;
use App\Ranksetting;
use App\Rankhistory;
use App\Voucher;
use App\Commission;
use App\Payout;
use App\Mail;
use App\Sales;
use App\PointHistory;
use App\Sponsortree;
use App\Packages;
use App\PairingHistory;
use App\CarryForwardHistory;
use App\PurchaseHistory;
use App\Currency;
use Auth;
use DB;
use Validator;


use App\Http\Controllers\user\UserAdminController;

class ReportController extends UserAdminController
{
     public function pvreport()
        {
            $title =trans('report.bonus_report');
            $sub_title = trans('report.bonus_report');
            $unread_count  = Mail::unreadMailCount(Auth::id());
            $unread_mail  = Mail::unreadMail(Auth::id());
            $base = trans('report.bonus_report');
            $method = trans('report.bonus_report');
             $users = Sponsortree::getDownlines(True,Auth::user()->id);
             $users = Sponsortree::$downline;

            
            $userss = User::getUserDetails(Auth::id());
            $user = $userss[0];
            return view('app.user.report.pvreport',compact('title','unread_count','unread_mail','users','user','sub_title','base','method'));
        } 

        public function pvreportview(Request $request)
        {

        
            
            $validator=Validator::make($request->all(),[
                'start'=>'required|date',
                'end'=>'required|date|'                 
                ]);
            if($validator->fails())
                return  redirect()->back()->withErrors($validator);
            
            $title =trans('report.bonus_report'); 
            $sub_title = trans('report.bonus_report');  
            $base = trans('report.bonus_report');
            $method = trans('report.bonus_view');
            $variable = Sponsortree::getDownlines(True,Auth::user()->id);
              $variable = Sponsortree::$downline;
            $reportdata=PointHistory::where('point_history.created_at' ,'>',date('Y-m-d 00:00:00',strtotime($request->start)))
            ->where('point_history.created_at', '<',date('Y-m-d 23:59:59',strtotime($request->end)))
            ->where(function($query) use($request,$variable){
                if($request->bonus_type != 'All'){
                    $query->where('point_history.commision_type','=',$request->bonus_type);
                }
                if($request->username != 'all'){
                    $query->where('point_history.user_id','=',$request->username);
                }else{
                     
                     foreach ($variable as $key => $value) {
                         $query->orwhere('point_history.user_id','=',$value['id']);
                     }
                }
            })
            ->join('users as fromuser','fromuser.id','=','point_history.from_id')
            ->join('users as touser','touser.id','=','point_history.user_id')
           
            ->select('fromuser.username as fromusername','touser.lastname','touser.name','touser.email','touser.username as tousername','point_history.*')
            ->get(); 
             
             $totalredeem_pv=PointHistory::where('point_history.created_at' ,'>',date('Y-m-d 00:00:00',strtotime($request->start)))
             ->where('point_history.created_at', '<',date('Y-m-d 23:59:59',strtotime($request->end))) 
              ->where(function($query) use($request,$variable){
                if($request->bonus_type != 'All'){
                    $query->where('point_history.commision_type','=',$request->bonus_type);
                }
                 if($request->username != 'all'){
                    $query->where('point_history.user_id','=',$request->username);
                }else{
                     
                     foreach ($variable as $key => $value) {
                         $query->orwhere('point_history.user_id','=',$value['id']);
                     }
                }
            })       
            ->sum('point_history.redeem_pv');

            $totalpv=PointHistory::where('point_history.created_at' ,'>',date('Y-m-d 00:00:00',strtotime($request->start)))
            ->where('point_history.created_at', '<',date('Y-m-d 23:59:59',strtotime($request->end)))   
             ->where(function($query) use($request,$variable){
                if($request->bonus_type != 'All'){
                    $query->where('point_history.commision_type','=',$request->bonus_type);
                }
                 if($request->username != 'all'){
                    $query->where('point_history.user_id','=',$request->username);
                }else{
                     
                     foreach ($variable as $key => $value) {
                         $query->orwhere('point_history.user_id','=',$value['id']);
                     }
                }

            })     
            ->sum('point_history.pv'); 


              
           return view('app.user.report.pvreportview',compact('title','reportdata','totalpv','totalredeem_pv','sub_title','base','method'));
        }


       
         public function ewalletreport()
        {
            $title = trans('report.income_report'); 
            $sub_title = trans('report.income_report'); 
            $base = trans('report.report');
            $method = trans('report.income_report'); 
           
            $user = User::find(Auth::id());
             $users = Sponsortree::getDownlines(True,Auth::user()->id);
             $users = Sponsortree::$downline;
             $packages = Packages::all();
            return view('app.user.report.ewalletreport',compact('title','user','users','sub_title','base','method','packages'));
        } 

    public function ewalletreportview(Request $request)
        {
            
         
            
            $validator=Validator::make($request->all(),[
                'start'=>'required|date',
                'end'=>'required|date|'                 
                ]);
            if($validator->fails())
                return  redirect()->back()->withErrors($validator);            
            
            $title = trans('report.income_report');   
            $sub_title = trans('report.income_report');   
            $base = trans('report.report');
            $method = trans('report.income_report');   

            $reportdata=Commission::where('commission.created_at' ,'>',date('Y-m-d 00:00:00',strtotime($request->start)))
            ->where('commission.created_at', '<',date('Y-m-d 23:59:59',strtotime($request->end)))
            ->where('commission.total_amount', '>',0)
            ->where('commission.user_id', '=',Auth::user()->id)
            ->where('commission.payment_status','=','yes')             
            ->join('users','users.id','=','commission.user_id')
            ->join('users as from','from.id','=','commission.from_id')
             ->join('packages','packages.id','=','commission.package')
            ->select('users.username','users.lastname','users.name','commission.created_at','commission.payable_amount' ,'commission.payment_type','from.username as fromuser','packages.package')->orderby('created_at','ASC');

          
            $reportdata= $reportdata->get();
            // dd($reportdata);
           
           return view('app.user.report.ewalletreportview',compact('title','reportdata','sub_title','base','method'));
        }



          public function pairingreport()
        {
            $title = 'Pairing report';
            $sub_title ='Pairing report';
            $base = 'Pairing report';
            $method = 'Pairing report';
           
            $user = User::find(Auth::id());
             Sponsortree::getDownlines(True,Auth::user()->id);
             $users = Sponsortree::$downline;

             
            $packages = Packages::all();
            return view('app.user.report.pairingreport',compact('title','user','users','sub_title','base','method','packages'));
        }

        public function pairingreportview(Request $request)
        {
            
           
            
            $validator=Validator::make($request->all(),[
                'start'=>'required|date',
                'end'=>'required|date|'                 
                ]);
            if($validator->fails())
                return  redirect()->back()->withErrors($validator);


            if($request->user_id != 'all'){
                $request->username = $request->user_id;
            }
            
            $title = 'Pairing report';  
            $sub_title = trans('report.income_report');
            $base = trans('report.report');
            $method = trans('report.income_report');


            Sponsortree::$downline= Sponsortree::$downlineIDArray = array();

            Sponsortree::getDownlines(True,Auth::user()->id);
            $variable = Sponsortree::$downline;
            $downlineIDArray = Sponsortree::$downlineIDArray;

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

             $final_arr[]  = $reportdata=PairingHistory::where('pairing_history.created_at' ,'>',date('Y-m-d 23:59:59',strtotime($value['start'])))
            ->where('pairing_history.created_at', '<',date('Y-m-d 23:59:59',strtotime($value['end'])))
             ->where(function($query) use($request,$variable,$downlineIDArray){
                if($request->username != 'all'){
                    $query->where('pairing_history.user_id','=',$request->username);
                }elseif($request->position != 'all'){
                  $package_users = User::where('package','=',$request->position)
                                                ->whereIn('id', $downlineIDArray)
                                                ->select('id')
                                                ->get();
                                    $userlist = array() ;
                               foreach ($package_users as $key => $value) {
                                array_push($userlist, $value->id)   ;
                                }
                                $query->wherein('pairing_history.user_id',$package_users);
                }else{
                       $query->wherein('pairing_history.user_id',$downlineIDArray);                   
                }
            })
            ->join('users','users.id','=','pairing_history.user_id')
            ->select('users.username','users.lastname','users.name','pairing_history.*')
            ->orderBy('created_at','ASC')
            ->get();

          }
            
            
           
           return view('app.user.report.pairingreportview',compact('title','reportdata','final_arr','date_arr','sub_title','base','method'));
        }


         public function carryreportview(Request $request)
        {
            
           
            
            $validator=Validator::make($request->all(),[
                'start'=>'required|date',
                'end'=>'required|date|'                 
                ]);
            if($validator->fails())
                return  redirect()->back()->withErrors($validator);


             if($request->user_id != 'all'){
                $request->username = $request->user_id;
            }
            
            $title ='Carry forward';   
            $sub_title = trans('report.pairing_report');
            $base = trans('report.report');
            $method = trans('report.pairing_report');

             Sponsortree::getDownlines(True,Auth::user()->id);
            $variable = Sponsortree::$downline;
            $downlineIDArray = Sponsortree::$downlineIDArray;


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
                             ->where(function($query) use($request,$variable,$downlineIDArray){
                                if($request->username != 'all'){
                                    $query->where('carry_forward_history.user_id','=',$request->username);
                                }else{
                                     foreach ($variable as $key => $value) {
                                       $query->orwhere('carry_forward_history.user_id','=',$value['id']);
                                    }
                                }
                                if($request->position != 'all'){
                                     $package_users = User::where('package','=',$request->position)
                                                ->whereIn('id', $downlineIDArray)
                                                ->select('id')
                                                ->get();
                                   foreach ($package_users as $key => $value) {
                                       $query->orwhere('pairing_history.user_id','=',$value->id);
                                    }

                                    // $query->where('users.package','=',$request->position);
                                }
                                    // $query->orwhere('carry_forward_history.left','>',0);
                                    // $query->orwhere('carry_forward_history.right','>',0);
                            })
                            ->join('users','users.id','=','carry_forward_history.user_id')
                            ->select('users.username','users.lastname','users.name','carry_forward_history.*')
                            ->orderBy('created_at','ASC')
                            ->orderBy('carry_forward_history.user_id','ASC')
                            ->get();
                   
                }            
            
           
           return view('app.user.report.carryreportview',compact('title','final_arr','date_arr','sub_title','base','method'));
        }

         public function maintenancereport()
        {
            $title ="Maintenance report";
            $sub_title = "Maintenance report";
            $base = 'Report';
            $method = 'Maintenance report';
            $user = User::find(Auth::id());
             $users = User::where('id','>',1)->get();

            return view('app.user.report.maintenancereport',compact('title','users','user','sub_title','base','method'));
        } 
         public function maintenancereportview(Request $request)
        { 
            $title ="Maintenance report";
            $sub_title = "Maintenance report";
            $base = 'Report';
            $method = 'Maintenance report';
            $users = array() ;

            Sponsortree::$downline= Sponsortree::$downlineIDArray = array();

            Sponsortree::getDownlines(True,Auth::user()->id);
            $variable = Sponsortree::$downline;
            $downlineIDArray = Sponsortree::$downlineIDArray;

            if($request->bv == 'n'){
                $users  =User::rightjoin('purchase_history','purchase_history.user_id','=','users.id')
                        ->whereYear('purchase_history.created_at','=',date('Y',strtotime($request->start)))
                        ->whereMonth('purchase_history.created_at','=',date('m',strtotime($request->start)))
                        ->where('purchase_history.status','=','approved')
                        ->whereIn('purchase_history.user_id', $downlineIDArray)
                        ->leftjoin('packages','packages.id','=','users.package')
                        ->select('users.username','users.id','users.name','packages.package','users.lastname','users.user_id',DB::raw('SUM(purchase_history.BV) as BV'))
                         ->having(DB::raw('SUM(purchase_history.BV)'),'<',100)
                        ->groupBY('purchase_history.user_id')
                        ->get();

            }elseif($request->bv == 'm'){
                $users  =User::rightjoin('purchase_history','purchase_history.user_id','=','users.id')
                        ->whereYear('purchase_history.created_at','=',date('Y',strtotime($request->start)))
                        ->whereMonth('purchase_history.created_at','=',date('m',strtotime($request->start)))
                        ->where('purchase_history.status','=','approved')
                        ->whereIn('purchase_history.user_id', $downlineIDArray)
                        ->leftjoin('packages','packages.id','=','users.package')
                        ->select('users.username','users.id','users.name','packages.package','users.lastname','users.user_id',DB::raw('SUM(purchase_history.BV) as BV'))
                         ->having(DB::raw('SUM(purchase_history.BV)'),'>=',100)
                        ->groupBY('purchase_history.user_id')
                        ->get();

            }else{
                $users = $downlineIDArray ;
            }

            // print_r($users->all()) ;
            

                $users_in = array();
               
               foreach ($users as $key => $value) {
                if(isset($value->id))
                    array_push($users_in, $value->id);
                else
                    array_push($users_in, $value);

               }

               $user_list = User::where(function($query) use($users_in){
                                $query->whereIn('users.id',$users_in);
                                 })
                            ->leftjoin('packages','packages.id','=','users.package')
                            ->select('users.*','packages.package')
                            ->get();

                $reportdata = array() ;
               
               foreach ($user_list as $key => $value) {
                    $bv = PurchaseHistory::getMonthlyTotal($value->id,$request->start) ;
                     if($bv>=100){ $status = 'Maintain' ;} else{ $status = 'Not Maintain' ;}
                   $reportdata[] =  array(
                                        'username' => $value->username,
                                        'user_id' => $value->user_id,
                                        'name' => $value->name .' ' .$value->lastname,
                                        'package' => $value->package,
                                        'BV' => $bv,
                                        'status' =>$status
                                         );
               }




            return view('app.user.report.maintenancereportview',compact('title','sub_title','base','method','reportdata'));
        } 




        public function payoutreport()
        {
            $title =trans('report.payout_released_report');
            $sub_title = trans('report.payout_release_report');
            $base = trans('report.report');
            $method = trans('report.payout_release_report');
            Sponsortree::getDownlines(True,Auth::user()->id);
             $users = Sponsortree::$downline;
            $packages = Packages::all();
            $user = User::find(Auth::user()->id);
            return view('app.user.report.payoutreport',compact('title','users','user','packages','sub_title','base','method'));
        } 

    public function payoutreportview(Request $request)
        {

            
            
            $validator=Validator::make($request->all(),[
                'start'=>'required|date',
                'end'=>'required|date|'                 
                ]);
            if($validator->fails())
                return  redirect()->back()->withErrors($validator);

             if($request->user_id  != 'all' ){
                $request->username = $request->user_id ;
            }
            
            $title =trans('report.payout_released_report'); 
            $sub_title = trans('report.payout_release_report');  
            $base = trans('report.report');
            $method = 'Payout release report view';

             Sponsortree::$downline= Sponsortree::$downlineIDArray = array();

            Sponsortree::getDownlines(True,Auth::user()->id);
            $variable = Sponsortree::$downline;
            $downlineIDArray = Sponsortree::$downlineIDArray;


            $reportdata=Payout::where('payout_request.created_at' ,'>',date('Y-m-d 00:00:00',strtotime($request->start)))
            ->where('payout_request.created_at', '<',date('Y-m-d 23:59:59',strtotime($request->end)))

                ->where(function($query) use($request,$variable,$downlineIDArray){
                if($request->username !== 'all'){
                    $query->where('payout_request.user_id','=',$request->username);
                }elseif ($request->position !== 'all') {
                   $package_users = User::where('package','=',$request->position)
                                                ->whereIn('id', $downlineIDArray)
                                                ->select('id')
                                                ->get();
                                $userlist =array();
                               foreach ($package_users as $key => $value) {
                                    array_push($userlist, $value->id);
                                }
                                   $query->wherein('payout_request.user_id',$userlist);
                }else{
                    $query->wherein('payout_request.user_id',$downlineIDArray);
                }
            })              
            ->join('users','users.id','=','payout_request.user_id')
            ->join('currency','currency.id','=','users.currency')
            ->select('users.username','users.lastname','users.name','users.user_id as userid','payout_request.*','currency.symbol_right','currency.symbol_left','currency.value')
            ->get(); 
           
           return view('app.user.report.payoutreportview',compact('title','reportdata','totalamount','sub_title','base','method'));
        } 

          public function salereport()
        {
            $title ="Transaction report";
            $sub_title = "Transaction report";
            $base = 'Report';
            $method = 'Transaction report';
            $user = User::find(Auth::id());
             Sponsortree::getDownlines(True,Auth::user()->id);
             $users = Sponsortree::$downline;
             $package = Packages::all();

            return view('app.user.report.salesreport',compact('title','users','user','sub_title','base','method','package'));
        } 


         public function salereportview(Request $request){

           
            
            $validator=Validator::make($request->all(),[
                'start'=>'required|date',
                'end'=>'required|date|'                 
                ]);
            if($validator->fails())
                return  redirect()->back()->withErrors($validator);

             if($request->user_id  != 'all' ){
                $request->username = $request->user_id ;
            }
            
            $title ="Transaction report"; 
            $sub_title = "Transaction report";  
            $base = 'Report';
            $method = 'Transaction report';

             Sponsortree::$downline= Sponsortree::$downlineIDArray = array();

            Sponsortree::getDownlines(True,Auth::user()->id);
            $variable = Sponsortree::$downline;
            $downlineIDArray = Sponsortree::$downlineIDArray;



            $reportdata=PurchaseHistory::where('purchase_history.created_at' ,'>',date('Y-m-d 00:00:00',strtotime($request->start)))
            ->where('purchase_history.created_at', '<',date('Y-m-d 23:59:59',strtotime($request->end)))
            ->where('purchase_history.status','=','approved')
             ->where(function($query) use($request,$variable,$downlineIDArray){
                if($request->username != 'all'){
                    $query->where('purchase_history.user_id','=',$request->username);
                }elseif ($request->position !='all' ) {
                     $package_users = User::where('package','=',$request->position)
                                                ->whereIn('id', $downlineIDArray)
                                                ->select('id')
                                                ->get();
                                    $userlist =array() ;
                               foreach ($package_users as $key => $value) {
                                    array_push($userlist, $value->id);
                                }
                                   $query->wherein('purchase_history.user_id',$userlist);
                }else{
                    $query->wherein('purchase_history.user_id',$downlineIDArray);
                }
                
            })
            ->join('users','users.id','=','purchase_history.user_id')
            ->join('packages','packages.id','=','users.package')
            ->select('purchase_history.*','users.username','users.user_id as userid','users.lastname','users.name','packages.package')
            ->orderBy('purchase_history.created_at','ASC')
            ->get();
              
           return view('app.user.report.salereportview',compact('title','reportdata','sub_title','base','method'));

        }


         public function summuryreport()
        {
            $title ="Summary report";
            $sub_title = "Summury report";
            $base = 'Report';
            $method = 'Summury report';
            $user = User::find(Auth::id());
             Sponsortree::getDownlines(True,Auth::user()->id);
             $users = Sponsortree::$downline;

            return view('app.user.report.summuryreport',compact('title','users','user','sub_title','base','method'));
        } 

        public function summuryreportview(Request $request){

             $title ="Summary report";
            $sub_title = "Summury report";
            $base = 'Report';
            $method = 'Summury report';
            $user = User::find($request->username);

             Sponsortree::getDownlines(True,Auth::user()->id);
            $variable = Sponsortree::$downline;
            $downlineIDArray = Sponsortree::$downlineIDArray;



    $direct_sponsor    = Commission::whereYear('commission.created_at','=',date('Y',strtotime($request->start)))
                        ->whereMonth('commission.created_at','=',date('m',strtotime($request->start)))
                        ->where('commission.payment_type','=','direct_sponsor_bonus')
                        ->where('commission.payment_status','=','yes')
                        ->where(function($query) use($request,$downlineIDArray,$variable){
                            if($request->username != 'all'){
                                $query->where('commission.user_id','=',$request->username);
                            }else{
                                 $query->wherein('commission.user_id',$downlineIDArray);
                            }
                        })
                        ->join('users','users.id','=','commission.user_id')
                        ->join('users as from','from.id','=','commission.from_id')
                        ->select('users.username','users.name','users.lastname','from.username as fromuser','commission.*')
                        ->get();
    $total_direct_sponsor = Commission::whereYear('commission.created_at','=',date('Y',strtotime($request->start)))
                        ->whereMonth('commission.created_at','=',date('m',strtotime($request->start)))
                        ->where('commission.payment_type','=','direct_sponsor_bonus')
                        ->where('commission.payment_status','=','yes')
                        ->where(function($query) use($request,$variable,$downlineIDArray){
                            if($request->username != 'all'){
                                $query->where('commission.user_id','=',$request->username);
                            }else{
                                $query->wherein('commission.user_id',$downlineIDArray);
                              
                            }
                        })
                        ->sum('commission.payable_amount');

    $pairing_bonus           =PairingHistory::whereYear('pairing_history.created_at','=',date('Y',strtotime($request->start)))
                        ->whereMonth('pairing_history.created_at','=',date('m',strtotime($request->start)))
                        ->where(function($query) use($request,$variable,$downlineIDArray){
                            if($request->username != 'all'){
                                $query->where('pairing_history.user_id','=',$request->username);
                            }else{
                                $query->wherein('pairing_history.user_id',$downlineIDArray);
                               
                            }
                        })
                        ->join('users','users.id','=','pairing_history.user_id')
                        ->select('users.username','users.name','users.lastname','pairing_history.*')
                        ->get();
     $total_pairing_bonus    =PairingHistory::whereYear('pairing_history.created_at','=',date('Y',strtotime($request->start)))
                        ->whereMonth('pairing_history.created_at','=',date('m',strtotime($request->start)))
                        ->where(function($query) use($request,$variable,$downlineIDArray){
                            if($request->username != 'all'){
                                $query->where('pairing_history.user_id','=',$request->username);
                            }else{
                                $query->wherein('pairing_history.user_id',$downlineIDArray);
                              // foreach ($variable as $key => $value) {
                              //      $query->orwhere('pairing_history.user_id','=',$value['id']);
                              //   }
                            }
                        })
                       ->select(DB::raw('SUM(first_bonus) as first_bonus'),DB::raw('SUM(second_bonus) as second_bonus'),DB::raw('SUM(third_bonus) as third_bonus'))
                        ->get();

    $matching_bonus    = Commission::whereYear('commission.created_at','=',date('Y',strtotime($request->start)))
                        ->whereMonth('commission.created_at','=',date('m',strtotime($request->start)))
                        ->where('commission.payment_type','=','matching_bonus')
                        ->where('commission.payment_status','=','yes')
                        ->where(function($query) use($request,$variable,$downlineIDArray){
                            if($request->username != 'all'){
                                $query->where('commission.user_id','=',$request->username);
                            }else{
                                $query->wherein('commission.user_id',$downlineIDArray);
                                
                            }
                        })
                        ->join('users','users.id','=','commission.user_id')
                        ->join('users as from','from.id','=','commission.from_id')
                        ->select('users.username','users.name','users.lastname','from.username as fromuser','commission.*')
                        ->get();

    $total_matching_bonus    = Commission::whereYear('commission.created_at','=',date('Y',strtotime($request->start)))
                        ->whereMonth('commission.created_at','=',date('m',strtotime($request->start)))
                        ->where('commission.payment_type','=','matching_bonus')
                        ->where('commission.payment_status','=','yes')
                        ->where(function($query) use($request,$variable,$downlineIDArray){
                            if($request->username != 'all'){
                                $query->where('commission.user_id','=',$request->username);
                            }else{
                                 $query->wherein('commission.user_id',$downlineIDArray);
                            }
                        })
                        ->sum('commission.payable_amount');
     $loyalty_bonus    = Commission::whereYear('commission.created_at','=',date('Y',strtotime($request->start)))
                        ->whereMonth('commission.created_at','=',date('m',strtotime($request->start)))
                        ->where('commission.payment_type','=','loyalty_bonus')
                        ->where('commission.payment_status','=','yes')
                        ->where(function($query) use($request,$variable,$downlineIDArray){
                            if($request->username != 'all'){
                                $query->where('commission.user_id','=',$request->username);
                            }else{
                               $query->wherein('commission.user_id',$downlineIDArray);
                            }
                        })
                        ->join('users','users.id','=','commission.user_id')
                        ->join('users as from','from.id','=','commission.from_id')
                        ->select('users.username','users.name','users.lastname','from.username as fromuser','commission.*')
                        ->get();

    $totaloyalty_bonus = Commission::whereYear('commission.created_at','=',date('Y',strtotime($request->start)))
                        ->whereMonth('commission.created_at','=',date('m',strtotime($request->start)))
                        ->where('commission.payment_type','=','loyalty_bonus')
                        ->where('commission.payment_status','=','yes')
                        ->where(function($query) use($request,$variable,$downlineIDArray){
                            if($request->username != 'all'){
                                $query->where('commission.user_id','=',$request->username);
                            }else{
                               $query->wherein('commission.user_id',$downlineIDArray);
                            }
                        })
                       ->sum('commission.payable_amount');


       return view('app.user.report.summuryreportview',compact('title','sub_title','base','method','direct_sponsor','total_direct_sponsor','matching_bonus','total_matching_bonus','pairing_bonus','total_pairing_bonus','loyalty_bonus','totaloyalty_bonus','request','user'));


        }

   

    




}
