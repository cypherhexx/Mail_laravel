<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;




use Assets;
use Auth;
use Validator;
use Response;
use Session;
use DB;
use App\User;
use App\Products;
use App\PurchaseHistory;
use App\Packages;
use App\PackageHistory;
use App\PointTable;
use App\Commission;
use App\Sponsortree;
use App\Tree_Table;
use App\Sales;



class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'count'=>'required|min:1' ,
            'product'=>'required|exists:products,id|min:1' ,
            'username'=>'required|exists:users,username' 
            ]);

        if($validator->fails()){
            return Response::json($validator->errors());
                          
        }

         $user_id = User::userNameToId($request->username); 
        $order_user = User::find($user_id); 

        $product_details = Products::find($request->product);
        $order =  PurchaseHistory::create([
                'user_id' => $order_user->id,
                'product_id' => $request->product,
                'count' => $request->count,
                'total_amount' => $request->count * $product_details->member_amount,
                'pay_by' => 'cash',
                'status' => 'approved',
                'BV' => $request->count * $product_details->pv,
                ]) ;
        // $order->status = 'approved' ;

        // $order->save();  

        try {
            DB::beginTransaction();

            $user_status = Sponsortree::where('user_id','=',$order->user_id)->pluck('type');
            $monthly_maintenance = User::where('id','=',$order->user_id)->pluck('monthly_maintenance');
            if($user_status == 'no' && $monthly_maintenance == 1){

                $total_bv = PurchaseHistory::where('user_id','=',$order->user_id)
                                            ->where('status','=','approved')
                                            ->sum('BV');
                $max_package = Packages::where('bv','<=', $total_bv)->max('id');
                $user_package = User::where('id',$order->user_id)->pluck('package');
                $user_package_details = Packages::find($user_package);

                if($max_package == $user_package  AND  $total_bv >= $user_package_details->bv){

                        Sponsortree::where('user_id','=',$order->user_id)->update(['type'=>'yes']);
                        Tree_Table::where('user_id','=',$order->user_id)->update(['type'=>'yes']);
                        
                }elseif($max_package > $user_package){

                    $max_package_details = Packages::find($max_package);
                    $last_purchase_pv = PurchaseHistory::where('status','=','approved')
                                        ->where('user_id','=',$order->user_id)
                                        ->orderBy('id','DESC')
                                        ->take(1)
                                        ->pluck('BV');

                     if($last_purchase_pv >= $max_package_details->last_purchase_bv){
                        Sponsortree::where('user_id','=',$order->user_id)->update(['type'=>'yes']);
                        Tree_Table::where('user_id','=',$order->user_id)->update(['type'=>'yes']);

                        User::where('id',$order->user_id)->update(['package'=>$max_package]);

                        PackageHistory::create([
                            'user_id'=>$order->user_id,
                            'package_id'=>$user_package,
                            'new_package_id'=>$max_package,
                            ]);
                    }
                      
                }       

            }elseif ($user_status == 'yes') {

                $total_bv = PurchaseHistory::where('user_id','=',$order->user_id)
                                            ->where('status','=','approved')
                                            ->sum('BV');
                $max_package = Packages::where('bv','<=', $total_bv)->max('id');
                $user_package = User::where('id',$order->user_id)->pluck('package');
                if($max_package > $user_package){

                    $max_package_details = Packages::find($max_package);
                    $last_purchase_pv = PurchaseHistory::where('status','=','approved')
                                        ->where('user_id','=',$order->user_id)
                                        ->orderBy('id','DESC')
                                        ->take(1)
                                        ->pluck('BV');

                     if($last_purchase_pv >= $max_package_details->last_purchase_bv){

                            User::where('id',$order->user_id)->update(['package'=>$max_package]);
                             PackageHistory::create([
                                'user_id'=>$order->user_id,
                                'package_id'=>$user_package,
                                'new_package_id'=>$max_package,
                                ]); 
                    }
                                            
                }
            }

                /**
                                  directSponsorBonus
                */
            $sponsor_id = Sponsortree::getSponsorID($order->user_id);

            $direct_sponsor_bonus = Commission::directSponsorBonus($sponsor_id,$order->user_id,$order->BV);

/**
                 Binary point update 
*/

                    $user_leg = Tree_Table::getUserLeg($order->user_id);
                    $placement_id = Tree_Table::getFatherID($order->user_id);
                    Tree_Table::getAllUpline($placement_id,$user_leg);
                    PointTable::updatePoint($order->BV,$order->user_id);


           
        } catch (Exception $e) {
             DB::rollBack();
                echo 'Caught exception: ',  $e->getMessage(), "\n";
        } finally {
                DB::commit();
                return Response::json(['message'=>'succes','1000'=>'OK'])->header('Content-Type','application/json');
        }




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
