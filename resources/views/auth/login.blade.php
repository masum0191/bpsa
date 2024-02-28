<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

   
    <!-- Main CSS-->
    
 <link rel="stylesheet" type="text/css" href="{{asset('assets/login/css/main.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login</title>
    <style>
.ml5 {
  position: relative;
  font-weight: 300;
  font-size: 4.5em;
  color: #402d2d;
}

.ml5 .text-wrapper {
  position: relative;
  display: inline-block;
  padding-top: 0.1em;
  padding-right: 0.05em;
  padding-bottom: 0.15em;
  line-height: 1em;
}

.ml5 .line {
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  margin: auto;
  height: 3px;
  width: 100%;
  background-color: #402d2d;
  transform-origin: 0.5 0;
}

.ml5 .ampersand {
  font-family: Baskerville, "EB Garamond", serif;
  font-style: italic;
  font-weight: 400;
  width: 1em;
  margin-right: -0.1em;
  margin-left: -0.1em;
}

.ml5 .letters {
  display: inline-block;
  opacity: 0;
}
    </style>
  </head>
  <body>
       <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    BPSA 
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <!--<li class="nav-item">-->
                                <!--    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>-->
                                <!--</li>-->
                            @endif
                        @else
                        @if(auth()->user()->is_admin == 1)
                           <a class="navbar-brand" href="{{ url('admin/home') }}">Admin Dashboard</a>
                         
                         @elseif(auth()->user()->is_admin == 2)
                           <a class="navbar-brand" href="{{ url('writer/home') }}">Writer Dashboard</a>
                         @else
                         <a class="navbar-brand" href="{{ url('editor/home') }}">Editor Dashboard</a>
                         @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    <section class="material-half-bg">
        
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
            <h1 class="ml5">
                    <span class="text-wrapper">
                      <span class="line line1"></span>
                      <span class="letters letters-left">Bangladesh Police  </span>
                      
                      <span class="letters letters-right">Service Association</span>
                      <span class="line line2"></span>
                    </span>
                  </h1>

      </div>
      <div class="col-md-4 text-uppercase bg-white ">

                    <div class="card-header bg-white h3 text-center"> {{ isset($url) ? ucwords($url) : ""}} {{ __('Admin Login') }}</div>

                    <div class="card-body">
                        @isset($url)
                        <form method="POST" action='{{ url("login/$url") }}' aria-label="{{ __('Login') }}">
                        @else
                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @endisset
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label">{{ __('User Name') }}</label>

                                <div class="col-md-8">
                                    <input id="email" type="email" value="" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>

                                <div class="col-md-8">
                                    <input id="password" type="password" value="" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                  
                                </div>
                            </div>
                        </form>
                    </div>


        </form>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="{{asset('assets/login/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('assets/login/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/login/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/login/js/main.js')}}"></script>
    {{-- font animate --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
    <script>
    anime.timeline({loop: true})
  .add({
    targets: '.ml5 .line',
    opacity: [0.5,1],
    scaleX: [0, 1],
    easing: "easeInOutExpo",
    duration: 800
  }).add({
    targets: '.ml5 .line',
    duration: 700,
    easing: "easeOutExpo",
    translateY: (el, i) => (-0.625 + 0.625*2*i) + "em"
  }).add({
    targets: '.ml5 .ampersand',
    opacity: [0,1],
    scaleY: [0.5, 1],
    easing: "easeOutExpo",
    duration: 700,
    offset: '-=700'
  }).add({
    targets: '.ml5 .letters-left',
    opacity: [0,1],
    translateX: ["0.5em", 0],
    easing: "easeOutExpo",
    duration: 600,
    offset: '-=300'
  }).add({
    targets: '.ml5 .letters-right',
    opacity: [0,1],
    translateX: ["-0.5em", 0],
    easing: "easeOutExpo",
    duration: 600,
    offset: '-=600'
  }).add({
    targets: '.ml5',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  });
    </script>
  </body>
</html>
