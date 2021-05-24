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
use App\Models\Notice;

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

//assignmentans
use App\Models\Assignmentanswer;

use App\Events\MyEvent;
use App\Events\AssignmentEvent;
use App\Events\TeacherEvent;


//admin 
use App\Models\Admin;

use App\Models\Feedback;



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
            $request->session()->put('srollno',$student->rollno);

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

            for($j=0;$j<count($notitids);$j++){
                $notiimgs[$j]=Teacher::where("tid",$notitids[$j]["tid"])->first("img")->img;
                $notitnames[$j]=Teacher::where("tid",$notitids[$j]["tid"])->first("name")->name;
            }

            for($i=0;$i<count($notititles);$i++ ){
                $noti[$i]["title"]=$notititles[$i]["title"];
                $noti[$i]["detail"]=$notidetails[$i]["detail"];
                $noti[$i]["tid"]=$notitids[$i]["tid"];
                $noti[$i]["date"]=$notidates[$i]["date"];
                $noti[$i]["img"]=$notiimgs[$i];
                $noti[$i]["name"]=$notitnames[$i];
                $noti[$i]["label"]="assignment";
            }
         
            
            $request->session()->put('sanoti',array_reverse($noti));

            $admin=Admin::where('id',1)->first();
            // dd($admin->img);
            $anoti=[];
            $anotititles=Notice::pluck('title');
            $anotidetails=Notice::pluck('detail');
            $anotidates=Notice::pluck('date');
          
            for($i=0;$i<count($anotititles);$i++ ){
                $anoti[$i]["title"]=$anotititles[$i];
                $anoti[$i]["detail"]=$anotidetails[$i];
                $anoti[$i]["date"]=$anotidates[$i];
                $anoti[$i]["img"]=$admin->img;
            }


            return view('student',['student'=>$student,'major'=>$major,'minor1'=>$minor1,'minor2'=>$minor2,'minor3'=>$minor3,"leaderboard"=>$Result,"chartdata"=>$chartdata,"event"=>$event,"noti"=>array_reverse($noti),"anoti"=>array_reverse($anoti)]);
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

    //noti
    $notititles=Assignmentanswer::where(["to"=>$teacher->tid])->get("subject");
    $notidates=Assignmentanswer::where(["to"=>$teacher->tid])->get("date");
    $notidetails=Assignmentanswer::where(["to"=>$teacher->tid])->get("detail");
    $notirollnos=Assignmentanswer::where(["to"=>$teacher->tid])->get("sender");
    $notifiles=Assignmentanswer::where(["to"=>$teacher->tid])->get("attachment");
    $noti=[];
    $notiimgs=[];
    $notitnames=[];
    // dd($notititles[0]["title"]);
    // dd($notirollnos);
    for($j=0;$j<count($notirollnos);$j++){
        $notiimgs[$j]=Student::where("rollno",$notirollnos[$j]["sender"])->first("img")->img;
        $notitnames[$j]=Student::where("rollno",$notirollnos[$j]["sender"])->first("name")->name;
    }
    // dd($notiimgs);
    // $notiimgs=Teacher::where("tid")
    for($i=0;$i<count($notititles);$i++ ){
        $noti[$i]["title"]=$notititles[$i]["subject"];
        $noti[$i]["detail"]=$notidetails[$i]["detail"];
        $noti[$i]["rollno"]=$notirollnos[$i]["sender"];
        $noti[$i]["date"]=$notidates[$i]["date"];
        $noti[$i]["file"]=$notifiles[$i]["attachment"];
        $noti[$i]["img"]=$notiimgs[$i];
        $noti[$i]["name"]=$notitnames[$i];
        // $noti[$i]["label"]="assignment";
    }
    
    $request->session()->put('tanoti',array_reverse($noti));


    $admin=Admin::where('id',1)->first();
    // dd($admin->img);
    $anoti=[];
    $anotititles=Notice::pluck('title');
    $anotidetails=Notice::pluck('detail');
    $anotidates=Notice::pluck('date');
  
    for($i=0;$i<count($anotititles);$i++ ){
        $anoti[$i]["title"]=$anotititles[$i];
        $anoti[$i]["detail"]=$anotidetails[$i];
        $anoti[$i]["date"]=$anotidates[$i];
        $anoti[$i]["img"]=$admin->img;
    }

    return view('teacher',['teacher'=>$teacher,'class'=>$classes,'list'=>$list,"event"=>$event,
    "noti"=>array_reverse($noti),"anoti"=>array_reverse($anoti)]);
}


// profile edit 

function tprofile_edit(Request $req){
    $validator=Validator::make($req->all(),[
        'profile'=>'mimes:jpeg,png,jpg,svg',
    ]);
        
    if($validator->passes()){

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
if($validator->fails()){
    return response()->json("fail", 200, $headers);
}
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
'to'=>'required',
'detail'=>'required',
'sub'=>'required',
'attachment'=>'mimes:pdf,doc,docx,txt,csv,pptx|max:10240'
    ],[
        'attachment.mimes' => 'Only pdf,doc,docx,txt,csv,pptx are allowed',
    ]);

    if($validator->passes()){
        $profileImage='';
        
        if ($req->hasFile('attachment')) {
            $files = $req->file('attachment');
            $destinationPath = 'uploads/files/';
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
        }
        $token=Str::random(30);
        Assignmentanswer::create([
"to"=>$req->to,
"sender"=>session('srollno'),
'subject'=>$req->sub,
"detail"=>$req->detail,
"attachment"=>$profileImage,
"date"=>date("Y-m-d"),
"token"=>$token,
        ]);
event(new TeacherEvent($req->to,session('srollno')));
        return response()->json(['msg'=>"good"],200);
    }
    else{
        $errors=$validator->errors();
        return response()->json($errors,200);
    }
  
}


//admin login
function adminlogin(Request $req){
    // $Password=Admin::where('email',$req->email)->get('password');

    $check=Admin::where('email',$req->email)->value('password');
             

    if($req->password==$check){
     $req->session()->put('adminemail', $req->email);
  
     return response()->json(['msg'=>'Valid'], 200);
    }
    return response()->json(['err'=>"Invalid email or password!"],200);
}

function admindashboard(Request $req){
    $admin=Admin::where('email',session('adminemail'))->first();
    $req->session()->put('adminimg', $admin->img);
    // dd($admin);
    $jstudent=[];
    $jstudent1=Student::where(['major'=>"Japan","year"=>"First Year"])->count();
    $jstudent2=Student::where(['major'=>"Japan","year"=>"Second Year"])->count();
    $jstudent3=Student::where(['major'=>"Japan","year"=>"Third Year"])->count();
    $jstudent=[$jstudent1,$jstudent2,$jstudent3];

    $mstudent=[];
    $mstudent1=Student::where(['major'=>"Myanmar","year"=>"First Year"])->count();
    $mstudent2=Student::where(['major'=>"Myanmar","year"=>"Second Year"])->count();
    $mstudent3=Student::where(['major'=>"Myanmar","year"=>"Third Year"])->count();
    $mstudent=[$mstudent1,$mstudent2,$mstudent3];

    $estudent=[];
    $estudent1=Student::where(['major'=>"English","year"=>"First Year"])->count();
    $estudent2=Student::where(['major'=>"English","year"=>"Second Year"])->count();
    $estudent3=Student::where(['major'=>"English","year"=>"Third Year"])->count();
    $estudent=[$estudent1,$estudent2,$estudent3];

    $teacher1=Teacher::where(['department'=>"English"])->count();
    $teacher2=Teacher::where(['department'=>"Myanmar"])->count();
    $teacher3=Teacher::where(['department'=>"Japan"])->count();

    $teacherc=[$teacher1,$teacher2,$teacher3];

    // dd(Teacher::count());
    $student_total=Student::count();
    $teacher_total=Teacher::count();
    $feedback_total=Feedback::count();
    // dd($feedback_total);

    return view('dashboard',["admin"=>$admin,"jstudent"=>$jstudent,"mstudent"=>$mstudent,"estudent"=>$estudent,
    "teacherc"=>$teacherc,"teacher_total"=>$teacher_total,"student_total"=>$student_total,"feedback_total"=>$feedback_total]);

}


function admin_teacher(Request $req){
    // echo "adf"
$teacher=Teacher::pluck('tid');

$Teacher=[];
foreach($teacher as $aa){
    $Teacher[$aa]["name"]=Teacher::where('tid',$aa)->first('name')->name;
    $Teacher[$aa]["email"]=Teacher::where('tid',$aa)->first('email')->email;
    $Teacher[$aa]["img"]=Teacher::where('tid',$aa)->first('img')->img;
    $Teacher[$aa]["department"]=Teacher::where('tid',$aa)->first('department')->department;
    $Teacher[$aa]["id"]=Teacher::where('tid',$aa)->first('tid')->tid;
    $Teacher[$aa]["Id"]=Teacher::where('tid',$aa)->first('id')->id;
}




    return view('dteacher',["teacher"=>array_reverse($Teacher)]);
}


function admin_student(Request $req){
    // echo "adf";
$student=Student::pluck('rollno');
// dd($student);
$Student=[];
foreach($student as $aa){
    $Student[$aa]["name"]=Student::where('rollno',$aa)->first('name')->name;
    $Student[$aa]["email"]=Student::where('rollno',$aa)->first('email')->email;
    $Student[$aa]["img"]=Student::where('rollno',$aa)->first('img')->img;
    $Student[$aa]["year"]=Student::where('rollno',$aa)->first('year')->year;
    $Student[$aa]["major"]=Student::where('rollno',$aa)->first('major')->major;
    $Student[$aa]["id"]=Student::where('rollno',$aa)->first('rollno')->rollno;
    $Student[$aa]["Id"]=Student::where('rollno',$aa)->first('id')->id;
}


// dd($Student);

    return view('dstudent',["student"=>array_reverse($Student)]);
}


function addstudent(Request $req){
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
           Student::create([
                "img"=>$profileImage,
                "rollno"=>$year.$major.'-'.$req->rollno,
                "name"=>$req->name,
                "email"=>$req->email,
                "major"=>$req->major,
                "year"=>$req->year,
                "password"=>Hash::make($req->password)
           ]);
           return response()->json(["msg"=>"good"],200);
       }

    
    }
    return response()->json($validator->errors(),200);
}

function addteacher(Request $req){

    $validator=Validator::make($req->all(),[
        'image'=>'required|mimes:jpeg,png,jpg,svg',
        'name'=>'required|min:3',
        'department'=>'required',
        'email'=>'required',
        'password'=>'required|min:5',
        ]);   
   
    if($validator->passes()){
        if ($files = $req->file('image')) {
            $destinationPath = 'uploads/teacher_image/';
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
        }
        
        if(Teacher::count()==0){
            $rows=0;
        }else{
              $rows=Teacher::all()->last()->id;
        }
      
        $rows=$rows+1;
        $checktid=count(Teacher::where('tid','t-'.$rows)->pluck('tid'));   
        if($checktid>0){
            return response()->json(['tid'=>'Tid already exist!',"adf"=>'t-'.$rows],200);
        } else{
            Teacher::create([
                "img"=>$profileImage,
                "tid"=>'t-'.$rows,
                "name"=>$req->name,
                "email"=>$req->email,
                "department"=>$req->department,
                "password"=>Hash::make($req->password)
           ]);
           return response()->json(["msg"=>"good"],200);
        }
    }

    return response()->json(["aa"=>$validator->errors(),"bb"=>$rows],200);
}

function notice(Request $req){
    Notice::create([
        "title"=>$req->title,
        "detail"=>$req->detail,
        "date"=>date("Y-m-d")
    ]);
    event(new MyEvent($req->title,$req->detail));
    return response()->json($req->all(),200);
}



// profile edit 

function editstudent(Request $req){
    $validator=Validator::make($req->all(),[
        
    ]);
        
    if($validator->passes()){

    if ($files = $req->file('profile')) {

            $destinationPath = 'uploads/student_image/';
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
        
        Student::where('id',$req->id)->update(['img'=>$profileImage,'name'=>$req->name,"year"=>$req->year,"major"=>$req->major,
        "email"=>$req->email,"rollno"=>$req->rollno]);
        return response()->json(["file good bro"], 200);
    }
    else{
        Student::where('id',$req->id)->update(['img'=>$req->profile,'name'=>$req->name,"year"=>$req->year,"major"=>$req->major,
        "email"=>$req->email,"rollno"=>$req->rollno]);
        return response()->json([" good bro"], 200);
    }

    
}

if($validator->fails()){
    return response()->json("fail", 200, $headers);
}
}


function editteacher(Request $req){
    $validator=Validator::make($req->all(),[
        
    ]);
        
    if($validator->passes()){

    if ($files = $req->file('profile')) {

            $destinationPath = 'uploads/student_image/';
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
        
        Teacher::where('id',$req->id)->update(['img'=>$profileImage,'name'=>$req->name,"department"=>$req->department,
        "email"=>$req->email,"tid"=>$req->tid]);
        return response()->json(["file good bro"], 200);
    }
    else{
        Teacher::where('id',$req->id)->update(['img'=>$req->profile,'name'=>$req->name,"department"=>$req->department,
        "email"=>$req->email,"tid"=>$req->tid]);
        return response()->json([" good bro"], 200);
    }
return response()->json($req->all(), 200);
    
}

if($validator->fails()){
    return response()->json("fail", 200, $headers);
}
}

function admin_feedback(Request $req){
    $array=[];
    $ids=Feedback::pluck('id');
    foreach($ids as $aa){
        $array[$aa]['email']=Feedback::where('id',$aa)->first('email')->email;
        $array[$aa]['about']=Feedback::where('id',$aa)->first('about')->about;
        $array[$aa]['date']=Feedback::where('id',$aa)->first('date')->date;
        $array[$aa]['id']=Feedback::where('id',$aa)->first('id')->id;
    }
    // dd($array);
    return view('dfeedback',["data"=>array_reverse($array)]);
}


//admin logout
function admin_logout(Request $request){
    $request->session()->forget('adminemail');
    return redirect('/admin/dashboard');
 }

 //feedback
 function feedback(Request $req){
    Feedback::create([
        "email"=>$req->email,
        "about"=>$req->detail,
        "date"=>date("Y-m-d")
    ]);

     return response()->json($req->all(),200);
 }

}
