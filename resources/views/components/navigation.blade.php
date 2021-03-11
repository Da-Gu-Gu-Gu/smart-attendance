<div id="nav">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <nav class="navbar navbar-light bg-white shadow-lg" >
        <div class="container">
        <a class="navbar-brand" href="/">
          <img src="{{ asset('img/logo.png') }}" width="50" height="50" alt="" loading="lazy">
        
        </a>
      
        {{-- l-nav --}}

        <li class="nav-item" id="l-nav">
            <a class="nav-link" href="/">@lang('lang.HOME')</a>
          </li>
      
          <li class="nav-item" id="l-nav">
            <a class="nav-link" href="#">@lang('lang.ABOUT')</a>
          </li>
          <li class="nav-item" id="l-nav">
            <a class="nav-link" href="#">@lang('lang.HOW-TO-USE')</a>
          </li>
          <li class="nav-item" id="l-nav" >
            <a class="nav-link" href="#">@lang('lang.CONTACT')</a>
          </li>
          <li class="nav-item dropdown" id="l-nav">
            <a class="nav-link dropdown-toggle " href="/lang/en" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img  src="{{asset('img/'.session('locale').'.png')}}" class="border" width="25" height="20" alt="">
            </a>
            <div class="dropdown-menu text-center" aria-labelledby="navbarDropdown">

              <a class="dropdown-item" href="/lang/en" onclick="language();">
                <img src="{{ asset('img/en.png') }}" width="20" height="25" alt="">
              </a>

              <a class="dropdown-item" href="/lang/mm" onclick="language();">
                <img src="{{ asset('img/mm.png') }}" width="20" height="20" alt="">
              </a>
              <a class="dropdown-item" href="/lang/jp" onclick="language();">
                <img src="{{ asset('img/jp.png') }}" class="border" width="20" height="20" alt="">
              </a>
          
  
              
            </div>
          </li>

          {{-- m-nav --}}
     
       
        <div class="col-9 " id="m-nav">
          <button class="btn border-0  float-right" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <img src="https://img.icons8.com/metro/26/000000/menu.png" />
          </button>
        </div>

          <div class="collapse  col-12 text-center snav-link" id="collapseExample"  >
          <li class="nav-item">
            <a class="nav-link" href="/">@lang('lang.HOME')</a>
          </li>
      
          <li class="nav-item">
            <a class="nav-link" href="#">@lang('lang.ABOUT')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">@lang('lang.HOW-TO-USE')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">@lang('lang.CONTACT')</a>
          </li>
          <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle " href="/lang/en" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img  src="{{asset('img/'.session('locale').'.png')}}" class="border" width="25" height="20" alt="">
            </a>
            <div class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="/lang/en" >
                <img src="{{ asset('img/en.png') }}" onclick="language();" width="20" height="25" alt="">
              </a>

              <a class="dropdown-item" href="/lang/mm" >
                <img src="{{ asset('img/mm.png') }}" width="20" height="20" alt="" onclick="language();">
              </a>
              <a class="dropdown-item" href="/lang/jp" onclick="language("{{asset('img/japan.png')}}")">
                <img src="{{ asset('img/jp.png') }}" class="border border-light" width="20" height="20" alt="" onclick="language();">
              </a>
            </div>
          </li>
    </div>
</div>
{{-- end m-nav --}}
      </nav>


</div>
