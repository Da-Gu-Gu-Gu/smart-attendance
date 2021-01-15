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
     
    <div class="my-3 py-5">
        <h1 class="mb-5  d-inline-block rounded px-5 py-2 text-white" style="background-color: #ff7d7b;">Scan Here<h1>
        {{QrCode::size(300)->generate('http://localhost:8000/student/scan/'.session('rollcall-token'))}}
    </div>
</center>
</body>
</html>