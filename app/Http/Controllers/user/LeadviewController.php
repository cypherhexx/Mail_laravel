<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;

use App\Voucher;


use App\LeadCapture;
use Auth;
use DB;
use Input;
use Redirect;
use Session;

use App\Helpers\Thumbnail;
use App\Http\Controllers\user\UserAdminController;
use Response;

class LeadviewController extends UserAdminController
{

         public function leadview()
      {

        $title = trans('lead.lead');
        $sub_title = trans('lead.lead');
        $method = trans('lead.lead');
         
        $data = LeadCapture::where('lead_capture.username',Auth::user()->id)->paginate(10);

        // print_r($data);

       
          return view('app.user.lead.leadview',compact('title','data','sub_title','method'));

      }
        public function updatelead(Request $request)
        {

                
             $settings = LeadCapture::find($request->pk);
              
                 $data_name = $request->name;
                 if($request->name == "status")
                 {

                        if($request->value == "complete"){
                            $request->value = 1;                    
                        }else{
                            $request->value = 0;
                        }

                      
                }
                  $settings-> $data_name= $request->value; 

                if($settings->save()){
                    return Response::json(array('status'=>1));
                }else{
                    return Response::json(array('status'=>0));
                }



         }

        



          public function deletelead(Request $request)
       {
            $requestid=$request->requestid;


         $res = LeadCapture::where('id',$requestid)->delete();
         Session::flash('flash_notification', array('level' => 'success', 'message' => 'lead details deleted successfully'));
         return Redirect::action('user\LeadviewController@leadview');     


       }
          public function getstatus()
      {

       

         $settings=LeadCapture::all();
         
         $response[0]="pending";
       
        $response[1]="complete";
       
        return json_encode($response,false);
         
      }









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
        //
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
