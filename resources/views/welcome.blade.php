<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> --}}
    <x-link/>
    <title>UCSY</title>
</head>
<body>
    <x-navigation/>
    {{-- content --}}
    <div id="content">
        <div id="content-text" >
        <div class="bd-callout bd-callout-red animate__animated animate__lightSpeedInRight">
                        You No need to shout <br>
                "Present Sir" <br>
                For the attendence  
        </div>
   <a href="/login"> <button class="btn btn-light text-danger mt-2 col-lg-3"> Login    &nbsp;&nbsp;<i class="fas fa-arrow-right "></i></button></a>
        
    </div>

    <span class="animate__animated animate__bounce"></span>
   

    </div>
   {{-- about --}}
   <div id="about" class="container  mt-5">
       <h3 class="text-center" data-aos="fade-down">ABOUT</h3>
       <div id="about-text" class="bd-callout-info my-5">
            <p>This system is attendece with <span> qr-code</span> system . I hope this can reduce a lot of times , papers and more easier by scanning <span>qr-code</span> . And there have two main parts, <b>Teacher </b> and <b>Student</b>.</p> 
                
        </div>   
        <div class="row justify-content-around my-lg-5 pt-lg-5" style="overflow-x: hidden">
            <section id="teacher" class="col-md-5 col-lg-5 shadow p-4 mb-5 "  data-aos="zoom-out-left"
           >
                <h5 class="mb-4 ">Teacher</h5>
                <h6>Teacher generates qr code as roll-call -form.
                    She can also print roll-call list with pdf format.</h6>
            </section>
            <section id="student" class="col-md-5 col-lg-5 shadow p-4  mb-5 "  data-aos="zoom-out-right"
           >
                <h5 class="mb-4">Student</h5>
                <h6>Teacher generates qr code as roll-call -form.
                    She can also print roll-call list with pdf format.</h6>

            </section>
        </div> 
   </div>


{{-- how-to-use --}}

<div  id="how-to-use" >
    <div class="custom-shape-divider-top-1606713114">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" class="shape-fill"></path>
        </svg>
    </div>
    <br><br>
    <h3 class="container text-white py-5 a" data-aos="fade-down">How-to-Use</h3>
    <center>
    <video  class="col-lg-6 col-md-8 col-12 my-5" controls>
        <source src="{{asset('img/aa.mp4')}}" type="video/mp4">
        
      </video> 
    </center>
</div>

   

{{-- contact --}}
   <div id="contact">
    <h3 class="text-center  py-5 " data-aos="fade-down">CONTACT</h3>

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
 
</body> 




<script>
  AOS.init();
</script>


</html>