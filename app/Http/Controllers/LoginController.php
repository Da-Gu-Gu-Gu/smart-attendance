<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use App\Models\Studentpasswordreset;
//teacher
use App\Models\Teacher;
use App\Models\Teacherpasswordreset;

//rollcall
use App\Models\Rollcall;

//attendance
use App\Models\Attendance;

class LoginController extends Controller
{
    //loginstudent
    function loginStudent(Request $req){
        $validator=Validator::make($req->all(),[
            'email'=>'required',
            'password'=>'required'
        ]);
        if($validator->passes()){
          
            $check=DB::table('students')->where('email',$req->email)->value('password');
             

           if( Hash::check($req->password,$check)){
            $req->session()->put('semail', $req->email);
            return response()->json(['msg'=>'Valid'], 200);
           }
           else{
            return response()->json(['fail'=>'inncorect email or password'], 200);
           }
        
            
        }
        if($validator->fails()){

            return response()->json($validator->errors(),200);
        }
    }
    
    // register student

    function registerStudent(Request $req){
        $validator=Validator::make($req->all(),[
            'image'=>'required|mimes:jpeg,png,jpg,svg',
            'rollno'=>'required|unique:students|max:3',
            'name'=>'required|min:3',
            'major'=>'required',
            'year'=>'required',
            'email'=>'required',
            'password'=>'required|min:5',
            ]);   
        

            if($validator->passes()){

                if ($files = $req->file('image')) {
                    $destinationPath = 'uploads/student_image/';
                    $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                    $files->move($destinationPath, $profileImage);
                }

                $verification_number=mt_rand(1000,9999);
                $req->session()->put('verify_number', $verification_number); 
                $req->session()->put('image', $profileImage);
                $req->session()->put('email', $req->email);   
                $req->session()->put('rollno', $req->rollno);   
                $req->session()->put('name', $req->name);  
                $req->session()->put('major', $req->major);   
                $req->session()->put('year', $req->year);  
                $req->session()->put('password', $req->password);              
                 return response()->json(['msg'=>'tovertify'], 200);
            }


            if($validator->fails()){
                $errors = $validator->errors();
                return $errors->toJson();
         
         
            }

    }

    // verify
    function verify(Request $req){
        if(session('verify_number')){
            \Mail::to(session('email'))->send(new \App\Mail\VerifyMail(session('verify_number')));  
            return view('vertification');
        }
        else{
            return redirect('/');
        }
    }


    // student
    function student(Request $request){
       

            $student=Student::where('email',session('semail'))->first();
            $subjects=Attendance::where('rollno',$student->rollno)->get('subject');
            $major=0;
            $minor1=0;
            $minor2=0;
            $minor3=0;
            foreach($subjects as $subject){
                if( $subject->subject==$student->major){
                    ++$major;
                }
                if( $subject->subject=='Minor 1'){
                    ++$minor1;
                }
                if( $subject->subject=='Minor 2'){
                    ++$minor2;
                }
                if( $subject->subject=='Minor 3'){
                    ++$minor3;
                }     
        }
            $request->session()->put('profile_image', $student->img);
            $request->session()->put('smajor',$student->major);
            $rollnos=Attendance::where('year',$student->year)->pluck('rollno');
            $result=array_count_values($rollnos->toArray());
            asort($result);
            $Result=array_reverse($result);
            return view('student',['student'=>$student,'major'=>$major,'minor1'=>$minor1,'minor2'=>$minor2,'minor3'=>$minor3,"leaderboard"=>$Result]);
    }

    // student logout
    function student_logout(Request $request){
     $request->session()->forget('semail');
     $request->session()->forget('prfile_image');
     return redirect('student');

    }

    // student-forgetpassword
    function forgetpasswordstudent(Request $request){
        $validator=Validator::make($request->all(),[
            'rollno'=>'required'
        ]);
    if($validator->passes()){
        $email=Student::where('rollno',$request->rollno)->get('email');
        $name =Student::where('rollno',$request->rollno)->get('name');
      
            if(count($email)<1){
                return response()->json(['msg'=>"Invalid Rollno"], 200);
                
            }
            else{
                $token=Str::random(60);//token ko mail ko poh
                Studentpasswordreset::create([
                'rollno'=>$request->rollno,
               'token'=>$token,
               'create_at'=>date('Y-m-d H:i:s'),
                ]);
              
                \Mail::to($email)->send(new \App\Mail\Studentpasswordreset($name[0]->name,$token));
                return response()->json(['success'=>'success','sadf'=>$name[0]->name,'token'=>$token], 200);
            }
    }

    if($validator->fails()){
        $errors=$validator->errors();
        return $errors->toJson();
    }
}

// student password reset
function spreset(Request $request){
   if(Student::where('rollno',session('spreset-rollno'))->update(['password'=>Hash::make($request->password)])){
        return response()->json(['good'=>'gg'], 200);
   }
   
}



// teacher-login
function loginteacher(Request $req){
  $validator=Validator::make($req->all(),[
            'email'=>'required',
            'password'=>'required'
        ]);
      
    if($validator->passes()){
        $check=DB::table('teachers')->where('email',$req->email)->value('password');
        if(Hash::check($req->password,$check)){
            $req->session()->put('temail',$req->email);
            return response()->json(['msg'=>'success'],200);
        }
        else{
            return response()->json(['msg'=>'fail'], 200);
        }

    }
    if($validator->fails()){
        $errors=$validator->errors();
        return $errors->toJson();
    }
}

 // teacher-forgetpassword
 function forgetpasswordteacher(Request $request){
    $validator=Validator::make($request->all(),[
        'tid'=>'required'
    ]);
if($validator->passes()){
    $email=Teacher::where('tid',$request->tid)->get('email');
    $name =Teacher::where('tid',$request->tid)->get('name');
  
        if(count($email)<1){
            return response()->json(['msg'=>"Invalid teacher id"], 200);
            
        }
        else{
            $token=Str::random(60);//token ko mail ko poh
            Teacherpasswordreset::create([
            'tid'=>$request->tid,
           'token'=>$token,
           'create_at'=>date('Y-m-d H:i:s'),
            ]);
          
            \Mail::to($email)->send(new \App\Mail\Teacherpasswordreset($name[0]->name,$token));
            return response()->json(['success'=>'success','sadf'=>$name[0]->name,'token'=>$token], 200);
        }
}

if($validator->fails()){
    $errors=$validator->errors();
    return $errors->toJson();
}
}


// teacher password reset
function tpreset(Request $request){
    if(Teacher::where('tid',session('tpreset-tid'))->update(['password'=>Hash::make($request->password)])){
         return response()->json(['good'=>'gg'], 200);
    }
    
 }

 //teacher logout
 function teacher_logout(Request $request){
    $request->session()->forget('temail');
    // $request->session()->forget('prfile_image');
    return redirect('teacher');
 }

 // teacher
 function teacher(Request $request){
    $teacher=Teacher::where('email',session('temail'))->first();
    $request->session()->put('tprofile_image', $teacher->img);
    $request->session()->put('tid', $teacher->tid);
    return view('teacher',['teacher'=>$teacher]);
}



//rollcall
function rollcall(Request $req){
    $validator=Validator::make($req->all(),[
        'year'=>'required',
        'lifetime'=>'required',
        'subject'=>'required',
        'major'=>'required'
    ]);
    if($validator->passes()){
                $token=Str::random(60);
                $tid=session('tid');
                Rollcall::create([
                'tid'=>$tid,
                'token'=>$token,
                'time'=>time(),
                'year'=>$req->year,
                'lifetime'=>$req->lifetime,
                'subject'=>$req->subject,
                'major'=>$req->major
                ]);
               
                return response()->json(['success'=>'success','token'=>$token], 200);
            
    }
  

}
}
