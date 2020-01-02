<?php
namespace App\Http\Controllers\Admin\Marketing\Campaign;
use App\AutoResponse;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Session;
use App\Models\Marketing\EmailCampaign;

class CampaignController extends AdminController {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title     = trans('campaign.campaigns');
        $sub_title = trans("campaign.view_and_manage_campaigns");
        $base   = trans('campaign.campaigns');
        $method = trans("campaign.view_and_manage_campaigns");
        $emailcampaignlist = EmailCampaign::all();
        return view('app.admin.campaign.campaign.campaigns', compact('title', 'sub_title', 'base', 'method','emailcampaignlist'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title     = trans('campaign.create_campaign');
        $sub_title = trans("campaign.create_campaign");
        $base   = trans('campaign.create_campaign');
        $method = trans("campaign.create_campaign");
        return view('app.admin.campaign.campaign.create_campaign', compact('title', 'sub_title', 'base', 'method'));
    }


  public function store(Request $request){

 
     $validator = Validator::make($request->all(), [
            'name' => 'bail|required',           
            'customer_group' => 'bail|required',           
            'first_name' => 'bail|required',           
            'last_name' => 'bail|required',           
            'from_email' => 'bail|required|email',           
            'subject' => 'bail|required',           
            'datetime' => 'bail|required',           
            'campaignemail' => 'bail|required',           
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($validator);
        }else{


            EmailCampaign::create([
                    'name' => $request->name,
                    'customer_group' => $request->customer_group,
                    'first_name' => $request->first_name ,       
                    'last_name' => $request->last_name,
                    'from_email' => $request->from_email,
                    'subject' => $request->subject,
                    'datetime' => date('Y-m-d',strtotime($request->datetime)),           
                    'campaign-email' => trim($request->campaignemail)
            ]);

                 Session::flash('flash_notification', array('level' => 'success', 'message' => 'Campaign created '));

                  return redirect('admin/campaign/lists');



        }
   
    
  }



  public function edit(Request $request,$id){

        $emailcampaign = EmailCampaign::findOrFail($id);
        $title     = trans('campaign.edit_campaign');
        $sub_title = trans("campaign.edit_campaign");
        $base   = trans('campaign.edit_campaign');
        $method = trans("campaign.edit_campaign");
        return view('app.admin.campaign.campaign.create_campaign', compact('title', 'sub_title', 'base', 'method','emailcampaign'));   
    
  }

  public function save(Request $request,$id){


 
     $validator = Validator::make($request->all(), [
            'name' => 'bail|required',           
            'customer_group' => 'bail|required',           
            'first_name' => 'bail|required',           
            'last_name' => 'bail|required',           
            'from_email' => 'bail|required|email',           
            'subject' => 'bail|required',           
            'datetime' => 'bail|required',           
            'campaignemail' => 'bail|required',           
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($validator);
        }else{


          $item = EmailCampaign::findOrFail($id);
          $item->name = $request->name;
          $item->customer_group = $request->customer_group;
          $item->first_name = $request->first_name ;
          $item->last_name = $request->last_name;
          $item->from_email = $request->from_email;
          $item->subject = $request->subject;
          $item->datetime = date('Y-m-d',strtotime($request->datetime));
          $item->campaignemail = $request->campaignemail ;
          $item->save();

          Session::flash('flash_notification', array('level' => 'success', 'message' => 'Campaign updated '));
          return redirect('admin/campaign/lists');



        }
  }

  public function changestatus(Request $request){
     // dd($request->all());

        $item = EmailCampaign::find($request->id);
        $item->status = $request->status;
        $item->save();

  }


  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autorespondersIndex()
    {
        $title     = trans('campaign.auto_reponders');
        $sub_title = trans("campaign.view_and_manage_autoresponders");
        $base   = trans('campaign.auto_reponders');
        $method = trans("campaign.view_and_manage_autoresponders");
        return view('app.admin.campaign.autoresponder.autoresponders', compact('title', 'sub_title', 'base', 'method','emailcampaignlist'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAutoResponder()
    {
        $title     = trans('campaign.create_campaign');
        $sub_title = trans("campaign.create_campaign");
        $base   = trans('campaign.create_campaign');
        $method = trans("campaign.create_campaign");
        return view('app.admin.campaign.campaign.create_campaign', compact('title', 'sub_title', 'base', 'method'));
    }




}
