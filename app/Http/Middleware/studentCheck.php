<?php

namespace App\Http\Middleware;

use App\Models\Student;
use Closure;
use Illuminate\Http\Request;

class studentCheck
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
       
        if(session('semail')){

            $student=Student::where('email',session('semail'))->first();
            return $next($request,['student'=>$student]);
            
        }else{
            return redirect('/login');
        }
    }
}
