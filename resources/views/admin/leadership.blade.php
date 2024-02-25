@extends('layouts.admin')
@section('contant')
<p class=" text-center text-info h4 "><i>Leadership Lists</i></p>
<a class="btn btn-primary btn-sm" href="{{url('admin/leadership/create')}}"> 
     New Leadership</a> 

<table class="table table-hover table-bordered" id="sampleTable">
    <thead>



  <th>ID</th>  
<th>Session</th>
<th>Name</th>
<th>BPSA Designation</th>
<th>Official designation</th>
<th>Note</th>

<th>Image</th>
<th>User </th>
<th>Status</th>
<th>Action</th>
</thead>
   
    <tbody>
@foreach ($massege as $order)


<tr>

    <td>{{@$order->id }}</td>
    
    <td>{{@$order->session }}</td>
    <td>{{@$order->name }}</td>
    <td>{{@$order->BPSA_Designation }}</td>
    <td>{{@$order->Official_designation }}</td>
    <td>{!!@$order->note !!}</td>
   
    <td><img src="{{@$order->photo}}" style="height: 100px; width:100px; border-radius: 5px;background: #ccc;padding:5px;" alt="Responsive image"></td>
    <td>{!!@$order->user !!}</td>
    <td> 
    @if(@$order->status==1)
    <a class="btn btn-primary btn-sm" href="{{url('admin/leadership/innotice/'.@$order->id)}}"><i class="fa fa-solid fa-toggle-on"></i></a>
    @else
    <a class="btn btn-dark  btn-sm"  href="{{url('admin/leadership/acnotice/'.@$order->id)}}"><i class="fa fa-thin fa-toggle-off"></i></a>
    @endif
    </td> 

<td>

        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{@$order->id}}" ><i class="fa fa-edit"></i></a>
        <div class="modal fade bd-example-modal-lg" id="edit{{@$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Leadership Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
       <form action="{{url('admin/leadership/update/')}}" method="post" enctype="multipart/form-data">
@csrf
    <div class="form-group">
     <label>Session</label>
     <input type="text" name="session" class="form-control" value="{{$order->session}}" />
    </div>
    <div class="form-group">
        <input type="hidden" name="id" class="form-control" value="{{$order->id}}" />
     <label>Name</label>
     <input type="text" name="name" class="form-control" value="{{$order->name}}" require/>
    </div>
     <div class="form-group">
     <label>BPSA Designation</label>
     <input type="text" name="BPSA_Designation" class="form-control" value="{{$order->BPSA_Designation}}" />
    </div>
    <div class="form-group">
     <label>Official designation</label>
     <input type="text" name="Official_designation" class="form-control" value="{{$order->Official_designation}}" />
    </div>
    <div class="form-group">
     <label>Note</label>
     <textarea name="note" id="txtEditorh" class="form-control textarea2" >{!!$order->note!!}</textarea>
    </div>
    
    
    <div class="form-group">
     <label>Photo </label>
     <input type="file" name="photo" class="form-control" value="" />
     <span><img src="{{@$order->photo}}" style="height: 100px; width:100px;" alt="Responsive image"></span>
    </div>
    
        
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
        
        
        <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Leadership?');" href="{{url('admin/leadership/destroy/'.@$order->id)}}"><i class="fa fa-trash"></i></a>
        
       

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