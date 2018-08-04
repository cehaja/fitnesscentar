<?php

namespace App\Http\Middleware;

use Closure;

class EmployeeMiddleware
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
        if ($request->user() && $request->user()->type != 'employee')
        {
            return redirect('home');
        }
        else if (!$request->user()){
            return redirect('login');
        }
        return $next($request);
    }
}
