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
            $request->session()->put('profile_image', $student->img);
            return view('student',['student'=>$student]);
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

}
