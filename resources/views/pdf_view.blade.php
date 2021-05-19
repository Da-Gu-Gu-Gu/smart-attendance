<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="https://i.ibb.co/ZzqN21h/Group-1-1.png" type="image/png" >
 
    <title>Smart Attendance</title>

</head>
<body>
    <x-link/>
    <h5 style="text-transform: uppercase;" class="pt-3">{{$teacher->name}}</h5>
    <div class="row justify-content-between mt-3">
        <p style="text-transform: uppercase;" class="col-6">Year: {{$year}}</p>
        <p style="text-transform: uppercase;float: right;" class="col-6 text-right">Date: {{$date}}</p>
    </div>
    <table class="table" border="1">
        <tr> 
            <th>No</th>
            <th>Rollno</th>
            <th>Major</th>
            <th>Minor 1</th>
            <th>Minor 2</th>
            <th>Minor 3</th>
        </tr>
        <?php $i=1;?>
        @foreach ($list  as $data)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$data['rollno']}}</td>
                <td>{{$data['Major']}}</td>
                <td>{{$data['Minor 1']}}</td>
                <td>{{$data['Minor 2']}}</td>
                <td>{{$data['Minor 3']}}</td>
            </tr>
        @endforeach
    </table>
    
</body>
</html>