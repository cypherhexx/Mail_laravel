<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\ResponseFactory;

class Authenticated {

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
    public function __construct(Guard $auth, ResponseFactory $response) {
        $this->auth = $auth;
        $this->response = $response;
    }

    public function handle($request, Closure $next) {
        if ($this->auth->check()) {
            return $next($request);
        }
        return $this->response->redirectTo('/');
    }

}
