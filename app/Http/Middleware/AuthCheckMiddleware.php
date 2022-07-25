<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session("name") && url("home") == $request->url() ){
            $request->session()->flash("error", "Please login first");
            return redirect("login");
        }
        if(session("name") && url("home") != $request->url()){
            return redirect("home");
        }
        return $next($request);
    }

}
