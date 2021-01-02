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
    <x-navigation/>
  <div style="position: relative;height:70vh;" class="container">
    <div class="row col-12" style="position: absolute;top:50%;left:0;transform:translateY(-50%);" >
            <div class="my-5 container " >
            <h3 class="mt-5  "><span>Don't worry !,</span><br>
                just enter Roll number</h3>  
                <form method="POST" id="sforgetpassword" name="sforgetpassword">
                    @csrf
                    <small class="text-center alert-success py-2 px-3 col-lg-6 col-md-8 mt-3 mb-0 rounded" id="success"></small>
                    <small class="text-center alert-danger py-2 px-3 col-lg-6 col-md-8 mt-3 mb-0 rounded" id="invalid-error"></small>
                    <div class="text_field mt-5">
                        <input type="text" class="form-control  col-lg-6 col-md-8 " id="rollno" value="" onchange="this.setAttribute('value',this.value)">
                        <label for="name" class="col-form-label">Enter roll number</label>
                       
                        </div>
                        <small class="text-danger d-block " id="error"></small>
                    <button class="btn  col-lg-6 col-md-8 text-white mt-5" id="submit" type="submit" style="background-color: #af79df;">Send</button>
                </form>
            </div>  


       
        </div>



</div>
<script>
     let error=document.getElementById('error');
     let success=document.getElementById('success');
     let invalid=document.getElementById('invalid-error');
     let submit=document.getElementById('submit');
    let aa=document.forms['sforgetpassword'];
    invalid.style.display="none";
    success.style.display="none";
    aa.onsubmit=function(e){
        e.preventDefault();
        let rollno=document.getElementById('rollno').value;
    console.log(rollno);
        axios.post('/api/forgetpassword/student',{
            'rollno':rollno
        }).then(res=>{
          console.log(res.data);
           if(res.data.success){
          
         
            success.style.display="block";
         
                success.innerHTML=res.data.success;
           

                invalid.style.display="none";
                error.style.display="none";
           }
            if(res.data.rollno){
             
              error.style.display="block";
                error.innerHTML=res.data.rollno[0];
                invalid.style.display="none";
                success.style.display="none";
                console.log(res.data.rollno);
           
            }
            if(res.data.msg){
              
              
                invalid.style.display="block";
                invalid.innerHTML=res.data.msg;
                success.style.display="none";
                error.style.display="none";
                console.log(res.data.msg);
            }
           
        
          
            
        });
    };
</script>
</body>
</html>