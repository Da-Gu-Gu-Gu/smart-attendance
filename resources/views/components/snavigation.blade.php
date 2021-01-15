<div id="nav">
    <link rel="stylesheet" href="{{asset('css/student.css')}}">
<div class="navbar navbar-dark shadow-lg" style="background-color: #d6b4f0;">
    <a href="/student"><div class="navbar-brand" style="text-transform: uppercase;font-weight:bold;">Student</div></a>
        <div id="nav-content" class="row justify-content-center align-middle">
        <i class="far fa-bell  w-50" style="font-size:30px;cursor:pointer;"><span class="badge bg-danger rounded-circle text-white" style="width:15px;height:15px;font-size:10px;line-height:10px;position: absolute;top:19%;">
            0</span></i>
        

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



</div>