<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Smart Attendance</title>
    <link rel="icon" href="https://i.ibb.co/ZzqN21h/Group-1-1.png" type="image/png" >
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">


    <x-link/>
</head>
<body >
    <div  class="container-fluid" style="width:100vw;">
        <div class="row g-0  ">
   <x-amenu/>
 
 
         <div id="content" class=" bg-dark col-10 "  >
        
           <x-anav/>
           <div class=" row  justify-content-between mt-2 mx-1" >
            <div class="d-flex " style="background-color: #26292E;   border-radius: 10px;" id="inputbox">
            <input type="text" id="searchinbox" placeholder="Search" class="pl-2 ">
            <span toggle="#search" class="text-white fas fa-search field-icon pl-2"  id="teye" onclick="focusInput(this)"></span>
         </div>
         <div class=" align-middle btn" data-toggle="modal" data-target="#addmodal" style="background-color: #26292E;border-radius:10px;height:40px;">
             <i class="far fa-plus-square text-primary"style="color:#FF66CB;font-size:25px;"></i>
         </div>

        </div>

  <div class="  row justify-content-between mt-4 pt-4 mx-1" >

                @foreach ($student as $item)
                <div class="col-lg-3 col-md-5 pt-3 shadow rounded border mb-3 mr-lg-3" style="background-color: #2D353F">
                    <center> <img src="{{asset('uploads/student_image/')}}<?php echo "/".$item['img'];?>" alt=""  width="55px;" height="55px;" class="rounded-circle text-center border"></center>
                     <div id="data" >
                         <p class="text-white text-center mb-0 pt-2" style="">{{$item['name']}}</p>
                         <ul class="text-left " style="font-size: 0.8rem;color: #8e8e8f;">
                             <li>Id : {{$item['id']}}</li>
                             <li>Year : {{$item['year']}}</li>
                             <li>Major : {{$item['major']}}</li>
                             <li>Email: {{$item['email']}}</li>
                        
                         </ul>
                         <div class="row justify-content-between">
                            <a href="" data='<?php echo json_encode($item);?>' onclick="edit(this)" class="col-6 text-info  text-center py-1"><i class="far fa-edit "></i></a>
                            <a href="/admin/dashboard/deletestudent/{{$item['id']}}" class="col-6 text-danger  text-center py-1"><i class="far fa-trash-alt"></i></a>
                         </div>
                     </div>
             </div>
                @endforeach
             
           </div>

         </div>
        </div>
    </div>



{{-- add modal --}}
<div class="modal fade my-5 " id="addmodal" tabindex="-1" aria-labelledby="addmodalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content text-white" style="background-color: #2D353F">
        <div class="d-flex justify-content-between px-3 pt-4">
          <h5 class="modal-title" id="addmodalLabel">Add Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
            <span aria-hidden="true"  style="font-size:30px !important;color:tomato;">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" id="add" name="profile_edit" enctype="multipart/form-data">
            @csrf
            <div class="d-flex justify-content-between">
                <div  class="col-3">
                <img src="https://img.icons8.com/fluent/96/000000/gender-neutral-user.png" id="imagepreview" class="rounded bg-light border border-info" width="75px" height="75px">
                <label for="image" style="position: relative;;top:-24px;left:-1px;width:75px;background:rgba(0,0,0,0.6);cursor: pointer;"  class="rounded text-white text-center">upload</label>
                <input type="file"  name="profile-edit" class="d-none" id="image"  onchange="readURL(this)" > 
                <small class="text-danger d-block text-left" id="image-error"></small>
            </div>
            
            <div class="col-8 col-lg-9 col-md-9 text-white">                
                <input type="text" class="form-control mb-3 text-white" id="rollno" pattern="[0-9]+" name="rollno" placeholder="Rollno" style="background: #26292E;">
            <input type="text" class="form-control mb-3 text-white"   id="name" value="" placeholder="Name" style="background: #26292E;">
            <input type="email" class="form-control mb-3 text-white"  id="email" value="" placeholder="Email" style="background: #26292E;">
            <select class="form-select form-control mb-3 text-white" id="major" style="background: #26292E;" >
                <option >Myanmar</option>
                <option >English</option>
                <option >Japan</option>
              </select>
              <select class="form-select form-control mb-3 text-white" id="year" style="background: #26292E;" >
                <option >First Year</option>
                <option >Second Year</option>
                <option >Third Year</option>
              </select>
            <input type="password" class="form-control mb-3 text-white"  id="password" value="" placeholder="Password" style="background: #26292E;">
        
        </div>
        </div>
      
          <button type="submit" class="btn text-white mt-2 col-12 bg-primary " > Add Student</button>
        </form>
        </div>
      </div>
    </div>
  </div>


{{-- edit modal --}}
<div class="modal fade my-5 " id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content text-white" style="background-color: #2D353F">
        <div class="d-flex justify-content-between px-3 pt-4">
          <h5 class="modal-title" id="editLabel">Edit Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
            <span aria-hidden="true"  style="font-size:30px !important;color:tomato;">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" id="eform" name="profile_edit" enctype="multipart/form-data">
            @csrf
            <div class="d-flex justify-content-between">
                <div  class="col-3">
                <img src="" id="eimagepreview" class="rounded bg-light border border-info" width="75px" height="75px">
                <label for="eimage" style="position: relative;top:-24px;left:-1px;width:75px;background:rgba(0,0,0,0.6);cursor: pointer;"  class="rounded text-white text-center">upload</label>
                <input type="file"  name="profile-edit" class="d-none" id="eimage" value="" onchange="readURL1(this)" > 
                <small class="text-danger d-block text-left" id="image-error"></small>
            </div>
            
            <div class="col-8 col-lg-9 col-md-9 text-white">                
                <input type="text" class="form-control mb-3 text-white" id="erollno" name="rollno" placeholder="Rollno" style="background: #26292E;">
            <input type="text" class="form-control mb-3 text-white"   id="ename" value="" placeholder="Name" style="background: #26292E;">
            <input type="email" class="form-control mb-3 text-white"  id="eemail" value="" placeholder="Email" style="background: #26292E;">
            <select class="form-select form-control mb-3 text-white" id="emajor" style="background: #26292E;" >
                <option >Myanmar</option>
                <option >English</option>
                <option >Japan</option>
              </select>
              <select class="form-select form-control mb-3 text-white" id="eyear" style="background: #26292E;" >
                <option >First Year</option>
                <option >Second Year</option>
                <option >Third Year</option>
              </select>
        
        </div>
        </div>
      
          <button type="submit" class="btn text-white mt-2 col-12 bg-primary " > Edit Student</button>
        </form>
        </div>
      </div>
    </div>
  </div>

    <script>

function edit(e) {

    var data=JSON.parse(e.getAttribute("data"));
  console.log(data);
e.setAttribute("data-toggle", "modal");
e.setAttribute("data-target", "#edit");
var eimage=document.getElementById("eimagepreview");
var erollno=document.getElementById("erollno");
var ename=document.getElementById("ename");
var eemail=document.getElementById("eemail");
var emajor=document.getElementById("emajor");
var eyear=document.getElementById("eyear");
var image=document.getElementById("eimage");



eimage.src="{{asset('uploads/student_image/')}}"+"/"+data.img;
erollno.value=data.id;
eemail.value=data.email;
ename.value=data.name;
emajor.value=data.major;
eyear.value=data.year;


var eform=document.forms["eform"];
eform.onsubmit=function(e){
    e.preventDefault();
    let formData = new FormData();
    
    if(image.files[0]==undefined)
    { 
        formData.append("profile",data.img);
}
    else{
        formData.append("profile", image.files[0]);
    }
    formData.append("name", ename.value);
    formData.append("rollno", erollno.value);
    formData.append("year", eyear.value);
    formData.append("email", eemail.value);
    formData.append("major", emajor.value);
    formData.append("id", data.Id);
    
    axios.post('/api/admin/editstudent',formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then(res=>{
            // console.log(res);
       window.location='/admin/dashboard/student';
    
    });
}



}

        function focusInput(e){
    document.getElementById("searchinbox").focus();
}
function readURL1(image){
    if(image.files && image.files[0]){
        var reader=new FileReader();
        reader.onload=function(e){
            $('#eimagepreview').attr('src',e.target.result);
        }

        reader.readAsDataURL(image.files[0]);
    }
}

function readURL(image){
    if(image.files && image.files[0]){
        var reader=new FileReader();
        reader.onload=function(e){
            $('#imagepreview').attr('src',e.target.result);
        }

        reader.readAsDataURL(image.files[0]);
    }
}

var form=document.forms['add'];
form.onsubmit=function(e){
    e.preventDefault();
    console.log('dasf');
    let formData = new FormData();
    let image = document.getElementById('image');
    let name = document.getElementById('name');
    let rollno = document.getElementById('rollno');
    let year = document.getElementById('year');
    let email = document.getElementById('email');
    let major = document.getElementById('major');
    let password = document.getElementById('password');

    formData.append("image", image.files[0]);
    formData.append("name", name.value);
    formData.append("rollno", rollno.value);
    formData.append("year", year.value);
    formData.append("email", email.value);
    formData.append("major", major.value);
    formData.append("password", password.value);
    axios.post('/api/admin/addstudent',formData ,{
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then(res=>{
     console.log(res);
     if(res.data.msg=="good"){
         window.location="/admin/dashboard/student";
     }

    });
}
    </script>
</body>