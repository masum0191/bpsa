<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@creativeitbari">
    <meta property="twitter:creator" content="@Hasibuzzaman">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Writer || BPSA</title>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/login/css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/editor.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('assets/summernote/summernote-bs4.min.css')}}">
    <link rel="icon" href="{{'assets/images/images.jpg'}}" type="image/gif" sizes="16x16">
  </head>
  <body class="app sidebar-mini rtl">
      {{-- top bar --}}
      <header class="app-header"><a class="app-header__logo" href="{{url('/admin/home')}}">BPSA </a>
        <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="{{url('/')}}" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
          <li class="app-search">
            <input class="app-search__input" type="search" placeholder="Search">
            <button class="app-search__button"><i class="fa fa-search"></i></button>
          </li>
          <!--Notification Menu-->
         {{-- <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i></a>
            <ul class="app-notification dropdown-menu dropdown-menu-right">
              <li class="app-notification__title">You have 4 new notifications.</li>
              <div class="app-notification__content">
                <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                    <div>
                      <p class="app-notification__message">Lisa sent you a mail</p>
                      <p class="app-notification__meta">2 min ago</p>
                    </div></a></li>
                <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
                    <div>
                      <p class="app-notification__message">Mail server not working</p>
                      <p class="app-notification__meta">5 min ago</p>
                    </div></a></li>
                <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                    <div>
                      <p class="app-notification__message">Transaction complete</p>
                      <p class="app-notification__meta">2 days ago</p>
                    </div></a></li>
                <div class="app-notification__content">
                  <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                      <div>
                        <p class="app-notification__message">Lisa sent you a mail</p>
                        <p class="app-notification__meta">2 min ago</p>
                      </div></a></li>
                  <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
                      <div>
                        <p class="app-notification__message">Mail server not working</p>
                        <p class="app-notification__meta">5 min ago</p>
                      </div></a></li>
                  <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                      <div>
                        <p class="app-notification__message">Transaction complete</p>
                        <p class="app-notification__meta">2 days ago</p>
                      </div></a></li>
                </div>
              </div>
              <li class="app-notification__footer"><a href="#">See all notifications.</a></li>
            </ul>
          </li>--}}
          <!-- User Menu-->
          <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
             {{-- <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
              <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i> Profile</a></li>--}}
              <li><a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i> Logout</a>                              
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
               </li>
            </ul>
          </li>
        </ul>
      </header>
      {{-- left bar --}}
      <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      
        <div>
          <p class="app-sidebar__user-name">{{ Auth::user()->name}}</p>
          <p class="app-sidebar__user-designation">{{ Auth::user()->email}}</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item  {{ (request()->is('writer/home')) ? 'active' : '' }}" href="/writer/home"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
      
         <li><a class="app-menu__item {{ (request()->is('writer/committee')) ? 'active' : '' }}" href="{{url('writer/committee')}}"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Committee</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('writer/post')) ? 'active' : '' }}" href="{{url('writer/post')}}"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Post</span></a></li>
        
        <li><a class="app-menu__item {{ (request()->is('writer/gallery')) ? 'active' : '' }}" href="{{url('writer/gallery')}}"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Gallery</span></a></li>
        

      </ul>
    </aside>
   
    {{-- main contant --}}
    <main class="app-content tile">
    @yield('contant')
</main>
    {{-- footer --}}
    <!-- Essential javascripts for application to work-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <!-- <script src="{{asset('assets/login/js/jquery-3.2.1.min.js')}}"></script> -->
            <script src="{{asset('assets/login/js/popper.min.js')}}"></script>
            <script src="{{asset('assets/login/js/bootstrap.min.js')}}"></script>
            <script src="{{asset('assets/login/js/main.js')}}"></script>
            <!-- The javascript plugin to display page loading on top-->
            <script src="{{asset('assets/login/js/plugins/pace.min.js')}}"></script>
 	<!-- Summernote -->
    	<script src="{{asset('assets/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('js/editor.js')}}"></script>
            <!-- Page specific javascripts-->
            <script type="text/javascript" src="{{asset('assets/login/js/plugins/chart.js')}}"></script>
            <script type="text/javascript" src="{{asset('assets/login/js/plugins/bootstrap-notify.min.js')}}"></script>
            <script type="text/javascript" src="{{asset('assets/login/js/plugins/sweetalert.min.js')}}"></script>
            <script type="text/javascript" src="{{asset('assets/login/js/plugins/moment.min.js')}}"></script>
            <script type="text/javascript" src="{{asset('assets/login/js/plugins/jquery-ui.custom.min.js')}}"></script>
            <script type="text/javascript" src="{{asset('assets/login/js/plugins/fullcalendar.min.js')}}"></script>

	<script>
			$(document).ready(function() {
        
        $('.textarea').richText();
        $('.textarea2').richText();
			
			});
		</script>
    <script>
if ("{{ session('status') }}") {
    swal("{{ session('status') }}");
    
}
	</script>
    {{-- footer 2 --}}

    @yield('footer2')
    
    {{-- extra contant --}}

    @yield('extra')

</body>
</html>