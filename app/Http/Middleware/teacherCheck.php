<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Teacher;

class teacherCheck
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
       
        if(session('temail')){

            $teacher=Teacher::where('email',session('temail'))->first();
            return $next($request,['student'=>$teacher]);
            
        }else{
            return redirect('/login');
        }
    }
}
