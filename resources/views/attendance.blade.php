<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <x-link/>
    <style>
        #info{
            /* width: 300px; */
            background-color: rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <x-snavigation/>
        <center>
            <div class="my-5 my-lg-0 ">
                <img src="{{asset('img/error.gif')}}" id="error" class="col-lg-6 py-3 " style="z-index: -11;display: none;" >
                <img src="{{asset('img/success.gif')}}" id="success" class="col-lg-6 py-3 " style="z-index: -11;display: none;" >
                <div id="info" class="d-inline-block px-3 py-2 rounded text-white bg-info">{{session('attendanceinfo')}}</div>
            </div>
        
        </center>

        <script>
            let check=document.getElementById('info').innerHTML;
            let success= document.getElementById('success');
            let error=document.getElementById('error');
            if(check=='Success'){
                success.style.display="block";
                error.style.display="none";
                console.log(success);
            }else{
                console.log(error);
                error.style.display="block";
                success.style.display="none";
            }
        </script>
</body>
</html>