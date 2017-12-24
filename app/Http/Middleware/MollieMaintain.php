<?php

namespace ActivismeBe\Http\Middleware;

use Closure;

class MollieMaintain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! env('MOLLIE_ACTIVE', false)) { // Mollie is under maintainance
            abort(404);
        }

        return $next($request);
    }
}
