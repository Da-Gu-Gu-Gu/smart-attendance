<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Studentpasswordreset;
use App\Models\Teacherpasswordreset;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::view('/test','email/email');
Route::view('/login','login');

Route::view('/student/forgot-password','student-forgotpassword');
Route::view('/teacher/forgot-password','teacher-forgotpassword');
Route::get('/verification',[LoginController::class,'verify']);

Route::view('/aa','email/spr');
Route::get('/test',function(){
    $aa=urlencode('heinhtetaung@gmalil.com');
    return dd($aa);
});
// Route::view('aa','email/spr');
Route::get('student/password/reset/{token}',function(Request $request,$token){
    $checktoken=Studentpasswordreset::where('token',$token)->get('rollno'); //rollno
    if(count($checktoken)<1){
        return abort(404);
    }
    else{
        $request->session()->put('spreset-rollno', $checktoken[0]->rollno);
        return view('spreset');
    }

});

// middleware student
Route::group(['middleware'=>['studentPage']], function () {
    Route::view('/student/yourattendance','yourattendance');
    Route::get('/student/logout',[LoginController::class,'student_logout']);
    Route::get('/student',[LoginController::class,'student']);
    Route::view('/student/scan','scan');
});





//teacher-reset-password
Route::get('teacher/password/reset/{token}',function(Request $request,$token){
    $checktoken=Teacherpasswordreset::where('token',$token)->get('tid'); //tid
    if(count($checktoken)<1){
        return abort(404);
    }
    else{
        $request->session()->put('tpreset-tid', $checktoken[0]->tid);
        return view('tpreset');
    }

});

//middleware teacher
Route::group(['middleware' => ['teacherPage']], function () {
    Route::get('/teacher/logout',[LoginController::class,'teacher_logout']);
    Route::view('/teacher','teacher');
});






