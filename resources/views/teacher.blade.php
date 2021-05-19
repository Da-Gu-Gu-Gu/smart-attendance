<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="https://i.ibb.co/ZzqN21h/Group-1-1.png" type="image/png" >
 
    <title>Smart Attendance</title>
    <x-link/>
    <style>
        *{
            margin: 0;
            padding:0;
        }
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
       background-color:#EEA4B6;
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
 #print{
     float: right;
    display: inline-block;
    border-radius: 10px;
    
    /* padding: 0 auto; */
    color:white;
    background-color: rgb(255, 0, 127);
  
   
 }
 #control{
    border-radius: 10px;
background: #ece2e2;
padding:15px;
 }

 body:not(.modal-open){
  padding-right: 0px !important;
}
.custom-control-input:checked~.custom-control-label::before {
  background-color: #FF66CB;
    border-color: #FF66CB;
  -webkit-box-shadow: none;
}

</style>
</head>
<body>

   <x-tnavigation/>

    
{{-- profile-content --}}
    <div class="container my-3  rounded " style="background-color:#FFE3EF; z-index:-1!important;">
        <div class="row justify-content-around py-5 ">
        <div  class="col-lg-5 col-md-7 rounded container">
           <center>
                <div class="container">
                <div id="teacher" class="row  shadow-lg rounded mr-lg-5 ">
                    <img src="{{asset('uploads/teacher_image/')}}<?php echo '/'.$teacher->img;?>"/> {{--teacher upload change ya oo ml --}}
                    <div id="status" class="col-12 text-white rounded">
                        <p class="font-weight-bold text-left pt-1 upper">{{$teacher->name}}</p>
                        <div class="d-flex justify-content-between pb-0 mb-0">
                            <p class=" p-1 rounded text-left blur" id="user_id">{{$teacher->tid}}</p>
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
                    <ul class="d-flex  text-decoration-none list-unstyled  text-white" style="background-color: #ff007f;">
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
 <a href="" class=" col-4 mt-5 mb-4  bg-white shadow-sm" id="scan" data-toggle="modal" data-target="#assignment">
            <center><div   class="  rounded pt-2  " >
            
                <img src="https://img.icons8.com/fluent-systems-filled/34/26e07f/task.png" class="pt-2"/>
            <sm class="text-center text-dark pt-2 d-block">Assignment</sm>
        </div>   </center>
        </a>


        <a href="" class=" col-4 mt-5 mb-4  bg-white shadow-sm" id="scan"  data-toggle="modal" data-target="#inbox">
            <center><div   class="  rounded pt-2 pb-1 " >
            
                <i class="fas fa-inbox pt-2" style="font-size: 36px;color:blue;"></i>
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

          <button class="btn  col-lg-8 col-md-10 text-white mt-3" id="submit" type="submit" style="background-color: #FF66CB;">Send</button>
    </form>
      </center>
  </div>

{{-- attendence list --}}
<div class="container" id="attendence-list" >
    <br>

    <button class="btn" id="print" class="container" data-toggle="modal" data-target="#download_check"><a href="#" class="text-white" >
        <i class="fas fa-download"></i></a>
    </button>
    <br>
    <br>
    <div id="control" class="mt-3 mb-5">
       
  
    <div id="filter" class="row my-4 container justify-content-between">
       <div class="input-group  col-lg-7  col-md-5 col-12 mb-3 mb-md-0 mb-lg-0">

    <input type="text"  id="search"  class="form-control" placeholder="Enter roll no" onkeyup="filter(this)" >
    <span toggle="#search" class="text-dark fas fa-search field-icon"  id="teye" onclick="focusInput(this)"></span>
    </div>   
      
    <select class="form-control col-lg-2 col-md-3 col-6 " onchange="m_filter(this)">
        <option selected>Major</option>
        <option>Myanmar</option>
        <option >English</option>
        <option >Japan</option>
    </select>

    <select class="form-control col-lg-2 col-md-3 col-6 mr-0" onchange="y_filter(this)">
        <option selected>Year</option>
        <option>First Year</option>
        <option >Second Year</option>
        <option >Third Year</option>
    </select>


</div>



</div>
{{-- <div class="container mb-3 mt-2 row">
    <div class="major-f d-inline-block p-1 border  border-danger mr-2" style="border-radius: 10px;">Myanmar</div>
    <div class="year-f d-inline-block p-1 border  border-danger" style="border-radius: 10px;">First Year</div>
</div> --}}
    <center>
  <div class=" row justify-content-between"  id="stu_list">

       
            @foreach ($list as $stu)
            <section class="col-lg-4 col-md-6 shadow  pt-3 pb-2 px-2 mb-3 row justify-content-around" style="border-radius:15px;" id="list" data_rollno="{{$stu['rollno']}}" data_major="{{$stu['major']}}" data_year="{{$stu['Year']}}" >
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

<!--calendar  Modal -->
<div class="modal fade my-5 " id="calendar_event" tabindex="-1" aria-labelledby="calendar_eventLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="d-flex justify-content-between px-3 pt-4">
            <h5 class="modal-title" id="ppeditLabel">Add Event</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true"  style="font-size:30px !important;color:red;">&times;</span>
            </button>
          </div>
        <div class="modal-body">
            <form  id="event_form" >
                @csrf
                <div id="list_group" class="swing">
            <input type="text" name="" id="input1" class="list mb-4  show text-left" placeholder="Event Name">
            <div id="input_group"></div>
        </div>

          <div id="add-to-list" class="border btn text-center col-12 " style=" -webkit-box-shadow: none;"><i class="far fa-plus-square"></i></div>
         
        </div>

        <div id="event_list" class="col-12 d-flex row">

        </div>
             
  
      
          <button type="submit" class="btn text-white mb-3 mx-3 "  style="background-color: #ff007f;">Save</button>
 
        </form>
      </div>
    </div>
  </div>


{{-- pp edit modal --}}
  <div class="modal fade my-5" id="ppedit" tabindex="-1" aria-labelledby="ppeditLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="d-flex justify-content-between px-3 pt-4">
          <h5 class="modal-title" id="ppeditLabel">Edit Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
            <span aria-hidden="true"  style="font-size:30px !important;color:red;">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" id="profile_edit" name="profile_edit" enctype="multipart/form-data">
            @csrf
            <div class="d-flex justify-content-between">
                <div id="image" class="col-3">
                <img src="{{asset('uploads/teacher_image/')}}<?php echo '/'.$teacher->img;?>"  id="imagepreview" class="rounded bg-light border border-info" width="75px" height="75px">
                <label for="profile-edit" style="position: relative;;top:-24px;left:-1px;width:75px;background:rgba(0,0,0,0.6);cursor: pointer;"  class="rounded text-white text-center">upload</label>
                <input type="file"  name="profile-edit" class="d-none" id="profile-edit" value="{{$teacher->img}}" onchange="readURL(this)"> 
                <small class="d-none" id="image-value">{{$teacher->img}}</small>
            </div>
               
            <input type="text" class="form-control col-8 col-lg-9 col-md-9 " name="name" id="name" value="{{$teacher->name}}" placeholder="Enter name">
        </div>
      
          <button type="submit" class="btn text-white " style="background-color: #ff007f;float: right;margin-top:-10px;"><i class="fas fa-check"></i> Save changes</button>
        </form>
        </div>
      </div>
    </div>
  </div>


{{-- download check --}}
  <div class="modal fade my-5" id="download_check" tabindex="-1" aria-labelledby="download_check" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="d-flex justify-content-between px-3 pt-4">
          <h5 class="modal-title" id="download_check">Which's year you want to download?</h5>
        </div>
        <div class="modal-body">
            <form method="POST" id="download_form" >
            @csrf
            <div class="custom-control custom-radio mb-3">
                <input class="custom-control-input" type="radio" name="customRadioInline1" id="inlineRadio1" value="all" checked>
                <label class="custom-control-label" for="inlineRadio1">All</label>
              </div>
              <div class="custom-control custom-radio mb-3">
                <input class="custom-control-input" type="radio" name="customRadioInline1" id="inlineRadio2" value="First Year">
                <label class="custom-control-label" for="inlineRadio2">First Year</label>
              </div>      
                <div class="custom-control custom-radio mb-3">
                <input class="custom-control-input" type="radio" name="customRadioInline1" id="inlineRadio3" value="Second Year">
                <label class="custom-control-label" for="inlineRadio3">Second Year</label>
              </div>        
              <div class="custom-control custom-radio mb-3">
                <input class="custom-control-input" type="radio" name="customRadioInline1" id="inlineRadio4" value="Third Year">
                <label class="custom-control-label" for="inlineRadio4">Third Year</label>
              </div>
        </div>
      
          <button type="submit" class="btn text-white mb-3 mx-3" style="background-color: #ff007f;float: right;margin-top:-10px;">Download</button>
        </form>
        </div>
      </div>
    </div>
  </div>



{{-- assignment modal --}}
<div class="modal fade my-5" id="assignment" tabindex="-1" aria-labelledby="assignmentLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="d-flex justify-content-between px-3 pt-4">
        <h5 class="modal-title" id="assignmentLabel">Create Assignment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true"  style="font-size:30px !important;color:red;">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form   id="assignment_form" >
          @csrf
             
          <input type="text" name="name" class="text-left mb-4" id="title" value="" placeholder="Title">
          <div class="form-group mb-4">
            <label for="detail">Detail</label>
            <textarea class="form-control" id="detail" rows="3" placeholder="Detail"></textarea>
          </div>

          <div class="form-group contianer mb-4">
            <label for="">To</label>
            <div class="row justify-content-around">
            <select class="form-control col-5 " id="amajor">
           
              <option>Myanmar</option>
              <option >English</option>
              <option >Japan</option>
          </select>
      
          <select class="form-control col-5" id="ayear">

              <option>First Year</option>
              <option >Second Year</option>
              <option >Third Year</option>
          </select>
            </div>
          </div>
        
      </div>
    
   
        <button type="submit" class="btn text-white  mx-3  mb-2" style="background-color: #ff007f;"> Send</button>
      </form>
      </div>
    </div>
  </div>
</div>



{{-- inbox modal --}}
<div class="modal fade my-5" id="inbox" tabindex="-1" aria-labelledby="inboxLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="d-flex justify-content-between px-3 pt-4">
          <h5 class="modal-title" id="inboxLabel">     <i class="fas fa-inbox " style="color:blue;"></i> Inbox</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
            <span aria-hidden="true"  style="font-size:30px !important;color:red;">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="text" name="" id="searchinbox" class="col-12"style="border-radius: 25px;" placeholder="Search ">

            <div id="inbox_content"  style="overflow-y: auto;height:400px; overflow-style: auto;-webkit-overflow-scrolling: display-none;">

            {{-- d mhr for loop --}}


            <div class="container mt-2 ">
              <div class="d-flex text-center text-white shadwo-sm  my-2" id="menu">
                  <div  class="left  col-6 moves" id="ass" onclick="first();" style="color:gray;">
                   Assignment
                    
                  </div>
                  <div  id="notice" class=" col-6" onclick="second();" style="color: gray">
                    Notice
                      
                  </div>
              </div>
                </div>
         
            <div id="first">
            @foreach ($noti as $data)
            <div id="inbox_body" class="d-flex    my-2 container justify-content-between " style="border-radius:5px;cursor: pointer;" onclick="openview(this)" data='<?php echo json_encode($data);?>'>
               <img src="{{asset('uploads/student_image/')}}<?php echo '/'.$data['img'];?>" class="my-3  rounded-circle" style="width: 45px;height:45px;" alt="">
               <div class="col-8  text-left py-3 ">
                  <p class="mb-0 ml-0">{{$data['name']}}</p>
                   <small style="color:#777777;" >{{$data['title']}} </small>
               </div>
               <div class="py-3 pr-0 text-right ">
                   <small style="color:white;">{{$data['date']}}</small>
               </div>
           </div>
            @endforeach
          </div>


        <div id="second" style="display: none">
          @foreach ($anoti as $data)
         
          <div  id="inbox_body" class="d-flex   my-2 container justify-content-between " style="border-radius:5px;cursor: pointer;" onclick="openview1(this)" data='<?php echo json_encode($data);?>'>
             
             <img src="{{asset('uploads/student_image/')}}<?php echo '/'.$data['img'];?>" class="my-3  rounded-circle" style="width: 45px;height:45px;" alt="">
             <div class="col-8  text-left py-3 ">
                <p class="mb-0 ml-0">Admin</p>
                 <small style="color:#777777;" >{{$data['title']}} </small>
             </div>
             <div class="py-3 pr-0 text-right ">
                 <small style="color:white;">{{$data['date']}}</small>
             </div>
         </div>
   
          @endforeach
         </div>

         


            </div>

           
              {{-- hahah --}}
              <div id="openview" style="display: none;"">
                <span class="text-dark " style="cursor: pointer;" onclick="close_view()"> <i class="fas fa-arrow-left py-3"></i></span> 
            
                <div id="inbox-oheader" class="d-flex shadow-sm mb-4">
                    <div class=" pl-3">
                  <img id="oimg" src="" class="my-3  rounded-circle " style="width: 40px;height:40px;" alt="">
                </div>
                  <div class="col-7  text-left py-3 ">
                    <b><p class="mb-0 pb-0" id="oname">1MM-100</p></b>
                     <small style="color:#777777;" class="mt-0" id="oid">mountchitmyrsuu@gmail.com </small>
                 </div>
                 <small style="color: #777777" class="text-right py-3 col-4 pr-4 " id="odate">2021-05-10</small>
                </div>
                <span id="otitle" style="color:#a55cdd;">dr ka title</span>
                <div class="my-3" id="gg">
                <a href="" id="dfile" download class="text-dark"><i class="fas fa-file-download" style="font-size:1.4rem;"></i><br><small id="dtext" ></small></a>
              </div>
                <p class="mt-3" id="odetail">Dear Gair,
                    ah dfadsafdasfkjsdajl;fj;ldsafjlasdfl
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus doloribus nesciunt excepturi explicabo odit laborum veritatis. Ea itaque reprehenderit unde porro ipsam laborum aspernatur hic, explicabo rerum culpa fugiat corporis!
                </p>
                {{-- <iframe src="{{asset('uploads/files/AttendanceList(all).pdf')}}" >ads
                </iframe> --}}
              </div>
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
let ass = document.getElementById('ass');
let not= document.getElementById('notice');
let  padama = document.getElementById('first');
let dutaya = document.getElementById("second");
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

function first() {

ass.classList.add("left");
padama.style.display = "block";
dutaya.style.display = "none";
not.classList.remove("right");
}

function second() {
dutaya.style.display = "block";
padama.style.display = "none";
ass.classList.remove("moves");
ass.classList.remove("left");
not.classList.add("right");
}

function readURL(image){
    if(image.files && image.files[0]){
        var reader=new FileReader();
        reader.onload=function(e){
            $('#imagepreview').attr('src',e.target.result);
        }

        reader.readAsDataURL(image.files[0]);
    }
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

// assignment_form
let form_assing=document.forms["assignment_form"];
form_assing.onsubmit=function(e){
  e.preventDefault();
  let title=document.getElementById("title").value;
  let detail=document.getElementById("detail").value;
  let year=document.getElementById("ayear").value;
  let major=document.getElementById("amajor").value;
  let tid=document.getElementById('user_id').innerText;

  axios.post('/api/assignment',{
    'title':title,
    'detail':detail,
    'year':year,
    'major':major,
    'tid':tid
  }).then(res=>{
    console.log(res);
  })
}

let form_edit=document.forms['profile_edit'];
form_edit.onsubmit=function(e){
    e.preventDefault();
    let form_data=new FormData();
    let profile_img=document.getElementById('profile-edit');
    let name=document.getElementById('name');
    if(profile_img.files[0]==undefined)
    { 
        form_data.append("profile",document.getElementById("image-value").innerText);
}
    else{
        form_data.append("profile", profile_img.files[0]);
    }


    
    form_data.append("name", name.value);
    console.log(form_data);

    axios.post('/api/tprofile_edit',form_data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then(res=>{
       window.location='/teacher';
    });
}


// download
let download_form=document.forms['download_form'];
download_form.onsubmit=function(e){
    e.preventDefault();
    let years=document.getElementsByName("customRadioInline1");
    let year;
    for(var i = 0; i < years.length; i++){
    if(years[i].checked){
        year = years[i].value;
    }
}
console.log(year)
window.location="/teacher/pdf/"+year;

}

//calendar
document.getElementById('add-to-list').onclick = function() {
  var list = document.getElementById('input_group');
  var newinput = document.createElement('input');
  newinput.type="text";
  newinput.className="mb-4 list";
  newinput.placeholder="Event Name";
  newinput.name="inputs";
//   newinput.innerHTML = 'A new item';
  list.appendChild(newinput);
  setTimeout(function() {
    newinput.className = newinput.className + " show";
  }, 10);
}
var calendar_form = document.forms["event_form"];
    calendar_form.onsubmit = function(e) {
        e.preventDefault();
        var user_id = document.getElementById("user_id").innerText;

        var date=localStorage.getItem("date");
        var events = [];
        var input1 = document.getElementById("input1");
        if (input1.value.length > 0) {
            events.push(input1.value);
        }

        let inputs = document.getElementsByName("inputs");
        for (let i = 0; i < inputs.length; i++) {
            console.log(inputs[i].value);
            if (inputs[i].value.length > 0) {
                events.push(inputs[i].value);
            }
        }

        console.log(events);
        axios.post('/api/event', {
            'userid': user_id,
            'event': events,
            'date': date
        }).then(res => {
            console.log(res);
        }).catch(err => {
            console.log(err);
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
// major-filter
function m_filter(e){
    console.log(e.value);
  
    for(i=0;i<items.length;i++){

        items[i].style.display="none";
        if(e.value=="Major"){
        items[i].style.display="flex";
    }

        if (items[i].getAttribute('data_major') == e.value) {    
            items[i].style.display = "flex"; 
        }
        if (e.value == '') {
            items[i].style.display = "flex"; 
        }

    }
    
}

function y_filter(e){
    for(i=0;i<items.length;i++){
        items[i].style.display="none";
        if(e.value=="Year"){
        items[i].style.display="flex";
    }
        if (items[i].getAttribute('data_year') == e.value) {    
            items[i].style.display = "flex"; 
        }
        if (e.value == '') {
            items[i].style.display = "flex"; 
        }
    }
    
}

function focusInput(e){
    document.getElementById("search").focus();
}

//event-list show

function event_list(date){
    var group= document.getElementById('event_list');
    group.innerHTML="";
   
var arr=<?php echo json_encode($event);?>;
var list=arr[date];
console.log(list.length);
for(var i=0;i<list.length;i++){
    var awine=document.createElement("div");
    awine.style.height="10px";
    awine.style.width="10px";
   awine.className="rounded-circle d-inline-block border ";
   awine.style.backgroundColor= '#' +Math.floor(Math.random()*16777215).toString(16);
    var element=document.createElement("div");

    element.style.position="relative";
   element.style.top=-24+"px";
   element.style.left=13+"px";   
    var uu=document.createElement("div");
    uu.className="col-4  ";
    awine.id="e"+i;
   
    element.innerText=list[i];
    group.appendChild(uu);
    uu.appendChild(awine);
   uu.appendChild(element);
    
}
}

function event_show(){
var dates=<?php echo json_encode($event);?>;
Object.keys(dates).forEach(function (key) {
    var awine=document.createElement("div");
    awine.style.height="12px";
    awine.style.width="10px";
    awine.style.left="-21px";
    awine.style.position="relative";
    awine.style.top="-1px";
   awine.className="rounded-circle d-inline-block border ";
   awine.style.backgroundColor= '#' +Math.floor(Math.random()*16777215).toString(16);
   document.getElementById(key).appendChild(awine); 
   console.log("aa"+key);
});
}
event_show();


function openview(e){
    console.log(e.getAttribute("data"));
    var noti=JSON.parse(e.getAttribute("data"));
    document.getElementById('oname').innerText=noti.name;
    document.getElementById('odate').innerText=noti.date;
    document.getElementById('oid').innerText=noti.rollno;
    document.getElementById('otitle').innerText=noti.title.toUpperCase();
    document.getElementById('odetail').innerText=noti.detail;
    document.getElementById("gg").style.display="block";
    document.getElementById('dfile').href="{{asset('uploads/files/')}}"+"/"+noti.file;
    document.getElementById('dtext').innerText=noti.file;
    document.getElementById('oimg').src="{{asset('uploads/student_image/')}}"+"/"+noti.img;
  hoo();
 
}
function openview1(e){
    console.log(e.getAttribute("data"));
    var noti=JSON.parse(e.getAttribute("data"));
    document.getElementById('oname').innerText="Admin";
    document.getElementById('odate').innerText=noti.date;
    document.getElementById('oid').innerText='';
    document.getElementById('otitle').innerText=noti.title.toUpperCase();
    document.getElementById('odetail').innerText=noti.detail;
    document.getElementById("gg").style.display="none";
    document.getElementById('oimg').src="{{asset('uploads/student_image/')}}"+"/"+noti.img;
    hoo();
}
function hoo(){
    document.getElementById("inbox_content").style.display="none";
    document.getElementById("openview").style.display="block";

}


function close_view(e){
    document.getElementById("inbox_content").style.display="block";
    document.getElementById("openview").style.display="none";
}
</script>
</body>
</html>
</body>
</html>


