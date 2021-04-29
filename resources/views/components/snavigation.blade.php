<div id="nav">
    <link rel="stylesheet" href="{{asset('css/student.css')}}">
<div class="navbar navbar-dark shadow-lg" style="background-color: #d6b4f0;">
    <a href="/student"><div class="navbar-brand" style="text-transform: uppercase;font-weight:bold;">Student</div></a>
        <div id="nav-content" class="row justify-content-around align-middle">
     
            <li class="dropdown dropdown-notifications" style="list-style: none;"  data-toggle="collapse" data-target="#noti" aria-expanded="false" aria-controls="noti">
                <a href="#notifications-panel"  data-toggle="collapse" href="#noti" role="button" aria-expanded="false" aria-controls="noti">
                    <i  class="far fa-bell  w-50 text-dark" style="font-size:30px;cursor:pointer;"><span class="badge bg-danger rounded-circle text-white notification-icon" data-count="0" style="width:15px;height:15px;font-size:10px;line-height:10px;position: absolute;top:0%;left:90%;">
                        0</span></i>
                </a>
                </li>

        <li class="dropdown" style="list-style:none;" >
            <a class=" dropdown-toggle text-dark" href="#" id="Profile" role="button" data-toggle="dropdown"  aria-expanded="false">
            <img src="{{asset('uploads/student_image/')}}<?php echo "/".session('profile_image');?>" id="profile" class="border" />
            </a>    
          <div class="dropdown-menu mt-3 text-left" style="right:0;left:auto;">
            <a class="dropdown-item " href="/logout">
                Edit Profile
            </a>
            <a class="dropdown-item text-danger " href="/student/logout">
                Logout
            </a>
          </div>
        </li>


    </div>
</div>
<div class=" collapse shadow p-3  mt-2 bg-light col-12 col-md-5 col-lg-4 rounded mr-lg-3 mr-md-2" id="noti" style="float: right;z-index:99999;position: absolute;right:0;">
    <h4>Notifications</h4>
    <hr>
    <div>
    <div class="d-flex justify-content-between">
        
            <img src="https://i.ibb.co/ZzqN21h/Group-1-1.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
       
            <p class="pl-2 text-left" id="noti_about">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
            
           
    </div>
    <small class="text-right text-info" style="float:right;">1 hour ago</small>
</div>

</div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//js.pusher.com/3.1/pusher.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <script type="text/javascript">
    
    
     // Enable pusher logging - don't include this in production
     Pusher.logToConsole = true;
        Pusher.log = function(msg) {
      console.log(msg);
    };
    
        var pusher = new Pusher('c85db90d744de13b28e3', {
          cluster: 'ap1'
        });
    
        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
          alert(data);
          console.log(data);
       
          console.log("adf"+JSON.stringify(data));
        document.getElementById('noti_about').innerHTML=data;
          
    
      });
    </script>
</div>



</div>