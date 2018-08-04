<?php

namespace App\Http\Middleware;

use Closure;

class AdminEmployeeMiddleware
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
        if ($request->user() && $request->user()->type != 'employee' && $request->user()->type != 'admin' )
        {
            return redirect('home');
        }
        else if (!$request->user()){
            return redirect('login');
        }
        return $next($request);
    }
}
