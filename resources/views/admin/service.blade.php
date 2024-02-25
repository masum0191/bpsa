@extends('layouts.admin');
@section('contant')
<p class=" text-center text-info h4 "><i>Services </i></p>
<a class="btn btn-primary btn-sm" href="#">  New Service</a> 

<table class="table table-hover table-bordered" id="sampleTable">
    <thead>


<th>Image</th>
<th>Service Name</th>
<th>Description</th>
<th>Action</th>
</thead>
   
    <tbody>
@foreach ($images as $order)


<tr>
<td><img src="{{@$order->image}}" style="height: 100px; width:100px;" alt="Responsive image"></td>
    <td>{{@$order->title }}</td>
    <td>{{@$order->description }}</td>
    

<td>

        <a class="btn btn-primary btn-sm" href="#">Edit</a>
        <a class="btn btn-danger btn-sm" href="#">Delete</a>
       

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