@extends('layouts.admin')
@section('contant')
<div class="" >

<p class="h5">Former Update</p>

<form action="{{url('admin/former/update/')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">
<input type="hidden" name="id" class="form-control" value="{{$former->id}}" />
     <label>Session</label>
      <input type="text" name="Session" class="form-control" value="{{$former->Session}}" require/>
     
    </div>
    <div class="form-group">
     <label>President Name</label>
     <input type="text" name="President_Name" class="form-control" value="{{$former->President_Name}}" require/>
    </div>
    <div class="form-group">
     <label>President Designation</label>
     <input type="text" name="President_Designation" class="form-control" value="{{$former->President_Designation}}" require/>
    </div>
    <div class="form-group">
     <label>President Image</label>
     <input type="file" name="President_Image" class="form-control" value="" />
     <span><img src="{{@$former->President_Image}}" style="height: 100px; width:100px;" alt="Responsive image"></span>
    </div>
   
   <div class="form-group">
     <label>Secretary Name</label>
     <input type="text" name="Secretary_Name" class="form-control" value="{{$former->Secretary_Name}}" require/>
    </div>
    <div class="form-group">
     <label>Secretary Designation</label>
     <input type="text" name="Secretary_Designation" class="form-control" value="{{$former->Secretary_Designation}}" require/>
    </div>
    <div class="form-group">
     <label>Secretary Image</label>
     <input type="file" name="Secretary_Image" class="form-control" value="" />
     <span><img src="{{@$former->Secretary_Image}}" style="height: 100px; width:100px;" alt="Responsive image"></span>
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

    


@endsection

