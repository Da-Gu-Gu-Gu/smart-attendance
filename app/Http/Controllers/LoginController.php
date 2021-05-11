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

// calendarevent
use App\Models\Calendarevent;

//assignment
use App\Models\Assignment;

use App\Events\MyEvent;
use App\Events\AssignmentEvent;

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


                if($req->year=='First Year'){
                    $year=1;
                }
                if($req->year=='Second Year'){
                    $year=2;
                }
                if($req->year=='Third Year'){
                    $year=3;
                }
                if($req->major=="Myanmar"){
                    $major='MM';
                }
                if($req->major=="English"){
                    $major="EN";
                }
                if($req->major=="Japan"){
                     $major="JP";
                    }

               $checkrollno=count(Student::where('rollno',$year.$major.'-'.$req->rollno)->pluck('rollno'));   
               if($checkrollno>0){
                   return response()->json(['rollno'=>'Roll no already exist!'],200);
               } else{

                $verification_number=mt_rand(1000,9999);
                $req->session()->put('verify_number', $verification_number); 
                $req->session()->put('image', $profileImage);
                $req->session()->put('email', $req->email);   
                $req->session()->put('rollno', $year.$major.'-'.$req->rollno);   
                $req->session()->put('name', $req->name);  
                $req->session()->put('major', $req->major);   
                $req->session()->put('year', $req->year);  
                $req->session()->put('password', $req->password);              
                 return response()->json(['msg'=>'tovertify'], 200);
               }
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
       
              //leaderboard
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

        if($student->year=='First Year'){
            $year=1;
        }
        if($student->year=='Second Year'){
            $year=2;
        }
        if($student->year=='Third Year'){
            $year=3;
        }
      
            $request->session()->put('profile_image', $student->img);
            $request->session()->put('smajor',$student->major);
            $request->session()->put('syear',$year);

            // dd('assignment'.session('syear'));
            $rollnos=Attendance::where('year',$student->year)->pluck('rollno');
            $result=array_count_values($rollnos->toArray());
            asort($result);
            $Result=array_reverse($result);

            
            //chart
            $dates=Attendance::where("rollno",$student->rollno)->pluck('date');
            $chartdata=array_count_values($dates->toArray());
           $chartdata= array_slice($chartdata,-5);//FOR 5 DAYS CHART DATA
         
  // event
  $event=[];
           $event_date=Calendarevent::where('userid',$student->rollno)->pluck('date');
           foreach($event_date as $data){
            $event[$data]=Calendarevent::where(['userid'=>$student->rollno,"date"=>$data])->pluck('event');;
        }
    //   dd($Result);
// noti

            $notititles=Assignment::where(["year"=>$student->year,"major"=>$student->major])->get("title");
            $notidates=Assignment::where(["year"=>$student->year,"major"=>$student->major])->get("date");
            $notidetails=Assignment::where(["year"=>$student->year,"major"=>$student->major])->get("detail");
            $notitids=Assignment::where(["year"=>$student->year,"major"=>$student->major])->get("tid");
            $noti=[];
            $notiimgs=[];
            $notitnames=[];
            // dd($notititles[0]["title"]);
            for($j=0;$j<count($notitids);$j++){
                $notiimgs[$j]=Teacher::where("tid",$notitids[$j]["tid"])->first("img")->img;
                $notitnames[$j]=Teacher::where("tid",$notitids[$j]["tid"])->first("name")->name;
            }
            // dd($notiimgs);
            // $notiimgs=Teacher::where("tid")
            for($i=0;$i<count($notititles);$i++ ){
                $noti[$i]["title"]=$notititles[$i]["title"];
                $noti[$i]["detail"]=$notidetails[$i]["detail"];
                $noti[$i]["tid"]=$notitids[$i]["tid"];
                $noti[$i]["date"]=$notidates[$i]["date"];
                $noti[$i]["img"]=$notiimgs[$i];
                $noti[$i]["name"]=$notitnames[$i];
                $noti[$i]["label"]="assignment";
            }
            // dd($noti);
            // print_r($noti);
            
            $request->session()->put('sanoti',array_reverse($noti));


            return view('student',['student'=>$student,'major'=>$major,'minor1'=>$minor1,'minor2'=>$minor2,'minor3'=>$minor3,"leaderboard"=>$Result,"chartdata"=>$chartdata,"event"=>$event,"noti"=>array_reverse($noti)]);
    }

    // student logout
    function student_logout(Request $request){
     $request->session()->forget('semail');
     $request->session()->forget('prfile_image');
     $request->session()->forget('syear');
     $request->session()->forget('sanoti');
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


// profile edit 

function sprofile_edit(Request $req){
    $validator=Validator::make($req->all(),[
        'profile'=>'mimes:jpeg,png,jpg,svg',
    ]);
        
    if($validator->passes()){

    if ($files = $req->file('profile')) {

            $destinationPath = 'uploads/student_image/';
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
        
        Student::where('email',session('semail'))->update(['img'=>$profileImage,'name'=>$req->name]);
    }
    else{
        Student::where('email',session('semail'))->update(['img'=>$req->profile,'name'=>$req->name]);
    }

     return response()->json(["value"=>$req->profile,"name"=>$req->name,"type"=>gettype($req->profile)], 200);
}

if($validator->fails()){
    return response()->json("fail", 200, $headers);
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
            $req->session()->put('tid',$req->tid);
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
    $request->session()->forget('tprfile_image');
    $request->session()->forget('tid');
    return redirect('teacher');
 }

 // teacher
 function teacher(Request $request){
    $teacher=Teacher::where('email',session('temail'))->first();
    $request->session()->put('tprofile_image', $teacher->img);
    $request->session()->put('tid', $teacher->tid);


    
    $years=Rollcall::where('tid',$teacher->tid)->pluck('year');  //classes
    $classes=array_count_values($years->toArray());


    $herstulist=Attendance::where('tid',$teacher->tid)->pluck('rollno'); //attendence list ko pya poh
    $list=[];
    foreach($herstulist as $aa){
        $major=Student::where('rollno',$aa)->first('major');
        $list[$aa]['major']=$major->major;  //dr ka major name
        $list[$aa]['profile']=Student::where('rollno',$aa)->first('img')->img;
        $list[$aa]['Year']=Attendance::where('rollno',$aa)->first('year')->year;
        $list[$aa]['rollno']=Attendance::where('rollno',$aa)->first('rollno')->rollno;
        $list[$aa]['Major']=Attendance::where('rollno',$aa)->where('subject',$major->major)->count();  //dr ka count ma tuu buu
        $list[$aa]['Minor 1']=Attendance::where('rollno',$aa)->where('subject','Minor 1')->count();
        $list[$aa]['Minor 2']=Attendance::where('rollno',$aa)->where('subject','Minor 2')->count();
        $list[$aa]['Minor 3']=Attendance::where('rollno',$aa)->where('subject','Minor 3')->count();
        
    }
 
    // event
    $event=[];
    $event_date=Calendarevent::where('userid',$teacher->tid)->pluck('date');
    foreach($event_date as $data){
        $event[$data]=Calendarevent::where(['userid'=>$teacher->tid,"date"=>$data])->pluck('event');;
    }

    return view('teacher',['teacher'=>$teacher,'class'=>$classes,'list'=>$list,"event"=>$event]);
}


// profile edit 

function tprofile_edit(Request $req){

    if ($files = $req->file('profile')) {

            $destinationPath = 'uploads/teacher_image/';
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
        
        Teacher::where('email',session('temail'))->update(['img'=>$profileImage,'name'=>$req->name]);
    }
    else{
        Teacher::where('email',session('temail'))->update(['img'=>$req->profile,'name'=>$req->name]);
    }

   
     return response()->json(["value"=>$req->profile,"name"=>$req->name], 200);
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
               
                $req->session()->put('qr-lifetime', $req->lifetime);       //qrcode ko lifetime countdown loke poh

                return response()->json(['success'=>'success','token'=>$token], 200);
            
    }
  

}

// calendar event
function calendarevent(Request $req){

    $validator=Validator::make($req->all(),[
        'event'=>'required',
        'date'=>'required',
        'userid'=>'required'
    ]);
    if($validator->passes()){
        for($i=0;$i<count($req->event);$i++){
            if(!Calendarevent::where(["userid"=>$req->userid,"date"=>$req->date,"event"=>$req->event[$i]])->exists()){
            Calendarevent::create([
                "userid"=>$req->userid,
                "event"=>$req->event[$i],
                "date"=>$req->date,
            ]);
            }
        }
    }


     return response()->json(["message"=>"success"], 200);
}



// assignment
function assignment(Request $req){
        $validator=Validator::make($req->all(),[
            'title'=>"required",
            'detail'=>'required',
            'year'=>"required",
            'major'=>'required',
            
        ]);
        if($validator->passes()){
            $token=Str::random(60);
            Assignment::create([
                "title"=>$req->title,
                "detail"=>$req->detail,
                "year"=>$req->year,
                "major"=>$req->major,
                "tid"=>$req->tid,
                "date"=>date("Y-m-d"),
                "token"=>$token,
            ]);

            event(new AssignmentEvent($req->tid,$token,$req->year,$req->major));
            return response()->json(["message"=>"success"], 200);
        }
}

function assanswer(Request $req){
    $validator=Validator::make($req->all(),[
        'to'=>"required",
       'sub'=>"required",
       'detail'=>"required",
       'list.*'=>'mimes:png',
    ]);
    if($validator->passes()){
        return response()->json(["type"=>gettype($req->list),"kee"=>$req->list],200);
    }

    if($validator->fails()){
        $aa=json_decode(html_entity_decode($req->list),true);



// json_decode(stripslashes($_POST['data']))
        
        $errors=$validator->errors();
        return response()->json(["error"=>$errors,"arr"=>$aa,"f"=>$req->list,"type"=>gettype($aa)], 200);
    }


}
}
