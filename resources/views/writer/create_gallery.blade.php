@extends('layouts.writer')
@section('contant')
<div class="" >

<p class="h5">Gallery Create</p>

<form action="{{url('writer/gallery/store')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">
    
     <label>Category</label>
     
     <select name="Category" id="" class="form-control">
     @foreach($category as $cat)
        <option value="{{$cat->id}}">{{$cat->name}}</option>
        @endforeach
     </select>
    </div>
    <div class="form-group">
     <label>Title</label>
     <input type="text" name="title" class="form-control" value="" require/>
    </div>
    <div class="form-group">
     <label>Description</label>
     <textarea name="description" id="txtEditorh" class="form-control textarea" ></textarea>
    </div>
   
    <div class="form-group">
     <label>Image </label>
     <input type="file" name="image" class="form-control" value="" />
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

