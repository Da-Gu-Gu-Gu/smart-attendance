<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Studentpasswordreset;
use App\Models\Teacherpasswordreset;
use App\Models\Rollcall;
use App\Models\Attendance;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LocalizationController;
use App\Events\MyEvent;

use App\Http\Controllers\PdfController;
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
    $locale=App::currentLocale();
    session()->put('locale', $locale); 
    return view('welcome');
});

//localization
Route::get('lang/{locale}',[LocalizationController::class,'index']);

Route::view('/test','email/email');
Route::view('/login','login');

Route::view('/student/forgot-password','student-forgotpassword');
Route::view('/teacher/forgot-password','teacher-forgotpassword');
Route::get('/verification',[LoginController::class,'verify']);

Route::view('/test/notisent','notisent');
Route::post('/noti/sent',function (Request $test) {

// event(new MyEvent(12));
//     return "Event has been sent!";});

event(new Assignment("blah blah"));
return "Everything will be ok";
});

Route::view('/test/notitest','notitest');

// Route::view('/dd','pdf_view');
// Route::view('/aa','email/spr');
// Route::get('/test',function(){
//     $aa=urlencode('heinhtetaung@gmalil.com');
//     return dd($aa);
// });
// Route::view('aa','email/email');
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
  
    Route::get('/student/logout',[LoginController::class,'student_logout']);
    Route::get('/student',[LoginController::class,'student']);
    Route::view('/student/scan','scan');
    Route::view('/student/attendance','attendance');
    Route::get('/student/scan/{token}',function(Request $request,$token){
        $checktoken=Rollcall::where('token',$token)->first(); //tid
        $student=Student::where('email',session('semail'))->first();

        print($student->rollno);
        $morethanone=Attendance::where('rollno',$student->rollno)->get('token'); //more than one time roll call?
        // print($morethanone[key($morethanone)]);
       $rollcallcheck=$morethanone->toArray();
       print_r($rollcallcheck);
        $aa=array_slice($rollcallcheck,-1);
    //    print(count($aa));
    if(count($aa)>0){
        if($aa[0]['token']==$checktoken->token){
            echo "tuu ny tl";
            $request->session()->put('attendanceinfo', 'You already get attendance');         
            return redirect('/student/attendance');
        }
    }

        if(empty($checktoken)){
            return abort(404);
        }
        // if()
        else{
            switch($checktoken->lifetime){
                case '3 Min':
                    $lifetime=180;
                    break;
                case '5 Min':
                    $lifetime=300;
                    break;
                case '10 Min':
                    $lifetime=600;
                    break;
                default:
                    $lifetime=180;
            }
            if(time()-$checktoken->time>$lifetime){
                $request->session()->put('attendanceinfo', 'Sorry, you miss your rollcall');         
                return redirect('/student/attendance');
            } 
            elseif($student->year!=$checktoken->year){
                $request->session()->put('attendanceinfo', 'You are not from '.$checktoken->year);         
                return redirect('/student/attendance');
            }elseif($student->major!=$checktoken->major){
                $request->session()->put('attendanceinfo', 'You are not from '.$checktoken->major. ' major');
                return redirect('/student/attendance');  
            }
            else{
                $attendance=Attendance::create([
                        'rollno'=>$student->rollno,
                        'tid'=>$checktoken->tid,
                        'subject'=>$checktoken->subject,
                        'year'=>$student->year,
                        'date'=>date('j-n-Y'),
                        'token'=>$token                    //new edit token for one time roll call
            
                ]);
                $request->session()->put('attendanceinfo', 'Success');         
                return redirect('/student/attendance');
                
                }
            }
            
        
    });

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
    Route::get('/teacher',[LoginController::class,'teacher']);
    Route::get('/teacher/pdf/{year}', [PdfController::class, 'createPDF']);      //pdf
    Route::get('/rollcall/{token}',function(Request $request,$token){
        $checktoken=Rollcall::where('token',$token)->first(); //tid
        if(empty($checktoken)){
            return abort(404);
        }
        else{
                $request->session()->put('rollcall-token', $token);
                return view('qrcode');
            
        }
    });
  
});








