<?php
namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Ranksetting;
use App\Mail;
use App\AppSettings;
use App\Packages;
use App\Currency;
use App\Tree_Table;
use App\ProfileInfo;
use View;
use Auth;

use App\Http\Controllers\Controller;

class UserAdminController extends Controller
{/**
     * Initializer.
     *
     * @return \AdminController
     */

    public $GLOBAL_USERRANK= null;
    public $GLOBAL_PACAKGE= null;
    public $USER_CURRENCY= null;
    public $GLOBAL_RANK= null;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user');
        // self::defineglobals();
    }

    public function defineglobals(){


        $this->GLOBAL_USERRANK=Ranksetting::where('id',Auth::user()->rank_id)->pluck('rank_name');
        View::share('GLOBAL_USERRANK',  $this->GLOBAL_USERRANK);
        
        $this->USER_CURRENCY=Currency::find(ProfileInfo::where('user_id','=',Auth::user()->id)->pluck('currency'));
      
        View::share('USER_CURRENCY',  $this->USER_CURRENCY);
        $this->GLOBAL_RANK=Ranksetting::where('id',Auth::user()->rank_id)->pluck('rank_name');
        View::share('GLOBAL_RANK',  $this->GLOBAL_RANK);
        $this->GLOBAL_PACAKGE=Packages::where('id',Auth::user()->package)->pluck('package');


        $active = Tree_Table::where('user_id',Auth::user()->id)->pluck('type'); 
        if($active == 'no' && Auth::user()->monthly_maintenance == 1){
            $this->GLOBAL_PACAKGE = 'Inactive' ;
        }elseif($active == 'no' && Auth::user()->monthly_maintenance == 0){
            $this->GLOBAL_PACAKGE = 'Non-Maintain' ;
        }
        View::share('GLOBAL_PACAKGE',   $this->GLOBAL_PACAKGE);


        $profile = ProfileInfo::find(ProfileInfo::where('user_id',Auth::user()->id)->pluck('id'));
        View::share('image', $profile->image); 

        $unread_count = Mail::unreadMailCount(Auth::user()->id);
        $unread_mail = Mail::unreadMail(Auth::user()->id);
        $app = AppSettings::find(1);
        View::share('unread_count',  $unread_count);
        View::share('unread_mail',  $unread_mail);
        View::share('logo',  $app->logo);
        View::share('logo_ico',  $app->logo_ico);
        View::share('company_name',  $app->company_name);
        if($app->theme == 'dark'){
        }
    }
}
