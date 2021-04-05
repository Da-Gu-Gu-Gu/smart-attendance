<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <x-link/>
    <style>
        ul li{
            width: 14.1%;
            position: relative;
        }
    #days{
        margin-top:-15px;
        width: 100%;
        position: relative;
    }
    #days div{

        padding-left: 10px;
        display:inline-block;
        width:14.2%;
        height: 14.1%;
        color:rgb(78, 76, 76);
       

    }
    ul li{
        display: inline;
        list-style: none;
    }
   .background{
       width:100%;
       height: 100%;
       /* border-radius: 20%; */
       background-color:#ff7d7b;
   }
   .event{
       background-color: aqua;
   }
   #scan{
       border-radius: 10px;
   }
   #attendence-list{
       display: none;
   }
   #list:hover{
       cursor: pointer;
       width:111%;
       height: 101%;
       transition: all 0.3s;
   }
   .form-control{
       outline: none;
   }
 
</style>
</head>
<body>

   <x-tnavigation/>
 
    
{{-- profile-content --}}
    <div class="container my-3  rounded " style="background-color:#ff7d7b; ">
        <div class="row justify-content-around py-5 ">
        <div  class="col-lg-5 col-md-7 rounded container">
           <center>
                <div class="container">
                <div id="teacher" class="row  shadow-lg rounded mr-lg-5 ">
                    <img src="{{asset('uploads/student_image/20210104153407.jpg')}}"/> {{--teacher upload change ya oo ml --}}
                    <div id="status" class="col-12 text-white rounded">
                        <p class="font-weight-bold text-left pt-1 upper">{{$teacher->name}}</p>
                        <div class="d-flex justify-content-between pb-0 mb-0">
                            <p class=" p-1 rounded text-left blur">{{$teacher->tid}}</p>
                            <p class=" p-1 rounded text-right blur" >{{$teacher->department}}</p>
                       </div>
                    </div>
            </div>
                </div>
           </center>
     
        </div>
        <div  class="col-lg-4 col-md-7 text-center pt-0 text-white mt-lg-0 mt-4 mr-lg-5 bg-white rounded shadow">
          <center>
            
                <div id="header" class="d-flex justify-content-between">
                    <a href="#" class="previous round" style="font-size: 40px;" id="pre">&#8249;</a>
                    <div class="d-flex pt-4">
                    <h1 class="text-center"><p id="month" class="text-info" style="font-size: 1rem;"></p>
                    <h2 class="text-success text-center" id="year" style="font-size:1rem;"></h2></h1>
                    </div>
                    <a href="#" class="next round" style="font-size: 40px;" onclick="nextmonth();">&#8250;</a>
                </div>
                <div id="weekdays">
                    <ul class="d-flex  text-decoration-none list-unstyled  text-white" style="background-color: #ff7d7b;">
                        <li>Sun</li>
                        <li>Mon</li>
                        <li>Tue</li>
                        <li>Wed</li>
                        <li>Thu</li>
                        <li>Fri</li>
                        <li>Sat</li>
                    </ul>
                </div>
        
                   
        
                    <div id="days" class=" row    pb-2 pb-lg-0"></div>
           
                </center>
    </div>
    </div>
    </div>


   

    <div id="attendance-record" class=" container shadow-lg text-white  py-2">
        <p class="text-center font-weight-bold">CLASS RECORD</p>
        <div class="justify-content-between d-flex">
            <div class="col-4 text-center ">
                {{$class['First Year']?? 0}} <br>
                <small>First Year</small>
               
            </div>
            <div class="col-4 text-center ">
                {{$class['Second Year']?? 0}} <br>
                <small>Second Year</small>
            </div>
            <div class="col-4 text-center ">
                {{$class['Third Year']?? 0}} <br>
                <small>Third Year</small>
            </div>
        </div>
    </div>

    {{--  --}}
    <div class="container">
    <div class="row justify-content-around bg-light my-3 rounded">
 <a href="/student/scan" class=" col-4 mt-5 mb-4  bg-white shadow-sm" id="scan">
            <center><div   class="  rounded pt-2  " >
            
                <img src="https://img.icons8.com/fluent-systems-filled/34/26e07f/task.png" class="pt-2"/>
            <sm class="text-center text-dark pt-2 d-block">Assignment</sm>
        </div>   </center>
        </a>


        <a href="/student/scan" class=" col-4 mt-5 mb-4  bg-white shadow-sm" id="scan">
            <center><div   class="  rounded pt-2 pb-1 " >
            
                <img src="https://img.icons8.com/color/34/26e07f/mailbox-closed-flag-down--v1.png" class="pt-2"/>
            <p class="text-center text-dark pt-1">Inbox</p>
        </div>   </center>
        </a>
    </div>
</div>

    <center>
        <div class="container my-3">
      <div class="d-flex text-center text-white shadow-sm  my-2" id="menu">
          <div  class="left py-2 col-6 moves" id="chart" onclick="chart();">
            <img src="https://img.icons8.com/ios/30/000000/google-forms.png" />
            
          </div>
          <div  id="leaderboard" class="py-2 col-6" onclick="leaderboard();">
            <i class="fas fa-user-friends text-dark" style="font-size: 25px;"></i><br>
              
          </div>
      </div>
        </div>
  </center>
  
  <div id="rollcall" class="container mt-3  col-lg-6 col-md-10  shadow-lg rounded p-5">
      <h2 class="text-center">Create Roll Call</h2>
      <center>
      <form class="mt-5" id="rollcall">
    <label for="Year" class="col-lg-8 col-md-10 text-left pl-0">Year</label>
    <select class="form-select form-control col-lg-8 col-md-10 mb-4 form-select-lg" id="Year" aria-label="Default select example">
        <option >First Year</option>
        <option >Second Year</option>
        <option >Third Year</option>
      </select>
      <label for="major" class="col-lg-8 col-md-10 text-left pl-0">Major</label>
      <select class="form-select form-control col-lg-8 col-md-10 mb-4 form-select-lg" id="major" onchange="changemajor(this)" aria-label="Default select example">
          <option >Myanmar</option>
          <option >English</option>
          <option >Japan</option>
        </select>
      <label for="subject" class="col-lg-8 col-md-10 text-left pl-0">Subject</label>
      <select class="form-select form-control col-lg-8 col-md-10 mb-4 form-select-lg" id="subject" aria-label="Default select example">
          <option id="change-major" >Myanmar</option>
          <option >Minor 1</option>
          <option >Minor 2</option>
          <option >Minor 3</option>
        </select>
        <label for="lifetime" class="col-lg-8 col-md-10 text-left pl-0">Lifetime</label>
        <select class="form-select form-control  col-lg-8 col-md-10 mb-4 form-select-lg" id="lifetime" aria-label="Default select example">

            <option >3 Min</option>
            <option >5 Min</option>
            <option >10 Min</option>
          </select>

          <button class="btn  col-lg-8 col-md-10 text-white mt-3" id="submit" type="submit" style="background-color: tomato;">Send</button>
    </form>
      </center>
  </div>

{{-- attendence list --}}
<div class="container my-5" id="attendence-list" >
    <input type="text" class="form-control my-4 col-lg-3 col-md-4 col-5" placeholder="roll no" onkeyup="filter(this)" style="border-radius: 30px;">
    <center>
  <div class=" row justify-content-between"  id="stu_list">

       
            @foreach ($list as $stu)
            <section class="col-lg-4 col-md-6 shadow  pt-3 pb-2 px-2 mb-3 row justify-content-around" style="border-radius:15px;" id="list" data_rollno="{{$stu['rollno']}}" >
            <img src="{{asset('uploads/student_image/')}}<?php echo '/'.$stu['profile'];?>"  width="50px" height="50px" style="border-radius: 100%"; alt="">

            <div >
                <p class="mb-0 text-left" >{{$stu['rollno']}}</p>
                <ul style="color:#777777">
                    <li><small>{{$stu['major']}} :<span style="color:red"> {{$stu['Major']}}</span>,</small></li>
                    <li ><small>Minor 1 :  <span style="color:red">{{$stu['Minor 1']}}</span>,</small></li>

                    <li><small>Minor 2 :  <span style="color:red">{{$stu['Minor 2']}}</span>,</small></li>
                    <li ><small>Minor 3 :  <span style="color:red">{{$stu['Minor 3']}}</span></small></li>
                </ul>
            </div>

        </section>
            @endforeach
        

  </div>
</center>
</div>

<!-- Modal -->
<div class="modal fade" id="calendar_event" tabindex="-1" aria-labelledby="calendar_eventLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn " data-dismiss="modal" aria-label="Close">&times;</button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>


   <script src="{{asset('js/calendar.js')}}"></script> 


   <script type="text/javascript">
	VanillaTilt.init(document.querySelector("#list"), {
		max: 50,
		speed: 500
	});
	
	//It also supports NodeList
	VanillaTilt.init(document.querySelectorAll("#list"));
</script>

   <script>
    let Chartt = document.getElementById('chart');
let Leaderboard = document.getElementById('leaderboard');
let rollcall= document.getElementById('rollcall');
let attendence_list = document.getElementById("attendence-list");
function changemajor(e){
    document.getElementById('change-major').innerHTML=e.value;
}

function chart() {

Chartt.classList.add("left");
rollcall.style.display = "block";
attendence_list.style.display = "none";
Leaderboard.classList.remove("right");
}

function leaderboard() {
attendence_list.style.display = "block";
rollcall.style.display = "none";
Chartt.classList.remove("moves");
Chartt.classList.remove("left");
Leaderboard.classList.add("right");
}


let form=document.forms['rollcall'];
form.onsubmit=function(e){
    e.preventDefault();
    let year=document.getElementById('Year').value;
    let subject=document.getElementById('subject').value;
    let lifetime=document.getElementById('lifetime').value;
    let major=document.getElementById('major').value;


    axios.post('/api/rollcall',{
        'year':year,
        'subject':subject,
        'lifetime':lifetime,
        'major':major
    }).then(res=>{
        window.location='/rollcall/'+res.data.token;
    });
}

    
//filter
let items=document.getElementById("stu_list").children;
function filter(e){
    
    for(i=0;i<items.length;i++){
        items[i].style.display="none";
        if (items[i].getAttribute('data_rollno') == e.value.toUpperCase()) {    
            items[i].style.display = "flex"; 
        }
        if (e.value == '') {
            items[i].style.display = "flex"; 
        }

    }
 
    
}

</script>
</body>
</html>
</body>
</html>
