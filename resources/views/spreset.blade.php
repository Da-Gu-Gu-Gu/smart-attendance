<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<x-link/>
<body>
    <x-navigation/>
    <div class="container col-lg-5 col-md-8 shadow rounded my-5 text-white text-weight-bold py-2" id="alert"style="background-color:#9afa6d;transition:all 0.5s;display:none;">
        <p>RESET SUCCESSFULLY!</p>
      
        <a href="/login"><button class="btn bg-white" style="right:10;">Go Back Login</button></a>

    </div>
    <div class="container col-lg-5 col-md-8 shadow rounded text-center my-5 py-4" style="font-size:40px;">
    <i class="fas fa-lock  text-center" style="color:#af79df;"></i>
    <h2 class="mt-4">Reset Password</h2>

    <center>
   
        <form class="mb-5" id="spreset">
           
        <input type="password" class="form-control col-lg-8 col-md-10 my-4" id="password"  placeholder="New Password" required>
        <input type="password" class="form-control col-lg-8 col-md-10 mt-4 " id="cpassword" placeholder="Confirm Password" required>
        <small class="text-danger d-block text-left col-lg-8 col-md-10" style="font-size:12px;" id="error"></small>
        <button type="submit" class="btn col-lg-8 col-md-10 text-white font-weight-bold mt-4" style="background-color:#af79df;">Reset Password</button>
    </form>
    </center>
    </div>
</body>
<script>
let form=document.forms['spreset'];
let password=document.getElementById('password');
let error=document.getElementById('error');
let cpassword=document.getElementById('cpassword');

form.onsubmit=function(e){
    e.preventDefault();
    

    if(password.value.length<5){
        error.innerHTML="password should have at least 5 character!";
    }
    else if(password.value!=cpassword.value){
        error.innerHTML="password doesn't match!";
    } 

    if(password.value.length>=5 &&(password.value==cpassword.value)){

        axios.post('/api/spreset',{
            'password':password.value
        }).then(res=>{
            console.log(res);
            if(res.data.good){
               document.getElementById('alert').style.display="block";
            }
        });
    }
}
</script>
</html>