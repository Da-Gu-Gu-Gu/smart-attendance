<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
  
    <x-link/>
</head>
<body>

   <x-snavigation/>
 
    
{{-- profile-content --}}
    <div class="container my-3  rounded " style="background-color:#d6b4f0; ">
        <div class="row justify-content-around py-5 ">
        <div  class="col-lg-7">
            <center>  
                <div id="student" class="row bg-white  border shadow-lg ">
            <div id="student-image">
                <img src="{{asset('uploads/student_image/')}}<?php echo '/'.$student->img;?>" id="simage" alt="">
            </div>
            <div id="student-details"  class="py-5 px-lg-5 px-md-5 px-4 text-left " >
                <p>Rollno &nbsp;-  &nbsp;&nbsp;&nbsp;&nbsp;{{$student->rollno}}</p>
                <p>Name &nbsp;&nbsp;-  &nbsp;&nbsp;&nbsp;&nbsp;{{$student->name}}</p>
                <p>Year    &nbsp;&nbsp;&nbsp;&nbsp;-  &nbsp;&nbsp;&nbsp;&nbsp;{{$student->year}}</p>
            </div>
            </div>
        </center>
        </div>
        <div  class="col-lg-4 col-md-8 text-center pt-0 text-white mt-lg-0 mt-4">
                <center>
            <div id="records">
            <h2 class="py-3">ATTENDANCE RECORDS</h2>
            <div id="records-text" class=" pl-3 justify-content-around row">
                <p class="text-left">Myanmar</p>
                <p class="text-right">- &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1</p>
                
            </div>

            <div id="records-text" class="pl-3 justify-content-around row">
                <p class="text-left">Minor 1</p>
                <p class="text-right">- &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 1</p>
                
            </div>

            <div id="records-text" class=" pb-3 pl-3 justify-content-around row">
                <p class="text-left">Minor 1</p>
                <p class="text-right">- &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 1</p>
                
            </div>
        </div>
    
                </center>
        </div>
    </div>
    </div>

    {{-- catergories --}}
    <div id="catergories" class="container mt-4">
        <div class="row justify-content-around">
            <div id="scan" class="mb-4 mb-lg-0">
                <a href="student/scan">
                <div id="image" class="bg-white" >
                    <center><img src="https://img.icons8.com/ios/35/000000/portrait-mode-scanning--v2.png" class="py-2"/></center>
                </div>
                <p class="text-center text-white ">Scan To Attendance</p>
            </a>
            </div>
         
            <div id="attendance" class="mb-4 mb-lg-0">
                <a href="student/yourattendance">
                <div id="image" class="bg-white">
                 <center><img src="https://img.icons8.com/material-outlined/35/000000/combo-chart.png" class="py-2"/></center>
                </div>
                <p class="text-center text-white "> Your Attendance</p>
            </a>
            </div>
     
            <div id="leaderboards" >
                <div id="image" class="bg-white">
                 <center>   <img src="https://img.icons8.com/ios/35/000000/leaderboard.png" class="py-2"/></center>
                </div>
                <p class="text-center text-white ">Attendance Leaderboard</p>
            </div>
            <div id="calendar">
                <div id="image" class="bg-white">
                    <center><img src="https://img.icons8.com/ios/35/000000/calendar-12.png" class="py-2"/></center>
                </div>
                <p class="text-center text-white ">Attendance Leaderboard</p>
            </div>
        </div>
    </div>
    
    {{-- <script>
 
        document.getElementById('profile').src="uploads/student_image/"+localStorage.getItem('image'); --}}

    {{-- </script> --}}
</body>
</html>