<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@BPSA">
    <meta property="twitter:creator" content="@BPSA">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="BPSA">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Admin || BPSA</title>
    
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
    <style>.active, .app-menu__item:hover {
  background-color: #666;
  color: white;
}</style>
  </head>
  <body class="app sidebar-mini rtl">
      {{-- top bar --}}
      <header class="app-header"><a class="app-header__logo" href="{{url('/admin/home')}}">BPSA </a>
        <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="{{url('/')}}" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
        
          <!-- User Menu-->
          <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
              <li><a class="dropdown-item" href="#"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
              <li><a class="dropdown-item" href="#"><i class="fa fa-user fa-lg"></i> Profile</a></li>
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
      <div class="app-sidebar__user">
        <div>
          <p class="app-sidebar__user-name">{{ Auth::user()->name}}</p>
          <p class="app-sidebar__user-designation">{{ Auth::user()->email}}</p>
        </div>
      </div>
      <ul class="app-menu" id="myDIV">
        <li><a class="app-menu__item {{ (request()->is('admin/home')) ? 'active' : '' }}" href="/admin/home"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
      <li><a class="{{ (request()->is('admin/user')) ? 'active' : '' }} app-menu__item" href="{{url('admin/user')}}"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">User</span></a></li>
         <li><a class="{{ (request()->is('admin/committee')) ? 'active' : '' }} app-menu__item" href="{{url('admin/committee')}}"><i class="app-menu__icon fa fa-pencil-square"></i><span class="app-menu__label">Committee</span></a></li>
         <li><a class="app-menu__item {{ (request()->is('admin/former')) ? 'active' : '' }}" href="{{url('admin/former')}}"><i class="app-menu__icon fa fa-address-card-o"></i><span class="app-menu__label">Former</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('admin/slider')) ? 'active' : '' }}" href="{{url('admin/slider')}}"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Slider</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('admin/massege')) ? 'active' : '' }}" href="{{url('admin/massege')}}"><i class="app-menu__icon fa fa-window-restore"></i><span class="app-menu__label">Massege</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('admin/successe')) ? 'active' : '' }}" href="{{url('admin/successe')}}"><i class="app-menu__icon fa fa-camera-retro"></i><span class="app-menu__label">Successe</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('admin/post')) ? 'active' : '' }}" href="{{url('admin/post')}}"><i class="app-menu__icon fa fa-check-circle"></i><span class="app-menu__label">Post</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('admin/leadership')) ? 'active' : '' }}" href="{{url('admin/leadership')}}"><i class="app-menu__icon fa fa-rss"></i><span class="app-menu__label">Current Leadership</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('admin/docment')) ? 'active' : '' }}" href="{{url('admin/docment')}}"><i class="app-menu__icon fa fa-folder"></i><span class="app-menu__label">Association Documents</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('admin/event')) ? 'active' : '' }}" href="{{url('admin/event')}}"><i class="app-menu__icon fa fa-tablet"></i><span class="app-menu__label">Events</span></a></li>

        <!--<li><a class="app-menu__item" href="{{url('admin/service')}}"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Our Services</span></a></li>-->
        <li class="item"><a class="app-menu__item {{ (request()->is('admin/blog')) ? 'active' : '' }}" href="{{url('admin/blog')}}"><i class="app-menu__icon fa fa-plus-square"></i><span class="app-menu__label">Blog</span></a></li>
        <!--<li><a class="app-menu__item" href="{{url('admin/news')}}"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">News</span></a></li>-->
        <li><a class="app-menu__item {{ (request()->is('admin/gallery')) ? 'active' : '' }}" href="{{url('admin/gallery')}}"><i class="app-menu__icon fa fa-rocket"></i><span class="app-menu__label">Gallery</span></a></li>
        <li><a class="app-menu__item {{ (request()->is('admin/video')) ? 'active' : '' }}" href="{{url('admin/video')}}"><i class="app-menu__icon fa fa-caret-square-o-right "></i><span class="app-menu__label">Video</span></a></li>

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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
if ("{{ session('status') }}") {
    swal("{{ session('status') }}");
    
}
	</script>
	<script>
	
	</script>
	<script>
	
			$(document).ready(function() {
        
        $('.textarea').richText();
        $('.textarea2').richText();
			
			});
		</script>
    
    {{-- footer 2 --}}

    @yield('footer2')
    
    {{-- extra contant --}}

    @yield('extra')
    <script type="text/javascript">

$(document).ready(function() {

    $('#sampleTable').DataTable( {


        dom: 'Pfrtip',
        
        "stateSave": true,

        searchPanes: {
            viewTotal: true,
            controls: false,
           // columns: [3]
        },
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        order: [[0, 'desc']],
        "columnDefs": [{ 
          searchPanes:{
                options:[
                    {
                        label: 'Age over 40',
                        value: function(rowData, rowIdx) {
                            return rowData[3] > 40;
                        }
                    }
                ]
            },
            "targets": [3] 
          }]

        

        
    });



});
</script>
<script>
var btnContainer = document.getElementById("myDIV");


var btns = btnContainer.getElementsByClassName("app-menu__item");


for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}	
</script>
<script>
//$(document).ready(function () {
    // Handler for .ready() called.
    //window.setTimeout(function () {
       // location.href = "/log";
   // },  30 * 60 * 1000);
//})
</script>
</body>
</html>