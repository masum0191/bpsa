@extends('layouts.admin')
@section('contant')

        <div class="app-title">
          <div>
           <marquee behavior="" direction=""><h1 class="text-uppercase"> BPSA || Dashboard</h1></marquee> 
            
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="/admin/home">Dashboard</a></li>
          </ul>
      <!-- rightbar top tiltle whene your need or remove end -->
      
        </div>
        <div class="row">
           <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
              <div class="info">
                <h4>Posts</h4>
                <p><b><?php echo App\Models\Post::count() ?></b></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-user fa-3x"></i>
              <div class="info">
                <h4>Committee</h4>
                <p><b><?php echo App\Models\Committee::count() ?></b></p>
              </div>
            </div>
          </div>
         
          <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
              <div class="info">
                <h4>Blogs</h4>
                <p><b><?php echo App\Models\Blog::count() ?></b></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Users</h4>
                <p><b><?php echo App\Models\User::count() ?></b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="tile">
              <h3 class="tile-title">Recent Post</h3>
             
             @foreach($post as $p)
             
             <div class="card">
            
             <div class="card-body">
             <div>
                 <a href="https://bpsa.com.bd/news/{{$p->id}}" target=""  class="row">
                 <div class="col-md-4"><img src="{{$p->Cover_Photo}}" height="70"> </div>
                 <div class="col-md-8"><p>{{$p->Heading}}</p>
                 <span>{{$p->created_at}}</span>
                 </div>
                 </a>
                  
             </div>
             </div>
             
            </div>
          
            @endforeach
          <a href="{{url('admin/post')}}" target=""  class="row ml-1 btn btn-primary">
                     View all </a> 
            </div> 
            
            
          </div>
          
          <div class="col-md-6">
            <div class="tile">
              <h3 class="tile-title">Recent Blog</h3>
               @foreach($blog as $p)
             
             <div class="card">
            
             <div class="card-body">
             <div>
                 <a href="#" target=""  class="row">
                 <div class="col-md-4"><img src="{{$p->image}}" height="70"> </div>
                 <div class="col-md-8"><p>{{$p->title}}</p>
                 <span>{{$p->created_at}}</span>
                 </div>
                 </a>
                  
             </div>
             </div>
             
            </div>
          
            @endforeach
          <a href="{{url('admin/blog')}}" target=""  class="row ml-1 btn btn-primary">
                     View all </a> 
            </div>
          </div>
        </div>
       
    
@endsection
{{-- footer2 for script --}}
@section('footer2')
    
@endsection
{{-- extra script --}}
@section('extra')
<script type="text/javascript">
    var data = {
        labels: ["January", "February", "March", "April", "May"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 80, 81, 56]
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [28, 48, 40, 19, 86]
            }
        ]
    };
    var pdata = [
        {
            value: 300,
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: "Complete"
        },
        {
            value: 50,
            color:"#F7464A",
            highlight: "#FF5A5E",
            label: "In-Progress"
        }
    ]
    
    var ctxl = $("#lineChartDemo").get(0).getContext("2d");
    var lineChart = new Chart(ctxl).Line(data);
    
    var ctxp = $("#pieChartDemo").get(0).getContext("2d");
    var pieChart = new Chart(ctxp).Pie(pdata);
  </script>
  <!-- Google analytics script-->
  <script type="text/javascript">
    if(document.location.hostname == 'pratikborsadiya.in') {
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
    }
  </script>
@endsection