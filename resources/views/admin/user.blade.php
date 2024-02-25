@extends('layouts.admin')
@section('contant')

<div class="row">
    <div class="col-md-6">
        <h3>User LISTS</h3>
    </div>
    <div class="col-md-6 text-right">
    <a class="btn btn-primary btn-sm" href="{{url('admin/user/create')}}">  New User</a> 
    </div>
</div>

    

<table class="table table-hover table-bordered" id="sampleTable">
    <thead>


<th>ID</th>
    
<th>Name</th>
<th>Email </th>

<th>Status </th>
<th>Action</th>
</thead>
   
    <tbody>
@foreach ($users as $user)


<tr>
<td>
    {!!@$user->id !!}</td>
    <td>
    {!!@$user->name !!}</td>
    

    <td>{{@$user->email }}
   
   
    <td> 
    @if(@$user->is_admin==1)
    <span class="btn btn-sm btn-primary">Admin</span>
    @elseif(@$user->is_admin==2)
    <span class="btn btn-sm btn-info">Writer</span>
    @else
     <span class="btn btn-sm btn-dark">Editor</span>
    @endif
    </td> 

<td>

        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{@$user->id}}"><i class="fa fa-edit"></i></a>
        
        
        <div class="modal fade bd-example-modal-lg" id="edit{{@$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">User Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
<form action="{{url('admin/user/update/')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">
<input type="hidden" name="id" class="form-control" value="{{$user->id}}" />
     <label>Name</label>
      <input type="text" name="name" class="form-control" value="{{$user->name}}" require/>
     
    </div>
    <div class="form-group">
     <label> Email</label>
     <input type="text" name="email" class="form-control" value="{{$user->email}}" require/>
    </div>
     <div class="form-group">
     <label> Password</label>
     <input type="password" name="password" class="form-control" value="" require/>
    </div>
    <div class="form-group">
     <label>User Types</label>
     <select name="userType" class="form-control">
         <option value="">Select One</option>
         <option <?php if($user->is_admin==1) echo "selected" ;?> value="1">Admin</option>
         <option  <?php if($user->is_admin==2) echo "selected" ;?> value="2">Writer</option>
         <option <?php if($user->is_admin==3) echo "selected" ;?>  value="3">Editor</option>
     </select>
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
        
        <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this User?');" href="{{url('admin/user/destroy/'.@$user->id)}}"><i class="fa fa-trash"></i></a>
        
</td>
 
</tr>

@endforeach
</tbody>

</table>

@endsection
@section('footer2')
<script type="text/javascript" src="{{asset('assets/login/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/login/js/plugins/dataTables.bootstrap.min.js')}}"></script>









@endsection