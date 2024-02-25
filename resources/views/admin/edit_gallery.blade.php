@extends('layouts.admin')
@section('contant')
<div class="" >

<p class="h5">Gallery Update</p>

<form action="{{url('admin/gallery/update/')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">
<input type="hidden" name="id" class="form-control" value="{{$post->id}}" />
     <label>Category</label>
     
     <select name="Category" id="" class="form-control">
     @foreach($category as $cat)
        <option <?php if($cat->id==$post->gcat_id) echo"selected";?> value="{{$cat->id}}">{{$cat->name}}</option>
        @endforeach
     </select>
    </div>
    <div class="form-group">
     <label>title</label>
     <input type="text" name="title" class="form-control" value="{{$post->title}}" require/>
    </div>
    <div class="form-group">
     <label>Description</label>
     <textarea name="description" id="txtEditorh" class="form-control textarea2" >{!!$post->description!!}</textarea>
    </div>
    
    
    <div class="form-group">
     <label>Image </label>
     <input type="file" name="image" class="form-control" value="" />
     <span><img src="{{@$post->image}}" style="height: 100px; width:100px;" alt="Responsive image"></span>
    </div>
    <
        
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

