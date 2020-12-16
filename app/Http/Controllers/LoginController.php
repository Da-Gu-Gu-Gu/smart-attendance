<?php

namespace App\Http\Controllers;


use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;

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
    function student(){
        if(session('semail')){
            return view('student');
        }else{
            return redirect('/login');
        }
    }
}
