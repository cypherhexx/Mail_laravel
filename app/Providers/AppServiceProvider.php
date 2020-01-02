<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\ProfileInfo;
use Auth;
use View;
use App\Mail;
use App\AppSettings;
use Cache;
use Validator;
use CountryState;
use App\Activity;
use App\Ranksetting;
use App\Packages;
use App\Currency;
use App\Tree_Table;
use App\PurchaseHistory;
use App\Roles;
use App\MyRole;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {        

         Schema::defaultStringLength(191);


        view()->composer(['no-layout'],function($view){
            $app = AppSettings::find(1);          
            $view            
            ->with('app',$app)
            ->with('logo',$app->logo)
            ->with('logo_ico',$app->logo_ico);
        });

        view()->composer(['site-*.base'],function($view){
            $app = AppSettings::find(1);  

                 
            $view            
            ->with('app',$app)
            ->with('logo',$app->logo)
            ->with('logo_ico',$app->logo_ico);
        });



        view()->composer(['app.admin*'],function($view){
            
            $user = \App\User::with(['profile_info', 'profile_info.package_detail', 'sponsor_tree', 'tree_table', 'purchase_history.package'])->find(Auth::id());
            
            $presence = \App\User::isOnline(\Auth::id());
            if($presence == null){
                $presence = "false";
            }
            $profile = ProfileInfo::where('user_id',Auth::id())->get();
            //$profile = ProfileInfo::where('user_id',2)->get();
            
            $image =  $profile->first()->profile;
            if($image){
                if($image == 1){
                    $image = 'avatar-big.png';
                }
            }

            
            $unread_count = Mail::unreadMailCount(Auth::id());
            $unread_mail = Mail::unreadMail(Auth::id());
            $app = AppSettings::find(1);
            $activities = Activity::with('user')->where('user_id',Auth::id())->orderBy('created_at','desc')->paginate(5);
            $view            
            ->with('user',$user)
            ->with('presence',$presence)
            ->with('profile',$profile)
            ->with('unread_count',$unread_count)
            ->with('unread_mail',$unread_mail)
            ->with('app',$app)
            ->with('logo',$app->logo)
            ->with('logo_ico',$app->logo_ico)
            ->with('image',$image)
            ->with('activities',$activities);

                 // role-assign 
            if(Auth::user()->id >1){

                $menu=Roles::orderby('id','asc')->where('id','>',1)->get();
                $emp_id=Auth::user()->id;
                $assigned_roles = MyRole::where('user_id',$emp_id)->distinct()->orderby('id','asc')->get();
                $asignd_roles= MyRole::where('user_id',$emp_id)->pluck('role_id');
                $data = json_decode($asignd_roles, true);
                if($data)
                $data = json_decode($data[0]);
                $mainmenu_id=Roles::whereIn('id', $data)->pluck('parent_id');
                $role_name=Roles::select('id','role_name','link','is_root','parent_id','main_role','icon')
                            ->whereIn('id', $data)
                            ->orwhereIn('id', $mainmenu_id)
                            ->orderby('id','asc')->get();
                            // dd($role_name);
                View::share('role_names', $role_name);
            }


            View::share('currency_sy',$app->currency);
            View::share('company_name',  $app->company_name);

        });


        view()->composer(['app.user*'],function($view){
            

            $GLOBAL_USERRANK= Ranksetting::where('id',Auth::user()->rank_id)->value('rank_name');

            // dd();

            $package_new=PurchaseHistory::where('user_id','=',Auth::user()->id)->orderBy('id','desc')->value('package_id');
            $GLOBAL_PACAKGE= Packages::where('id','=',$package_new)->value('package');;
            // dd($GLOBAL_PACAKGE);
            $USER_CURRENCY= Currency::find(ProfileInfo::where('user_id','=',Auth::user()->id)->value('currency'));
            $GLOBAL_RANK= Ranksetting::where('id',Auth::user()->rank_id)->value('rank_name');;

            $active = Tree_Table::where('user_id',Auth::user()->id)->value('type'); 
            if($active == 'no' && Auth::user()->monthly_maintenance == 1){
                $GLOBAL_PACAKGE = 'Inactive' ;
            }elseif($active == 'no' && Auth::user()->monthly_maintenance == 0){
                $GLOBAL_PACAKGE = 'Non-Maintain' ;
            }

            $user = \App\User::with(['profile_info', 'profile_info.package_detail', 'sponsor_tree', 'tree_table', 'purchase_history.package'])->find(Auth::id());
            
            // dd($GLOBAL_PACAKGE);
            // 
            // $user = \App\User::find(Auth::id());
            
            $presence = \App\User::isOnline(\Auth::id());
            if($presence == null){
                $presence = "false";
            }
            $profile = ProfileInfo::where('user_id',Auth::id())->get();
            // dd($profile);
            $image =  $profile->first()->profile;
            $unread_count = Mail::unreadMailCount(Auth::id());
            $unread_mail = Mail::unreadMail(Auth::id());
            $app = AppSettings::find(1);
            $activities = Activity::with('user')->where('user_id',Auth::id())->orderBy('created_at','desc')->get();
           
            $view            
            ->with('user',$user)
            ->with('presence',$presence)
            ->with('profile',$profile)
            ->with('unread_count',$unread_count)
            ->with('unread_mail',$unread_mail)
            ->with('app',$app)
            ->with('logo',$app->logo)
            ->with('logo_ico',$app->logo_ico)
            ->with('image',$image)
            ->with('activities',$activities)
            ->with('GLOBAL_USERRANK',$GLOBAL_USERRANK)
            ->with('GLOBAL_PACAKGE',$GLOBAL_PACAKGE)
            ->with('USER_CURRENCY',$USER_CURRENCY)
            ->with('GLOBAL_RANK',$GLOBAL_RANK);
            View::share('currency_sy',$app->currency);
            View::share('company_name',  $app->company_name);
           
        });



      
            

            // View::share('GLOBAL_PACAKGE', '');
            // View::share('unread_count',  $unread_count);
            // View::share('unread_mail',  $unread_mail);
            // View::share('logo',  $app->logo);
            // View::share('logo_ico',  $app->logo_ico);
            // View::share('company_name',  $app->company_name);

            
            // View::share('image',  $profile->first()->image);
            // View::share('currentuser',  $currentuser);
            // View::share('user',  $user);
            // View::share('presence',  $presence);
            // View::share('activities',  $activities);
            // View::share('theme',  $app->theme);
            // View::share('theme',  $app->theme);

       


        
        Validator::extend('country', function($attribute, $value, $parameters, $validator) {            
            if(!empty($value)){
                $countries = collect(CountryState::getCountries());
                $flipped = $countries->flip();               
                if($flipped->contains($value) === true){
                 return true;
                }                
            }
            return false;
        });


        //ASLAM STOPPED FURTHER VALIDATION HOOKS BECAUSE THERE MIGHT NOT BE NEEDING TO VERIFY THE STATE CUZ SOMETIMES VALUE MIGHT NOT BE THERE
        
        // Validator::extend('state', function($attribute, $value, $parameters, $validator) {

        //     if(!empty($value) && !empty($parameters)){
        //         $country = collect($parameters);

        //         $states = collect(CountryState::getStates($country->first()));                
        //         if($states->isEmpty() === false){
        //             dd($states);
        //             dd('country got state');
        //         }                
        //     }else{
        //         // dd('maybe no states');
        //         return true;
        //     }
        //     return false;
        // });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
