<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="https://i.ibb.co/ZzqN21h/Group-1-1.png" type="image/png" >
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">

<x-link/>

</head>
<body style="background-color: #121212">
    <div class="container text-dark  " style="position: fixed;top:20px;left:5px;">
    <a href="/" class="text-dark shadow-sm p-3 rounded" style="text-decoration:none;width:100%;height:100%;background:#E4E8EE">
    <img src="https://i.ibb.co/ZzqN21h/Group-1-1.png" width="40px" height="40px"> Smart Attendance
</a>
</div>

    <div class=" col-lg-4 col-md-6   text-white rounded" style="position: fixed;top:45%;left:50%;transform:translate(-50%,-50%);">
        <p class="text-danger" id="error"></p>
    <div class="py-4 shadow-sm " style="background:#1F1F1F;">
        <h3 class="text-center mb-4">Admin Login</h3>

<form method="POST" class="my-3 px-5 " id="admin_login" >
    @csrf
<input type="email" class="col-12 my-4 form-control" id="email"placeholder="Email" required>
<div class="input-group  my-4">
<input type="password" name="password" id="password" class="form-control col-12" placeholder="Password" required>
<span toggle="#tpassword" class=" fa fa-eye-slash field-icon1"  id="eye" style="color: #757474" onclick="show()"></span>
</div>
<button type="submit" class="btn text-white col-12" style="background-color: #1F51FF">Login</button>
</form>
</div>
    </div>


<script>
    function show(){
        let y = document.getElementById('eye');
        let password=document.getElementById("password");
    if (password.type === "password") {
        password.type = "text";

        y.classList.remove('fa-eye-slash');
        y.classList.add('fa-eye');
    } else {
        password.type = "password";
        y.classList.remove('fa-eye');
        y.classList.add('fa-eye-slash');
    }
    }

    let form=document.forms['admin_login'];
    form.onsubmit=function(e){
        e.preventDefault();
        let email=document.getElementById('email').value;
        let password=document.getElementById('password').value;
        let err=document.getElementById('error');
        axios.post('/api/admin/login',{
        'email':email,
        'password':password
    }).then(res=>{
console.log(res);
if(res.data.msg=="Valid"){
    window.location="/admin/dashboard";
}
res.data.err ? err.innerHTML = res.data.err : err.innerText = '';
    });
    }
   
</script>

</body>
</html>