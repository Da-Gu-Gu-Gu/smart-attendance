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
        <div class="mt-4 row ml-3">
            <h4 class="text-white " >Feedbacks</h4>
            @foreach ($data as $item)
                <div class="mb-3 row col-12 p-3  justify-content-between" style="background: #26292E">
                    <div class="col-1 ">
                    <div class="text-white border bg-danger text-center align-middle rounded-circle " style="height: 40px;width:40px;line-height:40px;text-transform:uppercase;">
                        {{$item["email"][0]}}
                    </div>
                </div>
                    <div class=" row  justify-content-between col-9" style="height: 40px;width:40px;line-height:40px;">
                    <p class="text-white pl-3 pl-lg-0 p-md-0">{{$item["email"]}}</p>
                          
                   
                        <p class="text-white d-none d-lg-inline d-md-inline">{{$item["date"]}}</p>
                    </div>
                    <i class="fas fa-angle-down  text-white col-1" data-toggle="collapse" href="#fb{{$item['id']}}" role="button" aria-expanded="false" aria-controls="collapseExample" style="font-size: 2rem;height: 40px;line-height:40px;float: right;">
                    
                    </i>
                    <div class="collapse col-12 mt-3 mb-2" id="fb{{$item['id']}}">
                        <div class="card card-body  text-white" style="background: #2D353F">
                                {{$item['about']}}
                        </div>
                      </div>
                </div>
            @endforeach
        </div>

         </div>
        </div>
    </div>
</body>