@extends('layouts.admin')
@section('contant')

<div class="row">
    <div class="col-md-6">
        <h3>DOCUMENT LISTS</h3>
    </div>
    <div class="col-md-6 text-right">
    <a class="btn btn-primary btn-sm" href="{{url('admin/docment/create')}}">  New Document</a> 
    </div>
</div>

    

<table class="table table-hover table-bordered" id="sampleTable">
    <thead>


<th>ID</th>   
<th>Title</th>
<th>Summary</th>
<th>File</th>
<th>Cover <br>  Photo</th>
<th>Status</th>
<th>Action</th>
</thead>
   
    <tbody>
@foreach ($docment as $order)


<tr>
    <td>{!!@$order->id !!}</td>
    <td>{!!@$order->title !!}</td>
    

    <td>{{@$order->summary }}</td>
  
   <td><a class="" target="_blank" href="{{@$order->file}}">{{Str::limit($order->file, 20)}}</a></td>
    <td><img src="{{@$order->c_photo}}" style="height: 100px; width:100px;border-radius: 5px; background:#ccc;padding:5px;" alt="Responsive image"></td>
<td></td>
<td>
    

        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{@$order->id}}" ><i class="fa fa-edit"></i></a>
        <div class="modal fade bd-example-modal-lg" id="edit{{@$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Document Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
       <form action="{{url('admin/docment/update')}}" method="post" enctype="multipart/form-data">
@csrf
   <div class="form-group">
     <label>Title</label>
      <input type="hidden" name="id" class="form-control" value="{{$order->id}}" />
     <input type="text" name="title" class="form-control" value="{{$order->title}}" />
    </div>
    <div class="form-group">
    
     <label>Summary</label>
     
     <input type="text" name="summary" class="form-control" value="{{$order->summary}}" />
    </div>
    <div class="form-group">
     <label>File</label>
     <input type="file" name="file" class="form-control" value="" />
     <span><a class="" target="_blank" href="{{@$order->file}}">{{@$order->file}}</a></span>
    </div>
    <div class="form-group">
     <label>Cover Photo</label>
     <input type="file" name="c_photo" class="form-control" value="" require/>
     <span><img src="{{@$order->c_photo}}" style="height: 100px; width:100px;" alt="Responsive image"></span>
    </div>
    
    
   
    
   
    <div class="form-group">
     <input type="submit" name="send" class="btn btn-info" value="Update" />
    </div>
    </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
            </div>
            </div>
        </div>
        </div>
        
        <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Document?');" href="{{url('admin/docment/destroy/'.@$order->id)}}"><i class="fa fa-trash"></i></a>
     
       

</td>
 
</tr>

@endforeach
</tbody>

</table>

@endsection
@section('footer2')
<script type="text/javascript" src="{{asset('assets/login/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/login/js/plugins/dataTables.bootstrap.min.js')}}"></script>






<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
if ("{{ session('status') }}") {
    swal("{{ session('status') }}");
    
}
    

</script>


@endsection