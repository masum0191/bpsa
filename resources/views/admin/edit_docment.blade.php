@extends('layouts.admin')
@section('contant')
<div class="" >

<p class="h5">Document Update</p>

<form action="{{url('admin/docment/update')}}" method="post" enctype="multipart/form-data">
@csrf
   <div class="form-group">
     <label>Title</label>
      <input type="hidden" name="id" class="form-control" value="{{$docment->id}}" />
     <input type="text" name="title" class="form-control" value="{{$docment->title}}" />
    </div>
    <div class="form-group">
    
     <label>Summary</label>
     
     <input type="text" name="summary" class="form-control" value="{{$docment->summary}}" />
    </div>
    <div class="form-group">
     <label>File</label>
     <input type="file" name="file" class="form-control" value="" />
     <span><a class="" target="_blank" href="{{@$docment->file}}">{{@$docment->file}}</a></span>
    </div>
    <div class="form-group">
     <label>Cover Photo</label>
     <input type="file" name="c_photo" class="form-control" value="" require/>
     <span><img src="{{@$docment->c_photo}}" style="height: 100px; width:100px;" alt="Responsive image"></span>
    </div>
    
    
   
    
   
    <div class="form-group">
     <input type="submit" name="send" class="btn btn-info" value="Update" />
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

