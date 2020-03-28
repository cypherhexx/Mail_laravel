<?php
namespace App\Http\Controllers\admin;

use App\AppSettings;
use App\AutoResponse;
use App\Emailsetting;
use App\Http\Controllers\Admin\AdminController;
use App\MenuSettings;
use App\PaymentNotification;
use App\PaymentType;
use App\Ranksetting;
use App\Settings;
use App\User;
use App\Welcome;
use App\MyRole;
use App\Roles;
use App\Packages;
use App\ProfileModel;
use App\PurchaseHistory;
use App\RsHistory;
use App\Activity;
use App\settings2;
use App\Category;

use Auth;
use Artisan;
use Illuminate\Http\Request;
use Input;
use Redirect;
use Response;
use Session;
use Validator;
use Log;
use Storage;
use Datatables;

class SettingsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    
    {
        

        $sett  = settings2::all();
        
       

        $title     = trans('settings.settings');
        $sub_title = trans('settings.commission_settings');
        $base      = trans('settings.settings');
        $method    = trans('settings.binary_commission');
        $settings  = Settings::find(1);
        $category  = category::get();
        
        //$unread_count  = Mail::unreadMailCount(Auth::id());
        //$unread_mail  = Mail::unreadMail(Auth::id());
        // $userss = User::getUserDetails(Auth::id());
        // $user   = $userss[0];
        return view('app.admin.settings.index', compact('title', 'sett','settings', 'sub_title', 'base', 'method','category'));
    }

    public function saveTheme(Request $request)
    {

        $app        = AppSettings::find(1);
        $app->theme = $request->theme;
        $app->save();
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('settings.theme_change')));
        return Redirect::action('Admin\SettingsController@themesettings');

    }

    public function getUploadForm()
    {
        return View::make('image/upload-form');
    }

    public function postUpload()
    {
        $file  = Input::file('image');
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);

        } else {
            $destinationPath = 'assets/images';
            $filename        = $file->getClientOriginalName();
            Input::file('image')->move($destinationPath, $filename);
            return Response::json(['success' => true, 'file' => asset($destinationPath . $filename)]);
        }

    }

    public function ranksetting()
    {
        // $settings  = Ranksetting::all();
        $settings  = Ranksetting::where('id','>',1)->get();
        // dd($settings);
        $title     = trans('settings.rank_settings');
        $sub_title = trans('settings.rank_settings_panel');
        $base      = trans('settings.settings');
        $method    = trans('settings.rank_settings');
        //$unread_count  = Mail::unreadMailCount(Auth::id());
        //$unread_mail  = Mail::unreadMail(Auth::id());
        $userss = User::getUserDetails(Auth::id());
        $user   = $userss[0];
        return view('app.admin.settings.ranksetting', compact('title', 'settings', 'user', 'sub_title', 'base', 'method'));
    }

    public function themesettings()
    {

        $title     = trans('settings.theme_settings');
        $sub_title = trans('settings.theme_settings_panel');
        $base      = trans('settings.settings');
        $method    = trans('settings.theme_settings');
        return view('app.admin.settings.themesettings', compact('title', 'settings', 'sub_title', 'base', 'method'));
    }

    public function appsettings()
    {
        $settings  = AppSettings::all();
        $title     = trans('settings.application_settings');
        $sub_title = trans('settings.app_settings_panel');
        $base      = trans('settings.settings');
        $method    = trans('settings.app_settings');
        //$unread_count  = Mail::unreadMailCount(Auth::id());
        //$unread_mail  = Mail::unreadMail(Auth::id());
        $userss = User::getUserDetails(Auth::id());
        $user   = $userss[0];
        return view('app.admin.settings.appsettings', compact('title', 'settings', 'user', 'sub_title', 'base', 'method'));
    }
    public function updateappsettings(Request $request)
    {
        $app_settings             = AppSettings::find(1);
        $data_name                = $request->name;
        $app_settings->$data_name = $request->value;
        $app_settings->save();
        return Response::json(array('status' => 1));
    }
    public function upload()
    {
        if (Input::hasFile('file')) {
            //upload an image to the /img/tmp directory and return the filepath.

            $file        = Input::file('file');
            $tmpFilePath = '/assets/images/';
            $tmpFileName = time() . '-' . $file->getClientOriginalName();
            $file        = $file->move(public_path() . $tmpFilePath, $tmpFileName);
            $path        = '/public' . $tmpFilePath . $tmpFileName;
            $app         = AppSettings::find(1);
            $app->logo   = $tmpFileName;
            $app->save();
            return response()->json(array('path' => $path), 200);

        } else {
            return response()->json(false, 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        
        $settings = Settings::find($request->pk);


        $data_name = $request->name;

        $settings->$data_name = $request->value;

        if ($settings->save()) {
            return Response::json(array('status' => 1));
        } else {
            return Response::json(array('status' => 0));
        }

    }

    public function getallranks()
    {
        $settings    = Ranksetting::all();
        $response    = [];
        $response[0] = "NA";
        foreach ($settings as $key => $value) {
            $response[$value->rank_code] = $value->rank_name;
        }
        return json_encode($response, false);
        // return Response::json($response);
    }
    // public function savelogo(){
    // }
    public function stores(Request $request)
    {

        $image = new Image();
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required',
        ]);
        $image->title       = $request->title;
        $image->description = $request->description;
        if ($request->hasFile('image')) {
            $file            = Input::file('image');
            $name            = time() . '-' . $file->getClientOriginalName();
            $image->filePath = $name;

            $file->move(public_path() . '/assets/images/', $name);
        }
        $image->save();
        return $this->create()->with('success', trans('settings.image_upload'));
    }

    public function updateranksetting(Request $request)
    {
        $settings  = Ranksetting::find($request->pk);
        $data_name = $request->name;
        if ($request->name == "quali_rank_id") {
            $request->value = Ranksetting::where('rank_code', $request->value)->pluck('id');
        }

        $settings->$data_name = $request->value;
        $settings->save();
        return Response::json(array('status' => 1));
    }

    public function email()
    {

        $title     = trans('ticket_config.email_settings');
        $sub_title = "Email Settings";
        $base      = "Email Settings";
        $method    = "Email Settings";

        $settings = Emailsetting::all();
       
        return view('app.admin.settings.emailsetting', compact('title', 'settings', 'sub_title', 'base', 'method'));

    }

    public function updateemailsetting(Request $request)
    {
        $settings = Emailsetting::find($request->pk);

        $data_name = $request->name;

        $settings->$data_name = $request->value;

        if ($settings->save()) {
            return Response::json(array('status' => 1));
        } else {
            return Response::json(array('status' => 0));
        }

    }

    public function updatpackage_image(Request $request)
    {
        
     // dd($request->all());
        $changedby=Auth::user()->username;
        if($request->hasfile('file')){

            // $file=$request->file;
            // try {
            //     $mime = $file->getMimeType();
            // } catch (\Exception $e) {
            //     $mime = $file->getClientMimeType();
            // }
            // //dd($mime);
            // $validator = Validator::make($request->all(), $this->validationRules);
       
            // if ($validator->fails()) {

            //     Session::flash('flash_notification', array('level' => 'error','message' => trans('ticket_config.uploaded_failed')));
            //     return Redirect::back();
            // }
            // else{


            $requestid=$request->requestid;
            $destinationPath = public_path().'/assets/uploads'; 

            $extension = Input::file('file')->getClientOriginalExtension(); 
            $fileName = rand(000011111,99999999999).'.'.$extension; 
            Input::file('file')->move($destinationPath, $fileName);
            // dd($destinationPath);
// dd($fileName);
             Ranksetting::where('id',$requestid)->update(['image' => $fileName]);
             $package_name=Ranksetting::where('id',$requestid)->value('image');
            Activity::add("Image updated by  $changedby ","package image of $package_name updated  by $changedby","ranksetting");
            Session::flash('flash_notification',array('message'=>trans('updated'),'level'=>'success'));
            return redirect()->back();
            // }
        }
        else{
            
            Session::flash('flash_notification',array('message'=>trans('No image selected'),'level'=>'danger'));
            return redirect('/admin/ranksetting');
        }

    }

    public function welcome()
    {

        $settings = Welcome::all();
        // $title= trans('settings.rank_settings');
        $title     = trans('menu.system_templates');
        $sub_title = trans('menu.system_templates');
        $base      = trans('menu.system_templates');
        $method    = trans('menu.system_templates');
        //$unread_count  = Mail::unreadMailCount(Auth::id());
        //$unread_mail  = Mail::unreadMail(Auth::id());
        //$userss = User::getUserDetails(Auth::id());
        //$user = $userss[0];
         $settings_payout  = PaymentNotification::all();
        return view('app.admin.settings.welcomesetting', compact('title', 'settings', 'sub_title', 'base', 'method','settings_payout'));
    }

    public function updatewelcome(Request $request)
    {
        $settings = Welcome::find($request->pk);

        $data_name = $request->name;

        $settings->$data_name = $request->value;

        if ($settings->save()) {
            return Response::json(array('status' => 1));
        } else {
            return Response::json(array('status' => 0));
        }

    }

    // public function changelogo()
    // {
    //     // $settings=Ranksetting::all();
    //     // //$title= trans('settings.rank_settings');
    //     // $title= "Change Logo";
    //     // $sub_title =  trans('settings.rank_settings_panel');
    //     // $base = trans('settings.settings');
    //     // $method =  trans('settings.rank_settings');
    //     // //$unread_count  = Mail::unreadMailCount(Auth::id());
    //     // //$unread_mail  = Mail::unreadMail(Auth::id());
    //     // $userss = User::getUserDetails(Auth::id());
    //     // $user = $userss[0];
    //     // return view('app.admin.settings.changelogo',compact('title','settings','user','sub_title','base','method'));
    //     Assets::addCSS(asset('assets/admin/css/profile.css'));
    //     Assets::addCSS(asset('assets/user/css/bootstrap-fileupload/bootstrap-fileupload.min.css'));

    //     Assets::addJS(asset('assets/user/js/bootstrap-fileupload/bootstrap-fileupload.min.js'));

    //     // $app=AppSettings::all();
    //        $app = AppSettings::find(1);
    //        $logo=$app->logo;

    //     $title= "Change logo";
    //     $sub_title =trans('settings.app_settings_panel');
    //     $base = trans('settings.settings');
    //     $method =  trans('settings.app_settings');
    //     $userss = User::getUserDetails(Auth::id());
    //     $user = $userss[0];
    //  return view('app/admin/logo',compact('title','settings','user','sub_title','base','method','logo'));

    // }

    public function getUploadLogo()
    {

        // $app=AppSettings::all();
        $app  = AppSettings::find(1);
        $logo = $app->logo;
        $logo_ico = $app->logo_ico;

        $settings  = AppSettings::all();
        $title     = trans('ticket_config.change_logo');
        $sub_title = trans('settings.app_settings_panel');
        $base      = trans('settings.settings');
        $method    = trans('settings.app_settings');
        $userss    = User::getUserDetails(Auth::id());
        $user      = $userss[0];
        return view('app.admin.settings.logo', compact('title', 'settings', 'user', 'sub_title', 'base', 'method', 'logo','logo_ico'));
    }
    public function updateChangeLogo(Request $request)
    {
        $settings = AppSettings::find($request->pk);

        $data_name = $request->name;

        $settings->$data_name = $request->value;

        if ($settings->save()) {
            return Response::json(array('status' => 1));
        } else {
            return Response::json(array('status' => 0));
        }

    }
    public function updateImage(Request $request)
    {
        if(Input::hasFile('file') && Input::hasFile('file2') ) {

        // upload an image to the /img/tmp directory and return the filepath.
        $file = Input::file('file');
        $tmpFilePath = '/assets/images/';
        $tmpFileName = time() . '-' . $file->getClientOriginalName();
        $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
        $path = '/public'.$tmpFilePath . $tmpFileName;
        $app = AppSettings::find(1);
        $app->logo = $tmpFileName;

        $app->save();

        $file = Input::file('file2');
        $tmpFilePath = '/assets/images/';
        $tmpFileName = time() . '-' . $file->getClientOriginalName();
        $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
        $path = '/public'.$tmpFilePath . $tmpFileName;
        $app = AppSettings::find(1);
        $app->logo_ico = $tmpFileName;

        $app->save();

        // Session::flash('flash_notification', array('level' => 'danger', 'message' => 'You dont have the permission to change the logo'));
        return Redirect::action('Admin\SettingsController@getUploadLogo');

        }elseif(Input::hasFile('file')){
           $file = Input::file('file');
         $tmpFilePath = '/assets/images/';
         $tmpFileName = time() . '-' . $file->getClientOriginalName();
         $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
         $path = '/public'.$tmpFilePath . $tmpFileName;
         $app = AppSettings::find(1);
         $app->logo = $tmpFileName;

         $app->save();
         return Redirect::action('Admin\SettingsController@getUploadLogo');

        }
        elseif(Input::hasFile('file2'))
        {
            $file = Input::file('file2');
         $tmpFilePath = '/assets/images/';
         $tmpFileName = time() . '-' . $file->getClientOriginalName();
         $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
         $path = '/public'.$tmpFilePath . $tmpFileName;
         $app = AppSettings::find(1);
         $app->logo_ico = $tmpFileName;

         $app->save();
         return Redirect::action('Admin\SettingsController@getUploadLogo');

        }
        else
        {
           return Redirect::action('Admin\SettingsController@getUploadLogo');
        }
    }

    //  public function uploads() {

    //        if(Input::hasFile('file')) {

    //       //upload an image to the /img/tmp directory and return the filepath.
    //       $file = Input::file('file');
    //       $tmpFilePath = '/assets/images/';
    //       $tmpFileName = time() . '-' . $file->getClientOriginalName();
    //       $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
    //       $path = '/public'.$tmpFilePath . $tmpFileName;
    //       $app = AppSettings::find(1);
    //       $app->logo = $tmpFileName;

    //       $app->save();

    //       Session::flash('flash_notification',array('level'=>'success','message'=>'Logo changed Successfully'));
    //         return Redirect::action('Admin\SettingsController@getUploadLogo');
    //         }
    //         Session::flash('flash_notification',array('level'=>'danger','message'=>'No file selected'));
    //         return Redirect::action('Admin\SettingsController@getUploadLogo');
    //   }

    // public function savelogo(){

    //     if(Input::hasFile('file')) {

    //       //upload an image to the /img/tmp directory and return the filepath.
    //          $file = Input::file('file');
    //       $tmpFilePath = '/assets/images/';
    //       $tmpFileName = time() . '-' . $file->getClientOriginalName();
    //       $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
    //       $path = '/public'.$tmpFilePath . $tmpFileName;
    //       $app = AppSettings::find(1);
    //       $app->logo = $tmpFileName;
    //       $app->save();
    //     if($user->save()){
    //              Session::flash('flash_notification',array('level'=>'success','message'=>'Logo changed Successfully'));
    //              return Redirect::action('Admin\SettingsController@getUploadLogo');
    //          }else{
    //             Session::flash('flash_notification',array('level'=>'danger','message'=>'No file selected'));
    //             return Redirect::action('Admin\SettingsController@getUploadLogo');
    //   }
    //  }

    // }

    public function site_management(){

        $app  = AppSettings::find(1);
        $status = $app->site_mode;
       
        $title     = trans('ticket_config.site_management');
        $sub_title = trans('settings.site_management');
        $base      = trans('settings.settings');
        $method    = trans('settings.site_management');
     
        return view('app.admin.settings.site_management', compact('title', 'settings', 'user', 'sub_title', 'base', 'method', 'status'));




    }

    public function postsite_mode(Request $request){
        //dd($request->all());

        if($request->mode=='yes'){

              AppSettings::where('id',1)->update(['site_mode'=>'yes']);
              Artisan::call('down');

          }else

            AppSettings::where('id',1)->update(['site_mode'=>'no']);
           

          Session::flash('flash_notification', array('level' => 'success', 'message' => 'success'));
         return Redirect::action('Admin\SettingsController@site_management');

    }
    public function autoresponder()
    {

        $title     = trans('menu.Auto_Responder');
        $sub_title = "Text your message";
        //$unread_count  = Mail::unreadMailCount(Auth::id());
        //$unread_mail  = Mail::unreadMail(Auth::id());
        $base = 'Email';

        $method = 'Auto Responder';
        $users  = User::getUserDetails(Auth::id());
        $user   = $users[0];
        $res    = AutoResponse::all();
        // dd($res);die();
        return view('app.admin.autoresponder.autoresponse', compact('title', 'user', 'sub_title', 'base', 'method', 'res'));
    }
    public function save(Request $request)
    {
        $response          = new AutoResponse();
        $response->subject = $request->subject;
        $response->content = $request->content;
        $response->date    = $request->date;
        $response->save();

        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('settings.response_created')));
        return Redirect::action('Admin\SettingsController@autoresponder');

    }
    public function updateresponse(Request $request)
    {
        AutoResponse::where('id', $request->id)->update(array('subject' => $request->subject, 'content' => $request->content, 'date' => $request->date));
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('settings.response_updated')));
        return Redirect::action('Admin\SettingsController@autoresponder', array('id' => $request->id));

    }
    public function editresponse($id)
    {
        $response = AutoResponse::where('id', $id)->get();

        $title     = 'Auto Responder';
        $sub_title = "Text your message";
        //$unread_count  = Mail::unreadMailCount(Auth::id());
        //$unread_mail  = Mail::unreadMail(Auth::id());
        $base = 'Email';

        $method = 'Auto Responder';
        $users  = User::getUserDetails(Auth::id());
        $user   = $users[0];

        return view('app.admin.autoresponder.aredit', compact('title', 'user', 'sub_title', 'base', 'method', 'response'));
    }
    public function deleteresponse($id)
    {

        $title     = 'Auto Responder';
        $sub_title = "Text your message";
        $base      = 'Email';
        $method    = 'Auto Responder';
        $users     = User::getUserDetails(Auth::id());
        $user      = $users[0];
        $response  = AutoResponse::where('id', $id)->get();

        return view('app.admin.autoresponder.ardelete', compact('title', 'user', 'sub_title', 'base', 'method', 'response'));
    }
    public function deleteconfirms(Request $request)
    {

        $res = AutoResponse::where('id', $request->cid)->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('settings.response_details')));
        return Redirect::action('Admin\SettingsController@autoresponder');
    }

    //   public function voucherlist()
    // {

    //     $title = 'Voucher Create';
    //     return view('app.admin.voucher.index',compact('title'));

    // }

    public function paymentgateway()
    {

        $title        = trans('menu.payment_gateway_settings');
        $sub_title    = trans('menu.payment_gateway_settings');
        $base         = trans('menu.payment_gateway_settings');
        $method       = trans('menu.payment_gateway_settings');
        $payment_type = PaymentType::all();
        return view('app.admin.settings.payment', compact('title', 'payment_type', 'sub_title', 'base', 'method'));

    }
    public function paymentstatus(Request $request)
    {

        $title  = trans('menu.payment_gateway_settings');
        $status = $request->decision;
        $id     = $request->id;

        PaymentType::where('id', $id)
            ->update(['status' => $status]);

        echo "ok";

    }

    public function payoutnotification()
    {

        $title     = trans("payout.notification.settings");
        $sub_title = trans("payout.notification.settings");
        $base      = trans("payout.notification.settings");
        $method      = trans("payout.notification.settings");
        $settings_payout  = PaymentNotification::all();

        // dd($settings);

        return view('app.admin.settings.payoutnotification', compact('title','sub_title','base','method', 'settings', 'sub_title', 'base', 'method','settings_payout'));

    }
    public function payoutupdate(Request $request)
    {
         
        $package = PaymentNotification::find($request->pk);

        $variable = $request->name;

        $package->$variable = $request->value;

        if ($package->save()) {
            return Response::json(array('status' => 1));
        } else {
            return Response::json(array('status' => 0));
        }

    }

    public function menusettings()
    {

        $title     = trans('menu.block_options');
        $sub_title = trans('menu.block_options');
        $base      = trans('menu.block_options');
        $method    = trans('menu.block_options');
        $menu_name = MenuSettings::where('id','<>',3)->get();
        return view('app.admin.settings.menusettings', compact('title', 'menu_name', 'sub_title', 'base', 'method'));

    }
    public function menuupdate(Request $request)
    {

        //dd($request->all());

        $title  = trans('menu.block_options');
        $status = $request->decision;
        $id     = $request->id;
//dd($status);
        echo "status".$status."<br>";
        echo "id".$id."<br>";
        MenuSettings::where('id', $id)
            ->update(['status' => $status]);

        echo "ok";

    }

    public function sitedown_management(){


        $title     = 'Site Management';
        $sub_title = 'Site Management';
        $base      = 'Site Management';
        $method    = 'Site Management';
        $menu_name = MenuSettings::orderBy('id','desc')->get();
        
        return view('app.admin.settings.sitedowsettings', compact('title', 'menu_name', 'sub_title', 'base', 'method'));

    }


    public function sitemanagementsettings(Request $request){

        $title  = 'Site Management';
        $status = $request->decision;
        $id     = $request->id;
  echo "status".$status."<br>";
  echo "id".$id."<br>";
  if($status=='no'){
        Artisan::call('down');
    
        MenuSettings::where('id', $id)
            ->update(['status' => $status]);

  }else

       MenuSettings::where('id', $id)
            ->update(['status' => $status]);

        echo "ok";



    }

    //back up

   public function backupSite()
    {   
        $title     = 'Back Up';
        $sub_title = 'Back Up';
        $base      = 'Back Up';
        $method    = 'Back Up';
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
        $files = $disk->files('http---binary-demo-ath.cloudmlm.online');
          // dd($disk);
        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('laravel-backup.backup.name') . '/', '', $f),
                    'file_size' => $disk->size($f),
                    'last_modified' => $disk->lastModified($f),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);
         // dd($backups);
        return view('app.admin.backup.backup')->with(compact('backups','title', 'sub_title', 'base', 'method'));
    }


static function humanFilesize($size, $precision = 2) {
    $units = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
    $step = 1024;
    $i = 0;

    while (($size / $step) > 0.9) {
        $size = $size / $step;
        $i++;
    }
    
    return round($size, $precision).$units[$i];
}


  public function createBackup()
    {
        try {
            // start the backup process
            Artisan::call('backup:run',['--only-db' => 'true']);
            $output = Artisan::output();
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            // return the results as a response to the ajax call
           Session::flash('flash_notification', array('level' => 'success', 'message' => "Back up created"));
            return redirect()->back();
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

   
  
      /**
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function downloadBackup($file_name,$files)
    {
        $file    = "/var/www/binary-demo-ath.cloudmlm.online/storage/app/http---binary-demo-ath.cloudmlm.online/".$files;
        $headers = array(
            'Content-Type: application/zip',
        );
        return Response::download($file, $files, $headers);
        
    }


    /**
     * Deletes a backup file.
     */
    public function deleteBackup($file_name,$files)
    {
        
       $file    = "/var/www/binary-demo-ath.cloudmlm.online/storage/app/http---binary-demo-ath.cloudmlm.online/".$files;
      if (!unlink($file))
       {
          Session::flash('flash_notification', array('level' => 'danger', 'message' => "Back up error"));
          return redirect()->back();
       }
     else
      {
           Session::flash('flash_notification', array('level' => 'success', 'message' => "Back up deleted"));
            return redirect()->back();
      }
    }

   //subadmin

     public function viewalladmin(){

        $title     = trans('registration.view_all_admin');
        $sub_title = trans('registration.view_all_admin');
        $base      = trans('registration.view_all_admin');
        $method    = trans('registration.view_all_admin');

        return view('app.admin.settings.adminview', compact('title', 'sub_title', 'base', 'method'));

    }

    public function adminview()
    {

          $user_count=User::where('admin','=',1)->where('id','<>',1)->count();
          $users=User::where('register_by','=','adminregister')->where('id','<>',1)->select('id','name','username','email','created_at');
       //dd($users);
          return Datatables::of($users)
                ->remove_column('id')
                ->edit_column('created_at', '{{ date("d M Y",strtotime($created_at)) }}')
                ->add_column('assign_roles','<a href="{{{ URL::to(\'admin/assign-role/\' . $id ) }}}" class="btn btn-info btn-sm"><span class="fa fa-plus"></span></a>')
                ->add_column('action','<a href="{{{ URL::to(\'admin/deleteadmin/\' . $id ) }}}" class="btn btn-danger btn-sm"><span class="fa fa-trash-o"></span></a>')
                ->setTotalRecords($user_count)
                ->escapeColumns([])
                ->make();

    }
    public function deleteadmin($id){
     
        $deleteid=User::find($id);
        $deleteid->delete();

        Session::flash('flash_notification', array('level' => 'success', 'message' => 'Admin deleted  successfully'));
        
        return redirect()->back();

    }
      public function postassign($id)
    {
    
        $title     = trans('registration.assign_roles');
        $sub_title = trans('registration.assign_roles');
        $base      = trans('registration.assign_roles');
        $method    = trans('registration.assign_roles'); 

        $my_roles  = MyRole::where('user_id',$id)->value('role_id');
       
        if(isset($my_roles))
        $menu_id = json_decode($my_roles, true);

        $roles      = Roles::where('is_root','yes')->get();
        $sub_roles   = Roles::where('is_root','no')->get();


       
        $emp_id     = $id;
        $employee   = User::where('id',$id)->value('username'); 
    
        return view('app.admin.settings.postassignroles',compact('title','sub_title','base','method','roles','employee','emp_id','sub_roles','menu_id'));
    }
    public function saverole(Request $request)
    {
        $menus=array();
        $menu_id=$request->menu;
        if(!isset($menu_id)){
            Session::flash('flash_notification', array('level' => 'danger', 'message' => 'Please select Roles'));
            return Redirect::action('Admin\SettingsController@viewalladmin'); 
        }
        $limit=count($menu_id);
        for ($i=0; $i <$limit ; $i++) { 
        // $menus[]=Role::where('id','=',$menu_id[$i])->select('id','parent_id')->first()->toArray();;
        $menus[]=Roles::where('id','=',$menu_id[$i])->value('id');
           // $x= json_encode($menus);
        }
     
        MyRole::where('user_id',$request->emp_id)->delete();
        $a= MyRole::create([
               'user_id' => $request->emp_id,
               'role_id' => json_encode($menus)
               ]);
     

        Session::flash('flash_notification', array('level' => 'success', 'message' => 'Roles assigned  successfully'));
        return Redirect::action('Admin\SettingsController@viewalladmin'); 

    }
    public function trackPayment(){

        $title     = 'Forced Track payment';
        $sub_title ='Forced Track payment';
        $base      = 'Forced Track payment';
        $method    ='Forced Track payment';
        $packages=Packages::where('id','>',1)->pluck('package','id');


        return view('app.admin.settings.trackpayment', compact('title', 'sub_title', 'base', 'method','packages'));
    }

    public function upTrackPayment(Request $request){
   
           $validator = Validator::make($request->all(), [
            'username' => 'required|exists:users',
           ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            } else {

                $user_id=User::where('username',$request->username)->value('id');
                $cur_package=ProfileModel::where('user_id',$user_id)->value('package');
                  if($request->package > $cur_package){

                    $package=Packages::find($request->package);
                    $purchase_id= PurchaseHistory::create([
                                    'user_id'=>$user_id,
                                    'purchase_user_id'=>$user_id,
                                    'package_id'=>$request->package,
                                    'count'=>1,
                                    'pv'=>$package->pv,
                                    'total_amount'=>$package->amount,
                                    'pay_by'=>'free',
                                    'rs_balance'=>$package->rs,
                                    'sales_status'=>'yes',
                                    ]);
                                    RsHistory::create([
                                    'user_id'=>$user_id,                   
                                    'from_id'=>1,
                                    'rs_credit'=>$package->rs,
                                    ]);

                    $pur_user=PurchaseHistory::find($purchase_id->id);
                    $user=User::join('profile_infos','profile_infos.user_id','=','users.id')
                               ->join('packages','packages.id','=','profile_infos.package')
                               ->where('users.id',$pur_user->user_id)
                               ->select('users.username','users.name','users.lastname','users.email','profile_infos.mobile','profile_infos.address1','packages.package')
                               ->get();
                    $userpurchase=array();      
                    $userpurchase['name']=$user[0]->name;
                    $userpurchase['lastname']=$user[0]->lastname;
                    $userpurchase['amount']=$package->amount;
                    $userpurchase['payment_method']=$purchase_id->pay_by;
                    $userpurchase['mail_address']=$user[0]->email;;
                    $userpurchase['mobile']=$user[0]->mobile;
                    $userpurchase['address']=$user[0]->address1;
                    $userpurchase['invoice_id'] ='0000'.$purchase_id->id;
                    $userpurchase['date_p']=$purchase_id->created_at;
                    $userpurchase['package']=$package->package;
                    PurchaseHistory::where('id','=',$purchase_id->id)->update(['datas'=>json_encode($userpurchase)]);
                    ProfileModel::where('user_id',$user_id)->update(['package' => $request->package]);
                   
                    Session::flash('flash_notification',array('message'=>"You have purchased the plan successfully ",'level'=>'success'));
                    return redirect()->back();
                  }else{
                    Session::flash('flash_notification',array('message'=>"Plan Purchase not possible",'level'=>'error'));
                    return redirect()->back();
                  }


            }
     }
         public function updatesettings1(Request $request)
    {
        
        $settings = Category::find($request->pk);
        

        $data_name = $request->name;

        $settings->$data_name = $request->value;

        if ($settings->save()) {
            return Response::json(array('status' => 1));
        } else {
            return Response::json(array('status' => 0));
        }

    }
     public function updatcategory_image(Request $request)
    {
     
        $changedby=Auth::user()->username;
        if($request->hasfile('file')){

            $requestid=$request->requestid;
            $destinationPath = public_path().'/assets/uploads'; 

            $extension = Input::file('file')->getClientOriginalExtension(); 
            $fileName = rand(000011111,99999999999).'.'.$extension; 
            Input::file('file')->move($destinationPath, $fileName);
      
             Category::where('id',$requestid)->update(['image' => $fileName]);
             $package_name=Category::where('id',$requestid)->value('image');
            Activity::add("Image updated by  $changedby ","package image of $package_name updated  by $changedby","ranksetting");
            Session::flash('flash_notification',array('message'=>trans('updated'),'level'=>'success'));
            return redirect()->back();
            // }
        }
        else{
            
            Session::flash('flash_notification',array('message'=>trans('No image selected'),'level'=>'danger'));
            return redirect()->back();
        }

    }



   
}
