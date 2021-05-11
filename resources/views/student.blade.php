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
   .background{
       width:100%;
       height: 100%;
       /* border-radius: 20%; */
       background-color:#d6b4f0;
   }
   .event{
       background-color: aqua;
   }
   #scan{

    border-radius: 10px;
   }

   body:not(.modal-open){
  padding-right: 0px !important;
}
 
</style>
</head>
<body >

   <x-snavigation/>
 

{{-- profile-content --}}
    <div class="container my-3  rounded " style="background-color:#d6b4f0; ">
        <div class="row justify-content-around py-5 ">
        <div  class="col-lg-4 col-md-7 rounded container">
           <center>
                <div class="container">
                <div id="student" class="row  shadow-lg rounded  ">
                    <img src="{{asset('uploads/student_image/')}}<?php echo '/'.$student->img;?>" >
                    <div id="status" class="col-12 text-white rounded">
                        <p class="font-weight-bold text-left pt-1 upper">{{$student->name}}</p>
                        <div class="d-flex justify-content-between pb-0 mb-0">
                            <p class=" p-1 rounded text-left blur" id="user_id">{{$student->rollno}}</p>
                            <p class=" p-1 rounded text-right blur" >{{$student->year}}</p>
                        </div>
                    </div>
            </div>
                </div>
           </center>
     
        </div>

        <div  class="col-lg-4 col-md-7 text-center pt-0 text-white mt-lg-0 mt-4 mr-lg-5 bg-white rounded shadow">
          <center>
            
                <div id="header" class="d-flex justify-content-between">
                    <a href="#" class="previous round" style="font-size: 40px;" id="pre" style="color:#d6b4f0 !important;">&#8249;</a>
                    <div class="d-flex pt-4">
                    <h1 class="text-center"><p id="month" class="text-info" style="font-size: 1rem;"></p>
                    <h2 class="text-success text-center" id="year" style="font-size:1rem;"></h2></h1>
                    </div>
                    <a href="#" class="next round" style="font-size: 40px;" onclick="nextmonth();" style="color:#d6b4f0 !important;">&#8250;</a>
                </div>
                <div id="weekdays">
                    <ul class="d-flex  text-decoration-none list-unstyled  text-white" style="background-color:#a55cdd; ">
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

    <div id="attendance-record" class=" container shadow text-white  py-2">
        <p class="text-center font-weight-bold">ATTENDANCE</p>
        <div class="justify-content-between d-flex">
            <div class="col-3 text-center ">
                {{$major}}<br>
                <small>{{session('smajor')}}</small>
               
            </div>
            <div class="col-3 text-center ">
                {{$minor1}} <br>
                <small>Minor-1</small>
            </div>
            <div class="col-3 text-center ">
                {{$minor2}}<br>
                <small>Minor-2</small>
            </div>
            <div class="col-3 text-center ">
                {{$minor3}} <br>
                <small>Minor-3</small>
            </div>
        </div>
    </div>

    {{--  --}}
    <div class="container">
    <div class="row justify-content-around bg-light my-3 rounded">
 <a href="/student/scan" class="col-4 mt-5 mb-4  bg-white shadow-sm " id="scan">
            <center><div   class="  rounded pt-2  " >
            
                <img src="https://img.icons8.com/ios/34/000000/fa314a/portrait-mode-scanning--v2.png" class="pt-2" />
            <sm class="text-center text-dark pt-2 d-block">Scan</sm>
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
      <div class="container mt-3 mb-5">
    <div class="d-flex text-center text-white shadwo-sm  my-2" id="menu">
        <div  class="left py-2 col-6 moves" id="chart" onclick="chart();">
            <img src="https://img.icons8.com/material-outlined/30/000000/combo-chart.png" /><br>
          
        </div>
        <div  id="leaderboard" class="py-2 col-6" onclick="leaderboard();">
            <img src="https://img.icons8.com/ios/30/000000/leaderboard.png" /><br>
            
        </div>
    </div>
      </div>
</center>

<center>


    <canvas id="myChart" class="col-lg-8 pt-3 shadow-sm bg-white" ></canvas>



</center>

<div id="leadertable" class=" container" style="display: none;">
    <p style="float: left;">Your Rank: <span class="text-success font-weight-bold" id="u-rank">0</span></p>
    <table class="table table-hover table-striped text-center col-12">
        <thead class=" text-white rounded" style="background-color: #a55cdd;">
    <tr >
        <td >Rank</td>
        <td>Roll no</td>
        <td>Attendance</td>
    </tr>
        </thead>
<?php $i=1;?>
@foreach ($leaderboard as $rollno=>$value)
    <tr>
        <td id="{{$rollno}}">{{$i++}}</td>
      <td>{{$rollno}}</td>
      <td>{{$value}}</td>

    </tr>
@endforeach

</table>
</div>





<!--calendar  Modal -->
<div class="modal fade my-5" id="calendar_event" tabindex="-1" aria-labelledby="calendar_eventLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="d-flex justify-content-between px-3 pt-4">
            <h5 class="modal-title" id="ppeditLabel">Add Event</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true"  style="font-size:30px !important;color:red;">&times;</span>
            </button>
          </div>
        <div class="modal-body">
            <form  id="event_form" name="event_form" method="POST">
                @csrf
                <div id="list_group" class="swing">
            <input type="text" name="" id="input1" class="list mb-4  show text-left" placeholder="Event Name">
            <div id="input_group"></div>
        </div>
    
          <div id="add-to-list" class="border btn text-center col-12 " style=" -webkit-box-shadow: none;"><i class="far fa-plus-square"></i></div>
         
        </div>

        <div id="event_list" class="col-12 d-flex row">

        </div>

          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="submit" class="btn text-white mb-3 mx-3 " style="background-color: #a55cdd;">Save</button>
 
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
            <form method="POST" id="profile_edit" enctype="multipart/form-data">
            @csrf
            <div class="d-flex justify-content-between">
                <div id="image" class="col-3">
                <img src="{{asset('uploads/student_image/')}}<?php echo '/'.$student->img;?>"  id="imagepreview" class="rounded bg-light border border-info" width="75px" height="75px">
                <label for="profile-edit" style="position: relative;;top:-24px;left:-1px;width:75px;background:rgba(0,0,0,0.6);cursor: pointer;"  class="rounded  text-white text-center">upload</label>
                <input type="file"  name="profile-edit" class="d-none" id="profile-edit" onchange="readURL(this)" > 
                <small class="d-none" id="image-value">{{$student->img}}</small>
            </div>
               
            <input type="text" class="form-control col-8 col-lg-9 col-md-9 mt-3" name="name" id="name" value="{{$student->name}}" placeholder="Enter name">
        </div>
      
          <button type="submit" class="btn text-white " style="background-color: #a55cdd;float: right;margin-top:-10px;"><i class="fas fa-check"></i> Save changes</button>
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
         @foreach ($noti as $data)
         <div id="inbox_body" class="d-flex    my-2 container justify-content-between " style="border-radius:5px;cursor: pointer;" onclick="openview(this)" data='<?php echo json_encode($data);?>'>
            <img src="{{asset('uploads/teacher_image/')}}<?php echo '/'.$data['img'];?>" class="my-3  rounded-circle" style="width: 45px;height:45px;" alt="">
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

{{-- answer form --}}
            <form action="POST" id="answerass" enctype="multipart/form-data" style="display: none;">
                <span class="text-dark " style="cursor: pointer;" onclick="back()"> <i class="fas fa-arrow-left py-3"></i></span> 
                @csrf
                <div class="d-flex justify-content-between">
                To:<input type="text" name="name" class="text-left mb-4" id="to"  placeholder="Teacher Id">
            </div>
            <div class="d-flex justify-content-between">
                Subject:<input type="text" name="name" class="text-left mb-4" id="sub"  placeholder="Subject">
            </div>
            <textarea  id="answerdetail"  rows="7" ></textarea>
            <div id="filesname" class="d-flex ">

            </div>
            <div class="d-flex justify-content-between">
            <label for="assfiles" style="cursor: pointer;"><i class="fas fa-paperclip  px-3 py-2 rounded" style="background-color: rgba(128, 128, 128,0.6)"></i></label>
            <input type="file" name="assfiles[]" id="assfiles" multiple class="d-none"  onchange="file_upload()">
            <button type="submit" class="btn text-white" style="background-color: #a55cdd">Send</button>
        </div>
            </form>
        
              
        <div id="compose" class=" text-center  pt-1 rounded text-white " onclick="assignment()" style="background:#a55cdd;position: absolute;right:32px;bottom:29px;font-size:20px;width:35px;height:35px;z-index:10;cursor: pointer; box-shadow: 0 8px 6px -6px black;">
            <i class="fas fa-paper-plane"></i>
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

    <script>
      
        let Chartt = document.getElementById('chart');
let Leaderboard = document.getElementById('leaderboard');
let ad = document.getElementById('myChart');
let table = document.getElementById("leadertable");

let rank=document.getElementById('u-rank');
if(document.getElementById("<?php echo $student->rollno; ?>") == null){
rank.innerHTML= 0;
}else{
    rank.innerHTML=document.getElementById("<?php echo $student->rollno; ?>").innerText;
}

function chart() {

    Chartt.classList.add("left");
    ad.style.display = "block";
    table.style.display = "none";
    Leaderboard.classList.remove("right");
}

function leaderboard() {
    table.style.display = "block";
    ad.style.display = "none";
    Chartt.classList.remove("moves");
    Chartt.classList.remove("left");
    Leaderboard.classList.add("right");
}

// image preview
function readURL(image) {
    if (image.files && image.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#imagepreview')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(image.files[0]);
    }
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
 

    axios.post('/api/sprofile_edit',form_data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then(res=>{
       window.location='/student';
    
    });
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
            window.location='/student';
        }).catch(err => {
            console.log(err);
        });
    }

    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script>

      
        var labels=<?php echo collect($chartdata)->keys(); ?>;
        console.log(labels);
        var values=<?php echo collect($chartdata)->values(); ?>;
        console.log(values);

        var ctx = document.getElementById('myChart').getContext('2d');




        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    
         
                    label: 'attendance',
                    data: values,
                 
                    borderColor: "#AF79DF",
            pointBorderWidth: 10,
            pointHoverRadius: 10,
            pointHoverBorderWidth: 1,
            pointRadius: 3,
            fill: false,
            borderWidth: 4,
              
                }]
            },
            options: {
                legend: {
                    display:false
        },
       scales: {
        
            xAxes: [{
                ticks: {
                    padding: 20,
                    fontColor: "rgba(0,0,0,0.5)",
                    fontStyle: "bold"
                },
               gridLines: {
                zeroLineColor: "transparent"
               }
            }],
     
            yAxes: [{
                ticks: {
                    fontColor: "rgba(0,0,0,0.5)",
                    fontStyle: "bold",
                    beginAtZero: true,
                    maxTicksLimit: 5,
                    padding: 20
                },
               gridLines: {
                  display: false,
                  stacked: false
               }
            }]
       }
    }
        });
        </script>

<script src="{{asset('js/calendar.js')}}"></script>
<script type="text/javascript">
    

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
   awine.style.backgroundColor= '#' +Math.floor(Math.random()*16777215).toString(16);;
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
// openview-inbox
function openview(e){
    console.log(e.getAttribute("data"));
    var noti=JSON.parse(e.getAttribute("data"));
    document.getElementById('oname').innerText=noti.name;
    document.getElementById('odate').innerText=noti.date;
    document.getElementById('oid').innerText=noti.tid;
    document.getElementById('otitle').innerText=noti.title.toUpperCase();
    document.getElementById('odetail').innerText=noti.detail;
    document.getElementById('oimg').src="{{asset('uploads/teacher_image/')}}"+"/"+noti.img;
    document.getElementById("inbox_content").style.display="none";
    document.getElementById("openview").style.display="block";
    document.getElementById("compose").style.display="none";
    document.getElementById("answerass").style.display="none";
}
function close_view(e){
    document.getElementById("inbox_content").style.display="block";
    document.getElementById("answerass").style.display="none";
    document.getElementById("openview").style.display="none";
    document.getElementById("compose").style.display="block";
}

function assignment(){
    document.getElementById("compose").style.display="none";
    document.getElementById("answerass").style.display="block";
    document.getElementById("inbox_content").style.display="none";
}
function back(){
    close_view();
}
var file_list={};
function file_upload(){
    var group=document.getElementById("filesname");
    var file=document.getElementById("assfiles");
    for(var i=0;i<file.files.length;++i){
        var create=document.createElement("small");
        create.className="pr-3";
        create.innerText=file.files.item(i).name;
        group.appendChild(create);
        file_list.push(file.files.item(i));
    }

}
file_upload();
var assanswer_form=document.forms['answerass'];
assanswer_form.onsubmit=function(e){
    e.preventDefault();
    let form_data=new FormData();
    var answerdetail=document.getElementById("answerdetail");
    var to=document.getElementById("to");
    var sub=document.getElementById("sub");
    form_data.append("to",to.value);
    form_data.append("sub",sub.value);
    form_data.append("detail",answerdetail.value);
    form_data.append("list",file_list);
    // form_data.append("test","test");
    console.log(form_data);
   
    // console.log(to)
    // console.log(sub)
    // console.log(answer)
    console.log(file_list)
    // alert(Object.entries(file_list));
    axios.post('/api/assanswer',form_data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then(res=>{
            console.log(res);
    //    window.location='/student';
    });
    
    
}
</script>
  
 
</body>
</html>