@extends('layouts.admin')
@section('contant')
<p class=" text-center text-info h4 "><i>Successes Lists</i></p>
<a class="btn btn-primary btn-sm" href="{{url('admin/successe/create')}}"> 
     New successes</a> 

<table class="table table-hover table-bordered" id="sampleTable">
    <thead>



<th>ID</th>
<th>User</th>
<th>Title</th>
<th>Note</th>

<th>Image</th>
<th>Status</th>
<th>Action</th>
</thead>
   
    <tbody>
@foreach ($massege as $order)


<tr>

   <td>{!!@$order->id !!}</td>
    
<td>{!!@$order->user !!}</td>
    <td>{{@$order->title }}</td>
    <td>{!!@$order->note !!}</td>
   
    <td><img src="{{@$order->image}}"style="height: 100px; width:100px; border-radius: 5px;background: #ccc;padding:5px;" alt="Responsive image"></td>
    <td> 
    @if(@$order->status==1)
    <a class="btn btn-primary btn-sm" href="{{url('admin/successe/innotice/'.@$order->id)}}"><i class="fa fa-solid fa-toggle-on"></i></a>
    @else
    <a class="btn btn-dark  btn-sm"  href="{{url('admin/successe/acnotice/'.@$order->id)}}"><i class="fa fa-thin fa-toggle-off"></i></a>
    @endif
    </td> 

<td>

        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{@$order->id}}" ><i class="fa fa-edit"></i></a>
        
        
        <div class="modal fade bd-example-modal-lg" id="edit{{@$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Committee Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
      <form action="{{url('admin/successe/update/')}}" method="post" enctype="multipart/form-data">
@csrf

    <div class="form-group">
        <input type="hidden" name="id" class="form-control" value="{{$order->id}}" />
     <label>Title</label>
     <input type="text" name="title" class="form-control" value="{{$order->title}}" require/>
    </div>
    <div class="form-group">
     <label>Note</label>
     <textarea name="note" id="txtEditorh" class="form-control " maxlength="500" >{!!$order->note!!}</textarea>
    </div>
    
    
    <div class="form-group">
     <label>Photo </label>
     <input type="file" name="photo" class="form-control" value="" />
     <span><img src="{{@$order->image}}" style="height: 100px; width:100px;" alt="Responsive image"></span>
    </div>
    <
        
    <div class="form-group">
     <input type="submit" name="send" class="btn btn-info" value="Submit" />
    </div>
    </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
            </div>
            </div>
        </div>
        </div>
        
        <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Successe?');" href="{{url('admin/successe/destroy/'.@$order->id)}}"><i class="fa fa-trash"></i></a>
        
       

</td>
 
</tr>

@endforeach
</tbody>
</table>
{{--{{$massege->links('pagination::bootstrap-4')}}--}}
@endsection
@section('footer2')
<script type="text/javascript" src="{{asset('assets/login/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/login/js/plugins/dataTables.bootstrap.min.js')}}"></script>








@endsection