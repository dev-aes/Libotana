<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsUser
{
   
    public function handle(Request $request, Closure $next)
    {
        abort_if(!$request->user()->hasRole('user'), 404);
        
        return $next($request);
    }
}