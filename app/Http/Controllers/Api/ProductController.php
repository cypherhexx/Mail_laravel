<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;



use Assets;
use View;
use Response;
use Session;
use Auth;
use App\Products;
use Validator;

class ProductController extends Controller
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

   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|',
            'product' => 'required|',
            'size' => 'required|',        
            'member_amount' => 'required|',
            'nonmember_amount' => 'required|',
            'bv' => 'required|',
            'action' => 'required',
        ]);

        if($validator->fails()){

            return Response::json($validator->errors());

        }else{  
         
            if(trim($request->action) == 'createORupdate'){
                $products = Products::firstOrNew(['id' => $request->id]);
                $products->product = $request->product;
                $products->size = $request->size;
                $products->member_amount = $request->member_amount;
                $products->nonmember_amount = $request->nonmember_amount;
                $products->pv = $request->bv;
                $products->save();
                return Response::json($products);

            }elseif(trim($request->action) == 'delete'){
                  // echo "hereree" ;
                 $products = Products::find($request->id);
                 $products->delete();
                 return Response::json(['message'=>'succes','1000'=>'OK'])->header('Content-Type','application/json');
            }


            

        }
    }
}
