@extends('layouts.admin')
@section('contant')

<div class="row">
    <div class="col-md-6">
        <h3>FORMER LISTS</h3>
    </div>
    <div class="col-md-6 text-right">
    <a class="btn btn-primary btn-sm" href="{{url('admin/former/create')}}">  New Former</a> 
    </div>
</div>

    

<table class="table table-hover table-bordered" id="sampleTable">
    <thead>



<th>ID</th>
<th>Session</th>
<th>President </th>
<th>Secretary</th>
<th>User</th>
<th>Status </th>
<th>Action</th>
</thead>
   
    <tbody>
@foreach ($former as $order)


<tr>
<td>
    {!!@$order->id !!}</td>
    <td>
    {!!@$order->Session !!}</td>
    

    <td>{{@$order->President_Name }}
    <br>
    {{@$order->President_Designation }}
    <br>
    <img src="{{@$order->President_Image}}" style="height: 100px; width:100px;border-radius: 50%; background:#ccc;padding:5px;" alt="Responsive image">
    </td>
    <td>{{@$order->Secretary_Name }}
    <br>
    {{@$order->Secretary_Designation }}
    <br>
    <img src="{{@$order->Secretary_Image}}" style="height: 100px; width:100px;border-radius: 50%; background:#ccc;padding:5px;" alt="Responsive image">
    </td>
    <td>{!!@$order->user !!}</td>
    <td> 
    @if(@$order->status==1)
    <a class="btn btn-primary btn-sm" href="{{url('admin/former/innotice/'.@$order->id)}}"><i class="fa fa-solid fa-toggle-on"></i></a>
    @else
    <a class="btn btn-dark  btn-sm"  href="{{url('admin/former/acnotice/'.@$order->id)}}"><i class="fa fa-thin fa-toggle-off"></i></a>
    @endif
    </td> 

<td>

        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{@$order->id}}"><i class="fa fa-edit"></i></a>
        
        
        <div class="modal fade bd-example-modal-lg" id="edit{{@$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Former Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
      <form action="{{url('admin/former/update/')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">
<input type="hidden" name="id" class="form-control" value="{{$order->id}}" />
     <label>Session</label>
      <input type="text" name="Session" class="form-control" value="{{$order->Session}}" require/>
     
    </div>
    <div class="form-group">
     <label>President Name</label>
     <input type="text" name="President_Name" class="form-control" value="{{$order->President_Name}}" require/>
    </div>
    <div class="form-group">
     <label>President Designation</label>
     <input type="text" name="President_Designation" class="form-control" value="{{$order->President_Designation}}" require/>
    </div>
    <div class="form-group">
     <label>President Image</label>
     <input type="file" name="President_Image" class="form-control" value="" />
     <span><img src="{{@$order->President_Image}}" style="height: 100px; width:100px;" alt="Responsive image"></span>
    </div>
   
   <div class="form-group">
     <label>Secretary Name</label>
     <input type="text" name="Secretary_Name" class="form-control" value="{{$order->Secretary_Name}}" require/>
    </div>
    <div class="form-group">
     <label>Secretary Designation</label>
     <input type="text" name="Secretary_Designation" class="form-control" value="{{$order->Secretary_Designation}}" require/>
    </div>
    <div class="form-group">
     <label>Secretary Image</label>
     <input type="file" name="Secretary_Image" class="form-control" value="" />
     <span><img src="{{@$order->Secretary_Image}}" style="height: 100px; width:100px;" alt="Responsive image"></span>
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
        
        <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Former?');" href="{{url('admin/former/destroy/'.@$order->id)}}"><i class="fa fa-trash"></i></a>
        
</td>
 
</tr>

@endforeach
</tbody>

</table>
{{--{{$former->links('pagination::bootstrap-4')}}--}}
@endsection
@section('footer2')
<script type="text/javascript" src="{{asset('assets/login/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/login/js/plugins/dataTables.bootstrap.min.js')}}"></script>








@endsection