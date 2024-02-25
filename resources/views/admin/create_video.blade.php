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
<p class="h5">Video Create</p>

<form action="{{url('admin/video/store')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">

     <label>Category</label>
     
     <select name="Category" id="" class="form-control">
     @foreach($category as $cat)
        <option  value="{{$cat->id}}">{{$cat->name}}</option>
        @endforeach
     </select>
    </div>
<div class="form-group">

     <label>Upload Video</label>
     <input type="file" name="video" class="form-control" value="" />
    </div>
    <div class="form-group">
     <label>Youtube Link (Embed link)</label>
     <input type="text" name="ylink" class="form-control" value="" />
    </div>
    
    <div class="form-group">
     <input type="submit" name="send" class="btn btn-info" value="Send" />
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

