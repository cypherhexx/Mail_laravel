<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\AssignedRoles;
use App\MenuSettings;
use Auth;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode ;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;

class User {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The response factory implementation.
     *
     * @var ResponseFactory
     */
    protected $response;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @param  ResponseFactory  $response
     * @return void
     */
    public function __construct(Guard $auth, ResponseFactory $response, Application $app) {
        $this->auth = $auth;
        $this->response = $response;
         $this->app = $app;
    }

    public function handle($request, Closure $next) {
        if ($this->auth->check()) {
            $site_mode = MenuSettings::where('id',3)->value('status');
            //dd($site_mode);

            $user = 0;
            if ($this->auth->user()->admin == 0) {
                $user = 1;
            }
            if ($user == 0) {
                return $this->response->redirectTo('/admin/dashboard');
            }

            //dd($this->app->isDownForMaintenance());
        if($site_mode=='no'){

          
          if (!Auth::user()->isAdmin && $this->app->isDownForMaintenance()) {

            $data = json_decode(file_get_contents($this->app->storagePath().'/framework/down'), true);

            throw new MaintenanceModeException($data['time'], $data['retry'], $data['message']);
        }
      }

  

       // return $next($request);






            return $next($request);
        }
        return $this->response->redirectTo('/');
    }

}
