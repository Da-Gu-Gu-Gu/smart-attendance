<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="https://i.ibb.co/ZzqN21h/Group-1-1.png" type="image/png" >
    <x-link/>
    
 
    <title>Smart Attendance</title>
</head>
<body>
    <x-navigation/>
    <div class="container  my-5">
        <div class="row" style="overflow: hidden;">
        <div class="col-xl-6  "   >
            <h1 id="ltext" style="font-size: 3.3rem;" class="animate__animated animate__bounceInLeft">If you are <b id="change">student</b> ,<br>
            login here  <i class="fas fa-long-arrow-alt-right"></i></h1>
        </div>
        <div class="col-xl-6 mt-4 ">
            <div id="toggle" class="   row rounded justify-content-between   m-auto " >
               <p class="py-2 m-auto w-50 text-center active" id="s" onclick="s()" style="text-transform: uppercase;">@lang('lang.student')</p>
               <p class="py-2 m-auto w-50 text-center"  id="t" onclick="t()" style="text-transform: uppercase">@lang('lang.teacher')</p>
            </div><br>
            {{-- student login form --}}
            <div id="student-lform" class="rounded m-auto col-xl-9 col-lg-8 col-md-6  border pt-4 shadow animate__animated  animate__backInRight" style="display: block;overflow-x: hidden;">
                <form class="px-4 pt-3 "  method="POST" name="studentlogin" id="studentlogin" >
                  @csrf
                    <small class="  text-center alert-danger py-2 px-3  rounded" style="display:none;" id="sl_error"></small>
                    {{-- <small class="text-danger d-block text-center" id="image-error"></small> --}}
                    <div class="form-group mt-3" >
                      <input type="email" class="form-control"  id="sl_email" aria-describedby="emailHelp" placeholder="Email">
                     
                      <small class="text-danger d-block " id="sl_email-error"></small>
                    </div>
                  
                 
   

                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" name="password" id="sl_password" class="form-control validate" placeholder="Password" >
                           
                            <span toggle="#spassword" class="text-dark fas fa-eye-slash field-icon" id="seye" onclick="sshow()"></span>
                        </div>
                        <small class="text-danger d-block " id="sl_password-error"></small>
                      </div>


                    <button type="submit" class="btn  text-white col-12" id="ssubmit">
                      <div class="spinner-border spinner-border-sm text-light " id="sloading-icon" style="opacity: 0;" role="status" style="vertical-align: text-top"> </div>
                      <span class="sbtn_text text-white " style="vertical-align: middle;"> @lang('lang.login') </span>
                    </button>
                
                      <a href="/student/forgot-password" class="text-decoration-none"><small class="form-text text-muted text-center mt-3">forgot password ?</small> </a>
                    </form>
                      <hr>
                    <p class="text-center  " style="font-size: 0.9rem;">if you don't have an acoount,<a href="" class="text-primary text-decoration-none" data-toggle="modal" data-target="#student-register" > Sign up </a> here</p>
            </div>

            {{-- teacher login form --}}
            
            <div id="teacher-lform" class="rounded m-auto col-xl-9 col-lg-8 col-md-6  border py-4 shadow animate__animated  animate__backInRight " style="display: none;overflow-x: hidden;">
              <form class="px-4 pt-3 " id="teacherlogin" method="POST">
                @csrf
                <small class="  text-center alert-danger py-2 px-3  rounded" style="display:none;" id="tl_error"></small>
                  <div class="form-group mt-3">
                    <input type="email" class="form-control" id="temail"  aria-describedby="emailHelp" placeholder="Email">
                    <small class="text-danger d-block " id="tl_email-error"></small>
                  </div>
                  <div class="form-group">
                      <div class="input-group">
                          <input type="password" name="password" id="tpassword" class="form-control validate" placeholder="Password">
                          <span toggle="#tpassword" class="text-dark fa fa-eye-slash field-icon"  id="teye" onclick="tshow()"></span>
                      </div>
                      <small class="text-danger d-block " id="tl_password-error"></small>
                    </div>
                    <button type="submit" class="btn  text-white col-12 text-weight-bold" id="tsubmit" style="background-color: #FF66CB;">
                      <div class="spinner-border spinner-border-sm text-light " id="tloading-icon" style="opacity: 0;" role="status" style="vertical-align: text-top;"> </div>
                      <span class="tbtn_text text-white " style="vertical-align: middle;"> @lang('lang.login') </span>
                    </button>
              
                    <a href="/teacher/forgot-password" class="text-decoration-none"><small class="form-text text-muted text-center mt-3 cursor">forgot password ?</small> </a>
                  </form>
                   
          </div>
        </div>
    </div>
    </div>

{{-- student-register --}}
<div class="modal fade " id="student-register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content " >
      <div class="d-flex justify-content-between px-3 pt-4">
        <h5 class="modal-title text-center" id="exampleModalLabel">Create Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true" class="p-auto" style="font-size: 30px;color:red;">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form  enctype="multipart/form-data" id="studentregister" method="POST" name="studentregister" >
          @csrf
         <div class="d-flex justify-content-between mt-3 ">
         
          <div class="col-3 ">
       <img src="https://img.icons8.com/fluent/96/000000/gender-neutral-user.png"  id="imagepreview" class="rounded bg-light border border-info" width="75px" height="75px">
          <label for="image" class="rounded  text-white text-center" style="position: relative;;top:-24px;left:-1px;width:75px;background:rgba(0,0,0,0.6);cursor: pointer;" >upload</label>
        
        
          <input type="file" name="image" class="d-none" id="image" onchange="readURL(this)"> 
       
          <small class="text-danger d-block text-left" id="image-error"></small>
         </div>


          <div class="col-8 col-lg-9 col-md-9   pl-0 pr-0">

              <div class="form-group ">

                <div >
                  <label for="rollno" >Rollno (number only)</label>
                <input type="text" class="form-control" id="rollno" pattern="[0-9]+" name="rollno" value="" onchange="this.setAttribute('value',this.value)">
         
              </div>
                  <small class="text-danger" id="rollno-error"></small>
              </div>
              
              <div class="form-group   ">
                <div >
                  <label for="name" >Name</label>
                <input type="text" class="form-control" id="name" name="name" value="" onchange="this.setAttribute('value',this.value)">
                
                </div>
                  <small class="text-danger" id="name-error"></small>
              </div>

          

          <div class="form-group row justify-content-between">
            <div id="Major" class="col-6 my-2">
            <label for="major">Major</label>
          
            <select class="form-control " id="major" name="major">
              <option >Myanmar</option>
              <option >Japan</option>
              <option >English</option>
            </select>
            
      
           
          </div>

          <div id="Year" class="col-6 my-2">
            <label for="year">Year</label>
          
            <select class="form-control " id="year" name="year">
              <option >First Year</option>
              <option >Second Year</option>
              <option >Third Year</option>
            </select>
          

        
          </div>

          </div>

          <div class="form-group  ">
            <div >
              <label for="email" >Email</label> 
            <input type="email" class="form-control"  name="email" id="email" value="" onchange="this.setAttribute('value',this.value)">
           
            </div>
              <small class="text-danger" id="email-error"></small>
         
          </div>
          <div class="form-group ">
            <div >
              <label for="password" >Password</label>
            <input type="password" class="form-control" id="password" name="password" value="" onchange="this.setAttribute('value',this.value)">
          
            </div>
              <small class="text-danger" id="password-error"></small>
           
          </div>
          </div>
         </div>
          <div>
        <button type="submit" class="btn col-12 text-white my-xl-2 " id="signup" >
          <div class="spinner-border spinner-border-sm text-light " id="loading-icon" style="opacity: 0;" role="status" style="vertical-align: text-top"> </div>
          <span class="btn_text text-white text-center" style="vertical-align: middle;">Sign up</span>
     </button>
    </div>
      
    </form>
  </div>
    </div>
  </div>
</div>

</body>
<script src="{{ asset('js/login.min.js') }}"></script>

</html>
