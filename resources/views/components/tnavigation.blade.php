<div>
    <link rel="stylesheet" href="{{asset('css/teacher.css')}}">
<div class="navbar navbar-dark shadow-lg" style="background-color: tomato;">
    <a href="/student"><div class="navbar-brand" style="text-transform: uppercase;font-weight:bold;">Teacher</div></a>
        <div id="nav-content" class="row justify-content-center align-middle">
        <i class="far fa-envelope  w-50" style="font-size:30px;cursor:pointer;"><span class="badge bg-danger rounded-circle text-white" style="width:15px;height:15px;font-size:10px;line-height:10px;position: absolute;top:19%;">
            0</span></i>
        

        <li class="dropdown" style="list-style:none;" >
            <a class=" dropdown-toggle text-dark" href="#" id="Profile" role="button" data-toggle="dropdown"  aria-expanded="false">
            <img src="{{asset('uploads/teacher_image/')}}<?php echo "/".session('tprofile_image');?>" id="profile" class="border" />
            </a>    
          <div class="dropdown-menu mt-3 text-left" style="right:0;left:auto;">
            <a class="dropdown-item " href="/t/edit-profile">
                Edit Profile
            </a>
            <a class="dropdown-item text-danger " href="/teacher/logout">
                Logout
            </a>
          </div>
        </li>


    </div>
</div>



</div>