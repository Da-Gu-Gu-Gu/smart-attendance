<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
{{-- icon --}}
<link rel="icon" href="https://i.ibb.co/ZzqN21h/Group-1-1.png" type="image/png" >
    <x-link/>
    <title>Smart Attendance</title>
</head>
<body>
 
       
    </div>
    <x-navigation/>
    {{-- content --}}
    <div id="content">
        <div id="content-text" >
        <div class="bd-callout bd-callout-red animate__animated animate__lightSpeedInRight">
                       @lang('lang.YOU NO NEED TO SHOUT') <br>
                <b>"@lang('lang.PRESENT SIR')"</b> <br>
                @lang('lang.FOR THE ATTENDENCE') 
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
            <h5 class=" container text-left ml-md-4 ml-lg-5"  style="color:#ff007f;border-left:2px solid #ff007f;">Features</h5>
        <div class="row  container justify-content-around  " style="overflow-x: hidden">
   
            <section id="hover" class="col-md-3 col-lg-3 shadow p-4 py-2 mb-5 "  data-aos="zoom-out-left"
           >
            <i class="fas fa-qrcode" style="font-size:2.8rem;"></i>
             <p class="mt-1">@lang('lang.Qr-Code')</p>
                
            </section>
              <section id="hover" class="col-md-3  col-lg-3 shadow p-4 py-2 mb-5 "  data-aos="zoom-out-right"
           >
           
            <i class="far fa-calendar-alt" style="font-size:2.8rem;"></i>
             <p class="mt-1">Schedule</p>
                
            </section>
            <section  id="hover" class="col-md-3  col-lg-3 shadow p-4  py-2 mb-5 "  data-aos="zoom-out-left"
           >
                <i class="fas fa-print" style="font-size:2.8rem;"></i>
                 <p class="mt-1">@lang('lang.download')</p>
         

            </section>
</div>
{{-- second --}}
    <div class="row  container justify-content-around  " style="overflow-x: hidden">
             <section  id="hover" class="col-md-3  col-lg-3 shadow p-4 py-2 mb-5 "  data-aos="zoom-out-right"
           >
            <i class="far fa-chart-bar" style="font-size:2.8rem;"></i>
             <p class="mt-1">Attendance Chart</p>
                
            </section>
              <section id="hover" class="col-md-3   col-lg-3 shadow p-4 py-2 mb-5 "  data-aos="zoom-out-left"
           >
         
            <i class="fas fa-book" style="font-size:2.8rem;"></i>
             <p class="mt-1">Assignment</p>
                
            </section>
            <section id="hover" class="col-md-3 col-lg-3 shadow p-4 py-2 mb-5 "  data-aos="zoom-out-right"
           >
                <i class="fas fa-medal" style="font-size:2.8rem;"></i>
                <p class="mt-1">Attendance Leaderboard</p>
         

            </section>
        </div>
        
        <h5 class=" container text-left ml-md-4 ml-lg-5 mt-auto"  style="color:#5754FF;border-left:2px solid #5754FF;">Benefits</h5>
     
            <div class="row container mt-5 justify-content-between" style="overflow-x:hidden ">
             
                <section id="benefit" class="row shadow p-4 py-2 mb-5  col-lg-6"  data-aos="zoom-out-left"
                >
                     <i class="fas fa-tachometer-alt"style="font-size:2.8rem;width:20%;"></i>
                     <div class="text-left" style="width:80%;">
                     <p class="mb-0">Faster</p>
                     <small style="color:#777777;">You can get attendence in seconds.</small>
                    </div>
     
                 </section>
                 <section id="benefit" class="row shadow p-4 py-2 mb-5  col-lg-6    "  data-aos="zoom-out-right"
                 >
                      <i class="fas fa-dollar-sign" style="font-size:2.8rem;width:20%;"></i>
                      <div class="text-left" style="width:80%;">
                      <p class="mb-0">Reduce</p>
                      <small style="color:#777777;">Reduce a lot of times and papers.</small>
                     </div>
      
                  </section>
                  <section id="benefit" class="row shadow p-4 py-2 mb-5  col-lg-6"  data-aos="zoom-out-left"
                  >
                       <i  class="fas fa-server" style="font-size:2.8rem;width:20%;"></i>
                       <div class="text-left" style="width:80%;">
                       <p class="mb-0">Data</p>
                       <small style="color:#777777;">Data are permanent</small>
                      </div>
       
                   </section>

                   <section id="benefit" class="row shadow p-4 py-2 mb-5  col-lg-6"  data-aos="zoom-out-right"
                  >
                       <i   class="far fa-eye"style="font-size:2.8rem;width:20%;"></i>
                       <div class="text-left" style="width:80%;">
                       <p class="mb-0">Visibility</p>
                       <small style="color:#777777;">You can see all of your attendece data</small>
                      </div>
       
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



<script type="text/javascript">
	VanillaTilt.init(document.querySelector("#hover"), {
		max: 25,
		speed: 400
	});
	
	//It also supports NodeList
	VanillaTilt.init(document.querySelectorAll("#hover"));

    VanillaTilt.init(document.querySelector("#benefit"), {
		max: 25,
		speed: 400
	});
	
	//It also supports NodeList
	VanillaTilt.init(document.querySelectorAll("#benefit"));
</script>



<script>



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