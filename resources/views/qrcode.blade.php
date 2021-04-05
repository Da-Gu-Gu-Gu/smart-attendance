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
    <x-tnavigation/>
    
    <center>
     
    <div class="my-3 py-3">
        <p id="hidden" class="d-none">{{session('qr-lifetime')}}</p>
        <h1 class="mb-3  d-inline-block rounded  text-white px-3 py-1" id="time" style="background-color: #ff7d7b;">Scan Here<h1>
            <div class="shadow d-inline-block p-5" >
            {{QrCode::size(300)->generate('http://localhost:8000/student/scan/'.session('rollcall-token'))}}
        </div>
    </div>
</center>

{{-- test countdown --}}
<script >
    let check_countdown=document.getElementById("hidden").innerText;
    let countdown=0;
    switch(check_countdown){
        case "3 Min":  
             countdown=180;
             break;
        case "5 Min":
             countdown=300;
             break;
        case "10 Min":
             countdown=600;
             break;
        default:
        countdown=180;
        
    }
    function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    var aa=setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

       

        if (--timer < 0) {
            timer = duration;
        }
     
        
            display.textContent = minutes + ":" + seconds;
        
            if(minutes==00 && seconds==00){
            display.textContent="Time Over!"
            clearInterval(aa)
        }
    }, 1000);
  
}
display = document.querySelector('#time');
startTimer(countdown, display);
  

    

</script>


</body>
</html>