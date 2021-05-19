<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin;

class adminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       
        if(session('adminemail')){

            $admin=Admin::where('email',session('adminemail'))->first();
            return $next($request,['admin'=>$admin]);
            
        }else{
            return redirect('/admin');
        }
    }
}
