<div>
<nav class="navbar navbar-dark  text-white   navbar-expand-lg  " >
    <div class="flex-fill"></div>
        <div id="nav-content" class="row justify-content-around align-middle" style="background-color:#262A3B;width:160px;">
     
            <li class="dropdown dropdown-notifications" style="list-style: none;"  data-toggle="collapse" data-target="#noti" aria-expanded="false" aria-controls="noti">
                <a href="#notifications-panel"  data-toggle="collapse" href="#noti" role="button" aria-expanded="false" aria-controls="noti">
                    <i  class="far fa-bell  w-50 text-white" style="font-size:30px;cursor:pointer;"><span class="badge bg-danger rounded-circle text-white notification-icon" data-count="0" id="count" style="width:15px;height:15px;font-size:10px;line-height:10px;position: absolute;top:0%;left:90%;">
                        0</span></i>
                </a>
                </li>

        <li class="dropdown" style="list-style:none;" >
            <a class=" dropdown-toggle text-white" href="#" id="Profile" role="button" data-toggle="dropdown"  aria-expanded="false">
            <img src="{{asset('uploads/student_image/')}}<?php echo "/".session('adminimg');?>" id="profile"  />
            </a>    
          <div class="dropdown-menu mt-3 text-left " style="right:0;left:auto;background:#262A3B;">
            <a class="dropdown-item text-dark" href="" data-toggle="modal" data-target="#ppedit">
              Edit Profile
          </a>
            <a class="dropdown-item text-danger " href="/admin/logout">
                Logout
            </a>
          </div>
        </li>


    </div>

  
</nav>
</div>