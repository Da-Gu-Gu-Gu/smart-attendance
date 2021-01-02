<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <x-link/>
    <title>Document</title>
</head>
<body>
    <x-navigation/>
        <br>
     
        <div id="aa" class="col-12">
        <span class="alert alert-warning text-center col-md-4 col-lg-4 col-xl-4  mx-auto" id="alert" style="display: none;"></span>
    <h3 class="animate__animated animate__flipInX text-center ">Enter Verification Code </h3>
  
    <form id="verify_form" class="my-5 col-12">
         <center><input type="text"  id="1" class="form-controls" maxlength="1" onkeyup="change(this,'2')">
        <input type="text"  id="2"class="form-controls" maxlength="1" onkeyup="change(this,'3')">
        <input type="text"  id="3" class="form-controls"maxlength="1" onkeyup="change(this,'4')">
        <input type="text"  id="4" class="form-controls" maxlength="1">
    
        <button type="submit" class="d-block aa btn my-5 ">VERIFY</button>
         </center>
    </form>
    <center><small class="text-center my-5" style="font-size:18px;">Did not get code,<a href="" style="color:#7C73FF;cursor: pointer;" class="text-decoration-none "> send again? </a></small></center>
        </div>

        
  
</body>
<script>
    function change(first,next){
        if(first.value.length){
            document.getElementById(next).focus();
        }
    }
    
    
    let verify_form=document.forms['verify_form'];
verify_form.onsubmit=function(e){
  
e.preventDefault();

   let verify_number=document.getElementById('1').value+document.getElementById('2').value+document.getElementById('3').value+document.getElementById('4').value;
  

axios.post('/api/student',{
    'verify_number':parseInt(verify_number),
})
.then(res=>{
console.log(res);
if(res.data.msg=="Incorrect number!"){
    document.getElementById('alert').style.display="block";
    document.getElementById('alert').innerHTML=res.data.msg;
}
if(res.data.msg=='success'){
    window.location='/student';
}

});
}
</script>
</html>