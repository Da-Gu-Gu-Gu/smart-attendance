<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <x-link/>

</head>
<body>

    <x-snavigation/>
    

    <div id="Scan" class="  col-lg-6 my-5 ">
        <video id="preview" ></video>
        <div class="row justify-content-around px-3">
            <div id="end" class="col-8 bg-danger  btn ">
                <a href="/student"><p class="text-white text-center pt-1" >Close Camera</p></a>
            </div>
            <div id="change" class="col-3 btn" style="background-color:#d6b4f0;">
               <center><img src="https://img.icons8.com/ios/32/000000/lifecycle--v1.png" name="one" value="2" /></center>
            </div>
        </div>
    </div>

    {{-- instascan --}}
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script type="text/javascript">

// document.getElementById('profile').src="http://localhost:8000/uploads/student_image/"+localStorage.getItem('image');    

// function scan(){
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function (content) {
      console.log(content);
      window.location=content;
    });
    Instascan.Camera.getCameras().then(function (cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
        $('[name="one"]').on('click',function(){
          console.log($(this).val());
if($(this).val()==1){
if(cameras[0]!=""){
scanner.start(cameras[0]);
}
}
        });

$('[name="one"]').on('click',function(){
  console.log($(this).val());
if($(this).val()==2){
if(cameras[1]!=""){
scanner.start(cameras[1]);
}
}
});
      } else {
        console.error('No cameras found.');
      }
    }).catch(function (e) {
      console.error(e);
    });
// }
  </script>
</body>
</html>