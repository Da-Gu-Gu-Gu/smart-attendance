<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Smart Attendance</title>
    <link rel="icon" href="https://i.ibb.co/ZzqN21h/Group-1-1.png" type="image/png" >
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">


    <x-link/>
</head>
<body >
    <div  class="container-fluid" style="width:100vw;">
       <div class="row g-0  ">
  <x-amenu/>


        <div id="content" class=" bg-dark col-10 "  >
       
          <x-anav/>
         
            <div class="row justify-content-lg-between col-12 ml-2 ml-lg-0 ">
            <div class="col-lg-7 px-3 pt-4 pb-2  col-12 shadow   text-white" id="chart" style="background-color: #2D353F" >
                <p class="p-0 m-0">Student's Chart</p>
            <canvas id="myChart"class="pb-3" ></canvas>
        </div>
        <div class="col-lg-4 px-3 pt-4 pb-2  mt-lg-0 mt-5 shadow d-block  text-white" id="chart" style="background-color: #2D353F" >
            <p class="p-0 m-0">Teacher's Chart</p>
        <canvas id="tchart"class="pb-3" ></canvas>
    </div>

    </div>

    <div class="row justify-content-lg-between col-12 ml-2 ml-lg-0">
    <div id="overview" class="col-lg-7 mt-4 shadow py-4" style="background-color: #2D353F;">
        <p class="text-white">Overview</p>
        <div class="row  justify-content-around">
            <a href="/admin/dashboard/teacher" class="col-lg-3 col-md-3 col-12 my-2 rounded bg-dark ">
            <div id="one" >
                <div class="row justify-content-around p-2">
                    <div class="bg-white my-3 p-2 rounded-circle" style="width: 35px;height:35px">
                    <i class="fas fa-users text-center text-dark"></i>
                </div>
                    <div>
                        <span class="text-white d-block pt-2">Teachers</span>
                        <small class="p-0" style="color:#FF66CB">{{$teacher_total}}</small>
                    </div>
                </div>
            </div>
            </a>

            <a href="/admin/dashboard/student" class="col-lg-3 col-md-3 col-12 my-2 rounded bg-dark ">
            <div id="one" >
                <div class="row justify-content-around p-2">
                    <div class="bg-white my-3 p-2 rounded-circle" style="width: 35px;height:35px">
                    <i class="fas fa-users text-center text-dark"></i>
                </div>
                    <div>
                        <span class="text-white d-block pt-2">Students</span>
                        <small class="p-0" style="color:#AF79DF">{{$student_total}}</small>
                    </div>
                </div>
            </div>
        </a>

        <a href="/admin/dashboard/feedback" class="col-lg-3 col-md-3 col-12 my-2 rounded bg-dark ">
            <div id="one" >
                <div class="row justify-content-around p-2">
                    <div class="bg-white my-3 p-2 rounded-circle" style="width: 35px;height:35px">
                        <i class="far fa-flag text-center text-dark "></i>
                </div>
                    <div>
                        <span class="text-white d-block pt-2">Feedbacks</span>
                        <small class="p-0" style="color:#5FD289">{{$feedback_total}}</small>
                    </div>
                </div>
            </div>
        </a>
        </div>
        

     

    </div>
    <div class="col-lg-4  pt-4 pb-3 mt-4 shadow d-block  text-white"  style="background-color: #2D353F" >
        <p class="p-0 m-0">Create Notice</p>
        <form id="notice_form">
            @csrf
            <input type="text" id="subject" class="form-control form-control-sm  text-white bg-dark mb-2">
            <textarea name="" id="detail" cols="30" rows="3" class="form-control text-white bg-dark form-control-sm"></textarea>
            <button type="submit" class="btn bg-info text-white mt-3">Submit</button>
        </form>
  
</div>
       </div>
    </div>
    </div>
</div>
  
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script>
        var form=document.forms["notice_form"];
        form.onsubmit=function(e){
            e.preventDefault();
            let title=document.getElementById("subject").value;
  let detail=document.getElementById("detail").value;
  axios.post('/api/notice',{
      "title":title,
      "detail":detail
  }).then(res=>{
    console.log(res);
  })
        }
    </script>
    <script>

      
        var labels=['First Year','Second Year','Third Year'];
        console.log(labels);
        var values=<?php echo collect($mstudent)->values(); ?>;
        var values2=<?php echo collect($estudent)->values(); ?>;
        var values3=<?php echo collect($jstudent)->values(); ?>;
        console.log(values);
        console.log(values2)
        console.log(values3)

        var ctx = document.getElementById('myChart').getContext('2d');




        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Myanmar',
                    data: values,
                 
                    borderColor: "#AF79DF",
            pointBorderWidth: 3,
            pointHoverRadius: 3,
            pointHoverBorderWidth: 1,
            pointRadius: 3,
            fill: false,
            borderWidth: 4,
       
              
                },
                {
                    label: 'English',
                    data: values2,
                 
                    borderColor: "#FF66CB",
            pointBorderWidth: 3,
            pointHoverRadius: 3,
            pointHoverBorderWidth: 1,
            pointRadius: 3,
            fill: false,
            borderWidth: 4,
        
              
                },
                {
                    label: 'Japan',
                    data: values3,
                 
                    borderColor: "#5FD289",
            pointBorderWidth: 3,
            pointHoverRadius: 3,
            pointHoverBorderWidth: 1,
            pointRadius: 3,
            fill: false,
            borderWidth: 4,
         
              
                }
                
                ]
            },
        
            options: {   
            
    responsive: true,
    maintainAspectRatio: false,
       
                plugins: {
            title: {
                display: true,
                text: 'Custom Chart Title',
                padding: {
                    top: 10,
                    bottom: 30
                }
            }
        },
       legend: {
                    display:false
        },
       scales: {
        
            xAxes: [{
                ticks: {
                    padding: 20,
                    fontColor: "rgba(255,255,255,0.5)",
                    fontStyle: "bold"
                },
               gridLines: {
                zeroLineColor: "transparent"
               }
            }],
     
            yAxes: [{
                ticks: {
                    fontColor: "rgba(255,255,255,0.5)",
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


        var ctx = document.getElementById('tchart').getContext('2d');



        var tChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [
    'English',
    'Myanmar',
    'Japan'
  ],
  datasets: [{
    label: 'My First Dataset',
    data:<?php echo collect($teacherc)->values(); ?>,
    backgroundColor: [
      '#FF66CB',
      '#AF79DF',
      '#5FD289'
    ],
    borderColor: ['#FF66CB',
      '#AF79DF',
      '#5FD289'],
    hoverOffset: 2,
    
  }]},
  options: {   
    cutoutPercentage: 85,
            responsive: true,
            maintainAspectRatio: false,
               
                        plugins: {
                    title: {
                        display: true,
                        text: 'Custom Chart Title',
                        padding: {
                            top: 10,
                            bottom: 30
                        }
                    }
                },
       legend: {
                    display:false
        },
       scales: {
        
            xAxes: [{
                ticks: {
                    padding: 20,
                    fontColor: "rgba(255,255,255,0.5)",
                    fontStyle: "bold"
                },
               gridLines: {
                zeroLineColor: "transparent"
               }
            }],
     
            yAxes: [{
                ticks: {
                    fontColor: "rgba(255,255,255,0.5)",
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
         } );
        </script>
</body>
</html>