<!DOCTYPE html>
<html>
<head>
    <title>Email</title>
</head>
<body>

    <div >
        <div id="header" style="background-color:white;color:rgb(77, 75, 75);padding:0 auto;">
    
        <img style="vertical-align:middle;" src="https://i.ibb.co/ZzqN21h/Group-1-1.png" width="50" height="50"/><h1 style="display: inline-block;vertical-align:middle;margin-left:10px;">Qr-code Attendance</h1>
        </div>
        <div id="body" style="background-color:#93cce9;color:black;padding:10px;">
           <p style="font-size: 25px;font-weight:bold;">Welcome Student,<br>
            You're almost done!</p>
            <div>
                <p style="color:white;font-size:18px;">This is your verification code to create your account!</p>
                <center><h1 style="background-color: #6a8781;color:white;">{{ $verify_number }}</h1></center>
            </div>
            <p style="padding-bottom:10px;">Thank you,<br>    
               qr-code attendence system
            </p>
        </div>
 
   
    </div>
</body>
</html> 