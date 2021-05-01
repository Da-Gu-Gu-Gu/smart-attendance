<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Teacher;
use App\Models\Student;
use PDF;

class PdfController extends Controller
{
    //
      // Display user data in view
      public function showEmployees(){
        $employee = Attendance::all();
        return view('index', compact('employee'));
      }
  
      // Generate PDF
      public function createPDF() {
        // retreive all records from db
        $teacher=Teacher::where('email',session('temail'))->first();
    
        
    
    
        $herstulist=Attendance::where('tid',$teacher->id)->pluck('rollno'); //attendence list ko pya poh
        $list=[];
        foreach($herstulist as $aa){
            $major=Student::where('rollno',$aa)->first('major');
            $list[$aa]['major']=$major->major;  //dr ka major name
            // $list[$aa]['profile']=Student::where('rollno',$aa)->first('img')->img;
            $list[$aa]['Year']=Attendance::where('rollno',$aa)->first('year')->year;
            $list[$aa]['rollno']=Attendance::where('rollno',$aa)->first('rollno')->rollno;
            $list[$aa]['Major']=Attendance::where('rollno',$aa)->where('subject',$major->major)->count();  //dr ka count ma tuu buu
            $list[$aa]['Minor 1']=Attendance::where('rollno',$aa)->where('subject','Minor 1')->count();
            $list[$aa]['Minor 2']=Attendance::where('rollno',$aa)->where('subject','Minor 2')->count();
            $list[$aa]['Minor 3']=Attendance::where('rollno',$aa)->where('subject','Minor 3')->count();
            
        }
  
        // // share data to view
        view()->share('employee',$list);
        $pdf = PDF::loadView('pdf_view',["list"=> $list]);
  
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
      }
}
