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
                            <p class=" p-1 rounded text-left blur">{{$student->rollno}}</p>
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


        <a href="/student/scan" class="col-4 mt-5 mb-4  bg-white shadow-sm" id="scan">
            <center><div   class="  rounded pt-2 pb-1 " >
            
                <img src="https://img.icons8.com/fluent/34/4a90e2/filled-sent.png" class="pt-2"/>
            <p class="text-center text-dark pt-1">Sent</p>
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

    <script>
      
        let Chartt = document.getElementById('chart');
let Leaderboard = document.getElementById('leaderboard');
let ad = document.getElementById('myChart');
let table = document.getElementById("leadertable");

let rank=document.getElementById('u-rank');
rank.innerHTML=document.getElementById("<?php echo $student->rollno; ?>").innerHTML;

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
  
 
</body>
</html>