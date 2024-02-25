@extends('layouts.admin')
@section('contant')
<div class="row">
    <div class="col-md-6">
        <h3>Video Lists</h3>
    </div>
    <div class="col-md-6 text-right">
    <a class="btn btn-primary btn-sm" href="{{url('admin/video/create')}}">  New Video</a> 
    </div>
</div>


<table class="table table-hover table-bordered" id="sampleTableno">
    <thead>
        <th>ID</th>
<th>Category</th>
<th>User </th>
<th>Vedio</th>
<th>Youtube Link</th>
<th>Status</th>
<th>Action</th>
</thead>
   
    <tbody>
@foreach ($video as $order)


<tr><td>{!!@$order->id !!}</td>
     <td><?php $gcat=App\Models\Gcategory::where('id',@$order->gcat_id)->first();?>{{@$gcat->name }}</td>
     <td>{!!@$order->user !!}</td>
<td style="height: 100px; width:100px; border-radius: 5px;background: #ccc;padding:5px;"><video width="100" height="100" controls>
  <source src="{{@$order->video}}" type="video/mp4">
  <source src="{{@$order->video}}" type="video/ogg">
  
</video></td>
    <td style="height: 100px; width:100px; border-radius: 5px;background: #ccc;padding:5px;">{!!@$order->ylink!!}</td>
    
   
     <td> 
    @if(@$order->status==1)
    <a class="btn btn-primary btn-sm" href="{{url('admin/video/innotice/'.@$order->id)}}"><i class="fa fa-solid fa-toggle-on"></i></a>
    @else
    <a class="btn btn-dark  btn-sm"  href="{{url('admin/video/acnotice/'.@$order->id)}}"><i class="fa fa-thin fa-toggle-off"></i></a>
    @endif
    </td> 

<td>

        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{@$order->id}}" ><i class="fa fa-edit"></i></a>
        
         <div class="modal fade bd-example-modal-lg" id="edit{{@$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Video Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
   <form action="{{url('admin/video/update')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">

     <label>Category</label>
     
     <select name="Category" id="" class="form-control">
     @foreach($category as $cat)
        <option <?php if($cat->id==$order->gcat_id) echo"selected";?> value="{{$cat->id}}">{{$cat->name}}</option>
        @endforeach
     </select>
    </div>
<div class="form-group">
    <input type="hidden" name="id" class="form-control" value="{{$order->id}}" />

     <label>Upload Video</label>
     <input type="file" name="video" class="form-control" value="" />
     <span class=""> <video width="320" height="240" controls>
  <source src="{{@$order->video}}" type="video/mp4">
  <source src="{{@$order->video}}" type="video/ogg">
  
</video> </span>
    </div>
    <div class="form-group">
     <label>Youtube Link</label>
     <input type="text" name="ylink" class="form-control" value="" />
     <span>{!!@$order->ylink!!}</span>
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
        
        <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Video?');" href="{{ url('admin/video/destroy',$order->id) }}"><i class="fa fa-trash"></i></a>
       

</td>
 
</tr>

@endforeach
</tbody>
</table>
{{$video->links('pagination::bootstrap-4')}}
@endsection
@section('footer2')
<script type="text/javascript" src="{{asset('assets/login/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/login/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">
$('#sampleTable').DataTable();
</script>







@endsection