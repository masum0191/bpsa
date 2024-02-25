@extends('layouts.admin')
@section('contant')
<div class="" >
<!-- @if(Session::has('status'))
    <div class="alert alert-success">
        {{Session::get('status')}}
    </div>
@endif -->
<!-- @if (session('status'))
 <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
    </div>
                            @endif -->
<p class="h5">User Create</p>

<form action="{{url('admin/user/store/')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">
<input type="hidden" name="id" class="form-control" value="" />
     <label>Name</label>
      <input type="text" name="name" class="form-control" value="" require/>
     
    </div>
    <div class="form-group">
     <label> Email</label>
     <input type="text" name="email" class="form-control" value="" require/>
    </div>
    <div class="form-group">
     <label> Password</label>
     <input type="password" name="password" class="form-control" value="" require/>
    </div>
    <div class="form-group">
     <label>User Type</label>
     <select name="userType" class="form-control">
         <option value="">Select One</option>
         <option value="1">Admin</option>
         <option value="2">Writer</option>
         <option value="3">Editor</option>
     </select>
    </div>
   
    <div class="form-group">
     <input type="submit" name="send" class="btn btn-info" value="Submit" />
    </div>
    </form>
</div>





    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="pull-right">
        {{-- <a class="btn btn-primary" href="{{ route('itemCRUD.index') }}"> Back</a> --}}
    </div>


@endsection

