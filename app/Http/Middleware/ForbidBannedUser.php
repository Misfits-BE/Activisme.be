<?php

namespace ActivismeBe\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class ForbidBannedUser
{
    /**
     * The guard implementation. 
     * 
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * ForbidBannedUser constructor 
     * 
     * @param  Guard $auth The authencation guard
     * @return void
     */
    public function __construct(Guard $auth) 
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request. 
     * 
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * 
     * @throws \Exception 
     * 
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $this->auth->user();

        if ($user && $user->isBanned()) {
            return view('errors.banned');
        }

        return $next($request);
    }
}
