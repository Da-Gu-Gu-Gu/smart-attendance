<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<body>
    <x-link/>
    <h1>test</h1>

    <table class="table" border="1">
        <tr> 
            <th>No</th>
            <th>Rollno</th>
            <th>Year</th>
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
                <td>{{$data['Year']}}</td>
                <td>{{$data['Major']}}</td>
                <td>{{$data['Minor 1']}}</td>
                <td>{{$data['Minor 2']}}</td>
                <td>{{$data['Minor 3']}}</td>
            </tr>
        @endforeach
    </table>
    
</body>
</html>