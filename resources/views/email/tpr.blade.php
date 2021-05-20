<!DOCTYPE html>
<html>
<head>
    <title>Email</title>
</head>
<body>

    <center>
        <div style="padding: 20px;width:80%;border-radius: 50px;
        background: white;border:1px solid gray;">
            <div style="width: 100%;text-align:left;">
                <div style="display:flex;">
                <h1 style="width: 90%;">Hi {{$name}} ,</h1>
                <img style="vertical-align:middle;float: right;padding-top: 20px;" src="https://i.ibb.co/ZzqN21h/Group-1-1.png" width="50" height="50"/>
                </div>
              
                <p style="color:gray;">Here are you password reset link</p>
            </div>
            <hr>
            <div style="padding-top: 30px;padding-bottom:30px;">
            <p style="text-align: left;font-size:1.3rem;">This is password reset request for your teacher account.If you did not make this request, please ignore this mail.</p>
            <center><a href="http://attendance-smart.herokuapp.com/teacher/password/reset/{{$token}}" style="text-decoration: none;color:white;">
                <div style="background-color: tomato;width:200px;height:45px;line-height:45px;border-radius:10px;">
                    Reset Password
                </div>
            </a>
            </center>
            <p style="text-align: left;">Thank you,</p>
            <p style="text-align: left;">Smart Attendance</p>
        </div>

        </div>
    
    </center>
</body>
</html> 
