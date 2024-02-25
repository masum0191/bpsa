@extends('layouts.admin')
@section('contant')
<div class="row">
    <div class="col-md-6">
        <h3>Slider Lists</h3>
    </div>
    <div class="col-md-6 text-right">
    <a class="btn btn-primary btn-sm" href="{{ route('slider.create') }}">  New Slider</a> 
    </div>
</div>


<table class="table table-hover table-bordered" id="sampleTable">
    <thead>


<th>Image</th>
<th>Title</th>
<th>Description</th>
<th>Status</th>
<th>Action</th>
</thead>
   
    <tbody>
@foreach ($images as $order)


<tr>
<td><img src="{{@$order->image}}" style="height: 100px; width:100px;" alt="Responsive image"></td>
    <td>{{@$order->title }}</td>
    <td>{{@$order->description }}</td>
    <td> 
    @if(@$order->status==1)
    <a class="btn btn-primary btn-sm" href="{{url('admin/slider/innotice/'.@$order->id)}}"><i class="fa fa-solid fa-toggle-on"></i></a>
    @else
    <a class="btn btn-dark  btn-sm"  href="{{url('admin/slider/acnotice/'.@$order->id)}}"><i class="fa fa-thin fa-toggle-off"></i></a>
    @endif
    </td> 
    

<td>

        <a class="btn btn-primary btn-sm" href="{{ url('admin/slider/edit',$order->id) }}">Edit</a>
        <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?');" href="{{ url('admin/slider/destroy',$order->id) }}">Delete</a>
       

</td>
 
</tr>

@endforeach
</tbody>
</table>

@endsection
@section('footer2')
<script type="text/javascript" src="{{asset('assets/login/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/login/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">
$('#sampleTable').DataTable();
</script>




<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
if ("{{ session('status') }}") {
    swal("{{ session('status') }}");
    
}
    

</script>


@endsection