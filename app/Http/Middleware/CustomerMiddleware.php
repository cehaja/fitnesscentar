<?php

namespace App\Http\Middleware;

use Closure;

class CustomerMiddleware
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
        if ($request->user() && $request->user()->type != 'customer' && $request->user()->type !='member')
        {
            return redirect('home');
        }
        if (!$request->user()){
            return redirect('login');
        };
        return $next($request);
    }
}
