<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <x-link/>
    <title>UCSY</title>
</head>
<body>
 
       
    </div>
    <x-navigation/>
    {{-- content --}}
    <div id="content">
        <div id="content-text" >
        <div class="bd-callout bd-callout-red animate__animated animate__lightSpeedInRight">
                        You No need to shout <br>
                "Present Sir" <br>
                For the attendence  
        </div>
   <a href="/login"> <button class="btn btn-light  mt-2 col-lg-3" style="color:#ff007f"> @lang('lang.login')   &nbsp;&nbsp;<i class="fas fa-arrow-right "></i></button></a>
        
    </div>

    <span class="animate__animated animate__bounce"></span>
   

    </div>
   {{-- about --}}
   <div id="about" class="container  mt-5">
       <h3 class="text-center" data-aos="fade-down">@lang('lang.ABOUT')</h3>
       <div id="about-text" class="bd-callout-info my-5">
            <p>This system is smart attendece system by scanning the <span> qr-code</span>  . I hope this can reduce a lot of times , papers and more easier . And there have two main parts, <b>Teacher </b> and <b>Student</b>.</p> 
                
        </div>  
        <center>
        <div class="row  container justify-content-around my-lg-5 pt-lg-5" style="overflow-x: hidden">
            <section id="teacher" class=" col-md-5 col-lg-4 shadow p-4 mb-5 "  data-aos="zoom-out-left"
           >
                <h4 class="mb-4 text-center">Teacher</h4>

                <ul>
                    <li class="pb-3 ">Generate Qr-code</li>
                    <li class="pb-3">Calendar Schedule</li>
                    <li class="pb-3">View Student'attendance</li>
                   <li class="pb-3">Create Assignment</li>
                 
              
                
                </ul>
                
            </section>
            <section id="student" class="col-md-5 col-lg-4 shadow p-4  mb-5 "  data-aos="zoom-out-right"
           >
                <h4 class="mb-4 text-center">Student</h4>
                <ul>
                    <li class="pb-3">Scan Qr-code </li>
                    <li class="pb-3">Calendar Schedule</li>
                    <li class="pb-3">Attendance Leaderboard</li>
                    <li class="pb-3">Attendance Chart</li>
                 
                </ul>

            </section>
        </div> 
    </center> 
   </div>


{{-- how-to-use --}}

<div  id="how-to-use" >
    {{-- <div class="custom-shape-divider-top-1606713114">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" class="shape-fill"></path>
        </svg>
    </div> --}}
    <br><br>
    <h3 class="container text-white  a" data-aos="fade-down">@lang('lang.HOW-TO-USE')</h3>
    <center>
    <video  class="col-lg-6 col-md-8 col-12 my-5" controls>
        <source src="{{asset('img/aa.mp4')}}" type="video/mp4">
        
      </video> 
    </center>
</div>

   

{{-- contact --}}
   <div id="contact">
    <h3 class="text-center  py-5 " data-aos="fade-down">@lang('lang.CONTACT')</h3>

    <form class="container">
        <div class="form-group">
          <label for="exampleInputEmail1">Email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">About</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="8"></textarea>
          </div>
        <button type="submit" class="btn" id="send">Send</button>
      </form>

   </div>


   {{-- footer --}}
   <div id="footer" class="border w-100" style="height: 100vh;" >adsf</div>
 


{{-- scroll-up --}}
   <a id="back-to-top"  class="btn  back-to-top" role="button">
       <i class="fas fa-chevron-up text-white" ></i>
    </a>
</body> 




<script>

// flag change foh loke ya ml
// function language(asd){
//      alert(asd);
//      document.getElementsByClassName('selected').src=asd;
//      console.log(asd);
//    }

  AOS.init();

  $(document).ready(function(){
      $(window).scroll(function(){
          if($(this).scrollTop()>50){
              $('#back-to-top').fadeIn();
          }else{
              $('#back-to-top').fadeOut();
          }
      });

      $('#back-to-top').click(function(){
          $('body,html').animate({
              scrollTop:0
          },450);
          return false;
      });
  })

</script>


</html>