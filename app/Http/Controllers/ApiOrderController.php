<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Response;
use App\Products;
use App\User;
use App\PurchaseHistory;

class ApiOrderController extends Controller
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
            'pay'=>'required' ,

            ]);

        if($validator->fails()){
            return Response::json($validator->errors());
                          
        }

        $user_id = User::userNameToId($request->username); 

        $product_count = $request->count;
        
        $product_id = $request->product; 

        $pay = $request->pay; 


        $product_details = Products::find($product_id); 

        if($pay == 'credits'){

          if(Auth::user()->credits >= $product_count){

              User::where('id','=',$user_id)->decrement('credits',$product_count);
            
          }else{

        
         
            return Response::json( array('message'=>"You don't have enough product credits  "));

          }


        }elseif($pay == 'redeem'){

          $redeem_pv = PointTable::where('user_id','=',Auth::user()->id)->pluck('redeem_pv');

         $total_amount =  $product_count * 160 ; //$product_details->member_amount ;

           if($redeem_pv >= $total_amount){

              PointTable::where('user_id','=',$user_id)->decrement('redeem_pv',$total_amount);

           }else{

            return Response::json(array('message'=>"You don't have enough Credit Points  "));

           }

        }
       
  

        PurchaseHistory::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'count' => $product_count,
                'total_amount' => $product_count * $product_details->member_amount,
                'pay_by' => $pay,
                ]) ;

        
       
return Response::json([1000=>'OK'])->header('Content-Type','application/json');

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
