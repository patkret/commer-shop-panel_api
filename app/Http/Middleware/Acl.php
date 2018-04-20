<?php

namespace App\Http\Middleware;

use Closure;

class Acl
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
        dump($request->route()->uri());

        return $next($request);
    }
}
