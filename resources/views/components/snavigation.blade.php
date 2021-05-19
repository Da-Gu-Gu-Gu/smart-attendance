<div id="nav">
  <link rel="icon" href="https://i.ibb.co/ZzqN21h/Group-1-1.png" type="image/png" >
   
    <title>Smart Attendance</title>
    <link rel="stylesheet" href="{{asset('css/student.css')}}">
<div class="navbar navbar-dark shadow-lg" style="background-color: #d6b4f0;">
    <a href="/student"><div class="navbar-brand" style="text-transform: uppercase;font-weight:bold;">Student</div></a>
        <div id="nav-content" class="row justify-content-around align-middle">
     
            <li class="dropdown dropdown-notifications" style="list-style: none;"  data-toggle="collapse" data-target="#noti" aria-expanded="false" aria-controls="noti">
                <a href="#notifications-panel"  data-toggle="collapse" href="#noti" role="button" aria-expanded="false" aria-controls="noti">
                    <i  class="far fa-bell  w-50 text-dark" style="font-size:30px;cursor:pointer;"><span class="badge bg-danger rounded-circle text-white notification-icon" data-count="0" id="count" style="width:15px;height:15px;font-size:10px;line-height:10px;position: absolute;top:0%;left:90%;">
                        0</span></i>
                </a>
                </li>

        <li class="dropdown" style="list-style:none;" >
            <a class=" dropdown-toggle text-dark" href="#" id="Profile" role="button" data-toggle="dropdown"  aria-expanded="false">
            <img src="{{asset('uploads/student_image/')}}<?php echo "/".session('profile_image');?>" id="profile" class="border" />
            </a>    
          <div class="dropdown-menu mt-3 text-left" style="right:0;left:auto;">
            <a class="dropdown-item " href="" data-toggle="modal" data-target="#ppedit">
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

    <div id="noti_lists"></div>
    @foreach (session('sanoti') as $item)
    <div >
      <div class="d-flex justify-content-between">
          
              <img src="{{asset('uploads/teacher_image/')}}<?php echo "/".$item['img'];?>" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
            <div style="width:90%;">
             
              <p class="pl-2 text-left  mb-0" id="noti_about" >{{$item['name']}}  created assignment.</p>
              {{-- <small class="ml-2 bg-info px-2 text-white rounded">{{$item['label']}}</small>   --}}
            </div> 
             
      </div>
      <small class="text-right text-info" style="float:right;">{{$item['date']}}</small>
  </div>
  <hr>
    @endforeach


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

    var Group=document.getElementById("noti_lists");

    function notiadd(data){
      var group=document.createElement("div");
          group.className="my-3"
          var group2=document.createElement("div");
          group2.className="d-flex justify-content-between";
          var group3=document.createElement("div");
          group3.style.width="90%";
          var image=document.createElement("img");
          image.src="{{asset('uploads/teacher_image/')}}"+"/"+data["img"];
          image.style.width="50px";
          image.style.height="50px";
          image.className="img-circle";

          var text=document.createElement("p");
          text.className="pl-2 text-left mb-0";
          text.style.width="90%";
          text.innerText=data["name"] + " create assignment";

          group2.appendChild(image);
          group2.appendChild(text);

          var time=document.createElement("small");
          time.className="text-info mb-2";
          time.style.cssFloat="right";
          time.innerText="Just now";

          var hr=document.createElement("hr");
         
          group.appendChild(group2);
          group.appendChild(time);
          group.appendChild(hr);

          Group.insertBefore(group,Group.firstChild);
    }
function notice(data){
    var group=document.createElement("div");
          group.className="my-3"
          var group2=document.createElement("div");
          group2.className="d-flex justify-content-between";
          var group3=document.createElement("div");
          group3.style.width="90%";
          var image=document.createElement("img");
          image.src="{{asset('uploads/student_image/')}}"+"/"+data["img"];
          image.style.width="50px";
          image.style.height="50px";
          image.className="img-circle";

          var text=document.createElement("p");
          text.className="pl-2 text-left mb-0";
          text.style.width="90%";
          text.innerText="Admin sent noitce statement";

          group2.appendChild(image);
          group2.appendChild(text);

          var time=document.createElement("small");
          time.className="text-info mb-2";
          time.style.cssFloat="right";
          time.innerText="Just now";

          var hr=document.createElement("hr");
         
          group.appendChild(group2);
          group.appendChild(time);
          group.appendChild(hr);

          Group.insertBefore(group,Group.firstChild);
}
        var pusher = new Pusher('c85db90d744de13b28e3', {
          cluster: 'ap1'
        });
        var i=parseInt(document.getElementById("count").innerHTML);
    
        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
         
          notice(data);
          
          console.log("adf"+JSON.stringify(data));
          document.getElementById("count").innerHTML=++i;
        });

        var assignment_channel = pusher.subscribe('assignment'+ "<?php echo session('syear');echo session('smajor');?>");
        assignment_channel.bind('my-event', function(data) {
         
       notiadd(data);
          console.log("hadsfh"+JSON.stringify(data));
          document.getElementById("count").innerHTML=++i;
          
    
      });
    </script>
</div>



</div>