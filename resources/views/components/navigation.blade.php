<div id="nav">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <nav class="navbar navbar-light bg-white shadow-lg" >
        <div class="container">
        <a class="navbar-brand " href="/">
          <img src="{{ asset('img/ucsylogo.png') }}" width="45" height="45" alt="" loading="lazy">
        </a>
      
        {{-- l-nav --}}

        <li class="nav-item" id="l-nav">
            <a class="nav-link" href="/">HOME</a>
          </li>
      
          <li class="nav-item" id="l-nav">
            <a class="nav-link" href="#">ABOUT</a>
          </li>
          <li class="nav-item" id="l-nav">
            <a class="nav-link" href="#">HOW-TO-USE</a>
          </li>
          <li class="nav-item" id="l-nav" >
            <a class="nav-link" href="#">CONTACT</a>
          </li>
          <li class="nav-item dropdown" id="l-nav">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('img/british.svg') }}" width="20" height="25" alt="">
            </a>
            <div class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">
                <img src="{{ asset('img/index.png') }}" width="20" height="20" alt="">
              </a>
              <a class="dropdown-item" href="#">
                <img src="{{ asset('img/japan.png') }}" class="border" width="20" height="20" alt="">
              </a>
          
  
              
            </div>
          </li>

          {{-- m-nav --}}
     
       
         <div class="col-9 " id="m-nav">
          <button class="btn border-0  float-right" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <img src="https://img.icons8.com/metro/26/000000/menu.png" />
          </button>
        </div>
          <div class="collapse  col-12 text-center" id="collapseExample" >
          <li class="nav-item">
            <a class="nav-link" href="/">HOME</a>
          </li>
      
          <li class="nav-item">
            <a class="nav-link" href="#">ABOUT</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">HOW-TO-USE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">CONTACT</a>
          </li>
          <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('img/british.svg') }}" width="20" height="25" alt="">
            </a>
            <div class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">
                <img src="{{ asset('img/index.png') }}" width="20" height="20" alt="">
              </a>
              <a class="dropdown-item" href="#">
                <img src="{{ asset('img/japan.png') }}" class="border border-light" width="20" height="20" alt="">
              </a>
            </div>
          </li>
    </div>
</div>
{{-- end m-nav --}}
      </nav>
</div>
