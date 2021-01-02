<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<x-link/>

    <style>
        #img404{
            
            position: absolute;
            z-index: -1;
        }
        #a404,#img404{
       position: fixed;
            top:50%;
            left: 50%;
            transform: translate(-50%,-50%);
        }
    </style>



<body>
 <x-navigation />

 <center>
     <div id="a404">
 <div class="  text-center py-5 px-3 px-lg-5 px-md-5 px-sm-5 my-5 shadow rounded " style="position: relative;overflow:hidden;width:max-content;">
     <img src="{{asset('img/404.gif')}}" id="img404">
     <h1 style=" -webkit-text-stroke: 5px rgb(19, 18, 18);
     color:transparent;
     font-size: 13rem;">404</h1>
     <p style="font-size: 2rem;">PAGE NOT FOUND</p>
 </div>
     </div>
 </center>
 
 
</body>
</html>