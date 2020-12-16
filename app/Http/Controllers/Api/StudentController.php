<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $data=Student::get(['name','rollno','year','major','email']);
        return response()->json($data,200);
    }

 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        //
        
            if($req->verify_number==session('verify_number')){
            if(session('year')=='First Year'){
                $year=1;
            }
            if(session('year')=='Second Year'){
                $year=2;
            }
            if(session('year')=='Third Year'){
                $year=3;
            }
            if(session('major')=="Myanmar"){
                $major='MM';
            }
            if(session('major')=="English"){
                $major="EN";
            }
            if(session('major')=="Japan"){
                 $major="JP";
                }
         
                $student=Student::create([
                    'img'=>session('image'),
                    'rollno'=>$year.$major.'-'.session('rollno'),
                    'name'=>session('name'),
                    'major'=>session('major'),
                    'year'=>session('year'),
                    'email'=>session('email'),
                    'password'=>Hash::make(session('password')),
                    ]);
                    $semail=session('email');
                 
                    $req->session()->put('semail', $semail);
                    return response()->json(['msg'=>'success'],200);
            }
            elseif($req->verify_number!=session('verify_number')){
                return response()->json(['msg'=>'Incorrect number!'], 200);
            }
   
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
